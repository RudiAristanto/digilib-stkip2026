<nav class="sticky top-0 z-50 border-b border-slate-200 bg-white">

    <div class="mx-auto max-w-7xl px-4 sm:px-6">

        <div class="flex h-20 items-center justify-between">

            {{-- LOGO --}}
            <a href="{{ route('home') }}"
               class="flex items-center gap-3">

                <img
                    src="{{ asset('images/logo.png') }}"
                    alt="DIGILIB STKIP"
                    class="h-12 w-auto"
                >

                <div>
                    <div class="text-lg font-bold leading-tight text-blue-800 sm:text-xl">
                        DIGILIB STKIP
                    </div>

                    <div class="text-[10px] tracking-[0.22em] text-slate-500 sm:text-xs">
                        DIGITAL LIBRARY
                    </div>
                </div>

            </a>


            {{-- DESKTOP MENU --}}
            <div class="hidden h-full items-center gap-8 lg:flex">

                <a
                    href="{{ route('home') }}"
                    class="flex h-full items-center border-b-2 transition
                    {{ request()->routeIs('home')
                        ? 'border-blue-600 font-semibold text-blue-600'
                        : 'border-transparent text-slate-700 hover:text-blue-600' }}"
                >
                    Beranda
                </a>

                <a
                    href="{{ route('documents.index') }}"
                    class="flex h-full items-center border-b-2 transition
                    {{ request()->routeIs('documents.*') || request()->routeIs('pdf.viewer')
                        ? 'border-blue-600 font-semibold text-blue-600'
                        : 'border-transparent text-slate-700 hover:text-blue-600' }}"
                >
                    Dokumen
                </a>

                <a
                    href="{{ route('categories.index') }}"
                    class="flex h-full items-center border-b-2 transition
                    {{ request()->routeIs('categories.*')
                        ? 'border-blue-600 font-semibold text-blue-600'
                        : 'border-transparent text-slate-700 hover:text-blue-600' }}"
                >
                    Kategori
                </a>

                <!-- <a
                    
                    class="flex h-full items-center border-b-2 transition
                    {{ request()->routeIs('authors.*')
                        ? 'border-blue-600 font-semibold text-blue-600'
                        : 'border-transparent text-slate-700 hover:text-blue-600' }}"
                >
                    Penulis
                </a> -->

                <a
                    href="{{ route('about') }}"
                    class="flex h-full items-center border-b-2 transition
                    {{ request()->routeIs('about')
                        ? 'border-blue-600 font-semibold text-blue-600'
                        : 'border-transparent text-slate-700 hover:text-blue-600' }}"
                >
                    Tentang
                </a>

            </div>


            {{-- RIGHT SIDE --}}
            <div class="flex items-center gap-2">

                {{-- USER / LOGIN --}}
                @auth

                    <div class="relative hidden sm:block group">

                        <button
                            type="button"
                            class="flex items-center gap-2 rounded-xl bg-blue-600
                                   px-3 py-2 text-sm font-semibold text-white
                                   transition hover:bg-blue-700
                                   md:px-4 md:py-2.5"
                        >

                            <x-heroicon-o-user-circle class="h-5 w-5 shrink-0" />

                            <span class="max-w-[130px] truncate md:max-w-[180px]">
                                {{ auth()->user()->name }}
                            </span>

                            <x-heroicon-o-chevron-down class="h-4 w-4 shrink-0" />

                        </button>

                        {{-- DROPDOWN --}}
                        <div
                            class="absolute right-0 top-full hidden w-56 pt-2 group-hover:block"
                        >

                            <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-xl">

                                <div class="border-b border-slate-100 px-4 py-3">
                                    <p class="truncate text-sm font-semibold text-slate-900">
                                        {{ auth()->user()->name }}
                                    </p>

                                    <p class="truncate text-xs text-slate-500">
                                        {{ auth()->user()->email }}
                                    </p>
                                </div>

                                <a
                                    href="{{ route('dashboard') }}"
                                    class="flex items-center gap-3 px-4 py-3 text-sm text-slate-700 hover:bg-slate-50 hover:text-blue-600"
                                >
                                    <x-heroicon-o-squares-2x2 class="h-5 w-5" />
                                    Dashboard
                                </a>

                                <a
                                    href="{{ route('profile.edit') }}"
                                    class="flex items-center gap-3 px-4 py-3 text-sm text-slate-700 hover:bg-slate-50 hover:text-blue-600"
                                >
                                    <x-heroicon-o-user-circle class="h-5 w-5" />
                                    Profil Saya
                                </a>

                                <a
                                    href="{{ route('user.documents.create') }}"
                                    class="flex items-center gap-3 px-4 py-3 text-sm text-slate-700 hover:bg-slate-50 hover:text-blue-600"
                                >
                                    <x-heroicon-o-cloud-arrow-up class="h-5 w-5" />
                                    Upload Dokumen
                                </a>

                                <form
                                    method="POST"
                                    action="{{ route('logout') }}"
                                    class="border-t border-slate-100"
                                >
                                    @csrf

                                    <button
                                        type="submit"
                                        class="flex w-full items-center gap-3 px-4 py-3 text-left text-sm text-red-600 hover:bg-red-50"
                                    >
                                        <x-heroicon-o-arrow-right-on-rectangle class="h-5 w-5" />
                                        Logout
                                    </button>
                                </form>

                            </div>
                        </div>

                    </div>

                @else

                    <a
                        href="{{ route('login') }}"
                        class="hidden items-center gap-2 rounded-xl bg-blue-600
                               px-4 py-2.5 text-sm font-semibold text-white
                               transition hover:bg-blue-700 sm:flex"
                    >
                        <x-heroicon-o-user class="h-5 w-5" />
                        Login
                    </a>

                @endauth


                {{-- MOBILE HAMBURGER --}}
                <button
                    type="button"
                    id="mobileMenuButton"
                    class="inline-flex h-10 w-10 items-center justify-center
                           rounded-lg border border-slate-200 text-slate-700
                           hover:bg-slate-50 lg:hidden"
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
            class="hidden border-t border-slate-200 pb-4 pt-3 lg:hidden"
        >

            <div class="space-y-1">

                <a
                    href="{{ route('home') }}"
                    class="block rounded-lg px-3 py-2.5 text-sm font-semibold
                    {{ request()->routeIs('home')
                        ? 'bg-blue-50 text-blue-700'
                        : 'text-slate-700 hover:bg-slate-50' }}"
                >
                    Beranda
                </a>

                <a
                    href="{{ route('documents.index') }}"
                    class="block rounded-lg px-3 py-2.5 text-sm font-semibold
                    {{ request()->routeIs('documents.*') || request()->routeIs('pdf.viewer')
                        ? 'bg-blue-50 text-blue-700'
                        : 'text-slate-700 hover:bg-slate-50' }}"
                >
                    Dokumen
                </a>

                <a
                    href="{{ route('categories.index') }}"
                    class="block rounded-lg px-3 py-2.5 text-sm font-semibold
                    {{ request()->routeIs('categories.*')
                        ? 'bg-blue-50 text-blue-700'
                        : 'text-slate-700 hover:bg-slate-50' }}"
                >
                    Kategori
                </a>

                <!-- <a
                    
                    class="block rounded-lg px-3 py-2.5 text-sm font-semibold
                    {{ request()->routeIs('authors.*')
                        ? 'bg-blue-50 text-blue-700'
                        : 'text-slate-700 hover:bg-slate-50' }}"
                >
                    Penulis
                </a> -->

                <a
                    href="{{ route('about') }}"
                    class="block rounded-lg px-3 py-2.5 text-sm font-semibold
                    {{ request()->routeIs('about')
                        ? 'bg-blue-50 text-blue-700'
                        : 'text-slate-700 hover:bg-slate-50' }}"
                >
                    Tentang
                </a>

            </div>


            {{-- MOBILE USER MENU --}}
            <div class="mt-3 border-t border-slate-200 pt-3">

                @auth

                    <div class="mb-2 px-3">
                        <p class="truncate text-sm font-semibold text-slate-900">
                            {{ auth()->user()->name }}
                        </p>

                        <p class="truncate text-xs text-slate-500">
                            {{ auth()->user()->email }}
                        </p>
                    </div>

                    <a
                        href="{{ route('dashboard') }}"
                        class="block rounded-lg px-3 py-2.5 text-sm text-slate-700 hover:bg-slate-50"
                    >
                        Dashboard
                    </a>

                    <a
                        href="{{ route('profile.edit') }}"
                        class="block rounded-lg px-3 py-2.5 text-sm text-slate-700 hover:bg-slate-50"
                    >
                        Profil Saya
                    </a>

                    <a
                        href="{{ route('user.documents.index') }}"
                        class="block rounded-lg px-3 py-2.5 text-sm text-slate-700 hover:bg-slate-50"
                    >
                        Dokumen Saya
                    </a>

                    <a
                        href="{{ route('user.documents.create') }}"
                        class="block rounded-lg px-3 py-2.5 text-sm text-slate-700 hover:bg-slate-50"
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
                            class="mt-1 block w-full rounded-lg px-3 py-2.5
                                   text-left text-sm font-semibold text-red-600
                                   hover:bg-red-50"
                        >
                            Logout
                        </button>
                    </form>

                @else

                    <a
                        href="{{ route('login') }}"
                        class="block rounded-lg bg-blue-600 px-4 py-2.5
                               text-center text-sm font-semibold text-white
                               hover:bg-blue-700"
                    >
                        Login
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