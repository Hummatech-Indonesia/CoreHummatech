@extends('admin.layouts.app')

@section('content')
    <div class="py-3 my-3">
        <h4>Edit produk</h4>
    </div>
    <div class="card">
        <div class="card-body p-4 m-5">
            <form class="form-bookmark needs-validation" action="{{ route('product-coming.update', $comingSoonProduct->id) }}" method="POST" id="bookmark-form"
                novalidate="" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="type" value="company">
                <div class="row g-2">
                    <div class="form-group mb-3 mt-0 col-md-12">
                        <label for="name">Nama Produk <span class="text-danger">*</span></label>
                        <input class="form-control" name="name" id="name" type="text" required
                            placeholder="Contoh: Produk Hummatech" autocomplete="name" value="{{ old('name', $comingSoonProduct->name) }}" />
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group mb-3 mt-0 col-md-12">
                        <label for="category">Kategori Produk <span class="text-danger">*</span></label>
                        <select name="category_product_id" class="js-example-basic-single form-select" id="#edit">
                            <option value="" disabled selected>Pilih Kategori</option>
                            @forelse ($categories as $category)
                                <option value="{{ $category->id }}"{{ old('category_product_id', $comingSoonProduct->category_product_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
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
                        <div class="wysiwyg" style="height: 200px">{!! old('description', $comingSoonProduct->description) !!}</div>
                        <textarea name="description" class="d-none wysiwyg-area" id="description" cols="30" rows="10" placeholder="Jelaskan deskripsi produknya">{!! old('description', $comingSoonProduct->description) !!}</textarea>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group mb-3 mt-0 col-md-12">
                        <label for="link">Link <span class="text-danger">*</span></label>
                        <input class="form-control" id="link" type="url" name="link" required
                            placeholder="Contoh: https://hummatech.com/linknya" value="{{ old('link', $comingSoonProduct->link) }}"/>
                        @error('link')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group mb-3 mt-0 col-md-12">
                        <label for="photo">Foto / Logo Produk</label>
                        <figure class="col-xl-3 col-md-4 col-6" itemprop="associatedMedia" itemscope="">
                            <img class="img-thumbnail" src="{{ asset('storage/'.$comingSoonProduct->image) }}" itemprop="thumbnail">
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
@endsection
