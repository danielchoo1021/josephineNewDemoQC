{{-- Le_Almmora Homepage — Brand Introduction --}}
@php
    $brand_intro_features = \App\SettingBrandIntroFeature::where('status', '1')->orderBy('sort_level', 'asc')->get();
@endphp
<section class="la-section la-brand-intro" aria-label="Brand Introduction">
    <div class="container">
        <div class="la-brand-intro__inner">
            <div class="la-brand-intro__image la-reveal">
                @if(!empty($data['website_setting']->brand_intro_image))
                <img src="{{ \App\Http\Controllers\GlobalController::get_production_url($data['website_setting']->brand_intro_image) }}" alt="{{ $data['website_setting']->brand_intro_heading ?? 'Cleanliness begins with nature' }}" loading="lazy">
                @endif
            </div>

            <div class="la-brand-intro__column la-reveal">
                <span class="la-eyebrow">{{ $data['website_setting']->brand_intro_eyebrow ?? 'OUR BRAND' }}</span>

                <h2 class="la-section-heading la-brand-intro__heading">{{ $data['website_setting']->brand_intro_heading ?? 'Cleanliness Begins with Nature' }}</h2>

                <div class="la-brand-intro__body">
                    <p>{{ $data['website_setting']->brand_intro_body ?? "We believe that a clean home should never come at the cost of our health or our planet. That's why we create natural, safe and effective products for your loved ones." }}</p>
                </div>

                <a href="{{ route('about') }}" class="la-btn la-btn-outline la-btn-sm la-brand-intro__link">Learn More About Us</a>
            </div>

            @if($brand_intro_features->isNotEmpty())
            <ul class="la-feature-list la-reveal">
                @foreach($brand_intro_features as $feature)
                <li class="la-feature-list__item">
                    <span class="la-feature-list__icon" aria-hidden="true"><i class="{{ $feature->icon }}"></i></span>
                    <span>
                        <strong>{{ $feature->title }}</strong>
                        <small>{{ $feature->subtitle }}</small>
                    </span>
                </li>
                @endforeach
            </ul>
            @endif
        </div>
    </div>
</section>
