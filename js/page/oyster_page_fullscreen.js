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
	$('.main_wrapper').addClass('fullwidth');			
	centerWindow();
	if (window_w > 760) {
		jQuery('html').addClass('without_border');
	}
});
jQuery(window).load(function(){
	"use strict";
	centerWindow();
});
jQuery(window).resize(function(){
	"use strict";
	centerWindow();
	setTimeout('centerWindow()',500);
	setTimeout('centerWindow()',1000);
});
function centerWindow() {
	"use strict";
	setTop = (window_h - jQuery('.fw_content_wrapper').height() - header.height())/2+header.height();
	if (setTop < header.height()+50) {
		jQuery('.fw_content_wrapper').addClass('fixed');
		jQuery('body').addClass('addPadding');
		jQuery('.fw_content_wrapper').css('top', header.height()+50+'px');
	} else {
		jQuery('.fw_content_wrapper').css('top', setTop +'px');
		jQuery('.fw_content_wrapper').removeClass('fixed');
		jQuery('body').removeClass('addPadding');
	}
}