<!-- ======= Header ======= -->
<header id="header" class="header fixed-top" data-scrollto-offset="0">
    <div class="container-fluid d-flex align-items-center justify-content-between">

        <a href="{{ url('/') }}" class="logo d-flex align-items-center scrollto me-auto me-lg-0">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <img src="{{ asset('img/' . config('settings.app_logo_full')) }}" alt="">
        </a>

        <nav id="navbar" class="navbar">
            <ul>

                <li><a class="nav-link" href=""><i class="bi bi-twitter"></i></a></li>
                <li><a class="nav-link" href=""><i class="bi bi-facebook"></i></a></li>
                <li><a class="nav-link" href=""><i class="bi bi-instagram"></i></a></li>
                <li><a class="nav-link" href=""><i class="bi bi-skype"></i></a></li>
                <li><a class="nav-link" href=""><i class="bi bi-linkedin"></i></a></li>

            </ul>
            <i class="bi bi-list mobile-nav-toggle d-none"></i>
        </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->
