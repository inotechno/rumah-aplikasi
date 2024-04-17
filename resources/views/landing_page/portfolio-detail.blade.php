<!DOCTYPE html>
<html lang="en">
@include('landing_page.section.head')

<body>
    <div itemprop="image" itemscope="itemscope" itemtype="http://schema.org/ImageObject">
        <meta content="{{ asset('img/' . config('settings.app_logo_crop')) }}" itemprop="url" />
    </div>

    <!-- ======= Header ======= -->
    @include('landing_page.section.header-page')
    <!-- End Header -->

    <main id="main">
        <!-- ======= Breadcrumbs ======= -->
        <div class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2>Portofolio Details</h2>
                    <ol>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ url('/portfolios') }}">Portofolio</a></li>
                        <li>Portofolio Details</li>
                    </ol>
                </div>

            </div>
        </div><!-- End Breadcrumbs -->

        <!-- ======= Blog Details Section ======= -->
        <section id="blog" class="blog">
            <div class="container" data-aos="fade-up">

                <div class="row g-5">

                    <div class="col-lg-8">

                        <article class="blog-details">

                            <div class="post-img">
                                <img src="{{ asset('storage/portfolios/' . $portfolio->img_thumbnail) }}"
                                    alt="{{ $portfolio->slug_title }}" class="img-fluid" width="100%">
                            </div>

                            <h2 class="title">{{ $portfolio->title }}</h2>

                            <div class="meta-top">
                                <ul>
                                    <li class="d-flex align-items-center"><i class="bi bi-person"></i>
                                        <a>Administrator</a>
                                    </li>
                                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a><time
                                                datetime="{{ date('Y-m-d', strtotime($portfolio->created_at)) }}">{{ date('d M Y', strtotime($portfolio->created_at)) }}</time></a>
                                    </li>

                                    <li class="d-flex align-items-center">

                                        @if ($portfolio->status_portfolio == 'release')
                                            <i class="bi bi-cloud-haze2-fill"></i> <a class="text-success">Release</a>
                                        @elseif ($portfolio->status_portfolio == 'beta')
                                            <i class="bi bi-cloud-haze2-fill"></i> <a class="text-info">Beta</a>
                                        @elseif ($portfolio->status_portfolio == 'development')
                                            <i class="bi bi-cloud-haze2-fill"></i> <a
                                                class="text-warning">Development</a>
                                        @else
                                            <i class="bi bi-cloud-haze2-fill"></i> <a class="text-danger">Tidak ada
                                                status</a>
                                        @endif
                                    </li>
                                </ul>
                            </div><!-- End meta top -->

                            <div class="content">
                                {!! $portfolio->description !!}
                            </div><!-- End post content -->

                            <div class="meta-bottom">
                                <i class="bi bi-folder"></i>
                                <ul class="cats">
                                    <li><a href="#">{{ $portfolio->service->service_name }}</a></li>
                                </ul>

                                <!-- <i class="bi bi-tags"></i> -->
                                <ul class="cats float-right">
                                    <span>Bagikan Ke : </span>
                                    <!-- Sharingbutton Facebook -->
                                    <li>
                                        <a class="resp-sharing-button__link"
                                            href="https://facebook.com/sharer/sharer.php?u={{ url()->current() }}"
                                            target="_blank" rel="noopener" aria-label="">
                                            <div
                                                class="resp-sharing-button resp-sharing-button--facebook resp-sharing-button--small">
                                                <div aria-hidden="true"
                                                    class="resp-sharing-button__icon resp-sharing-button__icon--solid">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                        <path
                                                            d="M18.77 7.46H14.5v-1.9c0-.9.6-1.1 1-1.1h3V.5h-4.33C10.24.5 9.5 3.44 9.5 5.32v2.15h-3v4h3v12h5v-12h3.85l.42-4z" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </a>
                                    </li>

                                    <!-- Sharingbutton Twitter -->
                                    <li>
                                        <a class="resp-sharing-button__link"
                                            href="https://twitter.com/intent/tweet/?text=Silahkan%20kunjungi%20tautan%20dibawah%20ini%20untuk%20lihat%20selengkapnya%20%3A&amp;url={{ url()->current() }}"
                                            target="_blank" rel="noopener" aria-label="">
                                            <div
                                                class="resp-sharing-button resp-sharing-button--twitter resp-sharing-button--small">
                                                <div aria-hidden="true"
                                                    class="resp-sharing-button__icon resp-sharing-button__icon--solid">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                        <path
                                                            d="M23.44 4.83c-.8.37-1.5.38-2.22.02.93-.56.98-.96 1.32-2.02-.88.52-1.86.9-2.9 1.1-.82-.88-2-1.43-3.3-1.43-2.5 0-4.55 2.04-4.55 4.54 0 .36.03.7.1 1.04-3.77-.2-7.12-2-9.36-4.75-.4.67-.6 1.45-.6 2.3 0 1.56.8 2.95 2 3.77-.74-.03-1.44-.23-2.05-.57v.06c0 2.2 1.56 4.03 3.64 4.44-.67.2-1.37.2-2.06.08.58 1.8 2.26 3.12 4.25 3.16C5.78 18.1 3.37 18.74 1 18.46c2 1.3 4.4 2.04 6.97 2.04 8.35 0 12.92-6.92 12.92-12.93 0-.2 0-.4-.02-.6.9-.63 1.96-1.22 2.56-2.14z" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </a>
                                    </li>

                                    <!-- Sharingbutton E-Mail -->
                                    <li>
                                        <a class="resp-sharing-button__link"
                                            href="mailto:?subject=Silahkan%20kunjungi%20tautan%20dibawah%20ini%20untuk%20lihat%20selengkapnya%20%3A&amp;body={{ url()->current() }}"
                                            target="_self" rel="noopener" aria-label="">
                                            <div
                                                class="resp-sharing-button resp-sharing-button--email resp-sharing-button--small">
                                                <div aria-hidden="true"
                                                    class="resp-sharing-button__icon resp-sharing-button__icon--solid">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                        <path
                                                            d="M22 4H2C.9 4 0 4.9 0 6v12c0 1.1.9 2 2 2h20c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zM7.25 14.43l-3.5 2c-.08.05-.17.07-.25.07-.17 0-.34-.1-.43-.25-.14-.24-.06-.55.18-.68l3.5-2c.24-.14.55-.06.68.18.14.24.06.55-.18.68zm4.75.07c-.1 0-.2-.03-.27-.08l-8.5-5.5c-.23-.15-.3-.46-.15-.7.15-.22.46-.3.7-.14L12 13.4l8.23-5.32c.23-.15.54-.08.7.15.14.23.07.54-.16.7l-8.5 5.5c-.08.04-.17.07-.27.07zm8.93 1.75c-.1.16-.26.25-.43.25-.08 0-.17-.02-.25-.07l-3.5-2c-.24-.13-.32-.44-.18-.68s.44-.32.68-.18l3.5 2c.24.13.32.44.18.68z" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </a>
                                    </li>

                                    <!-- Sharingbutton WhatsApp -->
                                    <li>
                                        <a class="resp-sharing-button__link"
                                            href="https://api.whatsapp.com/send?text=Silahkan%20kunjungi%20tautan%20dibawah%20ini%20untuk%20lihat%20selengkapnya%20%3A%20{{ url()->current() }}"
                                            target="_blank" rel="noopener" aria-label="">
                                            <div
                                                class="resp-sharing-button resp-sharing-button--whatsapp resp-sharing-button--small">
                                                <div aria-hidden="true"
                                                    class="resp-sharing-button__icon resp-sharing-button__icon--solid">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                        <path
                                                            d="M20.1 3.9C17.9 1.7 15 .5 12 .5 5.8.5.7 5.6.7 11.9c0 2 .5 3.9 1.5 5.6L.6 23.4l6-1.6c1.6.9 3.5 1.3 5.4 1.3 6.3 0 11.4-5.1 11.4-11.4-.1-2.8-1.2-5.7-3.3-7.8zM12 21.4c-1.7 0-3.3-.5-4.8-1.3l-.4-.2-3.5 1 1-3.4L4 17c-1-1.5-1.4-3.2-1.4-5.1 0-5.2 4.2-9.4 9.4-9.4 2.5 0 4.9 1 6.7 2.8 1.8 1.8 2.8 4.2 2.8 6.7-.1 5.2-4.3 9.4-9.5 9.4zm5.1-7.1c-.3-.1-1.7-.9-1.9-1-.3-.1-.5-.1-.7.1-.2.3-.8 1-.9 1.1-.2.2-.3.2-.6.1s-1.2-.5-2.3-1.4c-.9-.8-1.4-1.7-1.6-2-.2-.3 0-.5.1-.6s.3-.3.4-.5c.2-.1.3-.3.4-.5.1-.2 0-.4 0-.5C10 9 9.3 7.6 9 7c-.1-.4-.4-.3-.5-.3h-.6s-.4.1-.7.3c-.3.3-1 1-1 2.4s1 2.8 1.1 3c.1.2 2 3.1 4.9 4.3.7.3 1.2.5 1.6.6.7.2 1.3.2 1.8.1.6-.1 1.7-.7 1.9-1.3.2-.7.2-1.2.2-1.3-.1-.3-.3-.4-.6-.5z" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </a>
                                    </li>

                                    <!-- Sharingbutton Telegram -->
                                    <li>
                                        <a class="resp-sharing-button__link"
                                            href="https://telegram.me/share/url?text=Silahkan%20kunjungi%20tautan%20dibawah%20ini%20untuk%20lihat%20selengkapnya%20%3A&amp;url={{ url()->current() }}"
                                            target="_blank" rel="noopener" aria-label="">
                                            <div
                                                class="resp-sharing-button resp-sharing-button--telegram resp-sharing-button--small">
                                                <div aria-hidden="true"
                                                    class="resp-sharing-button__icon resp-sharing-button__icon--solid">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                        <path
                                                            d="M.707 8.475C.275 8.64 0 9.508 0 9.508s.284.867.718 1.03l5.09 1.897 1.986 6.38a1.102 1.102 0 0 0 1.75.527l2.96-2.41a.405.405 0 0 1 .494-.013l5.34 3.87a1.1 1.1 0 0 0 1.046.135 1.1 1.1 0 0 0 .682-.803l3.91-18.795A1.102 1.102 0 0 0 22.5.075L.706 8.475z" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </a>
                                    </li>

                                </ul>
                            </div><!-- End meta bottom -->

                        </article><!-- End blog post -->

                        <!-- End blog comments -->

                    </div>

                    <div class="col-lg-4">

                        <div class="sidebar">

                            <div class="sidebar-item recent-posts">
                                <h3 class="sidebar-title">Portfolio Other</h3>

                                <div class="mt-3">
                                    @foreach ($latest_portfolios as $latest)
                                        <div class="post-item mt-3">
                                            <img src="{{ asset('storage/portfolios/' . $latest->img_thumbnail) }}"
                                                alt="" class="flex-shrink-0">
                                            <div>
                                                <h4><a
                                                        href="{{ route('portfolio.detail', $latest->slug_title) }}">{{ $latest->title }}</a>
                                                </h4>
                                                <time
                                                    datetime="{{ date('Y-m-d', strtotime($portfolio->created_at)) }}">{{ date('d M Y', strtotime($portfolio->created_at)) }}</time>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>


                            </div>
                            <!-- End sidebar recent posts-->
                            {{-- <div class="sidebar-item tags">
                                <h3 class="sidebar-title">Tags</h3>
                                <ul class="mt-3">
                                    @foreach ($portfolio->tags as $tag)
                                        <li><a href="#">{{ $tag->name }}</a></li>
                                    @endforeach
                                </ul>
                            </div> --}}
                            <!-- End sidebar tags-->

                        </div>
                        <!-- End Blog Sidebar -->

                    </div>
                </div>

            </div>
        </section><!-- End Blog Details Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    @include('landing_page.section.footer')
    <!-- End Footer -->

    <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <div id="preloader"></div>

    @include('landing_page.section.plugins')

</body>

</html>
