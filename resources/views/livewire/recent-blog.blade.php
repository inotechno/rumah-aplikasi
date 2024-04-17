<div>
    <section id="recent-blog-posts" class="recent-blog-posts">

        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h2>Blog</h2>
                @if ($posts->count() > 0)
                    <p>Recent posts form our Blog</p>
                @else
                    <p>Belum ada artikel</p>
                @endif
            </div>

            <div class="row">

                @foreach ($posts as $post)
                    <div class="col-lg-4 mt-md-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="post-box">
                            <div class="post-img"><img src="{{ asset('storage/posts/' . $post->img_thumbnail) }}"
                                    class="img-fluid" alt="{{ $post->slug_title }}"></div>
                            <div class="meta">
                                <span class="post-date">{{ date('D d, F Y', strtotime($post->created_at)) }}</span>
                                <span class="post-author"> / Administrator</span>
                            </div>
                            <h3 class="post-title">{{ $post->title }}</h3>
                            <p style="text-align: justify;">{{ $post->description_excerpt }}</p>
                            <a href="{{ route('post.detail', $post->slug_title) }}"
                                class="readmore stretched-link"><span>Read
                                    More</span><i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                @endforeach

            </div>

        </div>
        <br>
        <br>

        @if ($posts->count() > 2)
            <div class="section-header">
                <div class="mt-auto align-self-end">
                    <a class="see-all" href="{{ route('posts') }}">See All</a>
                </div>
            </div>
        @endif
    </section>
</div>
