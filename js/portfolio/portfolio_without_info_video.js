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
			
	video_setup();
});	
jQuery(window).resize(function($){
	"use strict";
	video_setup();
});	
jQuery(window).load(function($){
	"use strict";
	video_setup();
});	

function video_setup() {
	"use strict";
	var setHeight2 = window_h - header.height() - jQuery('.slider_info').height();
	jQuery('.fs_grid_gallery').height(window_h - header.height()-1);
	jQuery('.ribbon_wrapper').height(setHeight2);
	jQuery('.fw_video_block').height(setHeight2-20);
	jQuery('.fw_video_block').width(((setHeight2-20)/9)*16);
}
