@extends('landing.layouts.layouts.app')
@section('title', $news->title . ' - Berita')
@section('description')
    <meta name="description" content="{{ Str::limit(strip_tags($news->description), 200) }}" />
@endsection
{{-- @section('title', $slugs->name) --}}
@section('seo')
<meta name="title" content="{{ $news->title }} - Hummatech" />
<meta name="og:image" content="{{ asset('storage/' . $news->image) }}"/>
<meta name="og:image:secure_url" content="{{ asset('storage/' . $news->image) }}"/>
<meta name="og:image:type" content="image/jpeg" />
<meta property="og:image" content="{{ asset('storage/' . $news->image) }}" />
<meta property="og:image:alt" content="{{ $news->title }}" />
<meta property="og:url" content="{{ url('/') }}" />
<meta property="og:type" content="article" />
<link rel="canonical" href="{{ url('/') }}" />

<style>
    /* Style untuk gambar */
    .og-image {
        width: 1200px; /* Lebar gambar */
        height: 630px; /* Tinggi gambar */
        object-fit: cover;
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
    
    .ql-align-justify {
        text-align: justify;
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
        <div class="container">
            <div class="blog-items">
                <div class="row">
                    <div class="blog-content col-lg-8 col-md-12">
                        <div class="blog-item-box">
                            <!-- Single Item -->
                            <div class="single-item">
                                <div class="item">
                                    <div class="thumb">
                                        <a href=""><img src="{{ asset('storage/' . $news->thumbnail) }}"
                                                alt="{{ $news->title }}"></a>
                                        <time class="date">
                                            {{ \Carbon\Carbon::parse($news->date)->locale('id_ID')->isoFormat('D MMMM Y') }}
                                        </time>
                                    </div>
                                    <div class="info">
                                        <div class="meta">
                                            <ul>
                                                <li>
                                                    <img src="{{ asset('mobilelogo.png') }}" alt="Hummatech Logo" />
                                                    @php
                                                        $newsCategories = App\Models\NewsCategory::where('news_id', $news->id)->get();
                                                    @endphp
                                                    <div class="categories">
                                                        @foreach ($newsCategories as $index => $newsCategory)
                                                            <a href="javascript:void(0)" class="category-link">{{ $newsCategory->category->name }}</a>
                                                            @if (!$loop->last)
                                                                <a>,</a>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <h3>
                                            <a href="{{ url("/news/{$news->slug}") }}">{{ $news->title }}</a>
                                        </h3>
                                        <p>
                                        <div style="white-space: pre-wrap;">{!! $news->description !!}</div>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Start Sidebar -->
                    <div class="sidebar wow fadeInLeft col-lg-4 col-md-12">
                        <aside>
                            <div class="sidebar-item search">
                                <div class="sidebar-info">
                                    <form>
                                        <input type="text" name="text" class="form-control">
                                        <button type="submit"><i class="fas fa-search"></i></button>
                                    </form>
                                </div>
                            </div>
                            <div class="sidebar-item recent-post">
                                <div class="title">
                                    <h4>Berita Lainnya</h4>
                                </div>
                                @if ($otherNews->count() > 0)
                                    <ul>
                                        @foreach ($otherNews as $news)
                                            <li>
                                                <div class="thumb">
                                                    <a href="{{ url("news/{$news->slug}") }}">
                                                        <img alt="{{ $news->title }}"
                                                            src="{{ asset("storage/{$news->thumbnail}") }}" />
                                                    </a>
                                                </div>
                                                <div class="info">
                                                    <div class="meta-title">
                                                        <time class="post-date"><i class="fas fa-clock"></i>
                                                            {{ \Carbon\Carbon::parse($news->date)->locale('id_ID')->isoFormat('D MMMM Y') }}</time>
                                                    </div>
                                                    <a class="d-block mb-2"
                                                        href="{{ url("news/{$news->slug}") }}">{{ Str::limit($news->title, 45, '...') }}</a>
                                                    <p class="mb-0">{{ Str::limit(strip_tags($news->description), 20) }}
                                                    </p>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <div class="mx-auto d-flex flex-column justify-content-center text-center">
                                        <img src="{{ asset('nodata-gif-post.gif') }}" alt="No Data" height="200"
                                            class="mx-auto" width="200" />
                                        <p class="text-muted">Belum ada berita</p>
                                    </div>
                                @endif
                            </div>
                        </aside>
                    </div>
                    <!-- End Start Sidebar -->
                </div>
            </div>
        </div>
    </div>
@endsection
