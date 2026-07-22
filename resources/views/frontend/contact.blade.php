@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/le-almmora-home.css') }}?v={{ file_exists(public_path('css/le-almmora-home.css')) ? filemtime(public_path('css/le-almmora-home.css')) : time() }}">
    <link rel="stylesheet" href="{{ asset('css/le-almmora-contact.css') }}?v={{ file_exists(public_path('css/le-almmora-contact.css')) ? filemtime(public_path('css/le-almmora-contact.css')) : time() }}">
@endsection

@section('content')
<main class="le-almmora-home">
    <div class="page-header" style="background-image: url({{ asset($data['setting_header']->contact_us_image) }});"></div>

    <section class="la-section la-contact">
        <div class="container">
            <div class="la-section-title">
                <span class="la-eyebrow">GET IN TOUCH</span>
                <h2 class="la-section-heading">Contact Us</h2>
                <p class="la-contact__intro">We'd love to hear from you. Send us a message or reach out directly &mdash; our team typically replies within 1&ndash;2 business days.</p>
            </div>

            <div class="la-contact__grid">
                <div class="la-contact__form-card">
                    <h3 class="la-contact__card-heading">Send Us a Message</h3>

                    <form id="contact-form" method="post" action="{{ route('contact_us_send') }}">
                        @csrf
                        <div class="la-contact__form-row">
                            <input type="text" name="name" required class="la-contact__input" placeholder="{{ isset($data['lang']['lang']['full_name']) ? $data['lang']['lang']['full_name'] :'Full Name'}}">
                        </div>
                        <div class="la-contact__form-row">
                            <input type="email" name="email" required class="la-contact__input" placeholder="{{ isset($data['lang']['lang']['email_address']) ? $data['lang']['lang']['email_address'] :'Email Address'}}">
                        </div>
                        <div class="la-contact__form-row la-contact__form-row--split">
                            <select class="la-contact__input la-contact__input--select" name="country_code">
                                @foreach($countries as $country)
                                    <option {{ ( $country->country_id == '160') ? 'selected' : '' }} value="{{ $country->country_contact }}">(+{{ $country->country_contact }}) {{ $country->country_name }}</option>
                                @endforeach
                            </select>
                            <input type="text" name="phone" required class="la-contact__input" placeholder="{{ isset($data['lang']['lang']['phone_number']) ? $data['lang']['lang']['phone_number'] :'Phone Number'}}" onkeypress="return isNumberKey(event)">
                        </div>
                        <div class="la-contact__form-row">
                            <textarea name="message" required class="la-contact__input la-contact__textarea" placeholder="{{ isset($data['lang']['lang']['Message']) ? $data['lang']['lang']['Message'] :'Your Message'}}"></textarea>
                        </div>
                        <button type="submit" class="la-btn la-btn-primary la-contact__submit">
                            {{ isset($data['lang']['lang']['submit']) ? $data['lang']['lang']['submit'] :'Send Message'}}
                        </button>
                    </form>
                </div>

                <div class="la-contact__info-col">
                    @if(!empty($data['web_setting']->company_address))
                        <div class="la-contact__info-card">
                            <div class="la-contact__info-icon"><i class="fas fa-map-marker-alt"></i></div>
                            <div class="la-contact__info-body">
                                <h4>Address</h4>
                                <p>{{ $data['web_setting']->company_address }}</p>
                            </div>
                        </div>
                    @endif

                    @if(!empty($data['web_setting']->company_phone))
                        <div class="la-contact__info-card">
                            <div class="la-contact__info-icon"><i class="fas fa-phone-alt"></i></div>
                            <div class="la-contact__info-body">
                                <h4>Phone</h4>
                                <p>{{ $data['web_setting']->company_phone }}</p>
                            </div>
                        </div>
                    @endif

                    @if(!empty($data['web_setting']->contact_whatsapp))
                        <div class="la-contact__info-card">
                            <div class="la-contact__info-icon"><i class="fab fa-whatsapp"></i></div>
                            <div class="la-contact__info-body">
                                <h4>WhatsApp</h4>
                                <p><a href="https://api.whatsapp.com/send?phone=6{{ $data['web_setting']->contact_whatsapp }}" target="_blank" rel="noopener">Chat with us</a></p>
                            </div>
                        </div>
                    @endif

                    @if(!empty($data['web_setting']->contact_email))
                        <div class="la-contact__info-card">
                            <div class="la-contact__info-icon"><i class="far fa-envelope"></i></div>
                            <div class="la-contact__info-body">
                                <h4>Email</h4>
                                <p>{{ $data['web_setting']->contact_email }}</p>
                            </div>
                        </div>
                    @endif

                    @if(!empty($data['web_setting']->facebook) || !empty($data['web_setting']->instagram) || !empty($data['web_setting']->youtube) || !empty($data['web_setting']->tiktok))
                        <div class="la-contact__social">
                            @if(!empty($data['web_setting']->facebook))
                                <a href="{{ $data['web_setting']->facebook }}" target="_blank" rel="noopener" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                            @endif
                            @if(!empty($data['web_setting']->instagram))
                                <a href="{{ $data['web_setting']->instagram }}" target="_blank" rel="noopener" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                            @endif
                            @if(!empty($data['web_setting']->youtube))
                                <a href="{{ $data['web_setting']->youtube }}" target="_blank" rel="noopener" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                            @endif
                            @if(!empty($data['web_setting']->tiktok))
                                <a href="{{ $data['web_setting']->tiktok }}" target="_blank" rel="noopener" aria-label="TikTok"><i class="fab fa-tiktok"></i></a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    @if(!empty($data['web_setting']->company_address))
        <section class="la-contact__map">
            <iframe src="https://www.google.com/maps?q={{ urlencode($data['web_setting']->company_address) }}&output=embed" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Our Location"></iframe>
        </section>
    @endif
</main>
@endsection
