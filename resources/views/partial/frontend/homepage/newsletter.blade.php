{{-- Le_Almmora Homepage — Newsletter --}}
<section class="la-newsletter" aria-label="Newsletter Signup">
    <div class="container">
        <div class="la-newsletter__inner la-reveal">
            <div class="la-newsletter__text">
                <span class="la-newsletter__icon" aria-hidden="true"><i class="fa fa-envelope"></i></span>
                <div>
                    <strong>Be the first to know</strong>
                    <span>Sign up for exclusive offers and updates.</span>
                </div>
            </div>

            <form action="{{ route('Contact') }}" method="GET" class="la-newsletter__form">
                <input type="email" name="email" class="la-newsletter__input" placeholder="Enter your email" aria-label="Email address">
                <button type="submit" class="la-btn la-btn-gold la-newsletter__submit">Subscribe</button>
            </form>
        </div>
    </div>
</section>
