<div class="fullscreen-gallery">
  <div class="fs_grid_gallery">	
    
    <div class="ribbon_wrapper">
        <?php if (isset($content['field_image'])): ?>
        <div id="ribbon_swipe"></div>
        <div class="ribbon_list_wrapper">
          <ul class="fw_gallery_list">
            <?php 
              $count = '1';
              foreach ($node->field_image['und'] as $image) {
                print '<li data-count="'.$count.'" class="slide'.$count.'"><img src="'.file_create_url($image['uri']).'" alt="image'.$count.'"/></li>';
                $count++;
              }
            ?>
	          
      	  </ul>
        </div>
        <?php endif; ?>
    </div>
    
    <?php if (isset($content['field_media_embed'])) { print render($content['field_media_embed']); } ?>
    
    <div class="slider_info fw_slider_info">
    
      <?php if (isset($content['field_image'])): ?>
      <div class="slider_data">
        <a href="javascript:void(0)" class="ltl_prev"><i class="icon-angle-left"></i></a><span class="num_current">1</span> <?php print t('of'); ?> <span class="num_all"></span><a href="javascript:void(0)" class="ltl_next"><i class="icon-angle-right"></i></a>
        <h6 class="post_title"><?php print $title; ?></h6>
      </div>
      <?php endif; ?>
      
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

<div class="content_wrapper">
  <div class="container simple-post-container fw-post-container">
    <div class="content_block no-sidebar row">
      <div class="fl-container">
        <div class="row">						
          <div class="posts-block simple-post">
            <article class="contentarea sp_contentarea">
    
					    <?php if (isset($content['field_portfolio_introduction'])) { print render($content['field_portfolio_introduction']); } ?>
					    
				      <?php if (isset($content['field_portfolio_gallery'])) { print portfolio_gallery($node); } ?>
					
					    <?php
					      // Hide all other fields and render $content.
					      hide($content['field_image']);
					      hide($content['field_tags']);
					      hide($content['field_portfolio_skills']);
					      hide($content['field_portfolio_gallery']);
					      hide($content['field_media_embed']);
					      hide($content['field_portfolio_introduction']);
					      hide($content['field_portfolio_category']);
					      hide($content['field_portfolio_layout']);
					      hide($content['comments']);
					      hide($content['links']);
					      print render($content);
					    ?>
					                 
				    </article>
					   
					  <div class="blog_post-footer sp-blog_post-footer ">
						  <div class="blogpost_share">
						    <span>Share this:</span>
						    <a href="javascript:void(0)" class="share_facebook"><i class="stand_icon icon-facebook-square"></i></a>
						    <a href="javascript:void(0)" class="share_pinterest"><i class="stand_icon icon-pinterest"></i></a>                                                    
						    <a href="javascript:void(0)" class="share_tweet"><i class="stand_icon icon-twitter"></i></a>                                                       
						    <a href="javascript:void(0)" class="share_gplus"><i class="icon-google-plus-square"></i></a>
						    <div class="clear"></div>
						  </div>
				  
						  <div class="block_likes">
						    <div class="post-views"><i class="stand_icon icon-eye"></i> <span>5458</span></div>
						    <div class="gallery_likes gallery_likes_add ">
						      <i class="stand_icon icon-heart-o"></i>
						      <span>45</span>
						    </div>																				
						  </div>
						  
						  <div class="clear"></div>
						</div> 
					   
					  <div class="blogpost_user_meta">
							<div class="author-ava"><?php print $user_picture; ?></div>
							<div class="author-name"><h6><?php print t('About the Author:'); ?> <?php print $name; ?></h6></div>
							<?php if (isset(user_load($uid)->field_author_info)): ?>
							<div class="author-description"><?php print user_load($uid)->field_author_info['und'][0]['value']; ?></div>
							<?php endif; ?>
							<div class="clear"></div>
				    </div>   
				  
				    <hr class="single_hr">          
				  
				    <?php print portfolio_related_works($nid); ?>
				
				  <?php
				    // Remove the "Add new comment" link on the teaser page or if the comment
				    // form is being displayed on the same page.
				    if ($teaser || !empty($content['comments']['comment_form'])) {
				      unset($content['links']['comment']['#links']['comment-add']);
				    }
				    // Only display the wrapper div if there are links.
				    $links = render($content['links']);
				    if ($links):
				  ?>
				    <div class="link-wrapper">
				      <?php print $links; ?>
				    </div>
				  <?php endif; ?>
				
				  <?php print render($content['comments']); ?>
				
				  </div>

          </div>
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
			jQuery('.slide1').addClass('currentStep');			
			ribbon_setup();
			
			jQuery('.commentlist').find('li').each(function(){
				if (jQuery(this).find('ul').size() > 0) {
					jQuery(this).addClass('has_ul');
				}
			});
			jQuery('.form-allowed-tags').width(jQuery('#commentform').width() - jQuery('.form-submit').width() - 13);
		});	
		jQuery(window).resize(function($){
			"use strict";
			ribbon_setup();
			jQuery('.form-allowed-tags').width(jQuery('#commentform').width() - jQuery('.form-submit').width() - 13);
		});	
		jQuery(window).load(function($){
			"use strict";
			ribbon_setup();
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
		}</script>         