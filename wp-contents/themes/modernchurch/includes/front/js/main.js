jQuery(document).ready(function(){

	jQuery('.scroll-down').click(function() {
		jQuery('html,body').animate({
        	scrollTop: jQuery('.content-top').offset().top
        }, 1000);
        return false;
	});

	jQuery('.header-search').on('click', function(){
		jQuery('.header-search-form').fadeIn('fast');
		jQuery('.header-search-input').focus();
	});

	jQuery('.search-close').on('click', function(){
		jQuery('.header-search-form').fadeOut('fast');
		jQuery('.header-search-input').delay('10').blur();
	});


});