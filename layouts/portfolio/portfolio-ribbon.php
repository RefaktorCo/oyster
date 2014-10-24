<?php drupal_add_js(drupal_get_path('theme', 'oyster') .'/js/portfolio/portfolio_ribbon.js'); ?>
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
      
      <?php if (!$teaser && module_exists('oyster_utilities')): ?>
      <div class="slider_share">
        <?php print theme('oyster_social_share', array('title' => $title, 'link' => $base_url.'/node/'.$nid, 'image' => $share_image)); ?>
      </div>
      <?php endif; ?>
      
      <?php if (render($content['field_like']) || module_exists('statistics')): ?> 
	    <div class="block_likes">
	      <?php if (module_exists('statistics')): ?>
	      <div class="post-views"><i class="stand_icon icon-eye"></i> <span><?php print statistics_get($nid)['totalcount'] +1; ?></span></div>
	      <?php endif; ?>
	      <?php if (render($content['field_like'])): ?><?php print render($content['field_like']); ?><?php endif; ?>	   
	    </div> 
	    <?php endif; ?>
	    
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
<div class="preloader"></div>    