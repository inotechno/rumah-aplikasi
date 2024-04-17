<!DOCTYPE html>
<html lang="en">

@include('landing_page.section.head')

<body>

    <div itemprop="image" itemscope="itemscope" itemtype="http://schema.org/ImageObject">
        <meta content="{{ asset('img/' . config('settings.app_logo_crop')) }}" itemprop="url" />
    </div>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top" data-scrollto-offset="0">
        <div class="container-fluid d-flex align-items-center justify-content-between">

            <a href="{{ url('/') }}" class="logo d-flex align-items-center scrollto me-auto me-lg-0">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <img src="{{ asset('img/' . config('settings.app_logo_full')) }}" alt="">
            </a>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto" href="#">Home</a></li>
                    <li><a class="nav-link scrollto" href="{{ url('/') }}#services">Portfolio</a></li>
                    <li><a class="nav-link scrollto" href="{{ url('/') }}#featured-services">Services</a></li>
                    <li><a class="nav-link scrollto" href="{{ url('/') }}#about">About</a></li>
                    <li><a class="nav-link scrollto" href="{{ url('/') }}#recent-blog-posts">Blog</a></li>
                    <li><a class="nav-link scrollto" href="{{ url('/') }}#contact">Contact</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle d-none"></i>
            </nav><!-- .navbar -->
        </div>
    </header>

    <!-- End Header -->

    <section id="hero-animated" class="hero-animated d-flex align-items-center">
        <div class="container d-flex flex-column justify-content-center align-items-center text-center position-relative"
            data-aos="zoom-out">
            <img src="{{ asset('img/rumahaplikasi.png') }}" class="img-fluid animated">
            <h2>Kualitas nomor <span>SATU</span></h2>
            <p style="text-align: justify;">Rumah Aplikasi memberikan pelayanan jasa pembuatan aplikasi web, android dan
                ios, serta kami juga menyediakan beberapa aplikasi yang telah kami buat, dimana aplikasi tersebut dapat
                digunakan untuk sekolah, pondok pesantren, universitas, perusahaan dan instansi pemerintah.</p>
        </div>
    </section>

    <main id="main">
        <!-- ======= Portfolio Section ======= -->
        @livewire('portfolio')
        @livewire('service')
        @livewire('about')
        @livewire('partner')

        @include('landing_page.section.faq')

        @livewire('recent-blog')

        @include('landing_page.section.contact')

        <!-- End Portfolio Section -->
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    @include('landing_page.section.footer')
    <!-- End Footer -->

    <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    @include('landing_page.section.plugins')

</body>

</html>
