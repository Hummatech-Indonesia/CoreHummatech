@extends('admin.layouts.app')

@section('subcontent')
    <div class="py-3 my-3">
        <a href="{{ url('/admin/product') }}" class="btn btn-light"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
@endsection

@section('content')
    <div class="row pb-4">
        <div class="col-md-5">
            <img src="{{ asset('storage/' .$products->image) }}" alt="Milink.id" class="rounded-4 w-100" />
        </div>
        <div class="col-md-7">
            <h1 class="mb-1">{{ $products->name }}</h1>
            <p>{!! $products->description !!}</p>

            <a href="{{ $products->link }}" class="btn btn-lg btn-primary" target="_blank">Kunjungi Situs </a>
        </div>
    </div>

    <div class="card card-body">
        <h2 style="width: fit-content" class="border-bottom pb-2 mb-3 border-primary text-primary">Fitur</h2>
        @foreach ($products->features as $item)
        <h2 class="m-0">Fitur {{ $item->title }}</h2>
        <h5 class="m-0">{{ $item->description }}</h5>
        @endforeach
    </div>
@endsection
