!function(e){var r={};function t(o){if(r[o])return r[o].exports;var a=r[o]={i:o,l:!1,exports:{}};return e[o].call(a.exports,a,a.exports,t),a.l=!0,a.exports}t.m=e,t.c=r,t.d=function(e,r,o){t.o(e,r)||Object.defineProperty(e,r,{enumerable:!0,get:o})},t.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},t.t=function(e,r){if(1&r&&(e=t(e)),8&r)return e;if(4&r&&"object"==typeof e&&e&&e.__esModule)return e;var o=Object.create(null);if(t.r(o),Object.defineProperty(o,"default",{enumerable:!0,value:e}),2&r&&"string"!=typeof e)for(var a in e)t.d(o,a,function(r){return e[r]}.bind(null,a));return o},t.n=function(e){var r=e&&e.__esModule?function(){return e.default}:function(){return e};return t.d(r,"a",r),r},t.o=function(e,r){return Object.prototype.hasOwnProperty.call(e,r)},t.p="/",t(t.s=40)}({40:function(e,r,t){e.exports=t(41)},41:function(e,r){!function(){"use strict";var e=window.matchMedia&&window.matchMedia("(prefers-reduced-motion: reduce)").matches;if(document.querySelector(".le-almmora-home .la-hero")){document.body.classList.add("la-home-page");var r=!1,t=function(){window.scrollY>60?document.body.classList.add("la-home-header-scrolled"):document.body.classList.remove("la-home-header-scrolled"),r=!1};t(),window.addEventListener("scroll",(function(){r||(window.requestAnimationFrame(t),r=!0)}),{passive:!0})}var o=document.querySelector(".le-almmora-home .js-la-video-panel");if(o){var a=o.querySelector("video"),l=o.querySelector(".js-la-video-play");a&&l&&l.addEventListener("click",(function(){a.play(),a.setAttribute("controls",""),l.classList.add("la-is-hidden")}))}var n=document.querySelector(".le-almmora-home [data-la-featured-carousel]");if(n){var i=n.querySelectorAll("[data-la-featured-slide]"),c=n.querySelectorAll("[data-la-featured-image-slide]"),u=n.querySelectorAll("[data-la-featured-dot]"),s=n.querySelector("[data-la-featured-prev]"),d=n.querySelector("[data-la-featured-next]"),f=i.length,m=0,p=function(e){f&&(m=(e+f)%f,Array.prototype.forEach.call(i,(function(e,r){e.classList.toggle("la-is-active",r===m)})),Array.prototype.forEach.call(c,(function(e,r){e.classList.toggle("la-is-active",r===m)})),Array.prototype.forEach.call(u,(function(e,r){var t=r===m;e.classList.toggle("la-is-active",t),e.setAttribute("aria-selected",t?"true":"false")})))};s&&s.addEventListener("click",(function(){p(m-1)})),d&&d.addEventListener("click",(function(){p(m+1)})),Array.prototype.forEach.call(u,(function(e,r){e.addEventListener("click",(function(){p(r)}))}))}var y=document.querySelector(".le-almmora-home .js-la-gallery-slider");if(y&&window.jQuery&&window.jQuery.fn.owlCarousel){var v=window.jQuery(y);v.owlCarousel({loop:!0,margin:20,nav:!0,dots:!1,autoplay:!0,autoplayTimeout:5e3,autoplayHoverPause:!1,navText:['<i class="fa fa-arrow-left" aria-hidden="true"></i>','<i class="fa fa-arrow-right" aria-hidden="true"></i>'],responsive:{0:{items:2},576:{items:3},992:{items:4},1200:{items:5}}});var h=null,w=function(){window.clearTimeout(h),v.trigger("stop.owl.autoplay"),h=window.setTimeout((function(){v.trigger("play.owl.autoplay",[5e3])}),1e4)};v.on("click",".owl-nav .owl-prev, .owl-nav .owl-next",w),v.on("dragged.owl.carousel",w)}if(!e){var g=document.querySelectorAll(".le-almmora-home .la-hero__eyebrow, .le-almmora-home .la-hero__headline, .le-almmora-home .la-hero__supporting, .le-almmora-home .la-hero__actions");g.length&&(Array.prototype.forEach.call(g,(function(e){e.classList.add("la-pre-reveal")})),window.requestAnimationFrame((function(){window.requestAnimationFrame((function(){Array.prototype.forEach.call(g,(function(e){e.classList.add("la-is-visible")}))}))})));var b=document.querySelectorAll(".le-almmora-home .la-reveal");if(b.length&&"IntersectionObserver"in window){Array.prototype.forEach.call(b,(function(e){e.classList.add("la-pre-reveal")}));var A=new IntersectionObserver((function(e){e.forEach((function(e){e.isIntersecting&&(e.target.classList.add("la-is-visible"),A.unobserve(e.target))}))}),{threshold:.2,rootMargin:"0px 0px -40px 0px"});Array.prototype.forEach.call(b,(function(e){A.observe(e)}))}}}()}});
(function () {
    var reviewCarousel = document.querySelector('.le-almmora-home [data-la-review-carousel]');
    if (!reviewCarousel) return;

    var reviewSlides = reviewCarousel.querySelectorAll('[data-la-review-slide]');
    var reviewDots = reviewCarousel.querySelectorAll('[data-la-review-dot]');
    var reviewPrevBtn = reviewCarousel.querySelector('[data-la-review-prev]');
    var reviewNextBtn = reviewCarousel.querySelector('[data-la-review-next]');
    var reviewCount = reviewSlides.length;
    var reviewActiveIndex = 0;

    var goToReviewSlide = function (index) {
        if (!reviewCount) return;
        reviewActiveIndex = (index + reviewCount) % reviewCount;
        Array.prototype.forEach.call(reviewSlides, function (slide, slideIndex) {
            slide.classList.toggle('la-is-active', slideIndex === reviewActiveIndex);
        });
        Array.prototype.forEach.call(reviewDots, function (dot, dotIndex) {
            var isActive = dotIndex === reviewActiveIndex;
            dot.classList.toggle('la-is-active', isActive);
            dot.setAttribute('aria-selected', isActive ? 'true' : 'false');
        });
    };

    if (reviewPrevBtn) {
        reviewPrevBtn.addEventListener('click', function () {
            goToReviewSlide(reviewActiveIndex - 1);
        });
    }
    if (reviewNextBtn) {
        reviewNextBtn.addEventListener('click', function () {
            goToReviewSlide(reviewActiveIndex + 1);
        });
    }
    Array.prototype.forEach.call(reviewDots, function (dot, dotIndex) {
        dot.addEventListener('click', function () {
            goToReviewSlide(dotIndex);
        });
    });

    // Swipe support so the carousel feels scrollable left/right on touch devices
    var reviewTouchStartX = null;
    reviewCarousel.addEventListener('touchstart', function (e) {
        reviewTouchStartX = e.changedTouches[0].clientX;
    }, { passive: true });
    reviewCarousel.addEventListener('touchend', function (e) {
        if (reviewTouchStartX === null) return;
        var deltaX = e.changedTouches[0].clientX - reviewTouchStartX;
        if (Math.abs(deltaX) > 40) {
            goToReviewSlide(reviewActiveIndex + (deltaX < 0 ? 1 : -1));
        }
        reviewTouchStartX = null;
    }, { passive: true });
})();
