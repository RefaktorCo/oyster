<?php

/**
 * Define some variables for use in theme templates.
 */
function oyster_process_page(&$variables) {	
  // Assign site name and slogan toggle theme settings to variables.
  $variables['disable_site_name']   = theme_get_setting('toggle_name') ? FALSE : TRUE;
  $variables['disable_site_slogan'] = theme_get_setting('toggle_slogan') ? FALSE : TRUE;
   // Assign site name/slogan defaults if there is no value.
  if ($variables['disable_site_name']) {
    $variables['site_name'] = filter_xss_admin(variable_get('site_name', 'Drupal'));
  }
  if ($variables['disable_site_slogan']) {
    $variables['site_slogan'] = filter_xss_admin(variable_get('site_slogan', ''));
  }
}	

/**
* Add several style-related elements into the <head> tag.
*/
function oyster_preprocess_html(&$vars){
 
 $viewport = array(
   '#type' => 'html_tag',
   '#tag' => 'meta',
   '#attributes' => array(
     'name' => 'viewport',
     'content' =>  'width=device-width, initial-scale=1, maximum-scale=1',
   ),
   '#weight' => 1,
 );

 $ptsans = array(
   '#type' => 'markup',
   '#markup' => '<link href="//fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet" type="text/css">',
   '#weight' => 2,
 );
 
 $roboto = array(
   '#type' => 'markup',
   '#markup' => '<link href="//fonts.googleapis.com/css?family=Roboto:400,300,500,900" rel="stylesheet" type="text/css">',
   '#weight' => 3,
 );
 
 $font_awesome = array(
    '#tag' => 'link', 
    '#attributes' => array( 
      'href' => '//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css', 
      'rel' => 'stylesheet',
      'type' => 'text/css',
      'media' => 'screen',
    ),
    '#weight' => 4,
  );
 
 drupal_add_html_head( $viewport, 'viewport');
 drupal_add_html_head( $ptsans, 'ptsans');
 drupal_add_html_head( $roboto, 'roboto');
 drupal_add_html_head( $font_awesome, 'fontawesome');

}

/**
 * Impelements hook_form_alter()
 */
function oyster_form_alter(&$form, &$form_state, $form_id) {
  
  if ($form_id == 'search_block_form') {
    
    unset($form['search_block_form']['#title']); // Change the text on the label element
    unset($form['search_block_form']['#title_display']); // Toggle label visibilty
    $form['search_block_form']['#size'] = 40;  // define size of the textfield
    $form['search_block_form']['#default_value'] = t('Search the site...'); // Set a default value for the textfield
    
    // Add extra attributes to the text box
    $form['search_block_form']['#attributes']['onblur'] = "if (this.value == '') {this.value = 'Search the site...';}";
    $form['search_block_form']['#attributes']['onfocus'] = "if (this.value == 'Search the site...') {this.value = '';}";
    // Prevent user from searching the default text
    $form['#attributes']['onsubmit'] = "if(this.search_block_form.value=='Search the site...'){ alert('Please enter a search'); return false; }";

    // Alternative (HTML5) placeholder attribute instead of using the javascript
    $form['search_block_form']['#attributes']['placeholder'] = t('Search the site...');

    $form['search_block_form']['#attributes']['class'] = array('field_search', 'search');
    
    $form['actions']['submit'] =  array(
      '#type' => 'submit',
    	'#prefix' => '<span class="hidden">',
    	'#suffix' => '</span>',
    	
    );
    
  }
} 

/**
 * Add list classes for links in "Header Menu" region.
 */
function oyster_menu_link__header_menu(array $variables) {
  $output = '';
  unset($variables['element']['#attributes']['class']);
  $element = $variables['element'];
  static $item_id = 0;
  $menu_name = $element['#original_link']['menu_name'];

  // set the global depth variable
  global $depth;
  $depth = $element['#original_link']['depth'];

  if ( ($element['#below']) && ($depth == "1") ) {
    $element['#attributes']['class'][] = 'menu-item-has-children '.$element['#original_link']['mlid'].'';
  }
  
  if ( ($element['#below']) && ($depth == "2") ) {
    $element['#attributes']['class'][] = 'menu-item-has-children';
  }
  
  $sub_menu = $element['#below'] ? drupal_render($element['#below']) : '';
  $output .= l($element['#title'], $element['#href'], $element['#localized_options']);
  // if link class is active, make li class as active too
  if(strpos($output,"active")>0){
    $element['#attributes']['class'][] = "active";
  }
 
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . '</li>';
  
}

/**
 * Define class for first menu UL.
 */
function oyster_menu_tree__header_menu($variables){
  return '<ul class="menu" id="menu-main-menu">' . $variables['tree'] . '</ul>';
  
}

