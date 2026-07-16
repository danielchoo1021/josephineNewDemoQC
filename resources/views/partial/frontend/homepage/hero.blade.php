{{-- Le_Almmora Homepage — Hero --}}
<section class="la-hero" aria-label="Hero">
    <div id="laHeroCarousel" class="carousel slide la-hero__carousel" data-ride="carousel" data-interval="6000" data-pause="false">
        <div class="carousel-inner la-hero__carousel-inner">
            @if(!$banners->isEmpty())
                @foreach($banners as $bannerkey => $banner)
                    <div class="carousel-item la-hero__slide {{ ($bannerkey == 0) ? 'active' : '' }}">
                        <div class="la-hero__image" style="background-image: url('{{ asset($banner->image) }}');">
                            @if(!empty($banner->url))
                                <a href="{{ $banner->url }}" class="la-hero__slide-link" aria-label="Banner link"></a>
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
                <div class="carousel-item la-hero__slide active">
                    <div class="la-hero__image" style="background-image: url('{{ asset('images/banner-03.jpg') }}');"></div>
                </div>
            @endif
        </div>

        @if($banners->count() > 1)
            <ol class="carousel-indicators la-hero__indicators">
                @foreach($banners as $bannerkey => $banner)
                    <li data-target="#laHeroCarousel" data-slide-to="{{ $bannerkey }}" class="{{ ($bannerkey == 0) ? 'active' : '' }}"></li>
                @endforeach
            </ol>

            <a class="carousel-control-prev la-hero__control la-hero__control--prev" href="#laHeroCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next la-hero__control la-hero__control--next" href="#laHeroCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        @endif
    </div>

    <div class="la-hero__overlay" aria-hidden="true"></div>

    <div class="la-hero__content">
        <div class="container">
            <span class="la-eyebrow la-hero__eyebrow">
                NATURAL &bull; ECO-FRIENDLY &bull; CLEAN
            </span>

            <h1 class="la-hero__headline">
                Gentle to People, Kind to the Earth
            </h1>

            <p class="la-hero__supporting">
                Premium natural cleaning products powered by coconut and deep-sea minerals.
            </p>

            <div class="la-hero__actions">
                <a href="{{ route('about') }}" class="la-btn la-btn-gold la-hero__cta">
                    Discover Our Story
                </a>
                <a href="{{ route('listing') }}" class="la-btn la-btn-secondary la-hero__cta">
                    Shop Collection
                </a>
            </div>
        </div>
    </div>

    <div class="la-hero__scroll-indicator" aria-hidden="true">
        <span class="la-hero__scroll-line"></span>
    </div>
</section>
