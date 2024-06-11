@extends('landing.layouts.layouts.app')
@section('description')
<meta name="description" content="Hummatech adalah perusahaan software development terbaik di Malang. Kami menyediakan solusi perangkat lunak yang inovatif dan berkualitas tinggi." />
@endsection
{{-- @section('title', $slugs->name) --}}
@section('seo')
    <meta name="title" content="Berita - Hummatech." />
    <meta name="og:image" content="{{ asset('mobilelogo.png') }}" />
    <meta name="twitter:image" content="{{ asset('mobilelogo.png') }}" />
    <meta property="og:url" content="{{ url('/') }}" />
    <meta property="og:type" content="website" />
    <link rel="canonical" href="{{ url('/') }}" />
@endsection
@section('title', 'Berita')
@section('style')
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
        .meta {
            overflow: hidden;
            padding: 10px;
            box-sizing: border-box;
        }

        .meta ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        .meta li {
            display: flex;
            align-items: center;
        }

        .meta img {
            margin-right: 10px;
        }

        .categories {
            flex-wrap: wrap;
            display: flex;
            gap: 0 5px;
            align-items: center;
        }

        .category-link {
            font-size: 12px;
            text-decoration: none;
            color: inherit;
        }

        .categories span {
            margin: 0 5px;
        }
    </style>
@endsection

@section('content')
    <div class="breadcrumb-area text-center shadow dark text-light bg-cover"
        style="background-image: url('{{ $background == null ? asset('assets-home/img/default-bg.png') : asset('storage/' . $background->image) }}');">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <h1>Berita</h1>
                    <ul class="breadcrumb">
                        <li><a href="{{ url('/') }}"><i class="fas fa-home"></i> Beranda</a></li>
                        <li class="active">Berita</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="blog-area right-sidebar full-blog mt-5">
        <div class="mx-5 px-5">
            <div class="blog-items">
                <div class="row">
                    <div class="col-12 col-xl-3 mb-4">
                        <!-- Start Sidebar -->
                        <div class="sidebar wow fadeInLeft card item border-0 py-4">
                            <aside>
                                <div class="sidebar-item recent-post">
                                    <div class="title">
                                        <h4>Kategori berita</h4>
                                    </div>
                                    <div class="sidebar-info me-5">
                                        <ul>
                                            <li>
                                                <a href="/news" class="{{ request()->is('news') ? 'text-primary' : '' }}">
                                                    Semua
                                                </a>
                                            </li>
                                            @foreach ($newsCategories as $category)
                                                <li>
                                                    <a class="{{ request()->is('news/category/' . $category->slug) ? 'active text-primary' : '' }}"
                                                        href="{{ url("/news/category/{$category->slug}") }}">{{ $category->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </aside>
                        </div>
                        <!-- End Start Sidebar -->
                    </div>

                    <div class="col-12 col-xl-9">
                        <div class="item rounded rounded-3 mb-4">
                            @forelse ($newses as $news)
                                @if ($news->news)
                                    <div class="p-4 row d-flex align-items-stretch">
                                        <div class="col-lg-4 d-flex align-items-stretch">
                                            <a href="/news/{{ $news->news->slug }}" class="d-flex align-items-stretch w-100">
                                                <img src="{{ asset('storage/' . $news->news->thumbnail) }}" 
                                                alt="{{ $news->news->title }}" 
                                                class="img-fluid rounded rounded-3 w-100" style="object-fit: cover;">
                                            </a>
                                        </div>
                                        <div class="col-lg-8 d-flex flex-column justify-content-start mb-3 mt-2">
                                            <div>
                                                <div class="meta p-0">
                                                    <ul>
                                                        <li>
                                                            {{-- <img src="{{ asset('mobilelogo.png') }}" alt="Hummatech Logo" style="width: 8px"/> --}}
                                                            @php
                                                                $newsCategories = App\Models\NewsCategory::where('news_id', $news->news->id)->get();
                                                            @endphp
                                                            <div class="categories">
                                                                @foreach ($newsCategories as $index => $newsCategory)
                                                                    <a href="{{ url('/news/category/'. $newsCategory->category->slug) }}" class="m-0" style="font-size: 13px; color: #000; text-decoration: underline;">{{ $newsCategory->category->name }}</a>
                                                                    @if (!$loop->last)
                                                                        <span>|</span>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <h4 class="m-1">
                                                    <a href="/news/{{ $news->news->slug }}" class="text-link">{{ $news->news->title }}</a>
                                                </h4>
                                                <p class="text-muted m-0">{{ \Carbon\Carbon::parse($news->date)->locale('id_ID')->isoFormat('D MMMM Y') }}</p>
                                                <p class="mt-2">{!! Str::limit(strip_tags($news->news->description), 70) !!}</p>
                                            </div>
                                            <a href="{{ route('news.view', $news->news->slug) }}" class="py-1 px-3 bg-primary text-white align-self-start mt-auto" style="font-size: 13px; border-radius: 20px">Baca selengkapnya 
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" width="9px" fill="#fff" class="mt-0">
                                                    <path d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                @else
                                    <div class="p-4 row d-flex align-items-stretch">
                                        <div class="col-lg-4 d-flex align-items-stretch">
                                            <a href="/news/{{ $news->slug }}" class="d-flex align-items-stretch w-100">
                                                <img src="{{ asset('storage/' . $news->thumbnail) }}" 
                                                alt="{{ $news->title }}" 
                                                class="img-fluid rounded rounded-3 w-100" style="object-fit: cover;">
                                            </a>
                                        </div>
                                        <div class="col-lg-8 mb-3 mt-2">
                                           
                                                <div class="meta p-0">
                                                    <ul>
                                                        <li>
                                                            {{-- <img src="{{ asset('mobilelogo.png') }}" alt="Hummatech Logo" style="width: 8px"/> --}}
                                                            @php
                                                                $newsCategories = App\Models\NewsCategory::where('news_id', $news->id)->get();
                                                            @endphp
                                                            <div class="categories">
                                                                @foreach ($newsCategories as $index => $newsCategory)
                                                                    <a href="{{ url('/news/category/'. $newsCategory->category->slug) }}" class="m-0" style="font-size: 13px; color: #000; text-decoration: underline;">{{ $newsCategory->category->name }}</a>
                                                                    @if (!$loop->last)
                                                                        <span>|</span>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <h4 class="m-1">
                                                    <a href="/news/{{ $news->slug }}" class="text-primary">{{ $news->title }}</a>
                                                </h4>
                                                <p class="text-muted m-0">{{ \Carbon\Carbon::parse($news->date)->locale('id_ID')->isoFormat('D MMMM Y') }}</p>
                                                <p class="mt-2">{!! Str::limit(strip_tags($news->description), 120) !!}</p>
                                            
                                            <a href="{{ route('news.view', $news->slug) }}" class="py-1 px-3 bg-primary text-white align-self-start" style="font-size: 13px; border-radius: 20px">Baca selengkapnya 
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" width="9px" fill="#fff" class="mt-0">
                                                    <path d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            @empty
                                <div class="d-flex justify-content-center col-12 ">
                                    <img src="{{ asset('nodata-gif.gif') }}" width="400px" alt=""
                                        srcset="">
                                </div>
                                <h4 class="fs-1 text-center text-dark col-12 pb-5" style="font-weight: 600">
                                    Data Masih Kosong
                                </h4>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
