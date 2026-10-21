<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use setasign\Fpdi\Fpdi;

class PdfPageCounterService
{
    /**
     * Get the number of pages from a PDF file path (absolute or relative to disk) or raw content.
     */
    public static function countPages(string $filePath): ?int
    {
        // Check if path is absolute or exists directly
        $resolvedPath = file_exists($filePath) ? $filePath : null;

        // If not found, check in public storage disk
        if (! $resolvedPath && Storage::disk('public')->exists($filePath)) {
            $resolvedPath = Storage::disk('public')->path($filePath);
        }

        if (! $resolvedPath || ! file_exists($resolvedPath)) {
            return null;
        }

        // Method 1: FPDI parser
        try {
            $fpdi = new Fpdi();
            $pageCount = $fpdi->setSourceFile($resolvedPath);
            if ($pageCount && $pageCount > 0) {
                return (int) $pageCount;
            }
        } catch (\Throwable $e) {
            Log::debug('FPDI page count failed, falling back to regex: ' . $e->getMessage());
        }

        // Method 2: Fast regex parsing as fallback
        try {
            $content = @file_get_contents($resolvedPath);
            if ($content) {
                // Check /N attribute (often embedded in Linearized / metadata dictionary)
                if (preg_match('/\/N\s+([0-9]+)/', $content, $matches)) {
                    $val = (int) $matches[1];
                    if ($val > 0) {
                        return $val;
                    }
                }

                // Check /Count attribute in page tree root
                if (preg_match('/\/Type\s*\/Pages[^s].*?\/Count\s+([0-9]+)/s', $content, $matches)) {
                    $val = (int) $matches[1];
                    if ($val > 0) {
                        return $val;
                    }
                }

                // Check total /Type /Page occurrences
                if (preg_match_all('/\/Type\s*\/Page[^s]/', $content, $matches)) {
                    $val = count($matches[0]);
                    if ($val > 0) {
                        return $val;
                    }
                }
            }
        } catch (\Throwable $e) {
            Log::debug('Regex page count failed: ' . $e->getMessage());
        }

        return null;
    }
}
