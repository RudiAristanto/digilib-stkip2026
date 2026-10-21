<footer class="mt-20 border-t border-slate-800 bg-[#0c1527] text-slate-300">

    <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 gap-8 md:grid-cols-12 lg:gap-12">

            {{-- Brand info --}}
            <div class="md:col-span-5 lg:col-span-6">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white/10 p-2 ring-1 ring-white/15">
                        <img
                            src="{{ asset('images/logo.png') }}"
                            alt="DIGILIB STKIP"
                            class="h-7 w-auto object-contain"
                        >
                    </div>

                    <span class="text-lg font-extrabold tracking-tight text-white">
                        DIGILIB <span class="text-amber-400">STKIP</span>
                    </span>
                </div>

                <p class="mt-3 max-w-md text-sm text-slate-400 leading-relaxed">
                    Sistem Repositori Digital resmi STKIP. Menyediakan akses terbuka terhadap karya ilmiah, skripsi, jurnal, dan publikasi penelitian akademik.
                </p>
            </div>

            {{-- Quick links --}}
            <div class="md:col-span-3 lg:col-span-3">
                <h4 class="text-xs font-bold uppercase tracking-wider text-white">
                    Navigasi Cepat
                </h4>

                <ul class="mt-3 space-y-2 text-sm text-slate-400">
                    <li>
                        <a href="{{ route('home') }}" class="hover:text-amber-300 transition">Beranda</a>
                    </li>
                    <li>
                        <a href="{{ route('documents.index') }}" class="hover:text-amber-300 transition">Koleksi Dokumen</a>
                    </li>
                    <li>
                        <a href="{{ route('categories.index') }}" class="hover:text-amber-300 transition">Kategori</a>
                    </li>
                    <li>
                        <a href="{{ route('about') }}" class="hover:text-amber-300 transition">Tentang Repositori</a>
                    </li>
                </ul>
            </div>

            {{-- Academic & Support --}}
            <div class="md:col-span-4 lg:col-span-3">
                <h4 class="text-xs font-bold uppercase tracking-wider text-white">
                    Layanan Perpustakaan
                </h4>

                <p class="mt-3 text-xs text-slate-400 leading-relaxed">
                    Untuk pertanyaan mengenai pengunggahan dokumen dan bantuan akun, silakan hubungi pengelola perpustakaan STKIP.
                </p>

                <div class="mt-3">
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-500/15 border border-emerald-500/30 px-3 py-1 text-xs font-semibold text-emerald-300">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                        Sistem Aktif & Terintegrasi
                    </span>
                </div>
            </div>

        </div>

        <div class="mt-10 border-t border-slate-800/80 pt-6 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-slate-400">
            <p>© {{ date('Y') }} DIGILIB STKIP. Seluruh hak cipta dilindungi.</p>
            <p class="text-slate-500">Dibangun untuk kemajuan riset & akademik</p>
        </div>

    </div>

</footer>