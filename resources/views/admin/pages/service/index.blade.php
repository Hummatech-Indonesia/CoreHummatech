@extends('admin.layouts.app')

@section('subcontent')
<div class="card border-0 pt-4 mt-2 px-2">
    <div class="row">
        <div class="col-12 col-lg-4">
            <div class="d-flex align-items-center gap-2">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <form action="{{ route('service.index') }}" method="GET">
                        <input type="text" class="form-control" name="name" placeholder="Cari Layanan" aria-label="Username" value="{{ $search }}" aria-describedby="basic-addon1">
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-8">
            <div class="d-flex justify-content-lg-end justify-content-start">
                @include('admin.pages.service.create')
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')

    <div class="row">
        @forelse ($services as $service)
        <div class="col-xxl-3 col-md-4 col-sm-6">
            <div class="card border-1 rounded">
                <img src="{{ asset('storage/' . $service->image) }}" alt="Milink" class="rounded-top card-img-thumbnail" style="object-fit:cover; height: 200px; width: 100%;"/>
                <div class="card-header text-center h4 border-bottom text-primary"
                    style="margin-top: -1rem; border-radius: var(--bs-border-radius) var(--bs-border-radius) 0 0 !important;">
                    {{ $service->name }}</div>
                <div class="card-body">
                    <p>
                        {!! $service->short_description == null ? 
                            Str::words(html_entity_decode($service->description), 15, '') : 
                            $service->short_description !!}      
                    </p>

                    <div class="gap-2 d-flex">
                        <div class="d-grid flex-grow-1">
                            <a href="/detail/service/{{ $service->id }}" class="btn btn-light-primary btn-sm">Lihat Detail</a>
                        </div>
                        <div class="d-flex flex-shrink-0 gap-2">
                            <button class="btn btn-light-warning px-3 m-0 btn-edit btn-sm"  type="button" data-slug="{{ $service->slug }}" data-id="{{ $service->id }}" data-name="{{ $service->name }}" data-description="{{ $service->description }}" data-short_description="{{ $service->short_description }}" data-link="{{ $service->link }}" data-image="{{ $service->image }}"><i class="fas fa-pencil"></i></button>
                            <button class="btn px-3 btn-light-danger btn-delete btn-sm" data-id="{{ $service->id }}" type="button"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
            <div class="d-flex justify-content-center">
                <img src="{{ asset('assets/images/no-data.png') }}" alt="" width="400px">
            </div>
            <h5 class="text-center">
                Data Masih Kosong
            </h5>
        @endforelse
    </div>


