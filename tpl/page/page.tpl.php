<header class="main_header">
  <div class="header_wrapper">
  
    <?php if ($page['header_branding']) { print render($page['header_branding']); } ?>
    
    <?php if ($logo || $site_name || $site_slogan): ?>
  	<div class="logo_sect">
  	  <?php if ($logo): ?> 
        <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" class="logo"><img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" class="logo_def"></a>
      <?php endif; ?> 
            
      <?php if ($site_name || $site_slogan): ?>
      <div id="name-and-slogan"<?php if ($disable_site_name && $disable_site_slogan) { print ' class="hidden"'; } ?>>

        <?php if ($site_name): ?>
          <?php if ($title): ?>
            <div id="site-name"<?php if ($disable_site_name) { print ' class="hidden"'; } ?>>
	            <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a>
	          </div>
          <?php else: /* Use h1 when the content title is empty */ ?>
	          <h1 id="site-name"<?php if ($disable_site_name) { print ' class="hidden"'; } ?>>
	            <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a>
	          </h1>
          <?php endif; ?>
        <?php endif; ?>

        <?php if ($site_slogan): ?>
          <div id="site-slogan"<?php if ( ($disable_site_slogan ) ) { print 'class="hidden"'; } if ( (!$disable_site_slogan ) AND ($disable_site_name) ) { print 'class="slogan no-name"'; } else { print 'class="slogan"'; } ?>>
            <?php print $site_slogan; ?>
          </div>
        <?php endif; ?>

      </div> <!-- /#name-and-slogan -->
	    <?php endif; ?>  
       
    </div>  
    <?php endif; ?>  
                       
    <div class="header_rp">
      <nav>
        <div class="menu-main-menu-container">
          <?php print render($page['header_menu']); ?>    	
        </div>
        
        <div class="search_fadder"></div>
        <div class="header_search">
          <?php $block = module_invoke('search', 'block_view', 'search'); print render($block); ?>
	      </div>                
      </nav>            
      <a class="search_toggler" href="#"></a>
    </div>
    <div class="clear"></div>
  
  </div>
</header>

<?php print render($page['before_content']); ?>

<div class="main_wrapper">
  <?php if ($page['sidebar']): ?><div class="bg_sidebar is_right-sidebar"></div><?php endif; ?>  
  <div class="content_wrapper">
    <div class="container main-container">
      <div class="content_block <?php if ($page['sidebar']) { print "right-sidebar"; } else { print "no-sidebar"; } ?>">
        <div class="fl-container <?php if ($page['sidebar']) { print "hasRS"; } ?>">
          <div class="row">
            
            <?php if ($messages): ?>
					    <div id="messages"><div class="section clearfix">
					      <?php print $messages; ?>
					    </div></div> <!-- /.section, /#messages -->
					  <?php endif; ?>
            
            <?php if ($tabs): ?>
			        <div class="tabs">
			          <?php print render($tabs); ?>
			        </div>
			      <?php endif; ?>
			      <?php print render($page['help']); ?>
			      <?php if ($action_links): ?>
			        <ul class="action-links">
			          <?php print render($action_links); ?>
			        </ul>
			      <?php endif; ?>
			      <div id="content">
              <?php print render($page['content']); ?>
			      </div>
              
          </div>
        </div><!-- .fl-container -->
        <?php if ($page['sidebar']): ?>
        <div class="right-sidebar-block">
          <?php print render($page['sidebar']); ?> 
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>          
<?php if ($page['footer_bottom_left']): ?>          
<footer><!-- .main-wrapper -->
  <div class="footer_wrapper container">
    <div class="row">
      <div class="span6">
        <?php print render($page['footer_bottom_left']); ?> 
      </div>
    </div>
  </div>
</footer>    
<?php endif; ?>