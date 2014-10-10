<?php

function portfolio_related_works($nid){
  global $base_url;
  $query = new EntityFieldQuery();
	$query
    ->entityCondition('entity_type', 'node')
    ->propertyCondition('status', 1)
    ->entityCondition('bundle', 'portfolio');
  $results = $query->execute();
  $output = '';
  $output .= '<div class="row"><div class="span12 single_feature">';
  $output .= '<div class="bg_title"><h3>'.t('Related Works').'</h3></div>';
  $output .= ' <div class="featured_items"><div class="items3 featured_portfolio"><ul class="item_list">';
  foreach ($results['node'] as $result) {
    if ($result->nid != $nid) {
      // Load those nodes.
      $item = node_load($result->nid);
      // Get the portfolio item taxonomy terms.
      $taxonomy = array();
      foreach ($item->field_portfolio_category['und'] as $term) {
	      $taxonomy[] = taxonomy_term_load($term['tid'])->name;
      }
      $terms = implode(', ', $taxonomy);
	    // If image file does not exist in image style folder, create it.
			if (!file_exists(image_style_path('portfolio_related_works', $item->field_image['und'][0]['uri']))){ 
			  image_style_create_derivative(image_style_load('portfolio_related_works'), $item->field_image['und'][0]['uri'], image_style_path('portfolio_related_works', $item->field_image['und'][0]['uri']));
			}
			// Start markup output.
	    $output .= '
	    <li>
	      <div class="item">
	        <div class="item_wrapper">
						<div class="img_block wrapped_img">
							<a class="featured_ico_link" href="'.$base_url.'/node/'.$item->vid.'">
								<img src="'.file_create_url(image_style_path('portfolio_related_works', $item->field_image['und'][0]['uri'])).'">
								<div class="featured_item_fadder"></div>
								<span class="gallery_ico"><i class="stand_icon icon-eye"></i></span>
							</a>
						</div>
						
						<div class="featured_items_body">
							<div class="featured_items_title">
								<h6><a href="'.$base_url.'/node/'.$item->vid.'">'.$item->title.'</a></h6>
							</div>
							<div class="featured_item_content">
								'.substr($item->body['und'][0]['value'], 0, 75).'.... 
								<a class="morelink" href="'.$base_url.'/node/'.$item->vid.'">'.t('Read more').'</a>
								<div class="featured_items_meta">
									<div class="preview_categ">'.t('in').' '.$terms.'</div>
									<div class="gallery_likes gallery_likes_add ">
										<i class="stand_icon icon-heart-o"></i>
										<span>35</span>
									</div>											
								</div>
							</div>	
					  </div>
				  </div>
			  </div>
			</li>			
			';
	  }
  }
  $output .= '</ul></div></div></div></div><hr class="single_hr">';
  
  return $output;
}