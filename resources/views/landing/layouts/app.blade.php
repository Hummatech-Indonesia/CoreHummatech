<!DOCTYPE html>
<html lang="en">

<head>
    <!-- ========== Meta Tags ========== -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('description')
    <!-- ========== Page Title ========== -->
    @hasSection('title')
        <title>{!! "{$__env->yieldContent('title')} &mdash; " . config('app.name', 'Laravel') !!}</title>
    @else
        <title>{{ config('app.name', 'Laravel') }}</title>
    @endif

    @yield('seo')

    <!-- ========== Favicon Icon ========== -->
    <link rel="shortcut icon" href="{{ asset('mobilelogo.png') }}" type="image/x-icon">

    <!-- ========== Start Stylesheet ========== -->
    <link href="{{ asset('assets-home/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets-home/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets-home/css/themify-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets-home/css/elegant-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets-home/css/flaticon-set.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets-home/css/magnific-popup.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets-home/css/owl.carousel.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets-home/css/owl.theme.default.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets-home/css/animate.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets-home/css/bootsnav.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets-home/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets-home/css/responsive.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="owlcarousel/owl.carousel.min.css">
    <link rel="stylesheet" href="owlcarousel/owl.theme.default.min.css">
    <!-- ========== End Stylesheet ========== -->

    @yield('style')

    <style>
        footer::after {
            background: url({{ asset('assets-home/img/map.svg') }});
        }
    </style>

</head>

