<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    /**
     * Handle an incoming request and add standard security headers.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Mencegah MIME sniffing
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // Mencegah Clickjacking (iframe hanya diizinkan dari origin yang sama)
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');

        // Proteksi XSS pada browser lama
        $response->headers->set('X-XSS-Protection', '1; mode=block');

        // Kontrol referer information
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // Nonaktifkan fitur sensitif browser yang tidak digunakan
        $response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=()');

        return $response;
    }
}
