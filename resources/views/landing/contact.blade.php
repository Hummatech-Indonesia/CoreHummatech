@extends('landing.layouts.layouts.app')
@section('title', 'Contact')
@section('seo')
    <meta name="title" content="Hubungi Kami - Layanan Hummatech" />
    <meta name="og:image" content="{{ asset('mobilelogo.png') }}" />
    <meta name="description"
        content="Hummatech adalah perusahaan software development terbaik di Malang. Kami menyediakan solusi perangkat lunak yang inovatif dan berkualitas tinggi." />
    <meta name="twitter:image" content="{{ asset('mobilelogo.png') }}" />
    <meta property="og:url" content="{{ url('/') }}" />
    <meta property="og:type" content="website" />
    <link rel="canonical" href="{{ url('/') }}" />
@endsection
@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        #maps1 {
            height: 400px;
        }
    </style>

    <style>
        .popup-content {
            margin-top: 10px;
        }
    </style>
@endsection

@section('content')
    <div class="breadcrumb-area text-center shadow dark text-light bg-cover"
        style="background-image: url('{{ $background == null ? asset('assets-home/img/default-bg.png') : asset('storage/' . $background->image) }}');">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <h1>Hubungi Kami</h1>
                    <ul class="breadcrumb">
                        <li><a href="#"><i class="fas fa-home"></i> Beranda</a></li>
                        <li class="active">Hubungi Kami</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Start Contact Area ============================================= -->
    <div class="contact-us-area default-padding mb-5">
        <div class="container">
            <div class="row align-center">
                <div class="col-lg-5 info">
                    <div class="content">
                        <h2>Hubungi Kami</h2>
                        <p>
                            Kami di Sini untuk Anda! Hubungi Kami untuk Bantuan Langsung
                        </p>
                        <ul>
                            <li>
                                <div class="icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="content">
                                    <h5>Address</h5>
                                    <p>
                                        @isset($profiles)
                                            {{ $profiles->address }}
                                        @else
                                            Perum Permata Regency 1 Blok 10/28, Perun Gpa, Ngijo, Kec. Karang
                                            Ploso, Kabupaten Malang, Jawa Timur 65152.
                                            @endif
                                        </p>
                                    </div>
                                </li>
                                <li>
                                    @if ($profile->type != null)
                                        <div class="icon">
                                            <i class="{{ $profile->type == 'wa' ? 'fab fa-whatsapp' : 'fas fa-phone' }}"></i>
                                        </div>
                                        <div class="content">
                                            <h5>{{ $profile->type == 'wa' ? 'WhatsApp' : 'Phone' }}</h5>
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

                                            <a href="{{ $profile->type == 'wa' ? 'https://wa.me/' . $waNumber : 'tel: ' . $phoneNumber }}"
                                                target="_blank">{{ $phoneNumber }}</a>
                                        </div>
                                    @else
                                        <div class="icon">
                                            <i class="fas fa-phone"></i>
                                        </div>
                                        <div class="content">
                                            <h5>Phone</h5>
                                            <a href="tel: 085176777785">085176777785</a>
                                        </div>
                                    @endif
                                </li>
                                <li>
                                    <div class="icon">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div class="content">
                                        <h5>Email</h5>
                                        <p>
                                            @isset($profiles)
                                                <a href="mailto:{{ $profiles->email }}">{{ $profiles->email }}</a>
                                            @else
                                                <a href="mailto:info@hummatech.com">info@hummatech.com</a>
                                            @endisset
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-7 contact-form-box">
                        @if(session('berhasil'))
                            <div class="alert alert-success d-flex align-items-center" role="alert">
                                <i class="fas fa-check-circle"></i>
                                <span class="px-1"></span>
                                <div class="">
                                    {{ session('berhasil') }}
                                </div>
                            </div>
                        @endif
                        @if(session('gagal'))
                            <div class="alert alert-danger d-flex align-items-center" role="alert">
                                <i class="fas fa-times-circle"></i>
                                <span class="px-1"></span>
                                <div class="">
                                    {{ session('gagal') }}
                                </div>
                            </div>
                        @endif
                        <div class="form-box">
                            <form action="{{ route('contact.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input class="form-control" id="name" value="{{ old('name') }}"
                                                name="name" placeholder="Name" type="text">
                                            <span class="alert-error"></span>
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input class="form-control" id="email" value="{{ old('email') }}"
                                                name="email" placeholder="Email*" type="email">
                                            <span class="alert-error"></span>
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input class="form-control" id="no_telp" value="{{ old('no_telp') }}"
                                                name="no_telp" placeholder="Phone" type="text">
                                            <span class="alert-error"></span>
                                            @error('no_telp')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group comments">
                                            <textarea class="form-control" id="comments" name="description" placeholder="Tell Us About Project *">{{ old('description') }}</textarea>
                                            @error('description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 mb-3">
                                        <div id="cf-turnstile"></div>
                                    </div>
                                    <div class="col-lg-12">
                                        <button type="submit" >
                                            Send Message <i class="fa fa-paper-plane"></i>
                                        </button>
                                    </div>
                                    <!-- Alert Message -->
                                    <div class="col-lg-12 alert-notification">
                                        <div id="message" class="alert-msg"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Contact Area -->

        @if ($branches->count() > 0)
            <!-- Star Google Maps ============================================= -->
            <div class="maps-area">
                <div class="google-maps">
                    <div id="maps1"></div>
                </div>
            </div>
            <!-- End Google Maps -->
        @endif
    @endsection
@section('script')
    <style>
        .leaflet-marker-icon {
            background-image: url('{{ asset('marker1.png') }}');
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            width: 60px;
            height: 60px;
        }
    </style>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js?onload=onloadTurnstileCallback" defer></script>

    @if ($branches->count() > 0)
        <script>
            var map = L.map('maps1');

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors'
            }).addTo(map);

            var markers = [];
            var bounds = L.latLngBounds();

            @foreach ($branches as $branch)
                var marker = L.marker([{{ $branch->latitude }}, {{ $branch->lotitude }}]).addTo(map);
                marker.setIcon(L.icon({
                    iconUrl: '{{ asset('marker1.png') }}',
                    iconSize: [60, 60],
                    iconAnchor: [20, 20]
                }));
                marker.bindPopup("<div class='popup-content'><b>{{ $branch->name }}</b><br>{{ $branch->address }}</div>");
                markers.push(marker);
                bounds.extend(marker.getLatLng());

                @if ($branch->type === 'center')
                    map.setView(marker.getLatLng(), 12);
                    marker.openPopup();
                @endif
            @endforeach

            map.fitBounds(bounds);
        </script>
    @endif

    {{-- For Cloudflare Turnstile --}}
    <script>
        window.onloadTurnstileCallback = function() {
            turnstile.render('#cf-turnstile', {
                sitekey: "{{ config('turnstile.site_key') }}",
            });
        };
    </script>
@endsection
