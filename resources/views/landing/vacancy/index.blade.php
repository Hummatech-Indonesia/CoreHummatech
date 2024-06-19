@extends('landing.layouts.layouts.app')
@section('title' , 'Job Vacancy')
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
    </style>

    <style>
        /* Custom styles for the timeline */
        .timeline {
            position: relative;
            padding: 40px 0;
        }

        .timeline::before {
            content: '';
            position: absolute;
            width: 4px;
            height: 100%;
            background: #ced4da;
            left: 50%;
            top: 0;
            transform: translateX(-50%);
        }

        .timeline-item {
            margin-bottom: 50px;
            position: relative;
        }

        .timeline-item::after {
            content: '';
            display: table;
            clear: both;
        }

        .timeline-item-content {
            position: relative;
            width: 45%;
            border-radius: 5px;
            float: left;
            padding-right: 3rem;
        }

        .timeline-item-content h2 {
            margin-top: 0;
        }

        @media screen and (max-width: 992px) {
            .timeline-item-content {
                padding-right: .75rem;
            }

            .timeline-item-content h2 {
                font-size: 1rem;
                font-weight: bold;
                margin-bottom: .25rem;
            }

            .timeline-item-content p,
            .timeline-item-content .timeline-item-date {
                font-size: .75rem;
                line-height: 1.25;
                margin-bottom: 0;
            }
        }

        .timeline-item-date {
            font-size: 14px;
            color: #6c757d;
        }

        .timeline-number {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 5rem;
            height: 5rem;
            background-color: #007bff;
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.5rem;
            font-family: 'Poppins', Arial, Helvetica, sans-serif;
        }

        @media screen and (max-width: 992px) {
            .timeline-number {
                width: 2rem;
                height: 2rem;
                font-size: .875rem;
            }
        }

        /* Alternate the position of the timeline items */
        .timeline .timeline-item:nth-child(even) .timeline-item-content {
            float: right;
            text-align: right;
            padding-left: 3rem;
            padding-right: 0;
        }

        @media screen and (max-width: 992px) {
            .timeline .timeline-item:nth-child(even) .timeline-item-content {
                padding-left: .75rem;
                padding-right: 0;
            }
        }

        .timeline .timeline-item:nth-child(even) .timeline-item-content::before {
            right: 100%;
            border-right: 8px solid #f8f9fa;
            border-left: none;
        }

        .timeline .timeline-item:nth-child(odd) .timeline-item-content::before {
            left: 100%;
            border-left: 8px solid #f8f9fa;
            border-right: none;
        }

        .timeline .timeline-item:nth-child(even) .timeline-item-content::after,
        .timeline .timeline-item:nth-child(odd) .timeline-item-content::after {
            display: none;
        }

        @media screen and (min-width: 992px) {
            .text-lg-start {
                text-align: left !important;
            }
        }
    </style>
@endsection

@section('seo')
    <meta name="title" content="Lowongan - Layanan Hummatech" />
    <meta name="og:image" content="{{ asset('mobilelogo.png') }}" />
    <meta name="description"
        content="Hummatech adalah perusahaan software development terbaik di Malang. Kami menyediakan solusi perangkat lunak yang inovatif dan berkualitas tinggi." />
    <meta name="twitter:image" content="{{ asset('mobilelogo.png') }}" />
    <meta property="og:url" content="{{ url('/') }}" />
    <meta property="og:type" content="website" />
    <link rel="canonical" href="{{ url('/') }}" />
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
          "name": "Lowongan",
          "item": "{{ url('/data/lowongan') }}"
        },
      ]
    }
    </script>
@endsection

