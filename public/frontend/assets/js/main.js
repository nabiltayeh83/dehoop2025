(function($) {
    "use strict";
    
    /*---
       stickey menu
    ---*/
    $(window).on('scroll',function() {    
           var scroll = $(window).scrollTop();
           if (scroll < 100) {
            $(".sticky-header").removeClass("sticky");
           }else{
            $(".sticky-header").addClass("sticky");
           }
    });

    /*-----
    jQuery MeanMenu
    ------------------------------ */
    $('.mobile-menu nav').meanmenu({
        meanScreenWidth: "9901",
        meanMenuContainer: ".mobile-menu",
        onePage: true,
    });
    
    /* slider activation */
    $('.slider_active').owlCarousel({
        animateOut: 'fadeOut',
        autoplay: true,
		loop: true,
        nav: false,
        autoplay: false,
        autoplayTimeout: 8000,
        items: 1,
        dots:true,
    });
    
     /* product active activation */
    $('.product_active').owlCarousel({
        autoplay: true,
		loop: true,
        nav: true,
        autoplay: false,
        autoplayTimeout: 8000,
        items: 4,
        margin: 30,
        dots:false,
        navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
        responsiveClass:true,
		responsive:{
            	0:{
				items:1,
			},
            576:{
				items:2,
			},
            992:{
				items:3,
			},
            1200:{
				items:4,
			}

		  }

    });
    
    /* custom active activation */
    $('.shop_product').owlCarousel({
        autoplay: true,
		loop: true,
        nav: true,
        autoplay: false,
        autoplayTimeout: 8000,
        items: 1,
        dots:false,
        navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
        responsiveClass:true,
		responsive:{
            	0:{
				items:1,
			},
            768:{
				items:2,
			},
            992:{
				items:1,
			}

		  }
    });
    
    /* blog active activation */
    $('.blog_active,.related_active').owlCarousel({
        autoplay: true,
		loop: true,
        nav: true,
        autoplay: false,
        autoplayTimeout: 8000,
        items: 3,
        margin: 30,
        dots:false,
        navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
        responsiveClass:true,
		responsive:{
				0:{
				items:1,
			},
            768:{
				items:2,
			},
            992:{
				items:3,
			}


		  }
    });
    

     /* product active two activation */
    $('.product_active_two').owlCarousel({
        autoplay: true,
		loop: true,
        nav: true,
        autoplay: false,
        autoplayTimeout: 8000,
        items: 6,
        margin: 30,
        dots:false,
        navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
        responsiveClass:true,
		responsive:{
				0:{
				items:1,
			},
            550:{
				items:2,
			},
            768:{
				items:3,
			},
            992:{
				items:4,
			},
            1200:{
				items:5,
			},
            1600:{
				items:6,
			}


		  }
    });
    
     /* brand  activation */
    $('.brand_active').owlCarousel({
        autoplay: true,
		loop: true,
        nav: false,
        autoplay: false,
        autoplayTimeout: 8000,
        items: 5,
        dots:false,
        responsiveClass:true,
		responsive:{
				0:{
				items:1,
			},
            520:{
				items:2,
			},
            768:{
				items:3,
			},
            992:{
				items:4,
			},
            1200:{
				items:5,
			}


		  }
    });
    
    
     /* single product activation */
    $('.single-product-active').owlCarousel({
        autoplay: true,
		loop: true,
        nav: true,
        autoplay: false,
        autoplayTimeout: 8000,
        items: 4,
        dots:false,
        navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
        responsiveClass:true,
		responsive:{
				0:{
				items:1,
			},
            320:{
				items:2,
			},
            992:{
				items:3,
			},
            1200:{
				items:4,
			},


		  }
    });
    
      /* blog active activation */
    $('.product_gallery_active').owlCarousel({
        autoplay: true,
		loop: true,
        nav: true,
        autoplay: false,
        autoplayTimeout: 8000,
        items: 4,
        margin: 30,
        dots:false,
        navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
        responsiveClass:true,
		responsive:{
				0:{
				items:1,
			},
            576:{
				items:2,
			},
            992:{
				items:3,
			},
            1200:{
				items:4,
			},


		  }
    });

      /* blog active activation */
    $('.blog_thumb_active').owlCarousel({
        autoplay: true,
		loop: true,
        nav: true,
        autoplay: false,
        autoplayTimeout: 8000,
        items: 1,
        dots:false,
        navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
    });
    
    
        /* testimonial active activation */
    $('.testimonial_active').owlCarousel({
        autoplay: true,
		loop: true,
        nav: false,
        autoplay: false,
        autoplayTimeout: 8000,
        items: 1,
        dots:true,
    });
    
    
    
      /* product navactive activation */
    $('.product_navactive').owlCarousel({
        autoplay: true,
		loop: true,
        nav: false,
        autoplay: false,
        autoplayTimeout: 8000,
        items: 3,
        dots:true,
        responsiveClass:true,
		responsive:{
				0:{
				items:1,
			},
            250:{
				items:2,
			},
            480:{
				items:3,
			},
		  
        }
    });
    
    $('.modal').on('shown.bs.modal', function (e) {
        $('.product_navactive').resize();
    })

    $('.product_navactive a').on('click',function(e){
        e.preventDefault();

        var $href = $(this).attr('href');

    $('.product_navactive a').removeClass('active');
        $(this).addClass('active');

    $('.product-details-large .tab-pane').removeClass('active show');
        $('.product-details-large '+ $href ).addClass('active show');

    })
    

    /*wow activation*/
    new WOW().init();
    

    /*--------------------------
     ScrollUp
    ---------------------------- */
    $.scrollUp({
        scrollText: '<i class="fa fa-angle-double-up"></i>',
        easingType: 'linear',
        scrollSpeed: 900,
        animation: 'fade'
    });
	
    
     /*------addClass/removeClass-------*/
    $(".currency > a,.language > a,.top_links > a").on("click", function() {
        $(this).removeAttr('href');
        $(this).toggleClass('open').next('.dropdown_currency,.dropdown_language,.dropdown_links').toggleClass('open');
        $(this).parents().siblings().find('.dropdown_currency,.dropdown_language,.dropdown_links').removeClass('open');
    });

    $('body').on('click', function (e) {
        var target = e.target;
        if (!$(target).is('.currency > a,.language > a,.top_links > a') ) {
            $('.dropdown_currency,.dropdown_language,.dropdown_links').removeClass('open');
        }
    });
    
    /*mini cart slideToggle*/
    
    $(".shopping_cart").on("click", function() {
        $('.mini_cart').slideToggle('medium');
    }); 
    

    /*mini cart slideToggle*/
    
     $(".search_button").on("click", function(){
        $(this).removeAttr('href');
        $(".hover_search").addClass("active");
    });
    
     $(".close_btn").on("click", function(){
        $(".hover_search").removeClass("active");
    });

    /*niceSelect*/
     $('select').niceSelect();
    

    /*magnificPopup activation*/
    
    $('.view_large_img,.port_popup').magnificPopup({
        type: 'image',
        gallery:{
        enabled:true,
      }
    });


    /*counterup activation*/
    $('.counter_number').counterUp({
        delay: 10,
        time: 1000
    });
    
    

    /*countdown activation*/
		
	 $('[data-countdown]').each(function() {
		var $this = $(this), finalDate = $(this).data('countdown');
		$this.countdown(finalDate, function(event) {
		$this.html(event.strftime('<div class="countdown_area"><div class="single_countdown"><div class="countdown_number">%D</div><div class="countdown_title">days</div></div><div class="single_countdown"><div class="countdown_number">%H</div><div class="countdown_title">hrs</div></div><div class="single_countdown"><div class="countdown_number">%M</div><div class="countdown_title">mins</div></div><div class="single_countdown"><div class="countdown_number">%S</div><div class="countdown_title">secs</div></div></div>'));     
               
       });
	});	
    
    
    /*----------------------------
    	slider-range here
    ------------------------------ */
    $( "#slider-range" ).slider({
        range: true,
        min: 0,
        max: 500,
        values: [ 0, 500 ],
        slide: function( event, ui ) {
        $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
       }
    });
    $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
       " - $" + $( "#slider-range" ).slider( "values", 1 ) );
    

    /*magnificPopup activation*/
    
    $('.large_view').magnificPopup({
        type: 'image',
        gallery:{
        enabled:true,
      }
    });
    
    
     /*-------------------------------------------
    elevateZoom
    -------------------------------------------- */	
    $("#zoom1").elevateZoom({
        gallery:'gallery_01', 
        responsive : true,
        cursor: 'crosshair',
        zoomType : 'inner'
    
    });  
    

    
   $('.portfolio_gallery').imagesLoaded( function() {
        // init Isotope
        var $grid = $('.portfolio_gallery').isotope({
           itemSelector: '.gird_item',
            percentPosition: true,
            masonry: {
                columnWidth: '.gird_item'
            }
        });
            
        // filter items on button click
        $('.portfolio_button').on( 'click', 'button', function() {
           var filterValue = $(this).attr('data-filter');
           $grid.isotope({ filter: filterValue });
            
           $(this).siblings('.active').removeClass('active');
           $(this).addClass('active');
        });
       
    });
    
    // Newsletter Popup
    
    function newsLetterPopup(){
        $('.newsletter_popup').css({"opacity": "1", "visibility": "visible"});
        $('.popup_close').click(function(){
          $(".newsletter_popup").fadeOut(200);
        })    
    }
    newsLetterPopup();
 
      
    


})(jQuery);

