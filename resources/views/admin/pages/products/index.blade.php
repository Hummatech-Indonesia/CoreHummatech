@extends('admin.layouts.app')

@section('subcontent')
    <div class="d-flex justify-content-between align-items-end pt-4">
        {{-- <div class="col-12 col-lg-3">
            <label for="kategori">Pilih kategori</label>
            <select class="form-select" aria-label="Default select example">
                <option>Semua</option>
                @forelse ($services as $service)
                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                @empty
                    <option value="">Belum ada kategori produk</option>
                @endforelse
            </select>
        </div> --}}
        <form action="/product">
            <div class="col-12 col-lg-7">
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input type="text" name="name" value="{{ request()->name }}" class="form-control"
                    placeholder="Cari Produk" aria-label="Username" aria-describedby="basic-addon1">
                </div>
            </div>
        </form>
        <div class=" col-12 col-lg-5 gap-2 d-flex justify-content-end">
            <a href="/data/product" class="btn btn-secondary col-4" target="_blank">Lihat Produk</a>
            <a href="{{ route('product.create') }}" class="btn btn-primary">Tambah Produk</a>
        </div>
    </div>
@endsection

@section('content')
    <div class="row py-5">
        @if($products->isEmpty() && $comingProducts->isEmpty())
            <div class="d-flex justify-content-center">
                <img src="{{ asset('nodata.jpg') }}" alt="" width="400px">
            </div>
            <h5 class="text-center">
                Data Masih Kosong
            </h5>
        @else
            @foreach($comingProducts as $comingProduct)
                <div class="col-lg-3">
                    <div class="card border-0 shadow rounded ribbon-wrapper-right">
                        <div class="ribbon ribbon-primary ribbon-clip-right ribbon-right" style="margin-bottom: -30px">Coming soon!</div>
                        <img src="{{ asset('storage/' . $comingProduct->image) }}" alt="{{ $comingProduct->name }}"
                            style="object-fit: cover; width: 100%; height: 200px" class="rounded-top card-img-thumbnail position-relative" />
                        <div class="card-header text-center h4 border-bottom"
                            style="margin-top: -1rem; border-radius: var(--bs-border-radius) var(--bs-border-radius) 0 0 !important;">
                            {{ $comingProduct->name }}</div>
                        <div class="card-body">
                            <p>{{ Str::limit($comingProduct->description, 80) }}</p>

                            <div class="gap-2 d-flex">
                                <div class="d-grid flex-grow-1">
                                    <button type="button" class="btn btn-light-primary btn-mini btn-detail" 
                                    data-id="{{ $comingProduct->id }}" 
                                    data-name="{{ $comingProduct->name }}"
                                    data-category="{{ $comingProduct->CategoryProduct->name }}"
                                    data-description="{!! $comingProduct->description !!}"
                                    data-link="{{ $comingProduct->link }}"
                                    data-image="{{ asset('storage/'. $comingProduct->image) }}">Lihat
                                        Detail</button>
                                </div>
                                <div class="d-flex flex-shrink-0 gap-2">
                                    <button class="btn btn-light-warning px-3 m-0 btn-edit" type="button"
                                        onclick="window.location.href='{{ route('product-coming.edit', $comingProduct->id) }}'">
                                        <i class="fas fa-pencil"></i>
                                    </button>
                                    <button class="btn btn-light-danger px-3 m-0 btn-delete-coming" type="button"
                                        data-id="{{ $comingProduct->id }}"><i class="fas fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            @foreach($products as $product)
                <div class="col-lg-3">
                    <div class="card border-0 shadow rounded">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                            style="object-fit: cover; width: 100%; height: 200px" class="rounded-top card-img-thumbnail" />
                        <div class="card-header text-center h4 border-bottom"
                            style="margin-top: -1rem; border-radius: var(--bs-border-radius) var(--bs-border-radius) 0 0 !important;">
                            {{ $product->name }}</div>
                        <div class="card-body">
                            <p>{!! Str::words(html_entity_decode($product->description), 80, '') !!}</p>

                            <div class="gap-2 d-flex">
                                <div class="d-grid flex-grow-1">
                                    <a href="{{ route('product.show', $product->id) }}"
                                        class="btn btn-light-primary btn-mini">Lihat
                                        Detail</a>
                                </div>
                                <div class="d-flex flex-shrink-0 gap-2">
                                    <button class="btn btn-light-warning px-3 m-0 btn-edit" type="button"
                                        onclick="window.location.href='{{ $product->type == 'company' ? route('productCompany.edit', $product->id) : route('product.edit', $product->id) }}'">
                                        <i class="fas fa-pencil"></i>
                                    </button>
                                    <button class="btn btn-light-danger px-3 m-0 btn-delete" type="button"
                                        data-id="{{ $product->id }}"><i class="fas fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <div class="modal fade modal-bookmark" id="detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content px-2">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title me-2" id="exampleModalLabel">Detail Produk</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12 d-flex justify-content-between" id="detail-content">
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="d-flex justify-content-end">
                        <button class="purchase-btn btn btn-hover-effect btn-light-danger text-white f-w-500" type="button" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.components.delete-modal-component')
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    @if (session('success'))
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
         $('.btn-detail').click(function() {
            var detail = $('#detail-content');
            detail.empty();
            var id = $(this).data('id');
            var name = $(this).data('name'); 
            var category = $(this).data('category'); 
            var link = $(this).data('link'); 
            var description = $(this).data('description'); 
            var image = $(this).data('image');

            detail.append('<div class="left"> <h2>'+name+'</h2> <p class="text-primary">'+link+'</p> <p class="text-muted">Kategori: '+category+'</p> <div class="my-1"> <p>'+description+'</p> </div> </div> <div class="right"> <img src="'+image+'" width="100%" </div>');
            $('#detail').modal('show');
        });

        $('.btn-delete').on('click', function() {
            var id = $(this).data('id');
            $('#form-delete').attr('action', '/product/' + id);
            $('#modal-delete').modal('show');
        });

        $('.btn-delete-coming').on('click', function() {
            var id = $(this).data('id');
            $('#form-delete').attr('action', '/coming-soon-product/' + id);
            $('#modal-delete').modal('show');
        });
    </script>

    <script>
        function previewImage(event) {
            var input = event.target;
            var previewImage = document.getElementById('image-edit');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewImage.style.display = 'block';
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <script>
        function preview(event) {
            var input = event.target;
            var previewImage = document.getElementById('image-preview');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewImage.style.display = 'block';
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <script>
        const deleteElement = (id) => $('#' + id).remove();

        $('.add-button-trigger').click((e) => {
            let idInput = 'input_' + Math.random().toString(36).substr(2, 9); // Generate random id
            let target = $(e.target).parents('.modal').find('#product-listing');
            target.append(`<div class="d-flex align-items-center mt-3 gap-2" id="${idInput}">
                <input class="form-control" type="text" name="fiturs[]" autocomplete="name" placeholder="Jelaskan fitur produknya" />
                <button onclick="deleteElement('${idInput}')" type="button" class="btn delete-trigger px-3 mt-0 btn-danger"><i
                        class="fas fa-trash"></i></button>
            </div>`);
        });

        $('.btn-close').click((e) => {
            let target = $(e.target).parent('.modal').find('.delete-trigger');
            target.each((i, el) => $(el).click());
        });
    </script>
@endsection
