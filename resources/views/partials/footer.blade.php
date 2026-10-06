<footer class="mt-20 border-t border-slate-200/80 bg-white">

    <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 gap-8 md:grid-cols-12 lg:gap-12">

            {{-- Brand info --}}
            <div class="md:col-span-5 lg:col-span-6">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 p-2 ring-1 ring-blue-100">
                        <img
                            src="{{ asset('images/logo.png') }}"
                            alt="DIGILIB STKIP"
                            class="h-7 w-auto object-contain"
                        >
                    </div>

                    <span class="text-lg font-extrabold tracking-tight text-slate-900">
                        DIGILIB <span class="text-blue-600">STKIP</span>
                    </span>
                </div>

                <p class="mt-3 max-w-md text-sm text-slate-500 leading-relaxed">
                    Sistem Repositori Digital resmi STKIP. Menyediakan akses terbuka terhadap karya ilmiah, tugas akhir, dan publikasi penelitian akademik.
                </p>
            </div>

            {{-- Quick links --}}
            <div class="md:col-span-3 lg:col-span-3">
                <h4 class="text-xs font-bold uppercase tracking-wider text-slate-900">
                    Navigasi Cepat
                </h4>

                <ul class="mt-3 space-y-2 text-sm text-slate-600">
                    <li>
                        <a href="{{ route('home') }}" class="hover:text-blue-600 transition">Beranda</a>
                    </li>
                    <li>
                        <a href="{{ route('documents.index') }}" class="hover:text-blue-600 transition">Koleksi Dokumen</a>
                    </li>
                    <li>
                        <a href="{{ route('categories.index') }}" class="hover:text-blue-600 transition">Kategori</a>
                    </li>
                    <li>
                        <a href="{{ route('about') }}" class="hover:text-blue-600 transition">Tentang Repositori</a>
                    </li>
                </ul>
            </div>

            {{-- Academic & Support --}}
            <div class="md:col-span-4 lg:col-span-3">
                <h4 class="text-xs font-bold uppercase tracking-wider text-slate-900">
                    Layanan Perpustakaan
                </h4>

                <p class="mt-3 text-xs text-slate-500 leading-relaxed">
                    Untuk pertanyaan mengenai pengunggahan dokumen dan bantuan akun, silakan hubungi pengelola perpustakaan.
                </p>

                <div class="mt-3">
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700 ring-1 ring-emerald-600/20">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        Sistem Aktif & Terintegrasi
                    </span>
                </div>
            </div>

        </div>

        <div class="mt-10 border-t border-slate-100 pt-6 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-slate-400">
            <p>© {{ date('Y') }} DIGILIB STKIP. Seluruh hak cipta dilindungi.</p>
            <p>Dibangun untuk kemajuan riset & akademik</p>
        </div>

    </div>

</footer>