<body>

    <!-- Start Preloader
    ============================================= -->
    <div id="preloader">
        <div id="earna-preloader" class="earna-preloader">
            <div class="animation-preloader">
                <div class="spinner"></div>
                <div class="txt-loading">
                    <span data-text-preloader="H" class="letters-loading">
                        H
                    </span>
                    <span data-text-preloader="U" class="letters-loading">
                        U
                    </span>
                    <span data-text-preloader="M" class="letters-loading">
                        M
                    </span>
                    <span data-text-preloader="M" class="letters-loading">
                        M
                    </span>
                    <span data-text-preloader="A" class="letters-loading">
                        A
                    </span>
                    <span data-text-preloader="T" class="letters-loading">
                        T
                    </span>
                    <span data-text-preloader="E" class="letters-loading">
                        E
                    </span>
                    <span data-text-preloader="C" class="letters-loading">
                        C
                    </span>
                    <span data-text-preloader="H" class="letters-loading">
                        H
                    </span>
                </div>
            </div>
            <div class="loader">
                <div class="row">
                    <div class="col-3 loader-section section-left">
                        <div class="bg"></div>
                    </div>
                    <div class="col-3 loader-section section-left">
                        <div class="bg"></div>
                    </div>
                    <div class="col-3 loader-section section-right">
                        <div class="bg"></div>
                    </div>
                    <div class="col-3 loader-section section-right">
                        <div class="bg"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Preloader -->

    <!-- Header
    ============================================= -->
    @include('landing.layouts.header')
    <!-- End Header -->

    @yield('content')

    <!-- Start Footer
    ============================================= -->
    <footer class="bg-dark text-light">
        <div class="container">
            <div class="f-items default-padding">
                <div class="row">
                    <div class="col-lg-4 col-md-6 item">
                        <div class="f-item about">
                            <img src="{{ asset('assets/images/LOGO-HUMMATECH_Putih.png') }}"
                                style="height: 48px;width: auto;" alt="Logo">

                            @isset($profile)
                                <p>{!! Str::limit(strip_tags($profile->description), 300) !!}</p>
                                <a href="{{ url('/about/profile') }}">Lihat Selengkapnya</a>
                            @else
                                <p>
                                    Bertransformasi menjadi perusahaan yang mampu menjawab tantangan di era revolusi
                                    industri 4.0
                                </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 item">
                            <div class="f-item link">
                                <h4 class="widget-title">Sosial Media</h4>
                                <ul>
                                    @forelse ($socmed as $socmed)
                                        <li>
                                            <a href="{{ $socmed->link }}" target="_blank"
                                                style="display: flex;gap: .5rem;align-items: center">
                                                <i class="fas fa-angle-right"></i>
                                                <img alt="Facebook Logo" src="{{ asset("storage/{$socmed->image}") }}"
                                                    height="16px" class="mb-0" width="16px" />
                                                {{ $socmed->platform }}
                                            </a>
                                        </li>
                                    @empty
                                        <li>
                                            Tidak ada data
                                        </li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 item">
                            <div class="f-item link">
                                <h4 class="widget-title">Layanan Kami</h4>
                                <ul>
                                    @forelse ($services as $service)
                                        <li>
                                            <a href="{{ url("/services/{$service->slug}") }}" class="d-flex">
                                                <i class="fas fa-angle-right mt-2"></i>
                                                <span>{{ $service->name }}</span>
                                            </a>
                                        </li>
                                    @empty
                                        <li>Belum ada data layanan</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 item">
                            <div class="f-item contact-widget">
                                <h4 class="widget-title">Hubungi Kami</h4>
                                <div class="address">
                                    <ul>
                                        <li>
                                            <div class="icon">
                                                <i class="fas fa-home"></i>
                                            </div>
                                            <div class="content">
                                                <strong>Alamat:</strong>

                                                @isset($profiles)
                                                    {!! $profiles->address !!}
                                                @else
                                                    Perum Permata Regency 1 Blok 10/28, Perun Gpa, Ngijo, Kec. Karang
                                                    Ploso, Kabupaten Malang, Jawa Timur 65152.
                                                    @endif
                                                </div>
                                            </li>
                                            <li>
                                                <div class="icon">
                                                    <i class="fas fa-envelope"></i>
                                                </div>
                                                <div class="content">
                                                    <strong>Email:</strong>
                                                    @isset($profiles)
                                                        <a href="mailto:{{ $profiles->email }}">{{ $profiles->email }}</a>
                                                    @else
                                                        <a href="mailto:info@hummatech.com">info@hummatech.com</a>
                                                    @endisset
                                                </div>
                                            </li>
                                            <li>
                                                @if (isset($profile) && $profile->type != null)
                                                        <div class="icon">
                                                            <i class="{{ $profile->type == 'wa' ? 'fab fa-whatsapp' : 'fas fa-phone' }}"></i>
                                                            </div>
                                                            <div class="content">
                                                                <strong>{{ $profile->type == 'wa' ? 'Whatsapp:' : 'Phone:' }}</strong>

                                                            @php
                                                                $cleanPhone = str_replace(['+', '-', ' '], '', $profile->phone);

                                                                if (substr($cleanPhone, 0, 2) === '62') {
                                                                    $phoneNumber = '0' . substr($cleanPhone, 2);
                                                                    $waNumber = $cleanPhone;
                                                                } elseif (substr($cleanPhone, 0, 1) === '0') {
                                                                    $waNumber = '62' . substr($cleanPhone, 1);
                                                                    $phoneNumber = $cleanPhone;
                                                                } else {
                                                                    $phoneNumber = $cleanPhone;
                                                                }
                                                            @endphp

                                                            <a href="{{ $profile->type == 'wa' ? 'https://wa.me/'. $waNumber : 'tel: '. $phoneNumber }}" target="_blank">{{ $phoneNumber }}</a>
                                                        </div>
                                                @else
                                                    <div class="icon">
                                                        <i class="fas fa-phone"></i>
                                                    </div>
                                                    <div class="content">
                                                        <strong>Phone</strong>
                                                        <a href="tel: 085176777785">085176777785</a>
                                                    </div>
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Start Footer Bottom -->
                <div class="footer-bottom">
                    <div class="container d-flex justify-content-center">
                        <div class="mt-0 p-4">
                            <div class="row">
                                <div class="col-lg-12">
                                    <p class="text-center" style="font-weight: 600">&copy; Copyright 2024. All Rights Reserved by <a
                                        href="{{ url('/') }}">Hummatech </a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Footer Bottom -->
            </footer>
            <!-- End Footer -->

            <!-- jQuery Frameworks
                                    ============================================= -->
            <script src="{{ asset('assets-home/js/jquery-3.6.0.min.js') }}"></script>
            <script src="{{ asset('assets-home/js/popper.min.js') }}"></script>
            <script src="{{ asset('assets-home/js/bootstrap.min.js') }}"></script>
            <script src="{{ asset('assets-home/js/jquery.appear.js') }}"></script>
            <script src="{{ asset('assets-home/js/jquery.easing.min.js') }}"></script>
            <script src="{{ asset('assets-home/js/jquery.magnific-popup.min.js') }}"></script>
            <script src="{{ asset('assets-home/js/modernizr.custom.13711.js') }}"></script>
            <script src="{{ asset('assets-home/js/owl.carousel.min.js') }}"></script>
            <script src="{{ asset('assets-home/js/wow.min.js') }}"></script>
            <script src="{{ asset('assets-home/js/progress-bar.min.js') }}"></script>
            <script src="{{ asset('assets-home/js/circle-progress.js') }}"></script>
            <script src="{{ asset('assets-home/js/isotope.pkgd.min.js') }}"></script>
            <script src="{{ asset('assets-home/js/imagesloaded.pkgd.min.js') }}"></script>
            <script src="{{ asset('assets-home/js/count-to.js') }}"></script>
            <script src="{{ asset('assets-home/js/YTPlayer.min.js') }}"></script>
            <script src="{{ asset('assets-home/js/bootsnav.js') }}"></script>
            <script src="{{ asset('assets-home/js/Chart.min.js') }}"></script>
            <script src="{{ asset('assets-home/js/custom-chart.js') }}"></script>
            <script src="{{ asset('assets-home/js/main.js') }}"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script src="owlcarousel/owl.carousel.min.js"></script>

        </body>

        <!-- Mirrored from validthemes.net/site-template/earna/index-4.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 26 Feb 2024 03:11:02 GMT -->

        </html>
