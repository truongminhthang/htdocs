(function ($) {
 "use strict";
    

/*----------------------------
    Owl active
------------------------------ */  
    $(".class-carousel").owlCarousel({
        autoPlay: false, 
        slideSpeed:2000,
        pagination:false,
        navigation:true,	  
        items : 3,
        navigationText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
        itemsDesktop : [1199,3],
        itemsDesktopSmall : [980,3],
        itemsTablet: [768,2],
        itemsMobile : [479,1],
    });
/*----------------------------
    Blog Carousel
------------------------------ */  
    $(".blog-carousel").owlCarousel({
        autoPlay: false, 
        slideSpeed:2000,
        pagination:false,
        navigation:false,	  
        items : 3,
        navigationText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
        itemsDesktop : [1199,3],
        itemsDesktopSmall : [980,2],
        itemsTablet: [768,2],
        itemsMobile : [479,1],
    });
/*----------------------------
    Teacher Carousel
------------------------------ */  
    $(".teacher-carousel").owlCarousel({
        autoPlay: false, 
        slideSpeed:2000,
        pagination:false,
        navigation:true,	  
        items : 3,
        navigationText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
        itemsDesktop : [1199,3],
        itemsDesktopSmall : [980,2],
        itemsTablet: [768,2],
        itemsMobile : [479,1],
    }); 
/*----------------------------
    Teacher Carousel
------------------------------ */  
    $(".testimonial-carousel").owlCarousel({
        autoPlay: false, 
        slideSpeed:2000,
        pagination:false,
        navigation:true,	  
        items : 2,
        navigationText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
        itemsDesktop : [1199,2],
        itemsDesktopSmall : [980,2],
        itemsTablet: [768,1],
        itemsMobile : [479,1],
    });    
/*----------------------------
    Teacher Column Carousel
------------------------------ */  
    $(".teachers-column-carousel").owlCarousel({
        autoPlay: false, 
        slideSpeed:2000,
        pagination:false,
        navigation:true,	  
        items : 4,
        navigationText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
        itemsDesktop : [1199,4],
        itemsDesktopSmall : [980,3],
        itemsTablet: [768,2],
        itemsMobile : [479,1],
    }); 
/*----------------------------
    Class Details Carousel
------------------------------ */  
    $(".class-details-carousel").owlCarousel({
        autoPlay: false, 
        slideSpeed:2000,
        pagination:false,
        navigation:true,	  
        items : 1,
        navigationText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
        itemsDesktop : [1199,1],
        itemsDesktopSmall : [980,1],
        itemsTablet: [768,1],
        itemsMobile : [479,1],
    });
    
/*----------------------------
    Brand Carousel
------------------------------ */  
    $(".brand-carousel").owlCarousel({
        autoPlay: true, 
        slideSpeed:2000,
        pagination:false,
        navigation:false,	  
        items : 5,
        itemsDesktop : [1199,5],
        itemsDesktopSmall : [980,4],
        itemsTablet: [768,2],
        itemsMobile : [479,1],
    }); 
/*--------------------------
    Countdown
---------------------------- */	
    $('[data-countdown]').each(function() {
        var $this = $(this), finalDate = $(this).data('countdown');
        $this.countdown(finalDate, function(event) {
        $this.html(event.strftime('<div class="cdown days"><span class="counting">%-D</span>days</div><div class="cdown hours"><span class="counting">%-H</span>hrs</div><div class="cdown minutes"><span class="counting">%M</span>mins</div><div class="cdown seconds"><span class="counting">%S</span>secs</div>'));
        });
    });	
    
/*--------------------------
    ScrollUp
---------------------------- */	
	$.scrollUp({
        scrollText: '<i class="fa fa-angle-up"></i>',
        easingType: 'linear',
        scrollSpeed: 900,
        animation: 'fade'
    }); 	   
    
/*--------------------------
    Counter Up
---------------------------- */	
    $('.counter').counterUp({
        delay: 70,
        time: 5000
    });    
       
/*--------------------------------
	Testimonial Small Carousel
-----------------------------------*/
    $('.testimonial-small-text-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        draggable: false,
        fade: true,
        asNavFor: '.slider-nav'
    });
/*------------------------------------
	Testimonial Small Carousel as Nav
--------------------------------------*/
    $('.testimonial-small-image-slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '.testimonial-small-text-slider',
        dots: false,
        arrows: false,
        centerMode: true,
        focusOnSelect: true,
        centerPadding: '10px',
        responsive: [
            {
              breakpoint: 450,
              settings: {
                dots: false,
                slidesToShow: 3,  
                centerPadding: '0px',
                }
            },
            {
              breakpoint: 420,
              settings: {
                autoplay: true,
                dots: false,
                slidesToShow: 1,
                centerMode: false,
                }
            }
        ]
    });
    
/*--------------------------
    Mix It Up
---------------------------- */	
    $('.filter-items').mixItUp(); 
 
 $( ".header-overlay" ).siblings( ".breadcrumb-banner-area" ).addClass("transparent-breadcrumb");
/*--------------------------
    Venubox
---------------------------- */	
    $('.venobox').venobox({    
        border: '10px',          
        titleattr: 'data-title',  
        numeratio: true,           
        infinigall: true      
    });
	
    /*----------------------------
        text-animation
    ------------------------------ */  
    $('.univ-ani-heading').textillate({
      loop: true,
      in: {
        delay: 40,
      },
      out: {
        delay: 50,
      },
    });
    
    /*----------------------------
        text-animation
    ------------------------------ */  
    $('.slider-subtitle').textillate({
      loop: true,
      in: {
        delay: 50,
      },
      out: {
        delay: 70,
      },
    });	
	

/*--------------------------
    WOW
---------------------------- */		
new WOW().init();


/* First Word js */
$('p.event-date-list').each(function() {
   var html = $(this).html();
   var word = html .substr(0, html.indexOf(" "));
   var rest = html .substr(html.indexOf(" "));
   $(this).html(rest).prepend($("<span/>").html(word).addClass("em"));
});

    
})(jQuery); 