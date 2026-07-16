{{-- Le_Almmora Homepage — Featured Product --}}
@if(!empty($products_featured) && $products_featured->count() > 0)
    @php
        $laFeaturedProducts = $products_featured;
    @endphp
    <section class="la-section la-featured-product" aria-label="Featured Product" style="background-image: url('{{ asset('uploads/icybluewater.png') }}');" data-la-featured-carousel>
        <div class="container">
            <div class="la-featured-product__inner">
                <div class="la-featured-product__column la-reveal">
                    <span class="la-eyebrow">FEATURED PRODUCT</span>

                    @foreach($laFeaturedProducts as $laIndex => $laFeaturedProduct)
                        <div class="la-featured-product__slide{{ $laIndex === 0 ? ' la-is-active' : '' }}" data-la-featured-slide="{{ $laIndex }}">
                            <h2 class="la-section-heading la-featured-product__heading">
                                {{ !empty($laFeaturedProduct->featured_display_name) ? $laFeaturedProduct->featured_display_name : (!empty($laFeaturedProduct->product_name) ? $laFeaturedProduct->product_name : 'Our Best Seller') }}
                            </h2>

                            <ul class="la-check-list">
                                <li>
                                    <span class="la-check-list__icon" aria-hidden="true"><i class="fa fa-check"></i></span>
                                    <span>{{ !empty($laFeaturedProduct->featured_point_1) ? $laFeaturedProduct->featured_point_1 : 'Powerful degreasing' }}</span>
                                </li>
                                <li>
                                    <span class="la-check-list__icon" aria-hidden="true"><i class="fa fa-check"></i></span>
                                    <span>{{ !empty($laFeaturedProduct->featured_point_2) ? $laFeaturedProduct->featured_point_2 : 'Gentle on hands' }}</span>
                                </li>
                                <li>
                                    <span class="la-check-list__icon" aria-hidden="true"><i class="fa fa-check"></i></span>
                                    <span>{{ !empty($laFeaturedProduct->featured_point_3) ? $laFeaturedProduct->featured_point_3 : 'Natural deodorising' }}</span>
                                </li>
                            </ul>

                            <a href="{{ route('details', md5($laFeaturedProduct->id)) }}" class="la-btn la-btn-gold la-featured-product__cta">
                                Shop Now
                            </a>
                        </div>
                    @endforeach
                </div>

                <div class="la-featured-product__image la-reveal">
                    @foreach($laFeaturedProducts as $laIndex => $laFeaturedProduct)
                        <div class="la-featured-product__image-slide{{ $laIndex === 0 ? ' la-is-active' : '' }}" data-la-featured-image-slide="{{ $laIndex }}">
                            <span class="la-badge la-badge--gold">Best Seller</span>
                            <img src="{{ !empty($laFeaturedProduct->featured_image) ? asset($laFeaturedProduct->featured_image) : (!empty($laFeaturedProduct->first_image->image) ? asset($laFeaturedProduct->first_image->image) : asset('images/800x800.png')) }}" alt="{{ !empty($laFeaturedProduct->featured_display_name) ? $laFeaturedProduct->featured_display_name : (!empty($laFeaturedProduct->product_name) ? $laFeaturedProduct->product_name : 'Featured product') }}" loading="lazy">
                        </div>
                    @endforeach

                    @if($laFeaturedProducts->count() > 1)
                        <button type="button" class="la-featured-nav la-featured-nav--prev" data-la-featured-prev aria-label="Previous featured product">
                            <i class="fa fa-chevron-left" aria-hidden="true"></i>
                        </button>
                        <button type="button" class="la-featured-nav la-featured-nav--next" data-la-featured-next aria-label="Next featured product">
                            <i class="fa fa-chevron-right" aria-hidden="true"></i>
                        </button>
                    @endif
                </div>
            </div>

            @if($laFeaturedProducts->count() > 1)
                <div class="la-featured-dots" role="tablist" aria-label="Featured products">
                    @foreach($laFeaturedProducts as $laIndex => $laFeaturedProduct)
                        <button type="button" class="la-featured-dots__dot{{ $laIndex === 0 ? ' la-is-active' : '' }}" data-la-featured-dot="{{ $laIndex }}" role="tab" aria-selected="{{ $laIndex === 0 ? 'true' : 'false' }}" aria-label="Show featured product {{ $laIndex + 1 }} of {{ $laFeaturedProducts->count() }}"></button>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endif
