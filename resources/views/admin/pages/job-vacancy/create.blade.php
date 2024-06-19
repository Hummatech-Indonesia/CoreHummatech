@extends('admin.layouts.app')
@section('header-style')
    <style>
        .img-empty {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 400px;
            overflow: hidden;
            background: #eeeeee;
            border-radius: var(--bs-border-radius-xl);
            overflow: hidden;
        }

        .img-empty .upload-img {
            height: 300px;
            width: 100%;
        }
    </style>
@endsection
@section('subcontent')
    <div class="page-title">
        <div class="d-flex justify-content-between">
            <h3>Lowongan baru</h3>
            <a href="{{ route('job-vacancy.index') }}" class="btn btn-light">Kembali</a>
        </div>
    </div>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body add-post">
                    <form action="{{ route('job-vacancy.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-sm-12">
                            <div class="form-group mb-3">
                                <div class="fw-bold mb-2">Preview</div>
                                <div class="img-empty">
                                    <img src="{{ asset('blank-img.jpg') }}" id="upload-img" alt="Upload Placeholder" />
                                </div>
                            </div>
                
                            <div class="mb-3 form-group">
                                <label for="upload">Flyer <small class="text-danger">*Wajib Diisi</small></label>
                                <input type="file" id="upload" name="image" class="form-control" accept="image/*" onchange="readURL(this)" />
                                <small class="text-danger">Ekstensi yang diperbolehkan: png, jpg, jpeg</small>
                                @error('image')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="name">Posisi <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" id="name" placeholder="Masukan posisi">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <div class="col col-sm-5">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="Masukkan email">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col col-sm-4">
                                <label for="benefit">Nomor whatsApp <span class="text-danger">*</span></label>
                                <input type="text" name="whatsapp" class="form-control" value="{{ old('whatsapp') }}" placeholder="Masukkan nomor whatsApp yang bisa dihubungi pelamar">
                                @error('whatsapp')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col col-sm-3">
                                <div class="d-flex gap-3" style="margin-top: 35px">
                                    <label for="status">Status lowongan: <span class="text-danger">*</span></label>
                                    <div class="">
                                        <label for="active">Aktif</label>
                                        <input type="radio" name="status" id="active" value="active" checked>
                                    </div>
                                    <div class="">
                                        <label for="nonactive">Tidak Aktif</label>
                                        <input type="radio" name="status" id="nonactive" value="nonactive">
                                    </div>
                                </div>
                                @error('status')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="description">Deskripsi <span class="text-danger">*</span></label>
                            <div class="wysiwyg" id="description-editor" style="height: 150px">{!! old('description') !!}</div>
                            <textarea name="description" class="d-none wysiwyg-area" id="description" cols="30" rows="10" placeholder="Masukkan deskripsi lowongan">{!! old('description') !!}</textarea>
                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="qualification">Kualifikasi <span class="text-danger">*</span></label>
                            <div class="wysiwyg" id="qualification-editor" style="height: 150px">{!! old('qualification') !!}</div>
                            <textarea name="qualification" class="d-none wysiwyg-area" id="qualification" cols="30" rows="10" placeholder="Masukkan kualifikasi lowongan">{!! old('qualification') !!}</textarea>
                            @error('qualification')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="text-end">
                            <a class="btn btn-light-danger me-3" href="{{ route('job-vacancy.index') }}">Kembali</a>
                            <button type="submit" class="btn btn-send btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        var customToolbar = [
            [{ 'font': [] }],
            [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
            ['bold', 'italic', 'underline', 'strike', 'blockquote'],
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            [{ 'script': 'sub'}, { 'script': 'super' }],
            [{ 'indent': '-1'}, { 'indent': '+1' }],
            [{ 'direction': 'rtl' }],
            [{ 'color': [] }, { 'background': [] }],
            [{ 'align': [] }],
            ['link'],
            ['clean'],
            ['code-block'],
            [{ 'html': 'HTML' }]
        ];

        const desc = new Quill('#description-editor', {
            theme: 'snow',
            placeholder: "Masukkan deskripsi lowongan",
            modules: {
                toolbar: {
                    container: customToolbar,
                }
            },
        });
        desc.on('text-change', (eventName, ...args) => {
            $('#description').val(desc.root.innerHTML);
        });

        const qual = new Quill('#qualification-editor', {
            theme: 'snow',
            placeholder: "Masukkan deskripsi lowongan",
            modules: {
                toolbar: {
                    container: customToolbar,
                }
            },
        });
        qual.on('text-change', (eventName, ...args) => {
            $('#qualification').val(qual.root.innerHTML);
        });
    </script>

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#upload-img').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
