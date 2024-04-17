<div>
    <section id="featured-services" class="featured-services">
        <div class="section-header">
            <h2>Layanan Kami</h2>
        </div>
        <div class="container">

            <div class="row gy-3">

                @foreach ($services as $service)
                    @if ($service->service_slug != 'all-development')
                        <div class="col-xl col-md d-flex" data-aos="zoom-out">
                            <div class="service-item position-relative">
                                <div class="icon"><i class="{{ $service->service_icon }} icon"></i></div>
                                <h4><a href="" class="stretched-link">{{ $service->service_name }}</a></h4>
                                <p>{{ $service->service_description }}</p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

        </div>
    </section>
</div>
