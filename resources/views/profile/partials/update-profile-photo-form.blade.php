<section>

    <header>
        <h2 class="text-xl font-bold text-slate-900">
            Foto Profil Penulis
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Upload atau ganti foto yang akan ditampilkan pada profil penulis.
        </p>
    </header>


    @if(auth()->user()->author)

        <form
            method="POST"
            action="{{ route('profile.photo.update') }}"
            enctype="multipart/form-data"
            class="mt-6 space-y-6"
        >

            @csrf
            @method('PATCH')


            {{-- FOTO --}}
            <div class="flex items-center gap-5">

                @if(auth()->user()->author->foto)

                    <img
                        id="photo-preview"
                        src="{{ asset('storage/' . auth()->user()->author->foto) }}?v={{ auth()->user()->author->updated_at->timestamp }}"
                        alt="{{ auth()->user()->author->nama_penulis }}"
                        class="h-24 w-24 rounded-full object-cover shadow"
                    >

                @else

                    <div
                        id="photo-placeholder"
                        class="flex h-24 w-24 items-center justify-center rounded-full bg-gray-100"
                    >
                        <svg
                            class="h-10 w-10 text-gray-400"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.5"
                                d="M15.75 6a3.75 3.75 0 11-7.5 0
                                   3.75 3.75 0 017.5 0zM4.5
                                   20.118a7.5 7.5 0 0115 0A17.933
                                   17.933 0 0112 21.75c-2.676
                                   0-5.216-.584-7.5-1.632z"
                            />
                        </svg>
                    </div>

                    <img
                        id="photo-preview"
                        src=""
                        alt="Preview Foto"
                        class="hidden h-24 w-24 rounded-full object-cover shadow"
                    >

                @endif


                <div>
                    <p class="font-medium text-gray-900">
                        {{ auth()->user()->author->nama_penulis }}
                    </p>

                    <p class="mt-1 text-sm text-gray-500">
                        JPG, PNG atau WebP • Maks. 2 MB
                    </p>
                </div>

            </div>


            {{-- INPUT FOTO --}}
            <div>

                <x-input-label
                    for="foto"
                    value="Pilih Foto"
                />

                <input
                    id="foto"
                    name="foto"
                    type="file"
                    accept="image/jpeg,image/png,image/webp"
                    class="mt-2 block w-full text-sm text-gray-600"
                >

                <x-input-error
                    class="mt-2"
                    :messages="$errors->get('foto')"
                />

            </div>


            <div class="flex items-center gap-4">

                <x-primary-button>
                    Simpan Foto
                </x-primary-button>

                @if(session('success'))
                    <p class="text-sm text-green-600">
                        {{ session('success') }}
                    </p>
                @endif

            </div>

        </form>

    @else

        <div class="mt-6 rounded-lg bg-yellow-50 p-4 text-sm text-yellow-700">
            Akun Anda belum terhubung dengan data penulis.
        </div>

    @endif

</section>


<script>
    document.addEventListener('DOMContentLoaded', function () {

        const input = document.getElementById('foto');
        const preview = document.getElementById('photo-preview');
        const placeholder = document.getElementById('photo-placeholder');

        if (!input || !preview) {
            return;
        }

        input.addEventListener('change', function (event) {

            const file = event.target.files[0];

            if (!file) {
                return;
            }

            preview.src = URL.createObjectURL(file);
            preview.classList.remove('hidden');

            if (placeholder) {
                placeholder.classList.add('hidden');
            }

        });

    });
</script>