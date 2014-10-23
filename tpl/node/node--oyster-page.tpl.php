<?php if (isset($content['field_oyster_page_layouts']) && $content['field_oyster_page_layouts']['#items'][0]['value']
 == 'image'): ?>
  <div class="fullscreen_block fw_background bg_image bg1"></div>       
	<div class="content_bg"></div>
	
	<?php 
		if (render($content['field_oyster_page_image'])) {
		  drupal_add_css(
		    '.fw_background.bg_image {background: url('. file_create_url($node->field_oyster_page_image['und'][0]['uri']) .');}',
		    array(
		      'group' => CSS_THEME,
		      'type' => 'inline',
		      'media' => 'screen',
		      'preprocess' => FALSE,
		      'weight' => '9999',
		    )
		  );
		}
		?>
		
		<script>
		jQuery(document).ready(function($){
      "use strict";	
     	$('.main_wrapper').addClass('fullwidth');
     	
     	jQuery('.fw_background').height(jQuery(window).height());
			jQuery('.main_header').removeClass('hided');
			jQuery('.fullscreen_block').addClass('loaded');
			jQuery('html').addClass('without_border');
		});
		jQuery(window).resize(function() {
			"use strict";
			jQuery('.fw_background').height(jQuery(window).height());		
    });
		</script>
	
<?php endif; ?>

<?php if (isset($content['field_oyster_page_layouts']) && $content['field_oyster_page_layouts']['#items'][0]['value'] == 'video'): ?>
   
   <?php if (render($content['field_oyster_page_video'])): ?>
   <div class="fullscreen_block fw_background bg_video">
     <?php print render($content['field_oyster_page_video']); ?> 	
   </div>
   <?php endif; ?>
   
   <script>
		jQuery(document).ready(function($){
			"use strict";
			$('.main_wrapper').addClass('fullwidth');
			jQuery('.fw_background').height(jQuery(window).height());			
			jQuery('.main_header').removeClass('hided');
			jQuery('.fullscreen_block').addClass('loaded');
			if (jQuery(window).width() > 1024) {
				if (jQuery('.bg_video').size() > 0) {
					if (((jQuery(window).height()+150)/9)*16 > jQuery(window).width()) {				
						jQuery('iframe').height(jQuery(window).height()+150).width(((jQuery(window).height()+150)/9)*16);
						jQuery('iframe').css({'margin-left' : (-1*jQuery('iframe').width()/2)+'px', 'top' : "-75px", 'margin-top' : '0px'});
					} else {
						jQuery('iframe').width(jQuery(window).width()).height(((jQuery(window).width())/16)*9);
						jQuery('iframe').css({'margin-left' : (-1*jQuery('iframe').width()/2)+'px', 'margin-top' : (-1*jQuery('iframe').height()/2)+'px', 'top' : '50%'});
					}
				}
			} else if (jQuery(window).width() < 760) {
				jQuery('.bg_video').height(jQuery(window).height()-jQuery('.main_header').height());
				jQuery('iframe').height(jQuery(window).height()-jQuery('.main_header').height());
			} else {
				jQuery('.bg_video').height(jQuery(window).height() - jQuery('.main_header').height());
				jQuery('.bg_video').css({'margin-top': jQuery('.main_header').height()+'px'});
				jQuery('iframe').height(jQuery(window).height() - jQuery('.main_header').height());				
			}
			jQuery('html').addClass('without_border');
		});
		jQuery(window).resize(function() {
			"use strict";
			jQuery('.fw_background').height(jQuery(window).height());
			if (jQuery(window).width() > 1024	) {
				if (jQuery('.bg_video').size() > 0) {
					if (((jQuery(window).height()+150)/9)*16 > jQuery(window).width()) {
						jQuery('iframe').height(jQuery(window).height()+150).width(((jQuery(window).height()+150)/9)*16);
						jQuery('iframe').css({'margin-left' : (-1*jQuery('iframe').width()/2)+'px', 'top' : "-75px", 'margin-top' : '0px'});
					} else {
						jQuery('iframe').width(jQuery(window).width()).height(((jQuery(window).width())/16)*9);
						jQuery('iframe').css({'margin-left' : (-1*jQuery('iframe').width()/2)+'px', 'margin-top' : (-1*jQuery('iframe').height()/2)+'px', 'top' : '50%'});
					}
				}
			} else if (jQuery(window).width() < 760) {
				jQuery('.bg_video').height(jQuery(window).height()-jQuery('.main_header').height());
				jQuery('iframe').height(jQuery(window).height()-jQuery('.main_header').height());
			} else {
				jQuery('.bg_video').height(jQuery(window).height() - jQuery('.main_header').height());
				jQuery('.bg_video').css({'margin-top': jQuery('.main_header').height()+'px'});
				jQuery('iframe').height(jQuery(window).height() - jQuery('.main_header').height());				
			}
		});		
	</script>
<?php endif; ?>

<?php if (isset($content['field_oyster_page_layouts']) && $content['field_oyster_page_layouts']['#items'][0]['value'] == 'fullscreen'): ?>
  <div class="fw_content_wrapper">
    <div class="fw_content_padding">
      <div class="content_wrapper noTitle">
        <div class="container">
          <div class="row">
            <div class="posts-block ">                                                   
              <div class="contentarea">
                <div class="row">
                  <div class="span12 first-module module_number_1 module_cont pb0 module_text_area">
                    <div class="bg_title"><h2 class="headInModule"><?php print $title; ?></h2></div>
                      <div class="module_content">
                        <?php
										     	hide($content['comments']);
										      hide($content['links']);
										      hide($content['field_oyster_page_layouts']);
										      hide($content['field_oyster_page_image']);
										      hide($content['field_oyster_page_video']);
										      print render($content);
										    ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>  
  </div>
	<div class="fixed_bg"></div>
	
	<?php 
		if (render($content['field_oyster_page_image'])) {
		  drupal_add_css(
		    '.fixed_bg {background: url('. file_create_url($node->field_oyster_page_image['und'][0]['uri']) .');}',
		    array(
		      'group' => CSS_THEME,
		      'type' => 'inline',
		      'media' => 'screen',
		      'preprocess' => FALSE,
		      'weight' => '9999',
		    )
		  );
		}
		?>
	
	<script>
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
	</script>
<?php endif; ?>