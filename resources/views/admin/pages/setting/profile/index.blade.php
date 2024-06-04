@extends('admin.layouts.app')

@section('subcontent')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="d-flex justify-content-between">
                    <h3>profile perusahaan</h3>
                    <a href="/about/profile" class="btn btn-secondary w75" target="_blank">Lihat Profile</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="py-3">
        <div class="row">
            @if ($errors->all())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                        {{ $error }}
                    </div>
                @endforeach
            @endif

            @forelse ($profile as $profil)
                <div class="col-sm-12">
                    <div class="card card-body">
                        <form action="{{ route('update.profile', $profil->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="rounded-3 p-4 position-relative">
                                        <img src="{{ asset('storage/' . $profil->image) }}"
                                            style="object-fit: cover; width: 100%;" class="img-fluid" alt="Logo">
                                    </div>
                                    <div class="my-1 mb-4">
                                        <label for="image">Foto Profil</label>
                                        <input type="file" class="form-control" name="image">
                                        @error('image')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="my-1 mb-2">
                                        <label for="proposal">Proposal Perusahaan</label>
                                        <input type="url" value="{{ old('proposal', $profil->proposal) }}" class="form-control" name="proposal">
                                        @error('proposal')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="pt-3 d-flex gap-4">
                                        <div>
                                            <input type="radio" id="whatsapp" name="type" {{ $profil->type == 'wa' ? 'checked' : '' }} value="wa">
                                            <label for="whatsapp">Set WhatsApp</label>
                                        </div>
                                        <div>
                                            <input type="radio" id="telpon" name="type" {{ $profil->type == 'telp' ? 'checked' : '' }} value="telp">
                                            <label for="telpon">Set Telepon</label>
                                        </div>
                                    </div>
                                    <div id="telponInputEdit" class="mb-4">
                                        <input type="tel" class="form-control" id="phoneNumberEdit" name="phone" value="{{ old('phone', $profil->phone) }}" placeholder="Masukkan nomor telepon">
                                    </div>

                                    <div class="my-1">
                                        <label for="call">Email</label>
                                        <input type="email" class="form-control" name="email" placeholder="Email"
                                            value="{{ old('email', $profil->email) }}">
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="mt-1 mb-4">
                                        <label for="headline">Judul <span style="font-size: .6875rem"
                                                class="text-danger">*Wajib
                                                diisi</span></label>
                                        <input type="text" class="form-control" id="headline" name="title"
                                            value="{{ old('title', $profil->title) }}">
                                            @error('title')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="my-1 mb-4">
                                        <div class="d-flex justify-content-between">
                                            <label for="shortDesciption" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                Deskripsi singkat <span style="font-size: .6875rem"
                                                class="text-danger">*Wajib diisi</span>
                                            </label>
                                            <span id="count">
                                                Jumlah Karakter:
                                                <span id="char">0</span>
                                            </span>
                                        </div>
                                        <div class="wysiwyg" style="height: 100px" oninput="Count()">{!! old('subtitle', $profil->subtitle) !!}</div>
                                        <textarea name="subtitle" id="shortDescription" class="d-none wysiwyg-area" placeholder="Jelaskan deskripsi produknya" oninput="Count()">{!! old('subtitle', $profil->subtitle) !!}</textarea>
                                         @error('subtitle')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="my-1 mb-4">
                                        <label for="deskripsi">Deskripsi <span style="font-size: .6875rem"
                                                class="text-danger">*Wajib diisi</span></label>
                                        <div id="editor" style="height: 12.5rem">{!! $profil->description !!}</div>
                                        <textarea name="description" class="d-none description-hidden" id=" deskripsi" cols="30" rows="10">{!! old('description', $profil->description) !!}</textarea>
                                        @error('description')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="my-1">
                                        <label for="address">Alamat <span style="font-size: .6875rem" class="text-danger">*Wajib diisi</span></label>
                                        <div class="wysiwyg-address" style="height: 100px">{!! old('address', $profil->address) !!}</div>
                                        <textarea name="address" id="address" class="d-none wysiwyg-area-address" placeholder="Jelaskan deskripsi produknya">{!! old('address', $profil->address) !!}</textarea>
                                        @error('address')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-primary float-end">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            @empty

                <div class="col-sm-12">
                    <div class="card card-body">
                        <form action="{{ route('store.profile') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="rounded-3 p-4 position-relative">

                                        <!-- Kontainer untuk menampilkan gambar -->
                                        <div id="imageContainer">
                                            <img src="../assets/images/Figure.png" id="selectedImage"
                                                style="object-fit: cover; width: 100%;" class="img-fluid" alt="Logo">
                                        </div>
                                    </div>
                                    <div class="my-1 mb-4">
                                        <label for="image">Foto Profil</label>
                                        <input type="file" id="inputImage" class="form-control" name="image"
                                            accept="image/*" onchange="displayImage(event)">
                                        @error('image')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="my-1 mb-2">
                                        <label for="proposal">Proposal Perusahaan</label>
                                        <input type="url" class="form-control" name="proposal">
                                        @error('proposal')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="pt-3 d-flex gap-4">
                                        <div>
                                            <input type="radio" id="whatsapp" name="type" value="wa">
                                            <label for="whatsapp">Set WhatsApp</label>
                                        </div>
                                        <div>
                                            <input type="radio" id="telpon" name="type" value="telp">
                                            <label for="telpon">Set Telepon</label>
                                        </div>
                                    </div>
                                    <div id="telponInput" class="mb-4">
                                        <input type="tel" class="form-control" id="phoneNumber" name="phone" value="{{ old('phone') }}" placeholder="Masukkan nomor telepon">
                                        @error('phone')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="my-1">
                                        <label for="call">Email</label>
                                        <input type="email" class="form-control" name="email" placeholder="Email"
                                            value="{{ old('email') }}">
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="mt-1 mb-4">
                                        <label for="headline">Judul <span style="font-size: .6875rem"
                                                class="text-danger">*Wajib diisi</span></label>
                                        <input type="text" class="form-control" id="headline" name="title"
                                            value="{{ old('title') }}" placeholder="Masukkan Judul">
                                        @error('title')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="my-1 mb-4">
                                        <div class="d-flex justify-content-between">
                                            <label for="shortDesciption" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                Deskripsi singkat <span style="font-size: .6875rem"
                                                class="text-danger">*Wajib diisi</span>
                                            </label>
                                            <span id="count">
                                                Jumlah Karakter:
                                                <span id="char">0</span>
                                            </span>
                                        </div>
                                        <div class="wysiwyg" style="height: 100px" oninput="Count()">{!! old('subtitle') !!}</div>
                                       <textarea name="subtitle" id="shortDescription" class="d-none wysiwyg-area" placeholder="Jelaskan deskripsi produknya" oninput="Count()">{!! old('subtitle') !!}</textarea>
                                        @error('subtitle')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="my-1 mb-4">
                                        <label for="deskripsi">Deskripsi <span style="font-size: .6875rem"
                                                class="text-danger">*Wajib diisi</span></label>
                                        <div id="editor" style="height: 12.5rem">{!! old('description') !!}</div>
                                        <textarea name="description" class="d-none description-hidden" id="description" cols="30" rows="10">{!! old('description') !!}</textarea>
                                        @error('description')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="my-1">
                                        <label for="address">Alamat <span style="font-size: .6875rem" class="text-danger">*Wajib diisi</span></label>
                                        <div class="wysiwyg-address" style="height: 100px">{!! old('address') !!}</div>
                                        <textarea name="address" id="address" class="d-none wysiwyg-area-address" placeholder="Jelaskan deskripsi produknya">{!! old('address') !!}</textarea>
                                        @error('address')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-primary float-end">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @endforelse
        </div>

    </div>

    <div class="modal fade" id="uploadImageModal" tabindex="-1" aria-labelledby="uploadImageModalLabel"
        aria-hidden="true">
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
@endsection

