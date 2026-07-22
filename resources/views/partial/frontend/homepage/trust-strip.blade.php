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

        <div class="la-trust-strip__quote la-reveal"{{ isset($reviews) && $reviews->count() > 0 ? ' data-la-review-carousel' : '' }}>
            <span class="la-eyebrow">WHAT OUR CUSTOMERS SAY</span>

            @if(!isset($reviews) || $reviews->isEmpty())
                <p class="la-trust-strip__quote-text">&ldquo;Gentle on the hands, tough on grease &mdash; exactly what we look for in an everyday clean.&rdquo;</p>
                <div class="la-trust-strip__rating" aria-hidden="true">
                    <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                </div>
                <span class="la-trust-strip__customer">Verified Customer</span>
            @else
                <div class="la-review-carousel__track">
                    @foreach($reviews as $la_r_index => $review)
                        @php
                            $la_is_cn = isset($_COOKIE['global_language']) && $_COOKIE['global_language'] == '1';
                            $la_review_text = $la_is_cn ? ($review->review_text_cn ?: $review->review_text) : $review->review_text;
                            $la_customer_name = $la_is_cn ? ($review->customer_name_cn ?: $review->customer_name) : $review->customer_name;
                        @endphp
                        <div class="la-review-carousel__slide{{ $la_r_index === 0 ? ' la-is-active' : '' }}" data-la-review-slide="{{ $la_r_index }}">
                            <p class="la-trust-strip__quote-text">&ldquo;{{ $la_review_text }}&rdquo;</p>
                            <div class="la-trust-strip__rating" aria-hidden="true">
                                @for($la_star = 1; $la_star <= 5; $la_star++)
                                    <i class="fa fa-star{{ $la_star <= $review->rating ? '' : '-o' }}"></i>
                                @endfor
                            </div>
                            @if(!empty($review->image))
                                <img src="{{ asset($review->image) }}" alt="{{ $la_customer_name }}" class="la-review-carousel__avatar" loading="lazy">
                            @endif
                            <span class="la-trust-strip__customer">{{ $la_customer_name }}</span>
                        </div>
                    @endforeach
                </div>

                @if($reviews->count() > 1)
                    <div class="la-review-carousel__controls">
                        <button type="button" class="la-review-carousel__nav" data-la-review-prev aria-label="Previous review">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        </button>
                        <div class="la-featured-dots" role="tablist">
                            @foreach($reviews as $la_r_index => $review)
                                <button type="button" class="la-featured-dots__dot{{ $la_r_index === 0 ? ' la-is-active' : '' }}" data-la-review-dot="{{ $la_r_index }}" role="tab" aria-label="Review {{ $la_r_index + 1 }}" aria-selected="{{ $la_r_index === 0 ? 'true' : 'false' }}"></button>
                            @endforeach
                        </div>
                        <button type="button" class="la-review-carousel__nav" data-la-review-next aria-label="Next review">
                            <i class="fa fa-arrow-right" aria-hidden="true"></i>
                        </button>
                    </div>
                @endif
            @endif
        </div>

        <div class="la-trust-strip__photo la-reveal">
            <img src="{{ !empty($trust_photo->image) ? asset($trust_photo->image) : asset('images/placeholder-500x600.svg') }}" alt="Family using Le_Almmora products" loading="lazy">
        </div>
    </div>
</section>
