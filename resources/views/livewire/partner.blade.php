<div>
    <section id="clients" class="clients">
        <div class="section-header">
            <h2>Mitra Kami</h2>
        </div>
        <div class="container" data-aos="zoom-out">

            <div class="clients-slider swiper">
                <div class="swiper-wrapper align-items-center">
                    @foreach ($partners as $partner)
                        <div class="swiper-slide"><img src="{{ asset('storage/partners/' . $partner->logo) }}"
                                class="img-fluid" alt="{{ $partner->name }}"></div>
                    @endforeach
                </div>
            </div>

        </div>
    </section>

</div>
