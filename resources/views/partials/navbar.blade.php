<nav class="sticky top-0 z-50 border-b border-slate-200/80 bg-white/80 backdrop-blur-lg transition-all duration-300">

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        <div class="flex h-20 items-center justify-between">

            {{-- LOGO --}}
            <a href="{{ route('home') }}"
               class="group flex items-center gap-3.5 transition-transform hover:scale-[1.01]">

                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50/80 p-2 ring-1 ring-blue-100 shadow-sm transition group-hover:bg-blue-100/80">
                    <img
                        src="{{ asset('images/logo.png') }}"
                        alt="DIGILIB STKIP"
                        class="h-9 w-auto object-contain"
                    >
                </div>

                <div>
                    <div class="text-lg font-extrabold tracking-tight text-slate-900 group-hover:text-blue-700 transition sm:text-xl">
                        DIGILIB <span class="text-blue-600">STKIP</span>
                    </div>

                    <div class="text-[10px] font-semibold tracking-widest text-slate-400 uppercase">
                        Digital Library
                    </div>
                </div>

            </a>


            {{-- DESKTOP MENU --}}
            <div class="hidden h-full items-center gap-1.5 lg:flex">

                <a
                    href="{{ route('home') }}"
                    class="px-4 py-2 rounded-xl text-sm font-semibold transition-all duration-200
                    {{ request()->routeIs('home')
                        ? 'bg-blue-50 text-blue-700 shadow-sm'
                        : 'text-slate-600 hover:text-blue-600 hover:bg-slate-50' }}"
                >
                    Beranda
                </a>

                <a
                    href="{{ route('documents.index') }}"
                    class="px-4 py-2 rounded-xl text-sm font-semibold transition-all duration-200
                    {{ request()->routeIs('documents.*') || request()->routeIs('pdf.viewer')
                        ? 'bg-blue-50 text-blue-700 shadow-sm'
                        : 'text-slate-600 hover:text-blue-600 hover:bg-slate-50' }}"
                >
                    Dokumen
                </a>

                <a
                    href="{{ route('categories.index') }}"
                    class="px-4 py-2 rounded-xl text-sm font-semibold transition-all duration-200
                    {{ request()->routeIs('categories.*')
                        ? 'bg-blue-50 text-blue-700 shadow-sm'
                        : 'text-slate-600 hover:text-blue-600 hover:bg-slate-50' }}"
                >
                    Kategori
                </a>

                <a
                    href="{{ route('about') }}"
                    class="px-4 py-2 rounded-xl text-sm font-semibold transition-all duration-200
                    {{ request()->routeIs('about')
                        ? 'bg-blue-50 text-blue-700 shadow-sm'
                        : 'text-slate-600 hover:text-blue-600 hover:bg-slate-50' }}"
                >
                    Tentang
                </a>

            </div>


            {{-- RIGHT SIDE --}}
            <div class="flex items-center gap-3">

                {{-- USER / LOGIN --}}
                @auth

                    <div class="relative hidden sm:block group">

                        <button
                            type="button"
                            class="flex items-center gap-2.5 rounded-xl bg-slate-900
                                   px-4 py-2.5 text-sm font-semibold text-white shadow-sm
                                   transition hover:bg-slate-800 hover:shadow-md"
                        >

                            <x-heroicon-o-user-circle class="h-5 w-5 shrink-0 text-blue-400" />

                            <span class="max-w-[130px] truncate md:max-w-[180px]">
                                {{ auth()->user()->name }}
                            </span>

                            <x-heroicon-o-chevron-down class="h-4 w-4 shrink-0 text-slate-400 group-hover:rotate-180 transition-transform duration-200" />

                        </button>

                        {{-- DROPDOWN --}}
                        <div
                            class="absolute right-0 top-full hidden w-60 pt-2 group-hover:block transition-all"
                        >

                            <div class="overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-2xl ring-1 ring-black/5">

                                <div class="border-b border-slate-100 bg-slate-50/50 px-4 py-3.5">
                                    <p class="truncate text-sm font-bold text-slate-900">
                                        {{ auth()->user()->name }}
                                    </p>

                                    <p class="truncate text-xs text-slate-500 font-medium mt-0.5">
                                        {{ auth()->user()->email }}
                                    </p>
                                </div>

                                <div class="p-1.5 space-y-0.5">
                                    <a
                                        href="{{ route('dashboard') }}"
                                        class="flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-medium text-slate-700 hover:bg-blue-50 hover:text-blue-700 transition"
                                    >
                                        <x-heroicon-o-squares-2x2 class="h-4 w-4 text-slate-400" />
                                        Dashboard
                                    </a>

                                    <a
                                        href="{{ route('profile.edit') }}"
                                        class="flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-medium text-slate-700 hover:bg-blue-50 hover:text-blue-700 transition"
                                    >
                                        <x-heroicon-o-user class="h-4 w-4 text-slate-400" />
                                        Profil Saya
                                    </a>

                                    <a
                                        href="{{ route('user.documents.create') }}"
                                        class="flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-medium text-slate-700 hover:bg-blue-50 hover:text-blue-700 transition"
                                    >
                                        <x-heroicon-o-cloud-arrow-up class="h-4 w-4 text-slate-400" />
                                        Upload Dokumen
                                    </a>
                                </div>

                                <div class="border-t border-slate-100 p-1.5">
                                    <form
                                        method="POST"
                                        action="{{ route('logout') }}"
                                    >
                                        @csrf

                                        <button
                                            type="submit"
                                            class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-left text-sm font-semibold text-red-600 hover:bg-red-50 transition"
                                        >
                                            <x-heroicon-o-arrow-right-on-rectangle class="h-4 w-4 text-red-500" />
                                            Logout
                                        </button>
                                    </form>
                                </div>

                            </div>
                        </div>

                    </div>

                @else

                    <a
                        href="{{ route('login') }}"
                        class="hidden items-center gap-2 rounded-xl bg-blue-600
                               px-5 py-2.5 text-sm font-semibold text-white shadow-sm
                               transition hover:bg-blue-700 hover:shadow-md sm:flex"
                    >
                        <x-heroicon-o-arrow-right-on-rectangle class="h-4 w-4" />
                        Masuk
                    </a>

                @endauth


                {{-- MOBILE HAMBURGER --}}
                <button
                    type="button"
                    id="mobileMenuButton"
                    class="inline-flex h-11 w-11 items-center justify-center
                           rounded-xl border border-slate-200 bg-white text-slate-700 shadow-sm
                           hover:bg-slate-50 hover:text-blue-600 transition lg:hidden"
                    aria-label="Buka menu"
                    aria-expanded="false"
                >
                    <x-heroicon-o-bars-3
                        id="mobileMenuOpenIcon"
                        class="h-6 w-6"
                    />

                    <x-heroicon-o-x-mark
                        id="mobileMenuCloseIcon"
                        class="hidden h-6 w-6"
                    />
                </button>

            </div>

        </div>


        {{-- MOBILE MENU --}}
        <div
            id="mobileMenu"
            class="hidden border-t border-slate-200/80 bg-white/95 backdrop-blur-md pb-6 pt-4 lg:hidden rounded-b-2xl shadow-xl transition-all"
        >

            <div class="space-y-1.5 px-2">

                <a
                    href="{{ route('home') }}"
                    class="block rounded-xl px-4 py-3 text-sm font-semibold transition
                    {{ request()->routeIs('home')
                        ? 'bg-blue-50 text-blue-700'
                        : 'text-slate-700 hover:bg-slate-100' }}"
                >
                    Beranda
                </a>

                <a
                    href="{{ route('documents.index') }}"
                    class="block rounded-xl px-4 py-3 text-sm font-semibold transition
                    {{ request()->routeIs('documents.*') || request()->routeIs('pdf.viewer')
                        ? 'bg-blue-50 text-blue-700'
                        : 'text-slate-700 hover:bg-slate-100' }}"
                >
                    Dokumen
                </a>

                <a
                    href="{{ route('categories.index') }}"
                    class="block rounded-xl px-4 py-3 text-sm font-semibold transition
                    {{ request()->routeIs('categories.*')
                        ? 'bg-blue-50 text-blue-700'
                        : 'text-slate-700 hover:bg-slate-100' }}"
                >
                    Kategori
                </a>

                <a
                    href="{{ route('about') }}"
                    class="block rounded-xl px-4 py-3 text-sm font-semibold transition
                    {{ request()->routeIs('about')
                        ? 'bg-blue-50 text-blue-700'
                        : 'text-slate-700 hover:bg-slate-100' }}"
                >
                    Tentang
                </a>

            </div>


            {{-- MOBILE USER MENU --}}
            <div class="mt-4 border-t border-slate-100 pt-4 px-2">

                @auth

                    <div class="mb-3 rounded-xl bg-slate-50 p-3">
                        <p class="truncate text-sm font-bold text-slate-900">
                            {{ auth()->user()->name }}
                        </p>

                        <p class="truncate text-xs text-slate-500 font-medium">
                            {{ auth()->user()->email }}
                        </p>
                    </div>

                    <div class="space-y-1">
                        <a
                            href="{{ route('dashboard') }}"
                            class="block rounded-xl px-4 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-100 transition"
                        >
                            Dashboard
                        </a>

                        <a
                            href="{{ route('profile.edit') }}"
                            class="block rounded-xl px-4 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-100 transition"
                        >
                            Profil Saya
                        </a>

                        <a
                            href="{{ route('user.documents.index') }}"
                            class="block rounded-xl px-4 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-100 transition"
                        >
                            Dokumen Saya
                        </a>

                        <a
                            href="{{ route('user.documents.create') }}"
                            class="block rounded-xl px-4 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-100 transition"
                        >
                            Upload Dokumen
                        </a>

                        <form
                            method="POST"
                            action="{{ route('logout') }}"
                        >
                            @csrf

                            <button
                                type="submit"
                                class="mt-2 block w-full rounded-xl bg-red-50 px-4 py-2.5
                                       text-left text-sm font-semibold text-red-600
                                       hover:bg-red-100 transition"
                            >
                                Logout
                            </button>
                        </form>
                    </div>

                @else

                    <a
                        href="{{ route('login') }}"
                        class="block rounded-xl bg-blue-600 px-4 py-3
                               text-center text-sm font-bold text-white shadow-sm
                               hover:bg-blue-700 transition"
                    >
                        Masuk ke Akun
                    </a>

                @endauth

            </div>

        </div>

    </div>

</nav>


<script>
    document.addEventListener('DOMContentLoaded', function () {

        const button = document.getElementById('mobileMenuButton');
        const menu = document.getElementById('mobileMenu');
        const openIcon = document.getElementById('mobileMenuOpenIcon');
        const closeIcon = document.getElementById('mobileMenuCloseIcon');

        if (!button || !menu) {
            return;
        }

        button.addEventListener('click', function () {

            const isOpen = !menu.classList.contains('hidden');

            menu.classList.toggle('hidden');

            openIcon?.classList.toggle('hidden');
            closeIcon?.classList.toggle('hidden');

            button.setAttribute(
                'aria-expanded',
                isOpen ? 'false' : 'true'
            );

        });

    });
</script>