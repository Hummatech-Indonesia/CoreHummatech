@extends('landing.layouts.layouts.app')
@section('title', 'Job Vacancy')
@section('style')
<style>
    .description ol{
        padding-left: 18px !important;
    }

    .description p{
        margin: 0px;
    }

    .qualification {
        font-size: 18px
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
<div class="thumb-services-area inc-thumbnail default-padding bottom-less">
    <!-- Shape -->
    <div class="right-shape">
        <img src="{{ asset('assets-home/img/shape/9.png') }}" alt="Shape">
    </div>
    <div class="left-shape" style="top: -10pc; left: -1pc">
        <img src="{{ asset('assets_landing/produk/circle.png') }}" alt="Shape">
    </div>
    <!-- Shape -->

    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="site-heading m-0 p-0 text-start">
                    <h4 class="text-uppercase">Detail lowongan</h4>
                    <h2 class="text-uppercase w-50">{{ $jobVacancy->name }}</h2>
                    <div class="description mt-3">
                        {!! $jobVacancy->description !!}
                    </div>
                    <div class="my-4">
                       <a data-animation="animated zoomInUp" class="btn btn-gradient effect btn-md" href="https://wa.me/{{ $jobVacancy->whatsapp }}" target="_blank">Lamar</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="mt-4">
                   <div class="">
                        <h3 style="font-weight: 600">Kualifikasi:</h3>
                        <div class="description mt-3 qualification">
                            {!! $jobVacancy->qualification !!}
                        </div>
                   </div>
                   <div class="mt-5">
                        <h3 style="font-weight: 600">Gaji:</h3>
                        <h4 style="font-weight: 500">Rp. {{ number_format($jobVacancy->salary, 0, ',', '.') }}</h4>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
