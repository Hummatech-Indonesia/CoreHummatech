<ul class="sidebar-links" id="simple-bar">
    <li class="back-btn">
        <a href="index.html">
            <img class="img-fluid" src="{{ asset('assets/images/logo/logo-icon.png') }}" alt="">
        </a>
        <div class="mobile-back text-end">
            <span>Back</span>
            <i class="fa fa-angle-right ps-2" aria-hidden="true"></i>
        </div>
    </li>
    <li class="pin-title sidebar-main-title">
        <div>
            <h6>Pinned</h6>
        </div>
    </li>
    <li class="sidebar-main-title">
        <div>
            <h6>Master</h6>
        </div>
    </li>
    <li class="sidebar-list">
        <i class="fa fa-thumb-tack"></i>
        <a class="sidebar-link sidebar-title link-nav" href="/home">
            <svg class="stroke-icon">
                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-home') }}"></use>
            </svg>
            <svg class="fill-icon">
                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-home') }}"></use>
            </svg>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="sidebar-list">
        <i class="fa fa-thumb-tack"></i>
        <a class="sidebar-link sidebar-title link-nav" href="/hero-section">
            <svg class="stroke-icon">
                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-job-search') }}"></use>
            </svg>
            <svg class="fill-icon">
                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-job-search') }}"></use>
            </svg>
            <span>Gambar Slider</span>
        </a>
    </li>
    <li class="sidebar-list">
        <i class="fa fa-thumb-tack"></i>
        <a class="sidebar-link sidebar-title" href="#">
            <svg class="stroke-icon">
                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-bookmark') }}"></use>
            </svg>
            <svg class="fill-icon">
                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-bookmark') }}"></use>
            </svg>
            <span>Layanan</span>
        </a>
        <ul class="sidebar-submenu">
            <li>
                <a href="/service">Layanan</a>
            </li>
            {{-- <li>
                <a href="{{ route('sale.index') }}">Penjualan</a>
            </li> --}}
            <li>
                <a href="/gallery">Galeri</a>
            </li>
        </ul>
    </li>
    <li class="sidebar-list">
        <i class="fa fa-thumb-tack"></i>
        <a class="sidebar-link sidebar-title" href="#">
            <svg class="stroke-icon">
                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-ecommerce') }}"></use>
            </svg>
            <svg class="fill-icon">
                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-ecommerce') }}"></use>
            </svg>
            <span>Produk</span>
        </a>
        <ul class="sidebar-submenu">
            <li>
                <a href="/category-product">Kategori</a>
            </li>
            <li >
                <a href="/admin/product">Produk</a>
            </li>
        </ul>
    </li>
    <li class="sidebar-list">
        <i class="fa fa-thumb-tack"></i>
        <a class="sidebar-link sidebar-title link-nav" href="/admin/portfolio">
            <i class="fa-brands fa-wpforms text-white"></i>
            <span class="ps-4">Portofolio</span>
        </a>
    </li>
    <li class="sidebar-list">
        <i class="fa fa-thumb-tack"></i>
        <a class="sidebar-link sidebar-title" href="#">
            <svg class="stroke-icon">
                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-learning') }}"></use>
            </svg>
            <svg class="fill-icon">
                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-learning') }}"></use>
            </svg>
            <span>Mitra</span>
        </a>
        <ul class="sidebar-submenu">
            <li>
                <a href="/category-collab">Kategori</a>
            </li>
            <li>
                <a href="/collab">Mitra</a>
            </li>
        </ul>
    </li>
    <li class="sidebar-main-title">
        <div>
            <h6>Lainnya</h6>
        </div>
    </li>
    <li class="sidebar-list">
        <i class="fa fa-thumb-tack"></i>
        <a class="sidebar-link sidebar-title" href="#">
            <svg class="stroke-icon">
                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-blog') }}"></use>
            </svg>
            <svg class="fill-icon">
                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-blog') }}"></use>
            </svg>
            <span>Berita</span>
        </a>
        <ul class="sidebar-submenu">
            <li>
                <a href="/category-news">Kategori</a>
            </li>
            <li>
                <a href="/admin/news/">Berita</a>
            </li>
        </ul>
    </li>
    <li class="sidebar-list">
        <i class="fa fa-thumb-tack"></i>
        <a class="sidebar-link sidebar-title link-nav" href="/testimonial">
            <svg class="stroke-icon">
                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-user') }}"></use>
            </svg>
            <svg class="fill-icon">
                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-user') }}"></use>
            </svg>
            <span>Testimoni</span>
        </a>
    </li>
    <li class="sidebar-list">
        <i class="fa fa-thumb-tack"></i>
        <a class="sidebar-link sidebar-title link-nav" href="/branch">
            <svg class="stroke-icon">
                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-maps') }}"></use>
            </svg>
            <svg class="fill-icon">
                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-maps') }}"></use>
            </svg>
            <span>Cabang</span>
        </a>
    </li>
    <li class="sidebar-list">
        <i class="fa fa-thumb-tack"></i>
        <a class="sidebar-link sidebar-title" href="#">
            <svg class="stroke-icon">
                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-knowledgebase') }}"></use>
            </svg>
            <svg class="fill-icon">
                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-knowledgebase') }}"></use>
            </svg>
            <span>Pengaturan</span>
        </a>
        <ul class="sidebar-submenu">
            <li>
                <a href="/setting/profile">Profile</a>
            </li>
            <li>
                <a href="/setting/philosophy">Filosofi Logo</a>
            </li>
            <li>
                <a href="/vision-mision">Visi & Misi</a>
            </li>
            <li>
                <a href="/terms_condition">Syarat & Ketentuan</a>
            </li>
            <li>
                <a href="/setting/departement">Jabatan</a>
            </li>
            <li>
                <a href="/setting/structure">Struktur</a>
            </li>
            <li>
                <a href="/setting/teams">Tim</a>
            </li>
            <li>
                <a href="/faq">FAQ</a>
            </li>
            <li>
                <a href="/procedure">Prosedur</a>
            </li>
            <li>
                <a href="/home-description">Produk beranda</a>
            </li>
        </ul>
    </li>
    <li class="sidebar-list">
        <i class="fa fa-thumb-tack"></i>
        <a class="sidebar-link sidebar-title" href="#">
            <svg class="stroke-icon">
                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-contact') }}"></use>
            </svg>
            <svg class="fill-icon">
                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-contact') }}"></use>
            </svg>
            <span>Kontak</span>
        </a>
        <ul class="sidebar-submenu">
            {{-- <li>
                <a href="/message-approval">Approval Pesan </a>
            </li> --}}
            <li>
                <a href="/social-media">Sosial Media</a>
            </li>
        </ul>
    </li>
    <li class="sidebar-list">
        <i class="fa fa-thumb-tack"></i>
        <a class="sidebar-link sidebar-title" href="#">
            <svg class="stroke-icon">
                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-builders') }}"></use>
            </svg>
            <svg class="fill-icon">
                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-builders') }}"></use>
            </svg>
            <span>Lowongan</span>
        </a>
        <ul class="sidebar-submenu">
            <li>
                <a href="{{ route('job-vacancy.index') }}">Lowongan</a>
            </li>
            <li>
                <a href="/workflow">Alur Kerja</a>
            </li>
        </ul>
    </li>
    {{-- <li class="sidebar-list">
        <i class="fa fa-thumb-tack"></i>
        <a class="sidebar-link sidebar-title" href="#">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="32" class="text-white"
                viewBox="0 0 448 512">
                <path fill="currentColor"
                    d="M219.3.5c3.1-.6 6.3-.6 9.4 0l200 40C439.9 42.7 448 52.6 448 64s-8.1 21.3-19.3 23.5L352 102.9V160c0 70.7-57.3 128-128 128S96 230.7 96 160v-57.1l-48-9.6v65.1l15.7 78.4c.9 4.7-.3 9.6-3.3 13.3S52.8 256 48 256H16c-4.8 0-9.3-2.1-12.4-5.9s-4.3-8.6-3.3-13.3L16 158.4V86.6C6.5 83.3 0 74.3 0 64c0-11.4 8.1-21.3 19.3-23.5zM111.9 327.7c10.5-3.4 21.8.4 29.4 8.5l71 75.5c6.3 6.7 17 6.7 23.3 0l71-75.5c7.6-8.1 18.9-11.9 29.4-8.5c65 20.9 112 81.7 112 153.6c0 17-13.8 30.7-30.7 30.7H30.7C13.8 512 0 498.2 0 481.3c0-71.9 47-132.7 111.9-153.6" />
            </svg>
            <span>Alumni</span>
        </a>
        <ul class="sidebar-submenu">
            <li>
                <a href="{{ route('force.index') }}">Angkatan</a>
            </li>
            <li>
                <a href="/social-media">Galeri Alumni</a>
            </li>
        </ul>
    </li> --}}
</ul>
