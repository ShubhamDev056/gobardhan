(function ($) {
    "use strict";

/*--
    Menu Sticky
-----------------------------------*/
var windows = $(window);
var sticky = $('.header-sticky');

windows.on('scroll', function() {
    var scroll = windows.scrollTop();
    if (scroll < 300) {
        sticky.removeClass('is-sticky');
    }else{
        sticky.addClass('is-sticky');
    }
});

/*--
    Mobile Menu
------------------------*/
var mainMenuNav = $('.main-menu nav');
mainMenuNav.meanmenu({
    meanScreenWidth: '991',
    meanMenuContainer: '.mobile-menu',
    meanMenuClose: '<span class="menu-close"></span>',
    meanMenuOpen: '<span class="menu-bar"></span>',
    meanRevealPosition: 'right',
    meanMenuCloseSize: '0',
});



/*--
	Isotop with ImagesLoaded
-----------------------------------*/
var isotopFilter = $('.isotop-filter');
var isotopGrid = $('.isotop-grid');
var isotopGridItem = '.isotop-item';

isotopFilter.find('button:first-child').addClass('active');

/*-- Images Loaded --*/
isotopGrid.imagesLoaded(function () {

    isotopGrid.isotope({
        itemSelector: isotopGridItem,
        layoutMode: 'masonry',
    });

    /*-- Isotop Filter Menu --*/
    isotopFilter.on('click', 'button', function () {

        var filterValue = $(this).attr('data-filter');

        isotopFilter.find('button').removeClass('active');
        $(this).addClass('active');
        isotopGrid.isotope({filter: filterValue});

    });
    
});
    
/*--
	Video Popup
-----------------------------------*/
var videoPopup = $('.video-popup');
videoPopup.magnificPopup({
    disableOn: 700,
    type: 'iframe',
    mainClass: 'mfp-fade',
    removalDelay: 160,
    preloader: false,
    fixedContentPos: false
});
    
/*--
	Image Popup
-----------------------------------*/
var imagePopup = $('.image-popup');
imagePopup.magnificPopup({
    type: 'image',
    mainClass: 'mfp-fade',
});
    
/*--
	Image Popup
-----------------------------------*/
var galleryPopup = $('.gallery-popup');
galleryPopup.magnificPopup({
    type: 'image',
    mainClass: 'mfp-fade',
    gallery: {
        enabled: true,
    },
});

/*--
	Counter UP
-----------------------------------*/
var counter = $('.counter')
counter.counterUp({
    delay: 20,
    time: 3000
});
    

/*--
    Scroll Up
-----------------------------------*/
$.scrollUp({
    easingType: 'linear',
    scrollSpeed: 900,
    animation: 'fade',
    scrollText: '<i class="fa fa-angle-up"></i>',
});
	
//var offset = 0;
//offset = $(elem).offset().top;
    var scrollTrigger= $("*[scroll-trigger]");
    scrollTrigger.bind('click', function(e) {
		
        e.preventDefault(); // prevent hard jump, the default behavior
        var _this = $(this); 
        var triggerAttr = _this.attr('scroll-trigger'); 
		$('.top-menu-tabs li').each(function(){
			$(this).removeClass('active');
		})
		_this.closest('li').addClass('active'); 
        var scrollTarget = $('*[scroll-target='+triggerAttr+']');  // Set the target as variable

        // perform animated scrolling by getting top-position of target-element and set it as scroll target
		$('html, body').stop().animate({
				scrollTop: scrollTarget.offset().top - 190
		}, 600 );
        return false;
    });   
  $('.check_multiselect').SumoSelect({
	  selectAll:true,
	  search:true,
  });

})(jQuery);	

/*var TxtType = function(el, toRotate, period) {
this.toRotate = toRotate;
this.el = el;
this.loopNum = 0;
this.period = parseInt(period, 100) || 2000;
this.txt = '';
this.tick();
this.isDeleting = false;
};

TxtType.prototype.tick = function() {
var i = this.loopNum % this.toRotate.length;
var fullTxt = this.toRotate[i];

if (this.isDeleting) {
this.txt = fullTxt.substring(0, this.txt.length - 1);
} else {
this.txt = fullTxt.substring(0, this.txt.length + 1);
}

this.el.innerHTML = '<span class="wrap">'+this.txt+'</span>';

var that = this;
var delta = 100;

if (this.isDeleting) { delta /= 2; }

if (!this.isDeleting && this.txt === fullTxt) {
delta = this.period;
this.isDeleting = true;
} else if (this.isDeleting && this.txt === '') {
this.isDeleting = false;
this.loopNum++;
delta = 100;
}

setTimeout(function() {
that.tick();
}, delta);
};

window.onload = function() {
var elements = document.getElementsByClassName('typewrite');
for (var i=0; i<elements.length; i++) {
	var toRotate = elements[i].getAttribute('data-type');
	var period = elements[i].getAttribute('data-period');
	if (toRotate) {
	  new TxtType(elements[i], JSON.parse(toRotate), period);
	}
}
// INJECT CSS
var css = document.createElement("style");
css.type = "text/css";
css.innerHTML = ".typewrite > .wrap { border-right: 0.08em solid #ccc}";
document.body.appendChild(css);
};
*/