/**
 * Define class for all other menu ULs.
 */
function oyster_menu_tree__header_menu_below($variables){
  return '<ul class="sub-menu">' . $variables['tree'] . '</ul>';
}

/**
 * Implements hook_block_view_alter().
 */
function oyster_block_view_alter(&$data, $block) {

  if ( $block->region == 'header_search' && isset($data['content']) ) {
    // Unset some additional wrappers in the Header Search region.
  	unset($data['content']['search_block_form']['#theme_wrappers']);
    unset($data['content']['actions']['#theme_wrappers']);
    unset($data['content']['actions']['submit']['#theme_wrappers']);
  }

  if ( ($block->region == 'header_menu') && !isset($data['content']['#type']) ) {   
    $data['content']['#theme_wrappers'] = array('menu_tree__header_menu');

    foreach($data['content'] as &$key):
     
      if (isset($key['#theme'])) {
        $key['#theme'] = 'menu_link__header_menu';
      }
      if (isset($key['#below']['#theme_wrappers'])) {
        $key['#below']['#theme_wrappers'] = array('menu_tree__header_menu_below');
      }
      
      if (isset($key['#below'])) {
        foreach($key['#below'] as &$key2):
        
           if (isset($key2['#theme'])) {
             $key2['#theme'] = 'menu_link__header_menu';
           }
           if (isset($key2['#below']['#theme_wrappers'])) {
             $key2['#below']['#theme_wrappers'] = array('menu_tree__header_menu_below');
           }
           if (isset($key2['#below'])) {
              foreach($key2['#below'] as &$key3):
              
                if (isset($key3['#theme'])) {
                  $key3['#theme'] = 'menu_link__header_menu';
                }
              endforeach;
              
           }
        endforeach;
       
      }
    endforeach;
  }
}

/**
 * Modify theme_field()
 */
function oyster_field($variables) {
  $output = '';
  // Render the label, if it's not hidden.
  if (!$variables['label_hidden']) {
    $output .= '<div class="field-label"' . $variables['title_attributes'] . '>' . $variables['label'] . ':&nbsp;</div>';
  }
  switch ($variables['element']['#field_name']) {
	  case 'field_tags':
	    foreach ($variables['items'] as $delta => $item) {
	      $rendered_tags[] = drupal_render($item);
	    }
	    $output .= implode(', ', $rendered_tags);
	  break;
	  case 'field_portfolio_category':
	  case 'field_article_category':
	    foreach ($variables['items'] as $delta => $item) {
	      $rendered_tags[] = drupal_render($item);
	    }
	    $output .= implode(', ', $rendered_tags);
	  break;  
	  case 'field_portfolio_skills':	    
	    foreach ($variables['items'] as $delta => $item) {
	       $output .= '<span class="preview_skills">' . drupal_render($item) . '</span>';
	    }
	  break;
	  case 'field_image':
	    if ($variables['element']['#bundle'] =='article') {
		    foreach ($variables['items'] as $delta => $item) {
		       $output .= '<div class="item">' . drupal_render($item) . '</div>';
		    }
	    }
	  break;
	  case 'field_image':
	    if ($variables['element']['#bundle'] =='portfolio') {
		    foreach ($variables['items'] as $delta => $item) {
		       $output .=  drupal_render($item);
		    }
	    }
	  break;
	   case 'field_media_embed':
	     foreach ($variables['items'] as $delta => $item) {
		     $output .=  drupal_render($item);
	     }
	  break;
	  default:
	    // Render the items.
		  $output .= '<div class="field-items"' . $variables['content_attributes'] . '>';
		  foreach ($variables['items'] as $delta => $item) {
		    $classes = 'field-item ' . ($delta % 2 ? 'odd' : 'even');
		    $output .= '<div class="' . $classes . '"' . $variables['item_attributes'][$delta] . '>' . drupal_render($item) . '</div>';
		  }
		  $output .= '</div>';
		
		  // Render the top-level DIV.
		  $output = '<div class="' . $variables['classes'] . '"' . $variables['attributes'] . '>' . $output . '</div>';
	  break;
  }
   
  return $output;
}

/**
 * Theme node pagination function().
 */
function oyster_node_pagination($node, $mode = 'n') {
  $query = new EntityFieldQuery();
	$query
    ->entityCondition('entity_type', 'node')
    ->propertyCondition('status', 1)
    ->entityCondition('bundle', $node->type);
  $result = $query->execute();
  $nids = array_keys($result['node']);
  
  while ($node->nid != current($nids)) {
    next($nids);
  }
  
  switch($mode) {
    case 'p':
      prev($nids);
    break;
		
    case 'n':
      next($nids);
    break;
		
    default:
    return NULL;
  }
  
  return current($nids);
}