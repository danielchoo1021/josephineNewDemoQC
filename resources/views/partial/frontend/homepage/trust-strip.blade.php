{{-- Le_Almmora Homepage — Our Promise / Customer Stories --}}
<section class="la-section la-trust-strip" aria-label="Our Promise and Customer Stories">
    <div class="la-trust-strip__grid">
        <div class="la-trust-strip__video la-reveal">
            @if(!empty($video[1]->image))
                <video autoplay muted loop playsinline poster="{{ asset('images/placeholder-500x600.svg') }}" aria-label="Our Promise">
                    <source src="{{ asset($video[1]->image) }}" type="video/mp4">
                </video>
            @else
                <img src="{{ asset('images/placeholder-500x600.svg') }}" alt="Our Promise" loading="lazy">
            @endif

            @php
                $la_is_cn = isset($_COOKIE['global_language']) && $_COOKIE['global_language'] == '1';
                $la_video_title = $la_is_cn ? ($video[1]->title_cn ?? null) : ($video[1]->title ?? null);
                $la_video_text = $la_is_cn ? ($video[1]->text_cn ?? null) : ($video[1]->text ?? null);
            @endphp
            <div class="la-trust-strip__video-overlay">
                <span class="la-eyebrow">{{ !empty($la_video_title) ? $la_video_title : ($la_is_cn ? '我们的承诺' : 'OUR PROMISE') }}</span>
                <p>{{ !empty($la_video_text) ? $la_video_text : ($la_is_cn ? '为了更干净的家，也为了更好的地球。' : 'For a cleaner home and a better planet.') }}</p>
            </div>
        </div>

        <div class="la-trust-strip__quote la-reveal">
            <span class="la-eyebrow">WHAT OUR CUSTOMERS SAY</span>
            <p class="la-trust-strip__quote-text">&ldquo;Gentle on the hands, tough on grease &mdash; exactly what we look for in an everyday clean.&rdquo;</p>
            <div class="la-trust-strip__rating" aria-hidden="true">
                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
            </div>
            <span class="la-trust-strip__customer">Verified Customer</span>
        </div>

        <div class="la-trust-strip__photo la-reveal">
            <img src="{{ asset('images/placeholder-500x600.svg') }}" alt="Family using Le_Almmora products" loading="lazy">
        </div>
    </div>
</section>
