<?php 
  require_once(drupal_get_path('theme', 'oyster').'/inc/portfolio.inc');
 
  if (!$teaser && isset($node->field_portfolio_layout['und'])) {
    switch ($node->field_portfolio_layout['und'][0]['value']) {
      case 'simple':
        include_once(drupal_get_path('theme', 'oyster').'/layouts/portfolio/portfolio-simple.php');
      break;  
      case 'ribbon':
        include_once(drupal_get_path('theme', 'oyster').'/layouts/portfolio/portfolio-ribbon.php');
      break; 
      case 'full_no_info':
        include_once(drupal_get_path('theme', 'oyster').'/layouts/portfolio/portfolio-without-info.php');
      break;
      case 'full_with_info':
        include_once(drupal_get_path('theme', 'oyster').'/layouts/portfolio/portfolio-with-info.php');
      break;
      default:
        include_once(drupal_get_path('theme', 'oyster').'/layouts/portfolio/portfolio-simple.php');
      break;
    }
  }
  else {
	  include_once(drupal_get_path('theme', 'oyster').'/layouts/portfolio/portfolio-simple.php');
  }
?>