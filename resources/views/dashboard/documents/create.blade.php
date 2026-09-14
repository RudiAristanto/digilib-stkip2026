@extends('layouts.app')

@section('title', 'Upload Dokumen - DIGILIB STKIP')

@section('content')

<section class="min-h-screen bg-slate-50 py-10">

    <div class="max-w-4xl mx-auto px-6">

        <div class="mb-8">

            <h1 class="text-3xl font-bold text-slate-900">
                Upload Dokumen
            </h1>

            <p class="mt-2 text-slate-500">
                Unggah karya ilmiah Anda untuk diverifikasi oleh admin.
            </p>

        </div>

        <form
            method="POST"
            action="{{ route('user.documents.store') }}"
            enctype="multipart/form-data"
            class="rounded-2xl border border-slate-200 bg-white p-7 shadow-sm">

            @csrf

            <div class="grid gap-6 md:grid-cols-2">

                {{-- Judul --}}
                <div class="md:col-span-2">

                    <label class="mb-2 block font-semibold text-slate-700">
                        Judul Dokumen
                    </label>

                    <input
                        type="text"
                        name="judul"
                        value="{{ old('judul') }}"
                        required
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-600 focus:ring-blue-600">

                    @error('judul')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Kategori --}}
                <div>

                    <label class="mb-2 block font-semibold text-slate-700">
                        Kategori
                    </label>

                    <select
                        name="category_id"
                        required
                        class="w-full rounded-xl border border-slate-300 px-4 py-3">

                        <option value="">
                            Pilih Kategori
                        </option>

                        @foreach($categories as $category)

                            <option
                                value="{{ $category->id }}"
                                @selected(old('category_id') == $category->id)>

                                {{ $category->nama_kategori }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Penulis --}}

                    <div>

                        <label class="mb-2 block font-semibold text-slate-700">
                            Penulis
                        </label>

                        <div
                            class="w-full rounded-xl border border-slate-300 bg-slate-100 px-4 py-3">

                            <div class="font-semibold text-slate-800">
                                {{ $author->nama_penulis }}
                            </div>

                            <div class="mt-1 text-sm text-slate-500">
                                {{ $author->email }}
                            </div>

                        </div>

                        <p class="mt-2 text-sm text-slate-500">
                            Penulis otomatis mengikuti akun yang sedang login.
                        </p>

                    </div>


                {{-- Tahun --}}
                <div>

                    <label class="mb-2 block font-semibold text-slate-700">
                        Tahun Terbit
                    </label>

                    <input
                        type="number"
                        name="tahun_terbit"
                        value="{{ old('tahun_terbit', now()->year) }}"
                        required
                        class="w-full rounded-xl border border-slate-300 px-4 py-3">

                </div>


                {{-- Access --}}
                <div>

                    <label class="mb-2 block font-semibold text-slate-700">
                        Hak Akses
                    </label>

                    <select
                        name="access_type"
                        required
                        class="w-full rounded-xl border border-slate-300 px-4 py-3">

                        <option value="public">
                            Public
                        </option>

                        <option value="private">
                            Private
                        </option>

                    </select>

                </div>


                {{-- Kata Kunci --}}
                <div class="md:col-span-2">

                    <label class="mb-2 block font-semibold text-slate-700">
                        Kata Kunci
                    </label>

                    <input
                        type="text"
                        name="kata_kunci"
                        value="{{ old('kata_kunci') }}"
                        placeholder="Contoh: Laravel, Sistem Informasi, Pendidikan"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3">

                </div>


                {{-- Abstrak --}}
                <div class="md:col-span-2">

                    <label class="mb-2 block font-semibold text-slate-700">
                        Abstrak
                    </label>

                    <textarea
                        name="abstrak"
                        rows="7"
                        required
                        class="w-full rounded-xl border border-slate-300 px-4 py-3">{{ old('abstrak') }}</textarea>

                </div>


                {{-- PDF --}}
                <div>

                    <label class="mb-2 block font-semibold text-slate-700">
                        File PDF
                    </label>

                    <input
                        type="file"
                        name="file_pdf"
                        accept="application/pdf"
                        required
                        class="w-full rounded-xl border border-slate-300 p-3">

                    <p class="mt-2 text-sm text-slate-500">
                        PDF maksimal 50 MB.
                    </p>

                </div>


                {{-- Cover --}}
                <div>

                    <label class="mb-2 block font-semibold text-slate-700">
                        Cover
                    </label>

                    <input
                        type="file"
                        name="cover"
                        accept="image/*"
                        class="w-full rounded-xl border border-slate-300 p-3">

                    <p class="mt-2 text-sm text-slate-500">
                        JPG, PNG, atau WEBP. Maksimal 2 MB.
                    </p>

                </div>

            </div>


            <div class="mt-8 flex justify-end gap-3">

                <a
                    href="{{ route('dashboard') }}"
                    class="rounded-xl border border-slate-300 px-5 py-3 font-semibold text-slate-700 hover:bg-slate-50">

                    Batal

                </a>

                <button
                    type="submit"
                    class="rounded-xl bg-blue-700 px-6 py-3 font-semibold text-white hover:bg-blue-800">

                    Upload Dokumen

                </button>

            </div>

        </form>

    </div>

</section>

@endsection