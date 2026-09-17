@extends('layouts.app')

@section('title', 'Edit Dokumen - DIGILIB STKIP')

@section('content')

<section class="min-h-screen bg-slate-50 py-10">

    <div class="max-w-4xl mx-auto px-6">

        <div class="mb-8">

            <h1 class="text-3xl font-bold text-slate-900">
                Edit Dokumen
            </h1>

            <p class="mt-2 text-slate-500">
                Perbarui dokumen kemudian kirim kembali untuk diverifikasi admin.
            </p>

        </div>

        <form
            method="POST"
            action="{{ route('user.documents.update', $document) }}"
            enctype="multipart/form-data"
            class="rounded-2xl border border-slate-200 bg-white p-7 shadow-sm"
        >

            @csrf
            @method('PUT')


            <div class="space-y-6">

                <div>

                    <label class="mb-2 block font-semibold text-slate-700">
                        Judul
                    </label>

                    <input
                        type="text"
                        name="judul"
                        value="{{ old('judul', $document->judul) }}"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3"
                        required
                    >

                </div>


                <div>

                    <label class="mb-2 block font-semibold text-slate-700">
                        Kategori
                    </label>

                    <select
                        name="category_id"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3"
                        required
                    >

                        @foreach($categories as $category)

                            <option
                                value="{{ $category->id }}"
                                @selected(
                                    old('category_id', $document->category_id)
                                    == $category->id
                                )
                            >
                                {{ $category->nama_kategori }}
                            </option>

                        @endforeach

                    </select>

                </div>

                <div>
                    <label
                        for="study_program_id"
                        class="block text-sm font-medium text-gray-700"
                    >
                        Program Studi
                        <span class="text-red-500">*</span>
                    </label>

                    <select
                        name="study_program_id"
                        id="study_program_id"
                        required
                        class="mt-1 block w-full rounded-lg border-gray-300
                            shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    >
                        <option value="">Pilih Program Studi</option>

                        @foreach ($studyPrograms as $prodi)
                            <option
                                value="{{ $prodi->id }}"
                                @selected(
                                    old('study_program_id', $document->study_program_id)
                                    == $prodi->id
                                )
                            >
                                {{ $prodi->nama_prodi }}
                            </option>
                        @endforeach
                    </select>

                    @error('study_program_id')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>

                    <label class="mb-2 block font-semibold text-slate-700">
                        Tahun Terbit
                    </label>

                    <input
                        type="number"
                        name="tahun_terbit"
                        value="{{ old('tahun_terbit', $document->tahun_terbit) }}"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3"
                        required
                    >

                </div>


                <div>

                    <label class="mb-2 block font-semibold text-slate-700">
                        Kata Kunci
                    </label>

                    <input
                        type="text"
                        name="kata_kunci"
                        value="{{ old('kata_kunci', $document->kata_kunci) }}"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3"
                    >

                </div>


                <div>

                    <label class="mb-2 block font-semibold text-slate-700">
                        Abstrak
                    </label>

                    <textarea
                        name="abstrak"
                        rows="8"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3"
                        required
                    >{{ old('abstrak', strip_tags($document->abstrak)) }}</textarea>

                </div>


                <div>

                    <label class="mb-2 block font-semibold text-slate-700">
                        Hak Akses
                    </label>

                    <select
                        name="access_type"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3"
                        required
                    >

                        <option
                            value="public"
                            @selected(
                                old('access_type', $document->access_type)
                                === 'public'
                            )
                        >
                            Public
                        </option>

                        <option
                            value="private"
                            @selected(
                                old('access_type', $document->access_type)
                                === 'private'
                            )
                        >
                            Private
                        </option>

                    </select>

                </div>


                <div class="grid gap-6 md:grid-cols-2">

                    <div>

                        <label class="mb-2 block font-semibold text-slate-700">
                            Ganti PDF
                        </label>

                        <input
                            type="file"
                            name="file_pdf"
                            accept="application/pdf"
                            class="w-full rounded-xl border border-slate-300 p-3"
                        >

                        <p class="mt-2 text-sm text-slate-500">
                            Kosongkan jika tidak ingin mengganti PDF.
                        </p>

                    </div>


                    <div>

                        <label class="mb-2 block font-semibold text-slate-700">
                            Ganti Cover
                        </label>

                        <input
                            type="file"
                            name="cover"
                            accept="image/*"
                            class="w-full rounded-xl border border-slate-300 p-3"
                        >

                        <p class="mt-2 text-sm text-slate-500">
                            Kosongkan jika tidak ingin mengganti cover.
                        </p>

                    </div>

                </div>

            </div>


            <div class="mt-8 flex justify-end gap-3">

                <a
                    href="{{ route('user.documents.index') }}"
                    class="rounded-xl border border-slate-300 px-5 py-3 font-semibold text-slate-700"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="rounded-xl bg-blue-700 px-6 py-3 font-semibold text-white hover:bg-blue-800"
                >
                    Simpan Perubahan
                </button>

            </div>

        </form>

    </div>

</section>

@endsection