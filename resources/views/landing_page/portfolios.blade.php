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
                    <h2>Portfolio</h2>
                    <ol>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li>Portfolio</li>
                    </ol>
                </div>

            </div>
        </div><!-- End Breadcrumbs -->

        <!-- ======= Blog Section ======= -->
        <section id="blog" class="blog">
            <div class="container" data-aos="fade-up">

                <div class="row g-5">

                    <div class="col-lg-8">

                        <div class="row gy-4 posts-list">

                            @foreach ($portfolios as $portfolio)
                                <div class="col-lg-6">
                                    <article class="d-flex flex-column">

                                        <div class="post-img">
                                            <img src="{{ asset('storage/portfolios/' . $portfolio->img_thumbnail) }}"
                                                alt="{{ $portfolio->slug_title }}" class="img-fluid">
                                        </div>

                                        <h2 class="title">
                                            <a
                                                href="{{ route('portfolio.detail', $portfolio->slug_title) }}">{{ $portfolio->title }}</a>
                                        </h2>

                                        <div class="meta-top">
                                            <ul>
                                                <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a
                                                        href="{{ route('portfolio.detail', $portfolio->slug_title) }}">Administrator</a>
                                                </li>
                                                <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a
                                                        href="{{ route('portfolio.detail', $portfolio->slug_title) }}"><time
                                                            datetime="{{ date('Y-m-d', strtotime($portfolio->created_at)) }}">{{ date('d M Y', strtotime($portfolio->created_at)) }}</time></a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="content">
                                            <p>{{ $portfolio->description_excerpt }}</p>
                                        </div>

                                        <div class="read-more mt-auto align-self-end">
                                            <a href="{{ route('portfolio.detail', $portfolio->slug_title) }}">Read
                                                More</a>
                                        </div>

                                    </article>
                                </div><!-- End post list item -->
                            @endforeach

                        </div><!-- End blog posts list -->

                        <div class="blog-pagination">
                            {{ $portfolios->links('pagination') }}
                        </div><!-- End blog pagination -->

                    </div>

                    <div class="col-lg-4">

                        <div class="sidebar">

                            <div class="sidebar-item search-form">
                                <h3 class="sidebar-title">Search</h3>
                                <form action="{{ route('portfolios') }}" method="GET" class="mt-3">
                                    <input type="text" name="search" value="{{ old('search') }}">
                                    <button type="submit"><i class="bi bi-search"></i></button>
                                </form>
                            </div><!-- End sidebar search formn-->

                            <div class="sidebar-item categories">
                                <h3 class="sidebar-title">Categories</h3>
                                <ul class="mt-3">
                                    @foreach ($services as $service)
                                        <li><a href="#">{{ $service->service_name }}
                                                <span>({{ $service->portfolios->count() }})</span></a></li>
                                    @endforeach

                                </ul>
                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </section>
        <!-- End Blog Section -->

    </main>
    <!-- End #main -->

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
