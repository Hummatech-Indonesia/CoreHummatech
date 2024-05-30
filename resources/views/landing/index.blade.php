@extends('landing.layouts.app')
@section('seo')
    <meta name="title" content="Hummatech - Perusahaan Software Terbaik di Malang" />
    <meta name="description"
        content="Hummatech adalah perusahaan software development terbaik di Malang. Kami menyediakan solusi perangkat lunak yang inovatif dan berkualitas tinggi." />
    <meta name="og:description"
        content="Hummatech adalah perusahaan software development terbaik di Malang. Kami menyediakan solusi perangkat lunak yang inovatif dan berkualitas tinggi." />
    <meta name="og:image" content="{{ asset('mobilelogo.png') }}" />
    <meta name="twitter:image" content="{{ asset('mobilelogo.png') }}" />
    <meta property="og:url" content="{{ url('/') }}" />
    <meta property="og:type" content="website" />
    <link rel="canonical" href="{{ url('/') }}" />
@endsection

@section('style')
    <style>
        body {}

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
            /* padding-right: 50px; */
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

        .thumbs-services-area .item::after {
            position: absolute;
            left: -15px;
            top: 80px;
            right: -15px;
            background: none;
            content: "";
            bottom: 0;
            z-index: -1;
            border-radius: 7px;
        }

        .rounded-container {
            border-radius: 15px;
            overflow: hidden;
        }

        @media (max-width: 992px) {
            .owl-carousel {
                display: block;
            }
        }
    </style>
    <style>
        @media (max-width: 992px) {
            .about-triangle {
                display: none;
            }
        }

        @media (max-width: 992px) {
            .team-item img {
                max-width: 40%;
            }
        }

        .team-item {
            margin-right: 15px;
        }

        .team-item:last-child {
            margin-right: 0;
        }

        @media (max-width: 992px) {
            .team-item {
                margin-right: 0;
            }
        }

        @media (max-width: 600px) {
            .responsive-text {
                font-size: 16px;
                /* Ubah sesuai kebutuhan */
            }

        }
    </style>
@endsection

