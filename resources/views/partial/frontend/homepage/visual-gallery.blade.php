{{-- Le_Almmora Homepage — Explore Our Range --}}
@php
    $laRangeCategories = $categories_home->isEmpty() ? $featured_categories : $categories_home;
    $laRangeSlides = $laRangeCategories->count() + 1;
    $laUseSlider = $laRangeSlides > 5;
@endphp
@if(!$laRangeCategories->isEmpty())
    <section class="la-section la-gallery" aria-label="Explore Our Range">
        <div class="container">
            <div class="la-gallery__header la-reveal">
                <span class="la-eyebrow">SHOP COLLECTION</span>
                <h2 class="la-section-heading">Explore Our Range</h2>
            </div>

            <div class="la-gallery__row {{ $laUseSlider ? 'owl-carousel js-la-gallery-slider' : 'la-gallery__grid' }}">
                @foreach($laRangeCategories as $laCategory)
                    <a href="{{ route('listing', ['category' => $laCategory->category_name]) }}" class="la-gallery__item la-reveal">
                        <img src="{{ !empty($laCategory->image) ? asset($laCategory->image) : asset('images/800x800.png') }}" alt="{{ $laCategory->category_name }}" loading="lazy">
                        <span class="la-gallery__label">{{ $laCategory->category_name }}</span>
                    </a>
                @endforeach

                <a href="{{ route('listing') }}" class="la-gallery__item la-reveal">
                    <img src="{{ asset('images/800x800.png') }}" alt="All Products" loading="lazy">
                    <span class="la-gallery__label">All Products <i class="fa fa-arrow-right" aria-hidden="true"></i></span>
                </a>
            </div>
        </div>
    </section>
@endif