@section('script')
    <script src="../assets/js/slick/slick.min.js"></script>
    <script src="../assets/js/slick/slick.js"></script>
    <script src="../assets/js/header-slick.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
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
        $(document).ready(function() {
            let customToolbar = [
                ['bold', 'italic', 'underline', 'strike', 'blockquote'],
                ['link'],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'font': [] }],
                [{ 'align': [] }],
                ['clean'],
            ];

            $('.wysiwyg-address').each(function() {
                let quill = new Quill(this, {
                    theme: 'snow',
                    placeholder: "Masukkan alamat lengkap",
                    modules: {
                        toolbar: customToolbar
                    }
                });

                quill.on('text-change', (eventName, ...args) => {
                    $('.wysiwyg-area-address').val(quill.root.innerHTML);
                });
            });
        });
    </script>

    <script>
        function displayImage(event) {
            const input = event.target;
            const imageContainer = document.getElementById('imageContainer');
            const selectedImage = document.getElementById('selectedImage');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    selectedImage.src = e.target.result;
                };

                reader.readAsDataURL(input.files[0]);

                imageContainer.style.display = 'block';
            } else {
                imageContainer.style.display = 'none';
            }
        }
    </script>

    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>

    <script>
        var targetTags = new Tagify(document.getElementById('tags'));
    </script>

    <script>
        function formatPhone(event) {
            const phoneInput = event.target;
            const inputText = phoneInput.value.trim();

            // Menghapus karakter selain angka
            const phoneNumber = inputText.replace(/\D/g, '');

            // Mengatur awalan menjadi "+62"
            let formattedPhone = "+62";

            // Menghapus angka 0 setelah "+62"
            formattedPhone += phoneNumber.substr(2).replace(/^0+/, '');

            // Memperbarui nilai input dengan nomor telepon yang diformat
            phoneInput.value = formattedPhone;
        }
    </script>


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
            placeholder: "Silahkan masukkan deskripsi perusahaan.",
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
            $('.description-hidden').val(quill.root.innerHTML);
        });
    </script>

    <script>
        function Count() {
            var shortDescription = $('#shortDescription').val();
            $('#char').html(shortDescription.length);
            if (shortDescription.length > 0 && shortDescription.length < 50) {
                $('#count').css('color', 'red');
            } else if (shortDescription.length > 50 && shortDescription.length < 255) {
                $('#count').css('color', 'green');
            } else {
                $('#count').css('color', 'red');
            }
        }
    </script>
@endsection
