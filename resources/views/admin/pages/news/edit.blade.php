@extends('admin.layouts.app')

@section('header-style')
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.css" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets_landing/dist/imageuploadify.min.css') }}" rel="stylesheet" />

    <style>
        .ql-toolbar button {
            padding: .5rem;
            bakcground: var(--bs-gray-200);
        }
    </style>
@endsection

@section('subcontent')
    <div class="page-title">
        <div class="d-flex justify-content-between">
            <h3>Ubah Data Berita</h3>
            <a href="/admin/news" class="btn btn-light">Kembali</a>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body add-post">
                        <form enctype="multipart/form-data" action="{{ route('news.update', $news->id) }}" class="form theme-form"
                            method="POST">
                            @csrf
                            @method('PUT')
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" class="mb-3 d-flex w-50 rounded-3" />
                                    <label for="thumbnail">Gambar Berita</label>
                                    <input id="thumbnail" type="file" name="image" class="form-control" accept="image/*" />
                                    @error('image')
                                        <div class="text-danger">{{ $message }}
                                        </div>
                                    @enderror
                                    @error('image.*')
                                        <div class="text-danger">{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label>Judul Berita</label>
                                    <input class="form-control" value="{{ old('title', $news->title) }}" type="text" name="title"
                                        placeholder="Mis: Peluncuran Humma Academy" />
                                    @error('title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                 <div class="mb-3">
                                    <div class="col-form-label">Kategori Berita (atau <a href="/category-news">Tambah baru</a>)
                                        @php
                                        $currentCategory = $news->newsCategories->pluck('category_id')->toArray();
                                    @endphp

                                    <select class="js-example-basic-multiple col-sm-12" multiple="multiple" name="category[]">
                                        @forelse ($categories as $category)
                                            <option {{ in_array($category->id, $currentCategory) ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                        @empty
                                            <option disabled>Belum ada kategori berita</option>
                                        @endforelse
                                    </select>
                                        @error('category')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label >Tanggal</label>
                                    <div class="col-sm-12">
                                        <input class="form-control digits" type="date" value="{{ old('date', $news->date) }}" name="date">
                                        @error('date')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label>Deskripsi Berita</label>
                                    <div id="editor" style="height: 500px">{!! old('description', $news->description) !!}</div>
                                    <textarea name="description" class="d-none" id="description" cols="30" rows="10">{!! old('description', $news->description) !!}</textarea>

                                    @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="justify-content-end d-flex align-items-center">
                                    <a class="btn btn-light-danger me-3" href="/admin/news">Tutup</a>
                                    <button type="submit" class="btn btn-send btn-primary">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <!-- Modal -->
    <div class="modal fade" id="uploadImageModal" tabindex="-1" aria-labelledby="uploadImageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="uploadImageModalLabel">Unggah Gambar Baru</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="image-uploader-form" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="image" class="form-label">Unggah Gambar</label>
                            <input class="form-control" type="file" name="image" id="image" />
                        </div>

                        <div class="mb-3">
                            <label for="alt" class="form-label">Deskripsi Gambar</label>
                            <input class="form-control" type="text" name="alt" id="alt" />
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" id="save-button-uploader" class="btn btn-primary">Unggah Gambar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>

    <script>
        $('.js-example-basic-single').on('select2:select', (e) => {
            var $this = $(e.target);
            if ($this.val() === 'add-new') {
                window.location.href = `/category-news`
            }
        });
    </script>

    <script>
        var customToolbar = [
            ['bold', 'italic', 'underline', 'strike', 'blockquote', 'image'],

            [{
                'color': []
            }, {
                'background': []
            }],
            [{
                'font': []
            }],
            [{
                'align': [],
            }],

            ['clean'],
        ];

        const quill = new Quill('#editor', {
            theme: 'snow',
            placeholder: "Silahkan masukkan deskripsi artikel.",

            modules: {
                toolbar: {
                    container: customToolbar,
                    handlers: {
                        image: () => {
                            $('#uploadImageModal').modal('show');

                            let $image = $('#image-uploader-form #image'),
                                formData = new FormData();

                            $image.change((e) => {
                                let filename = e.target.files[0].name;
                                $('#image-uploader-form #alt').val(filename);
                            });

                            $('#save-button-uploader').click((e) => {
                                e.preventDefault();

                                formData.append('image', $image[0].files[0]);
                                formData.append('_token', '{{ csrf_token() }}');

                                $.ajax({
                                    url: '{{ route('image-uploader') }}',
                                    type: 'POST',
                                    data: formData,
                                    processData: false,
                                    contentType: false,
                                    success: ({
                                        data
                                    }) => {
                                        let index = quill.getSelection() ? quill
                                            .getSelection().index : 0;

                                        quill.insertEmbed(index, 'image', `{{ url('/storage') }}/${data.image}`);

                                        $('#image-uploader-form').trigger('reset');
                                        $('#uploadImageModal').modal('hide');
                                    }
                                });
                            });
                        }
                    }
                }
            },
        });

        quill.on('text-change', (eventName, ...args) => {
            $('#description').val(quill.root.innerHTML);
        });
    </script>

    <script src="../assets/js/dropzone/dropzone.js"></script>
    <script src="../assets/js/dropzone/dropzone-script.js"></script>
@endsection
