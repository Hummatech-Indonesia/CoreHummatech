@extends('admin.layouts.app')

@section('header-style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/sweetalert2.css') }}">
@endsection

@section('subcontent')
    <div class="py-1"></div>
    <div class="px-3 rounded-3 my-4 shadow-sm">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-7 p-0">
                    <h3>Berita</h3>
                </div>
                <div class="col-sm-5">
                    <div class="d-flex align-items-center">
                        <form action="/admin/news/">
                            <div class="d-flex align-items-center gap-2 justify-content-lg-end justify-content-start">
                                <p class="m-0">Cari:</p>&nbsp;
                                <input class="form-control me-2" name="title" value="{{ request()->title }}" type="text" placeholder="Search" aria-label="Search">
                            </div>
                        </form>
                        <a href="/admin/news/create" class="btn btn-primary">Tambah</a>&nbsp;
                        <a href="/news" class="btn btn-secondary w-50" target="_blank">Lihat Berita</a> &nbsp;
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
<div class="my-5">
    <ul class="simple-wrapper nav nav-tabs justify-content-between" id="myTab" role="tablist">
        <div class="d-flex">
            <li class="nav-item"><a class="nav-link active txt-primary" id="profile-tabs" data-bs-toggle="tab"
                    href="#berita" role="tab" aria-controls="profile" aria-selected="false">Berita</a></li>
            <li class="nav-item"><a class="nav-link txt-primary" id="contact-tab" data-bs-toggle="tab"
                    href="#draf" role="tab" aria-controls="contact" aria-selected="false">Draf</a>
            </li>
        </div>  
    </ul>

    <div class="product-grid">
        <div class="product-wrapper-grid">
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active py-3" id="berita" role="tabpanel">
                <div class="row">
                    @forelse ($news as $item)
                        <div class="col-xl-4 col-lg-4 col-sm-6">
                            <div class="card shadow-sm">
                                <div class="product-box">
                                    <div class="product-img">
                                        <img class="img-fluid" src="{{ asset('storage/' . ($item->thumbnail ?? '')) }}"
                                            alt="" style="object-fit:cover; width:242vw; height:20vh;">
                                    </div>
                                    <div class="product-details">
                                        <small style="font-size: 13px"><span
                                                class="text-primary mb-3 fw-bold"></span>{{ \Carbon\Carbon::parse($item['date'])->locale('id_ID')->isoFormat('dddd, D MMMM YYYY') }}</small>
                                        <a href="{{ route('news.show', $item->id) }}">
                                            <h4 class="mb-1 mt-3">{{ $item->title }}</h4>
                                        </a>
                                        <p class="mt-0 mb-2" style="font-size: 13px">{!! Str::words(strip_tags($item->description), 14, '...') !!}</p>
                                        <div class="d-flex gap-1 mb-3">
                                            @foreach ($item->newsCategories as $category)
                                                {{ $category->name }}
                                            @endforeach
                                        </div>
                                        
                                        <form action="{{ route('news.delete', $item->id) }}" id="form-{{ $item->id }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                        </form>
        
                                        <div class="gap-2 d-flex">
                                            <div class="d-grid flex-grow-1">
                                                <a href="{{ route('news.show', $item->id) }}" class="btn btn-sm btn-primary" type="button">Detail</a>
                                            </div>
                                            <div class="d-grid flex-grow-1">
                                                <button class="btn btn-sm btn-light-primary btn-draft" type="button"
                                                data-id="{{ $item->id }}">Jadikan draf</button>
                                            </div>
                                            <div class="d-flex flex-shrink-0 gap-2">
                                                <a href="{{ route('news.edit', $item->id) }}" style="background-color: #FFAA05; padding:6px 15px; border-radius: 5px; color: white" type="button"><i class="fa-solid fa-pen"></i></a>
                                                <a href="#" onclick="deleteDataConfirm('{{ $item->id }}')" style="background-color: #DC3545; padding:6px 15px; border-radius: 5px; color: white" type="button" title="hapus"><i class="fa-solid fa-trash-can"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="d-flex justify-content-center">
                            <img src="{{ asset('nodata.jpg') }}" alt="" width="400px">
                        </div>
                        <h5 class="text-center">
                            Data Masih Kosong
                        </h5>
                    @endforelse
                </div>
            </div>

            <div class="tab-pane fade py-3" id="draf" role="tabpanel" aria-labelledby="contact-tab">
                <div class="row">
                    @forelse ($drafts as $draft)
                    <div class="col-xxl-4 col-md-4 col-sm-6">
                        <div class="card border-1 rounded">
                            <img src="{{ asset('storage/' . $draft->image) }}" alt="Milink" class="rounded-top card-img-thumbnail" style="object-fit:cover; height: 200px; width: 100%;"/>
                            <div class="card-header text-center h4 border-bottom text-primary"
                                style="margin-top: -1rem; border-radius: var(--bs-border-radius) var(--bs-border-radius) 0 0 !important;">
                                {{ $draft->name }}</div>
                            <div class="card-body">
                                <p>
                                    {!! $draft->short_description == null ? 
                                        Str::words(html_entity_decode($draft->description), 15, '') : 
                                        $draft->short_description !!}      
                                </p>
            
                                <div class="gap-2 d-flex">
                                    <div class="d-grid flex-grow-1">
                                        <button class="btn btn-light-primary btn-publish btn-mini" type="button"
                                        data-id="{{ $draft->id }}">Publish</button>
                                    </div>
                                    <div class="d-flex flex-shrink-0 gap-2">
                                        <button class="btn px-3 btn-light-danger btn-delete" data-id="{{ $draft->id }}" type="button"><i class="fas fa-trash"></i></button>
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
                            Draf masih kosong
                        </h5>
                    @endforelse
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@include('admin.components.delete-modal-component')
@include('admin.components.draft-modal-component')
@include('admin.components.publish-modal-component')
    {{-- {{ $news->links() }} --}}
@endsection

@section('script')
    <script src="{{ asset('assets/js/sweet-alert/sweetalert.min.js') }}"></script>

    <script>
        function deleteDataConfirm($id) {
            swal({
                title: 'Apakah Anda Akan Menghapus Data Ini?',
                text: 'Data yang dihapus tidak dapat dikembalikan!',
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((e) => {
                if (e) {
                    $(`#form-${$id}`).submit();
                }
            });
        }
    </script>
    <script>
        $('.btn-draft').on('click', function() {
        var id = $(this).data('id');
        $('#form-draft').attr('action', '/admin/news/draft/' + id);
        $('#modal-draft').modal('show');
    });

    $('.btn-publish').on('click', function() {
        var id = $(this).data('id');
        $('#form-publish').attr('action', '/admin/news/publish/' + id);
        $('#modal-publish').modal('show');
    });

    $('.btn-delete').on('click', function() {
        var id = $(this).data('id');
        $('#form-delete').attr('action', '/admin/news/delete/' + id);
        $('#modal-delete').modal('show');
    });
    </script>
@endsection
