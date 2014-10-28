"use strict";
	
	var header = jQuery('.main_header'),
    html = jQuery('html'),
    body = jQuery('body'),
    footer = jQuery('footer'),
    window_h = jQuery(window).height(),
    window_w = jQuery(window).width(),
    main_wrapper = jQuery('.main_wrapper'),
    site_wrapper = jQuery('.site_wrapper'),
    setTop = 0,
    fullscreen_block = jQuery('.fullscreen_block'),
    is_masonry = jQuery('.is_masonry'),
    grid_portfolio_item = jQuery('.grid-portfolio-item'),
    pp_block = jQuery('.pp_block'),
    head_border = 1;

jQuery(document).ready(function($){
	"use strict";
	jQuery('html').addClass('fullscreen_page sticky_menu');
	$('.main_wrapper').addClass('fullwidth');
	
	if (jQuery('.fl-container').size() > 0) {
		jQuery('.fw_post_info').click(function(){
			jQuery('html, body').stop().animate({
				scrollTop: jQuery(jQuery('.content_wrapper')).offset().top-10
			}, 500);					
		});
	} else {
		jQuery('.fw_post_info').hide();
	}
	
  jQuery('#ribbon_swipe').on("swipeleft",function(){
		next_slide();
	});
	jQuery('#ribbon_swipe').on("swiperight",function(){
		prev_slide();
	});			
	jQuery('.ltl_prev').click(function(){
		prev_slide();
	});
	jQuery('.ltl_next').click(function(){
		next_slide();
	});
	jQuery('.btn_prev').click(function(){
		prev_slide();
	});
	jQuery('.btn_next').click(function(){
		next_slide();
	});
	jQuery('.slide1').addClass('currentStep');			
	ribbon_setup();
	
	setTimeout("ribbon_setup()",700);			
});	
jQuery(window).resize(function($){
	"use strict";
	ribbon_setup();
	setTimeout("ribbon_setup()",500);
	setTimeout("ribbon_setup()",1000);			
});	
jQuery(window).load(function($){
	"use strict";
	ribbon_setup();
	setTimeout("ribbon_setup()",350);
	setTimeout("ribbon_setup()",700);
});	

function ribbon_setup() {
	"use strict";
	var setHeight = window_h - header.height() - 20;
	var setHeight2 = window_h - header.height() - jQuery('.slider_info').height() - 20;
	jQuery('.fs_grid_gallery').height(window_h - header.height()-1);
	jQuery('.currentStep').removeClass('currentStep');
	jQuery('.slide1').addClass('currentStep');
	jQuery('.num_current').text('1');
	
	jQuery('.num_all').text(jQuery('.fw_gallery_list li').size());
	jQuery('.ribbon_wrapper').height(setHeight2);
	jQuery('.fw_gallery_list').height(setHeight2);
	var max_step = -1*(jQuery('.ribbon_list').width()-window_w);
}

function prev_slide() {
	"use strict";
	var current_slide = parseInt(jQuery('.currentStep').attr('data-count'));
	current_slide--;
	if (current_slide < 1) {
		current_slide = jQuery('.fw_gallery_list').find('li').size();
	}
	jQuery('.currentStep').removeClass('currentStep');
	jQuery('.num_current').text(current_slide);
	jQuery('.slide'+current_slide).addClass('currentStep');
}
function next_slide() {
	"use strict";
	var current_slide = parseInt(jQuery('.currentStep').attr('data-count'));
	current_slide++;
	if (current_slide > jQuery('.fw_gallery_list').find('li').size()) {
		current_slide = 1
	}
	jQuery('.currentStep').removeClass('currentStep');
	jQuery('.num_current').text(current_slide);
	jQuery('.slide'+current_slide).addClass('currentStep');
}