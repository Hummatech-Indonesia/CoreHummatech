@extends('landing.layouts.layouts.app')
@section('title', 'Portofolio')

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
<meta name="description" content="Portofolio Hummatech." />
<meta name="title" content="Portofolio - Hummatech" />
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
                    <h1>Portofolio</h1>
                    <ul class="breadcrumb">
                        <li><a href="/"><i class="fas fa-home"></i> Beranda</a></li>
                        <li class="active">Portofolio</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="thumb-services-area inc-thumbnail default-padding bottom-less ps-5">
        @forelse ($portfolios as $key => $portfolio)
            {{-- @dd($compact) --}}
            @if ($key % 2 === 1)
                <div class="container">
                    <div class="about-items">
                        <div class="row align-center">
                            <div class="col-lg-6 d-none d-md-none d-lg-inline-flex">
                                <div class="thumb">
                                    <img alt="{{ $portfolio->name }}" src="{{ asset('storage/' . $portfolio->image) }}"
                                        style="margin-left: 10px; margin-right: 10px; min-height: 400px;object-fit:contain;max-height:400px" />
                                </div>
                            </div>
                            <div class="col-lg-6 info">
                                <h3>
                                    <a href="/portfolio/{{ $portfolio->slug }}">{{ $portfolio->name }}</a>
                                </h3>
                                <img alt="{{ $portfolio->name }}" src="{{ asset('storage/' . $portfolio->image) }}"
                                    class="w-100 mb-3 d-lg-none" />

                                <p>
                                    {!! $portfolio->description !!}
                                </p>

                                <div class="d-flex gap-2">
                                    <a class="btn btn-stroke-gradient text-gradient effect btn-md"
                                        href="/portfolio/{{ $portfolio->slug }}">Lihat
                                        Detail</a>
                                    <a class="btn btn-gradient effect btn-md" target="_blank"
                                        href="{{ $portfolio->link }}">Kunjungi
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
                                    <a href="/portfolio/{{ $portfolio->slug }}">{{ $portfolio->name }}</a>
                                </h3>
                                <img alt="{{ $portfolio->name }}" src="{{ asset('storage/' . $portfolio->image) }}"
                                    class="w-100 mb-3 d-lg-none" />
                                <p>
                                    {!! $portfolio->description !!}
                                </p>

                                <div class="d-flex gap-2">
                                    <a class="btn btn-stroke-gradient text-gradient effect btn-md"
                                        href="/portfolio/{{ $portfolio->slug }}">Lihat
                                        Detail</a>
                                    <a class="btn btn-gradient effect btn-md" target="_blank"
                                        href="{{ $portfolio->link }}">Kunjungi
                                        website</a>
                                </div>
                            </div>
                            <div class="col-lg-5 d-none d-md-none d-lg-inline-flex">
                                <div class="thumb">
                                    <img alt="{{ $portfolio->name }}" src="{{ asset('storage/' . $portfolio->image) }}"
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
