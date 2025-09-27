(function ($) {

    var scrollTop = 100;
    $(window).scroll(function() {

        var topMenu = ".menu-nav";

        if ($(window).scrollTop() >= scrollTop) {
            setTimeout(function() {
                $('header').addClass('sticky-header');
            }, 1);
        }
        if ($(window).scrollTop() < (scrollTop)) {
            $('header').removeClass('sticky-header');
        }
    });

    var swiper1 = new Swiper('.home-swiper', {
        slidesPerView: 1,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.home-swiper .swiper-pagination',
            clickable: true,
        },
    });
    var filterswiper1 = new Swiper('.filter-swiper', {
        slidesPerView: 'auto',
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },

    });
    var articlesswiper1 = new Swiper('.articles-swiper', {
        slidesPerView: 1,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.articles-swiper .swiper-pagination',
            clickable: true,
        },
    });

    var testimonialswiper1 = new Swiper('.testimonial-swiper', {
        slidesPerView: 1,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.testimonial-swiper .swiper-pagination',
            clickable: true,
        },
    });

    var clientswiper2 = new Swiper('.client-swiper', {
        slidesPerView: 5,
        spaceBetween: 30,
        breakpoints: {
            1024: {
                slidesPerView: 5,
            },
            992: {
                slidesPerView: 4,
            },
            768: {
                slidesPerView: 3,
            },
            600: {
                slidesPerView: 2,
            }
        }
    });
var storywiper2 = new Swiper('.story-swiper', {
        slidesPerView: 2,
        spaceBetween: 20,
    pagination: {
        el: '.story-swiper .swiper-pagination',
        clickable: true,
    },

    breakpoints: {
            992: {
                slidesPerView: 2,
            },
            767: {
                slidesPerView: 1,
            }
        }
    });
var testimonial2swiper = new Swiper('.testimonial2-swiper', {
        slidesPerView: 2,
        spaceBetween: 20,
    pagination: {
        el: '.testimonial2-swiper .swiper-pagination',
        clickable: true,
    },

    breakpoints: {
            992: {
                slidesPerView: 2,
            },
            767: {
                slidesPerView: 1,
            }
        }
    });

$('.searchBtn').on('click',function (){
    $('.search-header').slideToggle();
});

    (new WOW).init();
    $(function() {

        var $window           = $(window),
            win_height_padded = $window.height() * 1.1;

        $window.on('scroll', revealOnScroll);

        function revealOnScroll() {
            var scrolled = $window.scrollTop(),
                win_height_padded = $window.height() * 1.1;

            // Showed...
            $(".wow:not(.animated)").each(function () {
                var $this     = $(this),
                    offsetTop = $this.offset().top;

                if (scrolled + win_height_padded > offsetTop) {
                    if ($this.data('timeout')) {
                        window.setTimeout(function(){
                            $this.addClass('animated ' + $this.data('animation'));
                        }, parseInt($this.data('timeout'),10));
                    } else {
                        $this.addClass('animated ' + $this.data('animation'));
                    }
                }
            });
            // Hidden...
            $(".wow.animated").each(function (index) {
                var $this     = $(this),
                    offsetTop = $this.offset().top;
                if (scrolled + win_height_padded < offsetTop) {
                    if(!$(this).hasClass('fadeIn')){
                        $(this).removeAttr('style');
                    }
                    $(this).removeClass('animated fadeInUp fadeInDown fadeInRight fadeInLeft zoomIn');
                }
            });
        }

        revealOnScroll();
    });
})(jQuery);