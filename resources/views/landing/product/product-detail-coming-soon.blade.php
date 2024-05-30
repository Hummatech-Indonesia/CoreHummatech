@extends('landing.layouts.layouts.app')
@section('title' , 'Detail Portofolio')
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
        {
          "@type": "ListItem",
          "position": 4,
          "name": "Produk",
          "item": "{{ url('/produk') }}"
        },
      ]
    }
    </script>
@endsection

@section('content')
    <div class="thumb-services-area inc-thumbnail default-padding bottom-less">
        <div class="container">
            <div class="about-items">
                <div class="row align-center">
                    <div class="col-lg-5">
                        <div class="thumb">
                            <img src="{{ asset('storage/' . $ComingSoonProduct->image) }}" alt="Thumb">
                        </div>
                    </div>
                    <div class="col-lg-6 info">
                        <h1>{{ $ComingSoonProduct->name }}</h1>
                        <p>
                            {!! $ComingSoonProduct->description !!}
                        </p>
                        <a class="btn btn-gradient effect btn-md" target="_blank" href="{{ $ComingSoonProduct->link }}">Kunjungi website</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Faq -->
@endsection
@section('script')
    <script>
        $('.testimonials-carousel').owlCarousel({
            loop: false,
            nav: true,
            margin: 30,
            dots: false,
            autoplay: false,
            items: 1,
            navText: [
                "<i class='arrow_left'></i>",
                "<i class='arrow_right'></i>"
            ]
        });
    </script>
@endsection
