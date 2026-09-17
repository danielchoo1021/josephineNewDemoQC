{{-- Le_Almmora Homepage — Why Choose Us / Ingredients --}}
@php
    $why_choose_us_items = \App\SettingWhyChooseUs::where('status', '1')->orderBy('sort_level', 'asc')->get();
@endphp
@if($why_choose_us_items->isNotEmpty())
<section class="la-section la-why-choose" aria-label="Why Choose Le_Almmora">
    <div class="container">
        <div class="la-section-title la-reveal">
            <span class="la-eyebrow">{{ $data['website_setting']->why_choose_us_eyebrow ?? 'INSPIRED BY NATURE' }}</span>
            <h2 class="la-section-heading">{{ $data['website_setting']->why_choose_us_heading ?? 'Pure Ingredients, Pure Care' }}</h2>
        </div>

        <div class="la-why-choose__grid">
            @foreach($why_choose_us_items as $item)
            <div class="la-why-choose__item la-reveal">
                <img src="{{ \App\Http\Controllers\GlobalController::get_production_url($item->image) }}" alt="{{ $item->title }}" class="la-why-choose__image" loading="lazy">
                <h3>{{ $item->title }}</h3>
                <p>{{ $item->subtitle }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
