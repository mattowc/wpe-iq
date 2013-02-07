<?php  templ_get_top_header_navigation_above() ?> 
<?php  //templ_get_top_header_navigation() ?> 
<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('header_above')){?>
<?php } else {?>  <?php }?>
<div id="info-header">
    <div id="info-container">
        <div id="info-wrap">
            Call toll free or something or <a href="#" class="btn btn-primary btn-small">Get Started</a>
        </div> <!-- End #info-wrap -->
    </div> <!-- End #info-container -->
</div> <!-- End #info-header -->
<div class="wrapper">
	<div class="header clear">
    	<div class="header_in">
        	<div class="logo">
            	<a href="<?php bloginfo('url'); ?>">
            		<img src="/wp-content/uploads/2011/05/iq-express-logo-remixed-4.gif" width="310" height="64" alt="">
            	</a>
            </div>
			<div class="header_right">		
				<?php  templ_get_top_header_navigation(); ?>
			</div>
		</div> <!-- header #end -->
	</div>
   
    <!-- Container -->
    <div id="container" class="clear">
		