<div class="modal fade modal-bookmark edit" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-semibold" id="exampleModalLabel">Edit Layanan</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form-bookmark needs-validation" method="POST" id="form-update" novalidate=""
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="form-group mb-3 mt-0 col-md-12">
                            <label for="image">Foto Layanan</label><br>
                            <img class="image-show mb-3" height="200px" class="mb-2">
                            <input class="form-control image-edit" id="image" type="file" name="image" required  />
                            @error('image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3 mt-0 col-md-12">
                            <label for="name">Nama Layanan</label>
                            <input class="form-control name-edit" id="name" name="name" type="text" required placeholder="Masukkan nama layanan" />
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3 mt-0 col-md-12">
                            <label for="slug">Slug</label>
                            <input class="form-control slug-edit" id="slug" name="slug" type="text" required placeholder="Masukkan slug" />
                            @error('slug')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="my-1">
                            <div class="d-flex justify-content-between">
                                <label for="shortDesciption" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Deskripsi singkat <span style="font-size: .6875rem"
                                    class="text-danger">*Wajib diisi</span>
                                </label>
                                <span class="count">
                                    Jumlah Karakter:
                                    <span class="char">0</span>
                                </span>
                            </div>
                            <div class="wysiwyg" style="height: 100px" oninput="Count()">{!! old('short_description') !!}</div>
                            <textarea name="short_description" id="short-description-edit" class="d-none wysiwyg-area shortDescription" placeholder="Jelaskan deskripsi produknya" oninput="Count()">{!! old('short_description') !!}</textarea>
                             @error('short_decription')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3 mt-0 col-md-12">
                            <label for="bm-title">Deskripsi Layanan</label>
                            <div id="editor2" class="description-edit" style="height: 300px">{!! old('description') !!}</div>
                            <textarea name="description" class="d-none" id="description-edit" cols="30" rows="10">{!! old('description') !!}</textarea>

                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3 mt-0 col-md-12">
                            <label for="link">Tautan Layanan <small class="text-danger">*Isi jika ada</small></label>
                            <input class="form-control link-edit" id="link" name="link" type="text" required placeholder="Masukkan tautan layanan" />
                            @error('link')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3 mt-0 col-md-12">
                            <label for="proposal">File Proposal <small>(opsional)</small></label>
                            <input class="form-control" id="proposal" name="proposal" type="file"/>
                            @error('proposal')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-light-danger" type="button" data-bs-dismiss="modal">Tutup</button>
                        <button class="btn btn-primary" type="submit">Perbarui</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@include('admin.components.delete-modal-component')
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{{ asset('assets/js/slick/slick.min.js') }}"></script>
<script src="{{ asset('assets/js/slick/slick.js') }}"></script>
<script src="{{ asset('assets/js/header-slick.js') }}"></script>
<script>
    $(document).ready(function() {
        let customToolbar = [
            ['bold', 'italic', 'underline', 'strike', 'blockquote'],
            ['link'],
            [{ 'color': [] }, { 'background': [] }],
            [{ 'font': [] }],
            [{ 'align': [] }],
            ['clean'],
        ];

        $('.wysiwyg').each(function() {
            let quill = new Quill(this, {
                theme: 'snow',
                placeholder: "Masukkan deskripsi",
                modules: {
                    toolbar: customToolbar
                }
            });

            quill.on('text-change', (eventName, ...args) => {
                $('.wysiwyg-area').val(quill.root.innerHTML);
            });
        });
    });
</script>
@if(session('success'))
<script>
    Swal.fire({
        title: 'Success',
        text: '{{ session('success') }}',
        icon: 'success',
        confirmButtonText: 'OK',
        timer: 2000, // Menutup SweetAlert setelah 3 detik
        timerProgressBar: true // Menampilkan progress bar
    });
</script>
@endif

<script>
    var customToolbar = [
        ['bold', 'italic', 'underline', 'strike', 'blockquote', 'image'],

        ['link'],

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
        placeholder: "Silahkan masukkan deskripsi layanan.",
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

                                    quill.insertEmbed(index, 'image',
                                        `{{ url('/storage') }}/${data.image}`);

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

    const quill2 = new Quill('#editor2', {
        theme: 'snow',
        placeholder: "Silahkan masukkan deskripsi layanan.",
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

                                    quill.insertEmbed(index, 'image',
                                        `{{ url('/storage') }}/${data.image}`);

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

    quill2.on('text-change', (eventName, ...args) => {
        $('#description-edit').val(quill2.root.innerHTML);
    });
</script>

<script>
    $('.btn-edit').on('click', function() {
        var id = $(this).data('id');
        var image = $(this).data('image');
        var name = $(this).data('name');
        var slug = $(this).data('slug');
        var short_description = $(this).data('short_description');
        var description = $(this).data('description');
        var link = $(this).data('link');
        quill2.root.innerHTML = description;
        $('#form-update').attr('action', '/service/' + id);
        $('.name-edit').val(name);
        $('#short-description-edit').val(short_description);
        console.log(short_description);
        $('.slug-edit').val(slug);
        $('.link-edit').val(link);
        $('.image-show').attr('src', 'storage/' + image);
        $('.edit').modal('show');
    });

    $('.btn-delete').on('click', function() {
        var id = $(this).data('id');
        $('#form-delete').attr('action', '/service/' + id);
        $('#modal-delete').modal('show');
    });
</script>

<script>
    function Count() {
        var shortDescriptions = $('.shortDescription');
        var charCounters = $('.char');
        var countDisplays = $('.count');

        shortDescriptions.each(function(index) {
            var shortDescription = $(this).val();
            charCounters.eq(index).html(shortDescription.length);
            if (shortDescription.length > 0 && shortDescription.length < 10) {
                countDisplays.eq(index).css('color', 'red');
            } else if (shortDescription.length >= 10 && shortDescription.length <= 100) {
                countDisplays.eq(index).css('color', 'green');
            } else {
                countDisplays.eq(index).css('color', 'red');
            }
        });
    }
</script>

@endsection
