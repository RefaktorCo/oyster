<?php 
  // Initialize oAuth helper functions.
  require_once(drupal_get_path('theme', 'oyster').'/inc/portfolio.inc');
?>

<div class="span12 module_blog module_none_padding module_blog_page">
  <div class="prev_next_links">
      <?php if (oyster_node_pagination($node, 'p') != NULL) : ?>
        <div class="fleft"><a href="<?php print url('node/' . oyster_node_pagination($node, 'p'), array('absolute' => TRUE)); ?>"><?php print t('Previous Post'); ?></a></div>
      <?php endif; ?>
      <?php if (oyster_node_pagination($node, 'n') != NULL) : ?>
        <div class="fright"><a href="<?php print url('node/' . oyster_node_pagination($node, 'n'), array('absolute' => TRUE)); ?>"><?php print t('Next Post'); ?></a></div>
      <?php endif; ?>
  </div>
  <div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
  
	  <div class="blog_post_page sp_post">
		  <div class="pf_output_container"> 
		    <?php if (count(field_get_items('node', $node, 'field_image')) == 1 ): ?>                                               	                                 
		        <?php print render($content['field_image']); ?>
		    <?php endif; ?>
		    
		    <?php if (count(field_get_items('node', $node, 'field_image')) > 1 ): ?>                                               	
		    <div class="slider-wrapper theme-default ">
		      <div class="nivoSlider">                                                
		        <?php print render($content['field_image']); ?>
		      </div>
		    </div>
		    <?php endif; ?>
		  </div>   
		  <div class="blogpreview_top">
        <div class="box_date">
          <span class="box_month"><?php print format_date($node->created, 'custom', 'M'); ?></span>
          <span class="box_day"><?php print format_date($node->created, 'custom', 'd'); ?></span>
        </div>                                            
        <div class="listing_meta">
          <span>in <a href="javascript:void(0)">Portrait</a></span>
          <span><a href="<?php print $node_url;?>/#comments"><?php print $comment_count; ?> <?php print t('Comment'); ?><?php if ($comment_count != "1" ) { echo "s"; } ?></a></span>
          <?php if (render($content['field_portfolio_skills'])) { print render($content['field_portfolio_skills']); } ?>
        </div>   
        <?php if ($display_submitted): ?>                                     
          <div class="author_ava"><?php print $user_picture; ?></div>
        <?php endif; ?>
      </div>
      <h3 class="blogpost_title"><?php print $title; ?></h3>
    </div><!--.blog_post_page -->      
    
    <article class="contentarea sp_contentarea">
	    <?php if ($content['field_portfolio_introduction']) { print render($content['field_portfolio_introduction']); } ?>
	    
	    
	    <?php
	      // We hide the comments and links now so that we can render them later.
	      
	      hide($content['field_image']);
	      hide($content['field_tags']);
	      hide($content['field_portfolio_skills']);
	      hide($content['field_portfolio_gallery']);
	      hide($content['field_media_embed']);
	      hide($content['field_portfolio_introduction']);
	      hide($content['field_portfolio_category']);
	      hide($content['comments']);
	      hide($content['links']);
	      print render($content);
	    ?>
	                 
    </article>
	   
	  <div class="blog_post-footer sp-blog_post-footer ">
		  <div class="blogpost_share">
		    <span>Share this:</span>
		    <a href="javascript:void(0)" class="share_facebook"><i class="stand_icon icon-facebook-square"></i></a>
		    <a href="javascript:void(0)" class="share_pinterest"><i class="stand_icon icon-pinterest"></i></a>                                                    <a href="javascript:void(0)" class="share_tweet"><i class="stand_icon icon-twitter"></i></a>                                                       
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