@section('content')
    <div class="breadcrumb-area text-center shadow dark text-light bg-cover"
        style="background-image: url({{ $background == null ? asset('assets-home/img/default-bg.png') : asset('storage/'. $background->image) }});">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <h1>Lowongan</h1>
                    <ul class="breadcrumb">
                        <li><a href="#"><i class="fas fa-home"></i> Beranda</a></li>
                        <li class="active">Lowongan</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-5 my-5">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="site-heading text-center">
                    <h4>Lowongan</h4>
                    <h3>Bergabunglah dengan tim kami dan wujudkan karir impian Anda!</h3>
                    <div class="devider"></div>
                </div>
            </div>
            @forelse ($jobVacancies as $jobVacancy)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h3 class="card-title mb-0">{{ $jobVacancy->name }}</h3>
                            <p class="card-text mt-2">{!! Str::limit($jobVacancy->description, 150, '...') !!}</p>
                            <a class="btn btn-primary btn-block rounded-pill" href="{{ route('vacancy.detail', $jobVacancy->slug) }}">
                                Detail<i class="fas fa-arrow-circle-right ms-3"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="d-flex justify-content-center col-12 ">
                    <img src="{{ asset('nodata-gif.gif') }}" width="600px" alt="" srcset="">
                </div>
                <h4 class="fs-1 text-center text-dark col-12 " style="font-weight: 600">
                    Lowongan tidak tersedia
                </h4>
            @endforelse
        </div>
    </div>
    
    {{-- @if ($vacancyData->count() > 0)
    <div class="about-us-area default-padding">
        <div class="container">
            <img src="{{ asset('assets-home/img/about-polygon.svg') }}" class="about-triangle" alt="Polygon" />
            <div class="about-items">
                <div class="row align-center">
                    <div class="col-lg-6 info text-center text-lg-start">
                        <h4 class="subtitle text-break">{{ $vacancyData[0]->subtitle }}</h4>
                        <h2>{{ $vacancyData[0]->title }}</h2>
                        <img src="{{ asset('storage/' .$vacancyData[0]->image) }}"
                            class="w-75 mx-auto d-block d-lg-none mb-3" alt="Thumb" />
                        <p>{!! Str::limit($vacancyData[0]->description, 200) !!}</p>

                        <a class="btn btn-gradient effect btn-md" target="_blank"
                            href="{{ $vacancyData[0]->link }}">Kunjungi Website</a>
                    </div>
                    <div class="col-lg-6 d-none d-lg-block d-md-none">
                        <div class="thumb">
                            <img src="{{ asset('storage/' .$vacancyData[0]->image) }}" class="w-100" alt="Thumb" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="d-flex justify-content-center col-12 ">
        <img src="{{ asset('nodata-gif.gif') }}" width="600px" alt="" srcset="">
    </div>
    <h4 class="fs-1 text-center text-dark col-12 " style="font-weight: 600">
        Data Masih Kosong
    </h4>
    @endif --}}

    <div class="work-process-area features-area default-padding-bottom py-5">
        <div class="container pt-5">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="site-heading text-center">
                        <h4>Alur Kerja</h4>
                        <h3>"Kendalikan Alur Kerja Anda: Strategi Efektif untuk Produktivitas dan Efisiensi"</h3>
                        <div class="devider"></div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="timeline">
                                @forelse ($workflows as $index=>$workflow)
                                <div class="timeline-item">
                                    <div class="timeline-number">{{ $index + 1 }}</div>
                                    <div class="timeline-item-content">
                                        <h2>{{ $workflow->name }}</h2>
                                        <p>{{ $workflow->description }}</p>
                                        {{-- <span class="timeline-item-date">{{ \Carbon\Carbon::parse($workflow->created_at)->locale('id_ID')->isoFormat('D MMMM Y') }}</span> --}}
                                    </div>
                                </div>
                                @empty
                                <div class="d-flex justify-content-center col-12 ">
                                    <img src="{{ asset('nodata-gif.gif') }}" width="600px" alt="" srcset="">
                                </div>
                                <h4 class="fs-1 text-center text-dark col-12 " style="font-weight: 600">
                                    Data Masih Kosong
                                </h4>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
