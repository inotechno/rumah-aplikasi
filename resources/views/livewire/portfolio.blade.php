<div>
    <section id="services" class="services">
        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h2>Portofolio Terbaru</h2>
                <p>Kualitas diatas segalanya.</p>
            </div>

            <div class="row gy-5">

                @foreach ($portfolios as $portfolio)
                    <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="200">
                        <div class="service-item">
                            <div class="img">
                                <img src="{{ asset('storage/portfolios/' . $portfolio->img_thumbnail) }}"
                                    class="img-fluid" alt="{{ $portfolio->slug_title }}">
                            </div>
                            <div class="details position-relative">
                                <div class="icon">
                                    <i class="bi bi-activity"></i>
                                </div>
                                <a href="{{ route('portfolio.detail', $portfolio->slug_title) }}"
                                    class="stretched-link">
                                    <h3>{{ $portfolio->title }}</h3>
                                </a>
                                <p>{{ $portfolio->description_excerpt }}</p>

                                <div class="text-center mt-3">
                                    @if ($portfolio->status_portfolio == 'release')
                                        <span class="label label-success">Release</span>
                                    @elseif ($portfolio->status_portfolio == 'beta')
                                        <span class="label label-warning">Beta</span>
                                    @elseif ($portfolio->status_portfolio == 'development')
                                        <span class="label label-danger">Development</span>
                                    @else
                                        <span class="label label-other">Tidak ada status</span>
                                    @endif
                                </div>

                            </div>

                        </div>
                    </div>
                @endforeach
            </div>

        </div>
        <br>
        <br>
        @if ($portfolios->count() > 5)
            <div class="section-header">
                <div class="mt-auto align-self-end">
                    <a class="see-all" href="{{ route('portfolios') }}">See All</a>
                </div>
            </div>
        @endif
    </section>
</div>
