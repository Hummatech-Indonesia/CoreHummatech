@extends('landing.layouts.layouts.app')
@section('title', 'Product')

@section('style')
    <style>
        .subtitle {
            text-transform: uppercase;
            font-weight: 600;
            color: #1273eb;
            margin-top: -5px;
            display: inline-block;
            background: linear-gradient(90deg, rgba(18, 115, 235, 1) 30%, rgba(4, 215, 242, 1) 100%);
            -webkit-background-clip: text;
            -moz-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .about-us-area .thumb {
            padding-left: unset;
            padding-right: 50px;
        }

        .about-us-area .thumb::after {
            right: 0;
            top: 5rem !important;
            left: unset !important;
        }

        .about-us-area .container {
            position: relative;
        }

        .about-us-area .about-triangle {
            position: absolute;
            z-index: -1;
            top: -7.5rem;
            right: -7.5rem;
        }

        @media screen and (max-width: 992px) {
            .about-us-area .about-triangle {
                right: 0;
            }

            .about-us-area .thumb {
                padding-top: 50px;
                padding-right: unset;
            }
        }

        @media screen and (max-width: 992px) {
            .about-items .btn {
                padding: 1rem 1.5rem;
            }
        }
    </style>
    <style>
        .custom-tabs {
            display: flex;
            justify-content: space-between;
            align-items: center;
            overflow: hidden;
            overflow-x: auto;
            padding-top: 2rem;
            flex-wrap: nowrap;
        }

        .custom-tabs li a {
            margin-right: 1rem;
            text-transform: uppercase;
            display: flex;
            justify-content: center;
            flex-wrap: nowrap;
            white-space: nowrap;
        }

        .custom-tabs li:last-child a {
            margin-right: 0;
        }

        .custom-tabs li.active a {
            border-bottom: 4px solid #1273eb;
            color: #1273eb;
        }
    </style>
@endsection

@section('seo')
    <meta name="description" content="Product Hummatech adalah product terbaik." />
    <meta name="title" content="Produk - Hummatech" />
    <!-- ========== Breadcrumb Markup (JSON-LD) ========== -->
    <script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
        {
            "@type": "ListItem",
            "position": 1,
            "name": "Beranda",
            "item": "{{ url('/') }}"
        },
        {
            "@type": "ListItem",
            "position": 2,
            "name": "Produk",
            "item": "{{ url('/produk') }}"
        },
    ]
}
</script>
@endsection

@section('content')
    <div class="breadcrumb-area text-center shadow dark text-light bg-cover"
        style="background-image: url('{{ $background == null ? asset('assets-home/img/default-bg.png') : asset('storage/'. $background->image) }}');">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <h1>Produk</h1>
                    <ul class="breadcrumb">
                        <li><a href="/"><i class="fas fa-home"></i> Beranda</a></li>
                        <li class="active">Produk</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="about-us-area">
        <div class="container">
            <ul class="nav custom-tabs">
                <li @if (!request()->category && !request()->is('data/product/coming-soon')) class="active" @endif><a href="{{ url('/product') }}">Semua</a></li>
                @foreach ($categories as $category)
                    <li class="{{ request()->is("data/product/kategori/{$category->slug}") ? 'active' : '' }}">
                        <a href="{{ url("data/product/kategori/{$category->slug}") }}">{{ $category->name }}</a>
                    </li>
                @endforeach
                @if ($comingProducts->isEmpty())
                @else
                    <li class="{{ request()->is('data/product/coming-soon') ? 'active' : '' }}">
                        <a href="{{ url('data/product/coming-soon') }}">Coming soon</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>

    <div class="thumb-services-area inc-thumbnail default-padding bottom-less ps-5">
        @php
            if (request()->is('data/product/coming-soon')) {
                $compact = $comingProducts;
            } else {
                $compact = $products;
            }
        @endphp
        @forelse ($compact as $key => $product)
            {{-- @dd($compact) --}}
            @if ($key % 2 === 1)
                <div class="container">
                    <div class="about-items">
                        <div class="row align-center">
                            <div class="col-lg-6 d-none d-md-none d-lg-inline-flex">
                                <div class="thumb">
                                    <img alt="{{ $product->name }}" src="{{ asset('storage/' . $product->image) }}"
                                        style="margin-left: 10px; margin-right: 10px; min-height: 400px;object-fit:contain;max-height:400px" />
                                </div>
                            </div>
                            <div class="col-lg-6 info">
                                <h3>
                                    <a
                                        href="{{ $compact == $comingProducts ? route('detail.comming-soon', $product->slug) : route('detail.product', $product->slug) }}">{{ $product->name }}</a>
                                </h3>
                                <img alt="{{ $product->name }}" src="{{ asset('storage/' . $product->image) }}"
                                    class="w-100 mb-3 d-lg-none" />

                                <p>
                                    {!! $product->description !!}
                                </p>

                                <div class="d-flex gap-2">
                                    <a class="btn btn-stroke-gradient text-gradient effect btn-md"
                                        href="{{ $compact == $comingProducts ? route('detail.comming-soon', $product->slug) : route('detail.product', $product->slug) }}">Lihat
                                        Detail</a>
                                    <a class="btn btn-gradient effect btn-md" target="_blank"
                                        href="{{ $product->link }}">Kunjungi
                                        website</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="right-shape">
                    <img src="{{ asset('assets-home/img/shape/9.png') }}" alt="Shape">
                </div>
                <div class="container my-5 py-5">
                    <div class="about-items">
                        <div class="row align-center">
                            <div class="col-lg-6 info">
                                <h3>
                                    <a
                                        href="{{ $compact == $comingProducts ? route('detail.comming-soon', $product->slug) : route('detail.product', $product->slug) }}">{{ $product->name }}</a>
                                </h3>
                                <img alt="{{ $product->name }}" src="{{ asset('storage/' . $product->image) }}"
                                    class="w-100 mb-3 d-lg-none" />
                                <p>
                                    {!! $product->description !!}
                                </p>

                                <div class="d-flex gap-2">
                                    <a class="btn btn-stroke-gradient effect btn-md text-gradient"
                                        href="{{ $compact == $comingProducts ? route('detail.comming-soon', $product->slug) : route('detail.product', $product->slug) }}">Lihat
                                        Detail</a>
                                    <a class="btn btn-gradient effect btn-md" target="_blank"
                                        href="{{ $product->link }}">Kunjungi
                                        website</a>
                                </div>
                            </div>
                            <div class="col-lg-5 d-none d-md-none d-lg-inline-flex">
                                <div class="thumb">
                                    <img alt="{{ $product->name }}" src="{{ asset('storage/' . $product->image) }}"
                                        style="margin-left: 10px; margin-right: 10px; min-height: 400px;object-fit:contain;max-height:400px ;" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @empty

            <div class="col-12">
                <div class="d-flex justify-content-center">
                    <img src="{{ asset('nodata-gif.gif') }}" alt="" width="800px">
                </div>
                <h4 class="text-center text-dark" style="font-weight:600">
                    Belum ada Produk
                </h4>
            </div>
        @endforelse
    </div>
@endsection
