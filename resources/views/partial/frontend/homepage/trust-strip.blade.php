{{-- Le_Almmora Homepage — Our Promise / Customer Stories --}}
<section class="la-section la-trust-strip" aria-label="Our Promise and Customer Stories">
    <div class="la-trust-strip__grid">
        <div class="la-trust-strip__video la-reveal{{ !empty($video[1]->image) ? ' js-la-video-panel' : '' }}">
            @if(!empty($video[1]->image))
                <video muted loop playsinline poster="{{ asset('images/placeholder-500x600.svg') }}" aria-label="Our Promise">
                    <source src="{{ asset($video[1]->image) }}" type="video/mp4">
                </video>
                <button type="button" class="la-trust-strip__play js-la-video-play" aria-label="Play video">
                    <i class="fa fa-play" aria-hidden="true"></i>
                </button>
            @else
                <img src="{{ asset('images/placeholder-500x600.svg') }}" alt="Our Promise" loading="lazy">
            @endif

            <div class="la-trust-strip__video-overlay">
                <span class="la-eyebrow">OUR PROMISE</span>
                <p>For a cleaner home and a better planet.</p>
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
