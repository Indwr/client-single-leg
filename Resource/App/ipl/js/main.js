(function ($) {
    "use strict";
    jQuery(document).ready(function ($) {
        //Water js
        $('.water').ripples({
            imageUrl: null,
            resolution: 256,
            dropRadius: 20,
            perturbance: 0.04,
            interactive: true
          });

          // YT Player
          $("#bgndVideo").YTPlayer();
          
        /*bottom to top*/
        $(document).on('click', '.back-to-top', function () {
            $("html,body").animate({
                scrollTop: 0
            }, 2000);
        });
        // menu button function 
        $(function(){
            $('.menu-btn > i').click(function(){
                $('#main_menu').slideToggle();
            })
        })

        // Product deal countdown
        $('[data-countdown]').each(function () {
            var $this = $(this),
                finalDate = $(this).data('countdown');
            $this.countdown(finalDate, function (event) {
                $this.html(event.strftime('<span>%D : <small>Days</small></span> <span>%H : <small>Hrs</small></span>  <span>%M : <small>Min</small></span> <span>%S <small>Sec</small></span>'));
            });
        });
        
        // counter section activation
        var $counternumber = $(".count-number");
        $counternumber.counterUp({
            delay: 30,
            time: 5000
        });


        // testimonial carousel activation 
        var testimonialCarousel = $('.testimonial-carosel');
        testimonialCarousel.owlCarousel({
            loop: true,
            autoplay: false,
            margin:30,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 1
                },
                960: {
                    items: 1
                },
                1200: {
                    items: 1
                },
                1920: {
                    items: 1
                }
            }
        });


    // Hero Area Slider
    var $game_time_slide = $('.game-time-slider');
    $game_time_slide.owlCarousel({
        loop: true,
        navText: ['<i class="fas fa-angle-left"></i>', '<i class="fas fa-angle-right"></i>'],
        nav: true,
        dots: false,
        autoplay: false,
        autoplayTimeout: 6000,
        smartSpeed: 1000,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 1
            },
            960: {
                items: 1
            },
            1200: {
                items: 1
            },
            1920: {
                items: 1
            }
        }
    });

        // smoth scroll
        $(function () {
            $('.navigation .navbar-nav a').on('click', function (event) {
                var $anchor = $(this);
                $('html, body').stop().animate({
                    scrollTop: $($anchor.attr('href')).offset().top -80
                }, 1000);
                event.preventDefault();
            });
        });
    });

    // window Scroll functions
    $(window).on('scroll', function () {
        /*--show and hide scroll to top --*/
        var ScrollTop = $('.back-to-top');
        if ($(window).scrollTop() > 500) {
            ScrollTop.fadeIn(1000);
        } else {
            ScrollTop.fadeOut(1000);
        }
        // sticky menu activation
        var mainMenuTop = $('.navigation');
        if ($(window).scrollTop() > 300) {
            mainMenuTop.addClass('stiky-nav');
        } else {
            mainMenuTop.removeClass('stiky-nav');
        }
    });


    // window load functions
    $(window).on('load', function () {
        var preLoder = $("#preloader");
        preLoder.fadeOut(1000);
    });


    // venobox function
    $(function(){
        $('.venobox').venobox(); 
    });

}(jQuery));	