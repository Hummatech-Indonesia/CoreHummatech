@extends('admin.layouts.app')

@section('content')
    <div class="py-3 my-3">
        <h4>Edit produk</h4>
    </div>
    <div class="card">
        <div class="card-body p-4 m-5">
            <form class="form-bookmark needs-validation" action="{{ route('product.update', $product->id) }}" method="POST"
                id="bookmark-form" novalidate="" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="type" value="service">
                <div class="row g-2">
                    <div class="form-group mb-3 mt-0 col-md-12">
                        <label for="name">Nama Produk <span class="text-danger">*</span></label>
                        <input class="form-control" name="name" value="{{ old('name', $product->name) }}" id="name"
                            type="text" required placeholder="Contoh: Produk Hummatech" autocomplete="name" />
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group mb-3 mt-0 col-md-12">
                        <label for="category">Kategori Produk <span class="text-danger">*</span></label>
                        <select name="category_product_id" class="js-example-basic-single form-select" id="#edit">
                            <option value="" disabled selected>Pilih Kategori</option>
                            @forelse ($categories as $category)
                                <option value="{{ $category->id }}"{{ old('category_product_id', $product->category_product_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @empty
                                <option value="" disabled selected>Kategori Masih Kosong</option>
                            @endforelse
                        </select>
                        @error('category_product_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group mb-3 mt-0 col-md-12">
                        <label for="description">Deskripsi <span class="text-danger">*</span></label>
                        <div class="wysiwyg" style="height: 200px">{!! old('description', $product->description) !!}</div>
                        <textarea name="description" class="d-none wysiwyg-area" id="description" cols="30" rows="10" placeholder="Jelaskan deskripsi produknya">{!! old('description', $product->description) !!}</textarea>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group mb-3 mt-0 col-md-12">
                        <label for="feature">Fitur <small class="text-danger">* Masukan Judul Fitur Beserta
                                Deskripsi</small></label>
                        <div class="d-flex align-items-center mt-3 gap-2">
                            <input type="hidden" name="id_feature[]" value="{{ $productfeatureFirst->id }}">
                            <input type="text" name="title[]" id=""
                                value="{{ old('title', $productfeatureFirst) }}" class="form-control"
                                placeholder="Masukan Judul Fitur">
                            <input class="form-control m-0" type="text" name="feature[]"
                                value="{{ old('description', $productfeatureFirst) }}" autocomplete="name"
                                placeholder="Masukan Deskripsi Fitur" />
                        </div>
                        <div id="product-listing">
                            @foreach ($productfeatures->skip(1) as $productfeature)
                                <input type="hidden" name="id_feature[]" value="{{ $productfeature->id }}">
                                <div class="d-flex align-items-center mt-3 gap-2" id="{{ $productfeature->id }}">
                                    <input class="form-control mb-0" type="text" name="title[]"
                                        value="{{ $productfeature->title }}" required="" autocomplete="name"
                                        placeholder="Masukan Judul Fitur" />
                                    <input class="form-control mb-0" type="text" name="feature[]" required=""
                                        autocomplete="name" value="{{ $productfeature->description }}"
                                        placeholder="Masukan Deskripsi Fitur" />
                                    <button onclick="deleteElement('{{ $productfeature->id }}')" type="button"
                                        class="btn delete-trigger px-3 mt-0 btn-danger"><i
                                            class="fas fa-trash"></i></button>
                                </div>
                            @endforeach
                        </div>
                        @error('feature.*')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        @error('title.*')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <button type="button" class="btn add-button-trigger btn-primary mt-3">Tambah Fitur</button>
                    </div>
                    <div class="form-group mb-3 mt-0 col-md-12">
                        <label for="link">Link <span class="text-danger">*</span></label>
                        <input class="form-control" id="link" type="url" name="link"
                            value="{{ old('link', $product->link) }}" required
                            placeholder="Contoh: https://hummatech.com/linknya" />
                        @error('link')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group mb-3 mt-0 col-md-12">
                        <label for="name">Tampilkan di <span class="text-danger">*</span></label>
                        <select name="service_id" class="js-example-basic-single form-select" id="">
                            @forelse ($services as $service)
                                <option value="{{ $service->id }}"
                                    {{ old('service_id', $product->service_id) == $service->id ? 'selected' : '' }}>
                                    {{ $service->name }}</option>
                            @empty
                                <option value="" disabled selected>Layanan Masih Kosong</option>
                            @endforelse
                        </select>
                        @error('service_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group mb-3 mt-0 col-md-12">
                        <label for="photo">Foto / Logo Produk</label>
                        <figure class="col-xl-3 col-md-4 col-6" itemprop="associatedMedia" itemscope="">
                            <img class="img-thumbnail" src="{{ asset('storage/' . $product->image) }}"
                                itemprop="thumbnail">
                        </figure>
                        <input class="form-control" id="photo" type="file" name="image" />
                        @error('image')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('product.index') }}" class="btn btn-light-danger mt-2" type="button">Kembali</a>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    @include('admin.components.delete-modal-component')
@endsection

@section('script')
<script src="{{ asset('assets/js/slick/slick.min.js') }}"></script>
<script src="{{ asset('assets/js/slick/slick.js') }}"></script>
<script src="{{ asset('assets/js/header-slick.js') }}"></script>
<script>
    $(document).ready(function() {
            let customToolbar = [
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

            $('.wysiwyg').each(function() {
                let quill = new Quill(this, {
                    theme: 'snow',
                    placeholder: "Masukkan deskripsi",
                    modules: {
                        toolbar: {
                            container: customToolbar,
                            handlers: {
                                'html': function() {
                                    var html = prompt('Edit HTML:', quill.root.innerHTML);
                                    if (html) {
                                        quill.root.innerHTML = html;
                                    }
                                }
                            }
                        }
                    }
                });

                quill.on('text-change', function() {
                    $('.wysiwyg-area').val(quill.root.innerHTML);
                });
            });
        });
</script>
    <script>
        const deleteElement = (id) => $('#' + id).remove();
        $('.btn-delete').click(function() {
            var id = $(this).data('id');
            $('#form-delete').attr('action', '/product/feature/' + id);
            $('#modal-delete').modal('show');
        });

        (() => {
            $('.add-fitur').click((e) => {
                let idInput = 'input_' + Math.random().toString(36).substr(2, 9); // Generate random id
                let target = $(e.target).parent().find('#product-listing');
                target.append(`<div class="d-flex align-items-center mt-3 gap-2" id="${idInput}">
                <input class="form-control mb-0" type="text" name="feature[]"
                    required="" autocomplete="name"
                    placeholder="Masukan Fitur" />
                <button onclick="deleteElement('${idInput}')" type="button" class="btn delete-trigger px-3 mt-0 btn-danger"><i
                        class="fas fa-trash"></i></button>
                </div>`);
            });

            $('.add-button-trigger').click((e) => {
                let idInput = 'input_' + Math.random().toString(36).substr(2, 9); // Generate random id
                let target = $(e.target).parent().find('#product-listing');
                target.append(`<div class="d-flex align-items-center mt-3 gap-2" id="${idInput}">
                <input class="form-control mb-0" type="text" name="title[]"
                    required="" autocomplete="name"
                    placeholder="Masukan Judul Fitur" />
                <input class="form-control mb-0" type="text" name="feature[]"
                    required="" autocomplete="name"
                    placeholder="Masukan Deskripsi Fitur" />
                <button onclick="deleteElement('${idInput}')" type="button" class="btn delete-trigger px-3 mt-0 btn-danger"><i
                        class="fas fa-trash"></i></button>
                </div>`);
            });
        })();
    </script>
@endsection
