<x-guest-layout>

    <div class="min-h-screen bg-slate-50 flex items-center justify-center px-4 py-10">

        <div class="w-full max-w-md">

            {{-- Brand --}}
            <div class="text-center mb-7">

                <img
                    src="{{ asset('images/logo.png') }}"
                    alt="Logo STKIP"
                    class="mx-auto h-20 w-auto"
                >

                <h1 class="mt-4 text-3xl font-bold text-blue-800">
                    DIGILIB STKIP
                </h1>

                <p class="mt-1 text-sm tracking-[0.2em] text-slate-500">
                    DIGITAL LIBRARY
                </p>

                <p class="mt-4 text-slate-500">
                    Masuk untuk mengakses dashboard pengguna.
                </p>

            </div>


            {{-- Card Login --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-lg">

                <x-auth-session-status
                    class="mb-4"
                    :status="session('status')"
                />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    {{-- Email --}}
                    <div>
                        <x-input-label
                            for="email"
                            value="Email"
                            class="font-semibold text-slate-700"
                        />

                        <x-text-input
                            id="email"
                            class="mt-2 block w-full rounded-xl border-slate-300 focus:border-blue-600 focus:ring-blue-600"
                            type="email"
                            name="email"
                            :value="old('email')"
                            required
                            autofocus
                            autocomplete="username"
                        />

                        <x-input-error
                            :messages="$errors->get('email')"
                            class="mt-2"
                        />
                    </div>


                    {{-- Password --}}
                    <div class="mt-5">
                        <x-input-label
                            for="password"
                            value="Password"
                            class="font-semibold text-slate-700"
                        />

                        <x-text-input
                            id="password"
                            class="mt-2 block w-full rounded-xl border-slate-300 focus:border-blue-600 focus:ring-blue-600"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                        />

                        <x-input-error
                            :messages="$errors->get('password')"
                            class="mt-2"
                        />
                    </div>


                    {{-- Remember --}}
                    <div class="mt-5">
                        <label
                            for="remember_me"
                            class="inline-flex items-center"
                        >
                            <input
                                id="remember_me"
                                type="checkbox"
                                class="rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500"
                                name="remember"
                            >

                            <span class="ms-2 text-sm text-slate-600">
                                Ingat saya
                            </span>
                        </label>
                    </div>


                    {{-- Actions --}}
                    <div class="mt-7 flex flex-col gap-3">

                        <button
                            type="submit"
                            class="w-full rounded-xl bg-blue-700 px-5 py-3
                                   font-semibold text-white transition
                                   hover:bg-blue-800"
                        >
                            Masuk
                        </button>

                        @if (Route::has('password.request'))

                            <a
                                href="{{ route('password.request') }}"
                                class="text-center text-sm font-medium text-blue-700 hover:text-blue-900"
                            >
                                Lupa password?
                            </a>

                        @endif

                    </div>

                </form>

            </div>


            {{-- Back Home --}}
            <div class="mt-6 text-center">

                <a
                    href="{{ route('home') }}"
                    class="inline-flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-blue-700"
                >
                    <x-heroicon-o-arrow-left class="h-4 w-4" />

                    Kembali ke Beranda
                </a>

            </div>

        </div>

    </div>

</x-guest-layout>