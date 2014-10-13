<div class="fullscreen-gallery">
  <div class="fs_grid_gallery">	
    
    <div class="ribbon_wrapper">
        <a href="javascript:void(0)" class="btn_prev"></a>
        <a href="javascript:void(0)" class="btn_next"></a>
        <?php if (isset($content['field_image'])): ?>
        <div id="ribbon_swipe"></div>
        <div class="ribbon_list_wrapper">
          <ul class="ribbon_list">
            <?php 
              $count = '1';
              foreach ($node->field_image['und'] as $image) {
                print '<li data-count="'.$count.'" class="slide'.$count.'"><div class="slide_wrapper"><img src="'.file_create_url($image['uri']).'" alt="image'.$count.'"/></div></li>';
                $count++;
              }
            ?>
	          
      	  </ul>
        </div>
        <?php endif; ?>
    </div>
    
    <div class="slider_info">
    
      <div class="slider_data">
        <a href="javascript:void(0)" class="ltl_prev"><i class="icon-angle-left"></i></a><span class="num_current">1</span> <?php print t('of'); ?> <span class="num_all"></span><a href="javascript:void(0)" class="ltl_next"><i class="icon-angle-right"></i></a>
        <h6 class="post_title"><?php print $title; ?></h6>
      </div>
      
      <div class="slider_share">
        <div class="blogpost_share">
          <span>Share this:</span>
          <a href="javascript:void(0)" class="share_facebook"><i class="stand_icon icon-facebook-square"></i></a>
          <a href="javascript:void(0)" class="share_pinterest"><i class="stand_icon icon-pinterest"></i></a>                                                            
          <a href="javascript:void(0)" class="share_tweet"><i class="stand_icon icon-twitter"></i></a>                                                       
          <a href="javascript:void(0)" class="share_gplus"><i class="icon-google-plus-square"></i></a>
          <div class="clear"></div>
        </div>
      </div>
      
      <div class="block_likes">
	      <div class="post-views"><i class="stand_icon icon-eye"></i> <span>5801</span></div>                            
	      <div class="gallery_likes gallery_likes_add ">
          <i class="stand_icon icon-heart-o"></i>
          <span>87</span>
	      </div>											
      </div>
      <div class="clear"></div>
      <div class="post_meta_data">
        <div class="listing_meta">
          <span><?php print t('by '); print $name; ?></span>
          <?php if ($content['field_portfolio_category']): ?>
            <span><?php print t('in'); ?> <?php print render($content['field_portfolio_category']); ?></span>
          <?php endif; ?>
          <?php if (render($content['field_portfolio_skills'])) { print render($content['field_portfolio_skills']); } ?>                                                   
        </div>
        <div class="post_controls">
          <?php if (oyster_node_pagination($node, 'p') != NULL) : ?>
        	  <div class="fleft"><a href="<?php print url('node/' . oyster_node_pagination($node, 'p'), array('absolute' => TRUE)); ?>" rel="prev"></a></div>
          <?php endif; ?>
          <?php if (oyster_node_pagination($node, 'n') != NULL) : ?>
            <div class="fright"><a href="<?php print url('node/' . oyster_node_pagination($node, 'n'), array('absolute' => TRUE)); ?>" rel="next"></a></div> 
          <?php endif; ?>
            <a href="javascript:history.back()" class="fw_post_close"></a>
        </div>
      </div>                           
    </div>
  </div>
</div>   

<script type="text/javascript">        
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
	
	jQuery('.num_all').text(jQuery('.ribbon_list li').size());
	jQuery('.ribbon_wrapper').height(setHeight2);
	jQuery('.ribbon_list .slide_wrapper').height(setHeight2);
	jQuery('.ribbon_list').height(setHeight2).width(20).css('left', 0);
	jQuery('.ribbon_list').find('li').each(function(){
		jQuery('.ribbon_list').width(jQuery('.ribbon_list').width()+jQuery(this).width());
		jQuery(this).attr('data-offset',jQuery(this).offset().left);
		jQuery(this).width(jQuery(this).find('img').width()+parseInt(jQuery(this).find('.slide_wrapper').css('margin-left')));
	});
	var max_step = -1*(jQuery('.ribbon_list').width()-window_w);
}
function prev_slide() {
	"use strict";
	var max_step = -1*(jQuery('.ribbon_list').width()-window_w);
	var current_slide = parseInt(jQuery('.currentStep').attr('data-count'));
	current_slide--;
	if (current_slide < 1) {
		current_slide = jQuery('.ribbon_list').find('li').size();
	}
	jQuery('.currentStep').removeClass('currentStep');
	jQuery('.num_current').text(current_slide);
	jQuery('.slide'+current_slide).addClass('currentStep');
	if (-1*jQuery('.slide'+current_slide).attr('data-offset') > max_step) {
		jQuery('.ribbon_list').css('left', -1*jQuery('.slide'+current_slide).attr('data-offset'));
	} else {
		jQuery('.ribbon_list').css('left', max_step);
	}
}
function next_slide() {
	"use strict";
	var max_step = -1*(jQuery('.ribbon_list').width()-window_w);
	var current_slide = parseInt(jQuery('.currentStep').attr('data-count'));
	current_slide++;
	if (current_slide > jQuery('.ribbon_list').find('li').size()) {
		current_slide = 1
	}
	jQuery('.currentStep').removeClass('currentStep');
	jQuery('.num_current').text(current_slide);
	jQuery('.slide'+current_slide).addClass('currentStep');
	if (-1*jQuery('.slide'+current_slide).attr('data-offset') > max_step) {
		jQuery('.ribbon_list').css('left', -1*jQuery('.slide'+current_slide).attr('data-offset'));
	} else {
		jQuery('.ribbon_list').css('left', max_step);
	}
}
</script>         