@extends('landing.layouts.layouts.app')
@section('title' , 'About Company')
@section('seo')
@section('seo')
@foreach ($profiles as $profile)
<meta name="title" content="{{ $profile->title }}" />
<meta name="description"
    content="{!! $profile->subtitle }!!}" />
<meta name="og:image" content="{{ asset('mobilelogo.png') }}" />
<meta name="twitter:image" content="{{ asset('mobilelogo.png') }}" />
<meta property="og:url" content="{{ url('/') }}" />
<meta property="og:type" content="website" />
<link rel="canonical" href="{{ url('/') }}" />
@endforeach
@endsection
@endsection
@section('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />

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

        @media screen and (max-width: 992px) {
            .about-us-area .about-triangle {
                right: 0;
            }

            .about-us-area .thumb {
                padding-top: 50px;
                padding-right: unset;
            }
        }

        .pagination {
            display: flex !important;
            gap: .5rem;
        }

        .pagination .page-item {
            margin: 0 !important;
        }

        .pagination .page-item .page-link {
            padding: .75rem 1rem !important;
            border-radius: 8px;
            margin: 0;
        }

        @media screen and (min-width: 992px) {
            .text-lg-start {
                text-align: left !important;
            }
        }
        .ql-align-justify{
            text-align: justify !important;
        }
    </style>
@endsection

@section('seo')
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
          "name": "Tentang Kami",
          "item": "{{ url('/about-us') }}"
        },
      ]
    }
</script>

<meta name="description" content="Perusahaan Software House terbaik se-Jawa Timur" />
<meta name="og:description" content="Perusahaan Software House terbaik se-Jawa Timur" />
@endsection

@section('content')
    <div class="breadcrumb-area text-center shadow dark text-light bg-cover"
        style="background-image: url('{{ $background != null && $background->show_in == 'Tentang Kami' && $background->about_in == 'Profile' ? asset('storage/'. $background->image) : asset('assets_landing/background/Profile.jpg') }}');">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <h1>Tentang Kami</h1>
                    <ul class="breadcrumb">
                        <li><a href="#"><i class="fas fa-home"></i> Beranda</a></li>
                        <li class="active">Tentang Kami</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="about-us-area pt-5 mb-5">
        <div class="container">
            <img src="{{ asset('assets-home/img/about-polygon.svg') }}" class="about-triangle" alt="Polygon" />
            <div class="about-items">
                <div class="row align-center justify-content-center">
                    <div class="col-lg-6 info text-center text-lg-start">
                        <h4 class="subtitle">Profile Perusahaan</h4>
                        @forelse ($profiles as $profile)
                        <h2>{{ $profile->title }}</h2>

                        <img src="{{ asset('storage/' . $profile->image) }}" alt="Thumb"
                            class="w-75 mb-3 d-block mx-auto d-lg-none" />
                        <p class="text-justify">
                            {!! $profile->description !!}
                        </p>

                        @if ($profile->proposal)
                            <a class="btn btn-gradient effect btn-md" target="_blank"
                                href="{{ $profile->proposal }}"
                               >Lihat Profil Lengkap</a>
                        @endif
                    </div>
                    <div class="col-lg-6 d-none d-md-none d-lg-inline">
                        <div class="thumb">
                            <img src="{{ asset('storage/' . $profile->image) }}" alt="Thumb" style="max-width: 80%; max-height: auto; display: inline-block;">
                        </div>
                    </div>

                @empty
                <div class="col-12">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('nodata-gif.gif') }}" alt="" width="800px">
                    </div>
                    <h4 class="text-center text-dark" style="font-weight:600">
                        Belum ada profile perusahaan
                    </h4>
                </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            var delay = 500;
            $('[class^="wow fadeInRight"]').each(function(index) {
                $(this).attr('data-wow-delay', delay + 'ms');
                delay += 300;
            });
        });
    </script>
@endsection