@section('content')
    <!-- Start Banner
                                                        ============================================= -->
    <div class="banner-area text-center text-big top-pad-50">
        <div id="bootcarousel" class="carousel text-light slide animate_text" data-ride="carousel">

            <!-- Wrapper for slides -->
            <div class="carousel-inner carousel-zoom">
                @forelse ($section as $key => $sectionItem)
                    <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                        <div class="slider-thumb bg-fixed"
                            style="background-image: url({{ asset('storage/' . $sectionItem->image) }});"></div>
                        <div class="box-table">
                            <div class="box-cell shadow dark">
                                <div class="container">
                                    <div class="row">
                                        <div class="">
                                            <div class="content">
                                                <h2>{{ $sectionItem->title }} <span>{{ $sectionItem->subtitle }}</span></h2>
                                                <p class="animated slideInRight">
                                                    {{ $sectionItem->information }}
                                                </p>
                                                @if (!empty($sectionItem->link))
                                                    <a data-animation="animated zoomInUp"
                                                        class="btn btn-gradient effect btn-md"
                                                        href="{{ $sectionItem->link }}"
                                                        target="_blank">
                                                        Lihat Selengkapnya
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="box-table">
                        <div class="">
                            <div class="slider-thumb bg-fixed"
                                style="background-image: url({{ asset('assets-home/img/banner/mischool.jpg') }});"></div>
                        </div>
                        <div class="box-cell shadow dark">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-10 offset-lg-1">
                                        <div class="content">
                                            <h2>Inovasi <span>Menuju Perkembangan</span></h2>
                                            <p class="animated slideInRight">
                                                bertransformasi menjadi perusahaan yang mampu menjawab
                                                tantangan di era revolusi industri 4.0
                                            </p>
                                            <a data-animation="animated zoomInUp" class="btn btn-gradient effect btn-md"
                                                href="">
                                                Lihat Selengkapnya
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="col-12">
                    <div class="d-flex justify-content-center ">
                        <img src="{{ asset('nodata-gif.gif') }}" alt="" width="500px" height="500px">
                    </div>
                    <h4 class="text-center text-dark" style="font-weight:600">
                        Belum ada Profile
                    </h4><br>
                </div> --}}
                @endforelse
            </div>

            <!-- End Wrapper for slides -->

            <!-- Left and right controls -->
            <a class="left carousel-control light" href="#bootcarousel" data-slide="prev">
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control light" href="#bootcarousel" data-slide="next">
                <span class="sr-only">Next</span>
            </a>

        </div>
    </div>
    <!-- End Banner -->

    <!-- Start About Area -->

    <div class="about-us-area pt-5">
        <div class="container">
            <img src="{{ asset('assets-home/img/about-polygon.svg') }}" class="about-triangle" alt="Polygon" />
            <div class="about-items">
                <div class="row d-flex align-items-center">
                    @forelse ($profile as $profile)
                        <div class="col-md-6 order-first order-md-last text-center">
                            <div class="thumb">
                                <img src="{{ asset('storage/' . $profile->image) }}" alt="Thumb"
                                    style="max-width: 70%; max-height: auto; display: inline-block;">
                            </div>
                        </div>
                        <div class="col-md-6 info">
                            <h2 class="text-break">{{ $profile->title }}</h2>
                            <p class="text-break">
                                {!! $profile->subtitle !!}
                            </p>
                            <a class="btn btn-gradient effect btn-md" href="/about/profile">Selengkapnya</a>
                        @empty
                            <div class="col-12">
                                <div class="d-flex justify-content-center ">
                                    <img src="{{ asset('nodata-gif.gif') }}" alt="" width="800px">
                                </div>
                                <h4 class="text-center text-dark" style="font-weight:600">
                                    Belum ada Profile
                                </h4><br>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- End About -->

    <!-- Star Services Area
                                                    ============================================= -->
    <div class="thumb-services-area inc-thumbnail default-padding bottom-less mt-5">
        <div class="right-shape">
            <img src="assets-home/img/shape/9.png" alt="Shape">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="site-heading text-center">
                        <h4>Layanan kami</h4>
                        <h2>Kami menyediakan layanan software untuk mendukung perusahaan dan bisnis anda</h2>
                        <div class="devider"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="services-items text-center">
                <div class="row">
                    @forelse ($services->take(6) as $service)
                        <!-- Single Item -->
                        <div class="col-lg-4 col-md-6 single-item wow fadeInRight" data-wow-delay="700ms">
                            <div class="item"
                                style="background-image: url('{{ asset('storage/' . $service->image) }}'); min-height: 20rem; max-height: 20rem;">
                                <div class="d-flex flex-column align-items-center">
                                    <h4 class="mb-0 pb-0">{{ $service->name }}</h4>
                                    <div style="min-height: 70px; max-height: 70px" class="text-white py-2">
                                        {!! Str::words($service->description, 15, '') !!}
                                    </div>
                                    <div class="pt-5 mt-3">
                                        <a href="/services/{{ $service->slug }}"><i class="fas fa-arrow-right"></i> Lihat Selengkapnya</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Item -->
                    @empty
                        <div class="col-12">
                            <div class="d-flex justify-content-center">
                                <img src="{{ asset('nodata-gif.gif') }}" alt="" width="800px">
                            </div>
                            <h4 class="text-center text-dark" style="font-weight:600">
                                Belum ada Layanan
                            </h4>
                        </div>
                    @endforelse
                </div>

            </div>
        </div>
    </div>
    <!-- End Services Area -->
    <div class="partner-area bg-gray shadow-less overflow-hidden text-light">
        <div class="container-fluid">
            <div class="item-box">
                <div class="row align-items-center">

                    <div class="col-lg-4 col-md-12 info">
                        @if ($home)
                            <h2 class="mx-5 text-break">{{ $home->title }}</h2>
                            <p class="mx-5">{{ $home->description }}</p>
                        @else
                            <h2 class="mx-5 text-break"> Menghadirkan produk dengan kualitas dan inovasi terbaik</h2>
                            <p class="mx-5"> Kami berkomitmen untuk menghadirkan produk-produk berkualitas tinggi yang
                                dipadukan dengan inovasi terdepan, memenuhi kebutuhan dan harapan konsumen dengan sempurna.
                            </p>
                        @endif
                    </div>

                    <div class="col-lg-8 col-md-12 clients">
                        <div class="partner-carousel owl-carousel owl-theme ">
                            @forelse ($product as $produk)
                                <div class="single-item">
                                    <div class="card rounded-container" style="min-height: 500px">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-center rounded-container"
                                                style="background-color: #E5F1FF;">
                                                <img class="img-fluid pt-3 mb-3"
                                                    style="margin-left: 10px; margin-right: 10px; min-height: 200px;object-fit:contain;max-height:200px"
                                                    src="{{ asset('storage/' . $produk->image) }}" width="300"
                                                    height="200" alt="">
                                            </div>
                                            <h4 class="text-dark mt-3" style="font-weight:600">
                                                {{ $produk->name }}
                                            </h4>

                                            <p class="text-dark">
                                                {!! Str::words(html_entity_decode($produk['description']), 160, '') !!}
                                            </p>
                                            <div class="bottom d-flex justify-content-center mt-4">
                                                <a href="{{ route('detail.product', $produk->slug) }}"
                                                    class="btn btn-primary rounded-pill py-2 px-4 ">
                                                    Lihat Detail <i class="fas fa-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="d-flex justify-content-center">
                                        <img src="{{ asset('nodata-gif.gif') }}" alt="" width="800px">
                                    </div>
                                    <h4 class="text-center text-dark" style="font-weight:600">
                                        Belum ada produk
                                    </h4>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Product Area -->

    <div class="thumbs-services-area m-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="site-heading text-center">
                        <h4>MITRA KAMI</h4>
                        <h3>Tumbuh bersama: Kolaborasi menuju kesuksesan</h3>
                        <div class="devider"></div>
                    </div>
                </div>
                <div class="container">
                    <!-- Start Services Items -->
                    <div class="services-content ">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="thumb-services-carousel owl-carousel owl-theme owl-loaded owl-drag">
                                    @forelse ($mitras as $mitra)
                                        <div class="item"
                                            style="display: flex; align-items: center; justify-content: center; ">
                                            <img src="{{ asset('storage/' . $mitra->image) }}" alt="{{ $mitra->name }}"
                                                class="img-fluid"
                                                style="max-width: 80%; max-height: auto; display: inline-block;">
                                        </div>
                                    @empty
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if (count($mitras) < 1)
            <div class="col-12 text-center ">
                <img src="{{ asset('nodata-gif.gif') }}" alt="" width="800px">
                <h4 class="text-dark" style="font-weight: 600; margin-top: 20px;">
                    Belum ada mitra
                </h4>
            </div>
        @endif

        @if (count($mitras) > 0)
            <div class="col-md-12 pagi-area text-center">
                <a class="text-primary" href="/mitra">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M16.15 13H5q-.425 0-.712-.288T4 12q0-.425.288-.712T5 11h11.15L13.3 8.15q-.3-.3-.288-.7t.288-.7q.3-.3.713-.312t.712.287L19.3 11.3q.15.15.213.325t.062.375q0 .2-.062.375t-.213.325l-4.575 4.575q-.3.3-.712.288t-.713-.313q-.275-.3-.288-.7t.288-.7z" />
                    </svg> Lihat Selengkapnya
                </a>
            </div>
        @endif
    </div>

    <!-- End collab  Area -->

    <div class="bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="site-heading text-center mt-4">
                        <h4>BERITA</h4>
                        <h3>Melangkah Ke Depan: Kabar Terbaru Mengenai Perkembangan Perusahaan Kami</h3>
                        <div class="devider"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="blog-area full-blog blog-standard full-blog grid-colum">
            <div class="container">
                <div class="blog-items content-less">
                    <div class="blog-content">
                        <div class="blog-item-box">
                            @php
                                $newsChunks = array_chunk($news->toArray(), 3);
                            @endphp

                            @if (count($news) > 0)
                                <div id="newsCarousel" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="">
                                            <div class="row">
                                                @foreach ($news as $index => $newsItem)
                                                    @if ($index < 3)
                                                        <div class="col-lg-4 col-md-6 mt-2">
                                                            <div class="item">
                                                                <div class="thumb">
                                                                    <a href="/news/{{ $newsItem->slug }}">
                                                                        <img src="{{ asset('storage/' . $newsItem->thumbnail) }}"
                                                                            alt="{{ $newsItem->title }}"
                                                                            class="img-fluid"
                                                                            style="width: 500px; height: 200px; object-fit: cover;">
                                                                    </a>

                                                                    <time class="date"
                                                                        datetime="">{{ \Carbon\Carbon::parse($newsItem->date)->locale('id_ID')->isoFormat('D MMMM Y') }}</time>
                                                                </div>
                                                                <div class="info">
                                                                    <div class="meta">
                                                                        <ul>
                                                                            <li>
                                                                                <img src="{{ asset('mobilelogo.png') }}"
                                                                                    alt="Hummatech Logo" />
                                                                                <span>By </span>
                                                                                <a href="javascript:void(0)">Hummatech</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>

                                                                    <h4>
                                                                        <a
                                                                            href="/news/{{ $newsItem->slug }}">{{ $newsItem->title }}</a>
                                                                    </h4>

                                                                    <p class="">{!! Str::limit(strip_tags($newsItem->description), 200) !!}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                                <div class="col-md-12 pagi-area text-center mb-5 mt-3">
                                                    <a class="text-primary" href="/news">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="32"
                                                            height="32" viewBox="0 0 24 24">
                                                            <path fill="currentColor"
                                                                d="M16.15 13H5q-.425 0-.712-.288T4 12q0-.425.288-.712T5 11h11.15L13.3 8.15q-.3-.3-.288-.7t.288-.7q.3-.3.713-.312t.712.287L19.3 11.3q.15.15.213.325t.062.375q0 .2-.062.375t-.213.325l-4.575 4.575q-.3.3-.712.288t-.713-.313q-.275-.3-.288-.7t.288-.7z" />
                                                        </svg> Lihat Berita Lainnya
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="col-12">
                                    <div class="d-flex justify-content-center">
                                        <img src="{{ asset('nodata-gif.gif') }}" alt="" width="800px">
                                    </div>
                                    <h4 class="text-center text-dark" style="font-weight:600">
                                        Belum ada Berita
                                    </h4><br>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($portfolios->isEmpty())
    @else
        <div class="services-details-area default-padding">
            <div class="container">
                <div class="row">

                    <div class="col-lg-8 offset-lg-2">
                        <div class="site-heading text-center mt-4">
                            <h4>portofolio</h4>
                            <h3>Inspirasi dari Karya: Portfolio Hummatech Menggambarkan Keunggulan Produk</h3>
                            <div class="devider"></div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="container">
                <div class="services-details-items">
                    <div class="row">
                        <div class="col-lg-12 services-single-content">
                            <div class="gallery-area overflow-hidden pt-3">
                                <div class="container">
                                    <div class="case-items-area">
                                        <div class="masonary">
                                            <div id="portfolio-grid" class="gallery-items colums-3 gap-2">
                                                {{-- @foreach ($comingProducts as $comingProduct)
                                                    <div class="pf-item mx-2" style="width: 300px">
                                                        <div class="item" style="width: 300px">
                                                            <div class="" style="background-color: #E5F1FF;">
                                                                <div class="p-2 bg-primary text-white"
                                                                    style="position-absolute">Coming soon!</div>
                                                                <img src="{{ asset('storage/' . $comingProduct->image) }}"
                                                                    width="300px" height="260px"
                                                                    style="object-fit: cover;" alt="Thumb">
                                                            </div>
                                                            <div class="content">
                                                                <div class="info">
                                                                    <h4><a
                                                                            href="{{ route('detail.product', $comingProduct->slug) }}">{{ $comingProduct->name }}</a>
                                                                    </h4>
                                                                    <span>{{ Str::limit($comingProduct->description, 50, '...') }}</span>
                                                                </div>
                                                                <div class="button">
                                                                    <a href="{{ asset('storage/' . $comingProduct->image) }}"
                                                                        class="item popup-gallery">
                                                                        <i class="fas fa-plus"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach --}}

                                                @foreach ($portfolios as $index => $portfolio)
                                                    @if ($index < 3)
                                                        <div class="pf-item mx-2" style="width: 370px">
                                                            <div class="item" style="width: 370px">
                                                                <div class="" style="background-color: #E5F1FF;">
                                                                    <img src="{{ asset('storage/' . $portfolio->image) }}"
                                                                        class="object-fit-cover" style="object-fit: cover"
                                                                        alt="{{ $portfolio->name }}">
                                                                </div>
                                                                <div class="content">
                                                                    <div class="info mb-0">
                                                                        <h4 class=" mb-0"><a
                                                                                href="{{ route('detail.product', $portfolio->slug) }}">{{ Str::limit($portfolio->name, 45, '...') }}</a>
                                                                        </h4>
                                                                        <p class="text-white mb-0">{{ Str::limit($portfolio->description, 80, '...') }}</p >
                                                                            <div class="button">
                                                                                <a href="{{ asset('storage/' . $portfolio->image) }}"
                                                                                    class="item popup-gallery">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                                        width="30" height="30"
                                                                                        viewBox="0 0 512 396.94">
                                                                                        <path fill="currentColor"
                                                                                            fill-rule="nonzero"
                                                                                            d="M49.63 0h336.95c13.64 0 26.03 5.64 35 14.6l.82.91c8.52 8.93 13.79 21.03 13.79 34.13v182.01c-8.72-2.42-17.63-4.27-26.69-5.48V192.2l-36.96 32.61c-21.85 1.34-42.73 6.43-62.42 14.53l-40.98-39.31-27.44 78.69c-.4 2.81-1.59 5.18-3.25 7.02l-1.7 1.57c-5.12 3.94-12.95 3.92-17.94-1.81l-78.13-118.22L26.7 262.86v79.61c0 6.25 2.62 11.97 6.77 16.13 4.19 4.19 9.95 6.81 16.16 6.81H235c10.6 9.86 21.96 18.81 33.95 26.69H49.63c-13.57 0-26.02-5.61-35.03-14.63-8.96-8.96-14.6-21.37-14.6-35V49.64c0-13.66 5.59-26.09 14.57-35.07l.92-.84C24.42 5.24 36.46 0 49.63 0zm337.74 292.43c9.66 0 18.41 3.92 24.74 10.24 6.33 6.33 10.24 15.07 10.24 24.74 0 9.65-3.91 18.41-10.24 24.73-6.33 6.33-15.06 10.25-24.74 10.25-9.65 0-18.4-3.92-24.73-10.25a34.82 34.82 0 0 1-10.24-24.73c0-9.65 3.91-18.41 10.24-24.74 6.33-6.32 15.08-10.24 24.73-10.24zm-122.68 29.88c28.32-34.25 72.44-63.49 117.77-64.39 48.01-.97 96.09 29.72 127.66 64.45a7.207 7.207 0 0 1 .47 9.14c-26.32 37.15-73.49 65.2-119.34 65.43-46.78.21-97.89-28.89-126.93-65.24-2.25-2.84-2.03-6.84.37-9.39zm20.04 4.96c26.61 30.85 65.31 52.73 106.3 52.55 39.43-.19 75.09-21.01 99.09-52.07-28.24-29.46-65.39-53.54-107.15-52.72-39.06.79-73.06 23.66-98.24 52.24zM26.7 227.39c29.55-26.64 76.84-63.89 106.71-88.99 4.87-4.22 12.12-4.13 16.91-.04.97.81 1.68 1.78 2.49 2.75l67.52 105.51 26.92-75.68c1.99-10.57 14.47-14.08 22.04-7.05l62.79 60.12 77.42-72.04V49.64c0-5.94-2.36-11.48-6.2-15.61l-.6-.56c-4.16-4.15-9.88-6.77-16.12-6.77H49.63c-6.04 0-11.54 2.34-15.61 6.12l-.58.62c-4.15 4.16-6.74 9.9-6.74 16.2v177.75zM267.63 61.07c11.02 0 21.04 4.49 28.28 11.73 7.24 7.24 11.72 17.23 11.72 28.28 0 11.02-4.48 21.04-11.72 28.28-7.24 7.24-17.26 11.72-28.28 11.72-11.04 0-21.04-4.48-28.28-11.72-7.24-7.24-11.72-17.26-11.72-28.28 0-11.05 4.48-21.04 11.72-28.28 7.24-7.24 17.24-11.73 28.28-11.73zm12.21 27.8a17.249 17.249 0 0 0-12.21-5.04c-4.77 0-9.09 1.93-12.2 5.04a17.198 17.198 0 0 0-5.05 12.21c0 4.77 1.93 9.09 5.05 12.2 3.11 3.11 7.43 5.05 12.2 5.05s9.09-1.94 12.21-5.05c3.11-3.11 5.04-7.43 5.04-12.2s-1.93-9.1-5.04-12.21z" />
                                                                                    </svg>
                                                                                </a>
                                                                            </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center pt-5">
                    @if (count($portfolios) > 3)
                        <a class="text-primary" href="/portfolio">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M16.15 13H5q-.425 0-.712-.288T4 12q0-.425.288-.712T5 11h11.15L13.3 8.15q-.3-.3-.288-.7t.288-.7q.3-.3.713-.312t.712.287L19.3 11.3q.15.15.213.325t.062.375q0 .2-.062.375t-.213.325l-4.575 4.575q-.3.3-.712.288t-.713-.313q-.275-.3-.288-.7t.288-.7z" />
                            </svg> Lihat Selengkapnya
                        </a>
                    @else
                    @endif
                </div>
            </div>
        </div>
    @endif



    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <script>
        $(document).ready(function() {
            var itemCount = $('.thumb-services-carousel .item').length;
            $('.thumb-services-carousel').owlCarousel({
                center: true,
                dots: false,
                nav: false,

                items: 5,
                loop: itemCount > 4 ? true : false,
                margin: 10,
                autoplay: true,
                autoplayTimeout: 2000,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 5
                    }
                }
            });
        });
    </script>

@endsection
