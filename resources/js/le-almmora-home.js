/**
 * Le_Almmora Homepage — Hero entrance, scroll-reveal for all sections, homepage-only Navbar state
 *
 * Lightweight vanilla JS only. Does not load jQuery or Bootstrap —
 * both are already loaded globally by resources/views/layouts/app.blade.php.
 * Respects prefers-reduced-motion. No third-party animation library.
 */
(function () {
    'use strict';

    var prefersReducedMotion = window.matchMedia &&
        window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    // Homepage header scroll-state (transparent-over-hero -> white-on-scroll)
    //
    // Purely additive: only ever adds/removes classes on <body>. Does not
    // touch resources/views/partial/frontend/header.blade.php or the shared
    // layout. Runs on every viewport width, but the corresponding CSS in
    // le-almmora-home.scss only applies the visual change at >=768px, so
    // mobile navigation is unaffected regardless. Kept outside the
    // reduced-motion early-return below because this is a functional
    // scroll-position state, not a decorative animation; the transition
    // itself is separately disabled under prefers-reduced-motion in CSS.
    var heroEl = document.querySelector('.le-almmora-home .la-hero');

    if (heroEl) {
        document.body.classList.add('la-home-page');

        var headerScrollThreshold = 60;
        var headerTicking = false;

        var updateHeaderScrollState = function () {
            if (window.scrollY > headerScrollThreshold) {
                document.body.classList.add('la-home-header-scrolled');
            } else {
                document.body.classList.remove('la-home-header-scrolled');
            }
            headerTicking = false;
        };

        updateHeaderScrollState();

        window.addEventListener('scroll', function () {
            if (!headerTicking) {
                window.requestAnimationFrame(updateHeaderScrollState);
                headerTicking = true;
            }
        }, { passive: true });
    }

    // Click-to-play video panel (Our Promise / trust strip)
    //
    // Video does not autoplay; a play button sits over the poster frame
    // until clicked. Functional interaction, not a decorative animation,
    // so kept outside the reduced-motion early-return below.
    var videoPanel = document.querySelector('.le-almmora-home .js-la-video-panel');

    if (videoPanel) {
        var videoEl = videoPanel.querySelector('video');
        var playBtn = videoPanel.querySelector('.js-la-video-play');

        if (videoEl && playBtn) {
            playBtn.addEventListener('click', function () {
                videoEl.play();
                videoEl.setAttribute('controls', '');
                playBtn.classList.add('la-is-hidden');
            });
        }
    }

    // Featured Product — swap between multiple featured products
    //
    // Purely additive lightweight carousel: dots + prev/next arrows toggle
    // which `.la-featured-product__slide` / `.la-featured-product__image-slide`
    // pair carries `.la-is-active`. Only rendered by the Blade partial when
    // there is more than one featured product, so this does nothing on the
    // single-product state.
    var featuredCarousel = document.querySelector('.le-almmora-home [data-la-featured-carousel]');

    if (featuredCarousel) {
        var featuredTextSlides = featuredCarousel.querySelectorAll('[data-la-featured-slide]');
        var featuredImageSlides = featuredCarousel.querySelectorAll('[data-la-featured-image-slide]');
        var featuredDots = featuredCarousel.querySelectorAll('[data-la-featured-dot]');
        var featuredPrevBtn = featuredCarousel.querySelector('[data-la-featured-prev]');
        var featuredNextBtn = featuredCarousel.querySelector('[data-la-featured-next]');
        var featuredCount = featuredTextSlides.length;
        var featuredActiveIndex = 0;

        var goToFeaturedSlide = function (index) {
            if (!featuredCount) {
                return;
            }

            featuredActiveIndex = (index + featuredCount) % featuredCount;

            Array.prototype.forEach.call(featuredTextSlides, function (slide, slideIndex) {
                slide.classList.toggle('la-is-active', slideIndex === featuredActiveIndex);
            });

            Array.prototype.forEach.call(featuredImageSlides, function (slide, slideIndex) {
                slide.classList.toggle('la-is-active', slideIndex === featuredActiveIndex);
            });

            Array.prototype.forEach.call(featuredDots, function (dot, dotIndex) {
                var isActive = dotIndex === featuredActiveIndex;
                dot.classList.toggle('la-is-active', isActive);
                dot.setAttribute('aria-selected', isActive ? 'true' : 'false');
            });
        };

        if (featuredPrevBtn) {
            featuredPrevBtn.addEventListener('click', function () {
                goToFeaturedSlide(featuredActiveIndex - 1);
            });
        }

        if (featuredNextBtn) {
            featuredNextBtn.addEventListener('click', function () {
                goToFeaturedSlide(featuredActiveIndex + 1);
            });
        }

        Array.prototype.forEach.call(featuredDots, function (dot, dotIndex) {
            dot.addEventListener('click', function () {
                goToFeaturedSlide(dotIndex);
            });
        });
    }

    // Explore Our Range — Owl Carousel (already loaded globally; see
    // resources/views/layouts/app.blade.php). Only rendered by the Blade
    // partial when there are more than 5 categories to show, so this simply
    // does nothing on pages/states where a plain grid is used instead.
    var gallerySlider = document.querySelector('.le-almmora-home .js-la-gallery-slider');

    if (gallerySlider && window.jQuery && window.jQuery.fn.owlCarousel) {
        var $gallerySlider = window.jQuery(gallerySlider);

        $gallerySlider.owlCarousel({
            loop: true,
            margin: 20,
            nav: true,
            dots: false,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: false,
            navText: [
                '<i class="fa fa-arrow-left" aria-hidden="true"></i>',
                '<i class="fa fa-arrow-right" aria-hidden="true"></i>'
            ],
            responsive: {
                0: { items: 2 },
                576: { items: 3 },
                992: { items: 4 },
                1200: { items: 5 }
            }
        });

        // Manual interaction (nav click or drag/swipe) suspends autoplay for
        // 10s. Each new interaction restarts the 10s window, so autoplay
        // only resumes once the user has been idle for a full 10s — it
        // never fires while someone is actively clicking through slides.
        var galleryResumeTimer = null;

        var pauseGalleryAutoplay = function () {
            window.clearTimeout(galleryResumeTimer);
            $gallerySlider.trigger('stop.owl.autoplay');
            galleryResumeTimer = window.setTimeout(function () {
                $gallerySlider.trigger('play.owl.autoplay', [5000]);
            }, 10000);
        };

        $gallerySlider.on('click', '.owl-nav .owl-prev, .owl-nav .owl-next', pauseGalleryAutoplay);
        $gallerySlider.on('dragged.owl.carousel', pauseGalleryAutoplay);
    }

    if (prefersReducedMotion) {
        return;
    }

    // Hero entrance animation
    var heroTargets = document.querySelectorAll(
        '.le-almmora-home .la-hero__eyebrow, ' +
        '.le-almmora-home .la-hero__headline, ' +
        '.le-almmora-home .la-hero__supporting, ' +
        '.le-almmora-home .la-hero__actions'
    );

    if (heroTargets.length) {
        Array.prototype.forEach.call(heroTargets, function (el) {
            el.classList.add('la-pre-reveal');
        });

        window.requestAnimationFrame(function () {
            window.requestAnimationFrame(function () {
                Array.prototype.forEach.call(heroTargets, function (el) {
                    el.classList.add('la-is-visible');
                });
            });
        });
    }

    // Brand Introduction reveal-on-scroll
    var scrollTargets = document.querySelectorAll('.le-almmora-home .la-reveal');

    if (scrollTargets.length && 'IntersectionObserver' in window) {
        Array.prototype.forEach.call(scrollTargets, function (el) {
            el.classList.add('la-pre-reveal');
        });

        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('la-is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.2, rootMargin: '0px 0px -40px 0px' });

        Array.prototype.forEach.call(scrollTargets, function (el) {
            observer.observe(el);
        });
    }
})();
