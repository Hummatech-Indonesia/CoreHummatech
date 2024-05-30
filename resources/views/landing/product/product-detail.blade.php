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
    <meta name="title" content="{{ $product->name }} - Layanan Hummatech" />
    <meta name="og:image" content="{{ asset('storage/' . $product->image) }}" />
    <meta name="og:description" content="{!! $product->description !!}" />
    <meta name="twitter:image" content="{{ asset('storage/' . $product->image) }}" />
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
                            <img src="{{ asset('storage/' . $product->image) }}" alt="Thumb">
                        </div>
                    </div>
                    <div class="col-lg-6 info">
                        <h1>{{ $product->name }}</h1>
                        <p>
                            {!! $product->description !!}
                        </p>
                        <a class="btn btn-gradient effect btn-md" target="_blank" href="{{ $product->link }}">Kunjungi website</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="services-area bg-gray default-padding bottom-less">
        <div class="right-shape">
            <img src="{{ asset('assets-home/img/shape/9.png') }}" alt="Shape">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="site-heading text-center">
                        <h4>FITUR-FITUR</h4>
                        <h2>Fitur - Fitur {{ $product->name }} yang mungkin dapat membantu anda</h2>
                        <div class="devider"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-full w-75">
            <div class="services-items">
                <div class="row">
                    @foreach ($product->features as $item)
                        <div class="col-lg-4 col-md-6 single-item">
                            <div class="item">
                                <div class="info">
                                    <h4>{{ $item->title }}</h4>
                                    <p>
                                        {{ $item->name }}
                                    </p>
                                    <div class="bottom">
                                        <span>0{{ str_pad($loop->iteration, 1, '0', STR_PAD_LEFT) }}</span>
                                        <a href="">Fitur</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="testimonials-area default-padding">
        <!-- Fixed Shape -->
        <div class="fixed-shape" style="background-image: url(../assets-home/img/shape/circle.png);"></div>
        <!-- End Fixed Shape -->
        <div class="container">
            <div class="testimonial-items bg-gradient-gray">
                <div class="row align-center bg-gradient-gray">
                    @forelse ($testimonial as $testi)
                        <div class="col-lg-7 testimonials-content">
                            <div class="testimonials-carousel owl-carousel owl-theme">
                                <div class="item">
                                    <div class="info">
                                        <p>
                                            {{ $testi->description }}
                                        </p>
                                        <div class="provider">
                                            <div class="thumb">
                                                <img src="{{ asset('storage/' . $testi->image) }}" alt="Author">
                                            </div>
                                            <div class="content">
                                                <h4 class="text-primary">{{ $testi->name }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-7">
                            <div class="d-flex justify-content-center">
                                <img src="{{ asset('nodata-gif.gif') }}" alt="" width="800px">
                            </div>
                            <h4 class="text-center text-dark" style="font-weight:600">
                                Belum ada Testimonial
                            </h4>
                        </div>
                    @endforelse
                    <div class="col-lg-5 info">
                        <h4>Testimoni</h4>
                        <h2>Testimoni Membuktikan Kualitas produk Kami</h2>
                        <p>
                            Tingkatkan Kepercayaan Anda: Dengarlah Suara Pelanggan Kami Melalui Testimoni Mereka
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End testimonials Area -->

    <!-- start faq -->
    <div class="faq-content-area mb-5 pb-5 pt-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="site-heading text-center">
                        <h4>FAQ</h4>
                        <h2>Temukan Jawaban Anda: FAQ Kami Memudahkan Anda Memahami Layanan Kami"</h2>
                        <div class="devider"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mb-5">
            <div class="faq-items">
                <div class="row align-center">

                    <div class="col-lg-10 offset-lg-1">
                        <div class="faq-content wow fadeInUp">
                            <div class="accordion" id="accordionExample">
                                @forelse ($faqs as $faq)
                                    <div class="card">
                                        <div class="card-header" id="headingFour{{ $loop->iteration }}">
                                            <h4 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseFour"
                                                aria-expanded="false" aria-controls="collapseFour">
                                                {{ $faq->question }}
                                            </h4>
                                        </div>
                                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour{{ $loop->iteration }}"
                                            data-parent="#accordionExample">
                                            <div class="card-body">
                                                <p>
                                                    {{ $faq->answer }}
                                                </p>
                                                <div class="ask-question">
                                                    <span>Still no luck?</span> <a href="#">Ask a question</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                <div class="col">
                                    <div class="d-flex justify-content-center">
                                        <img src="{{ asset('nodata-gif.gif') }}" alt="" width="400px">
                                    </div>
                                    <h4 class="text-center text-dark" style="font-weight:600">
                                        Belum ada FAQ
                                    </h4>
                                </div>
                                @endforelse
                            </div>
                        </div>
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
