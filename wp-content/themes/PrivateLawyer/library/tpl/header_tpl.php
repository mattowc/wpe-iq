<?php  templ_get_top_header_navigation_above() ?> 
<?php  //templ_get_top_header_navigation() ?> 
<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('header_above')){?>
<?php } else {?>  <?php }?>
<div style="display: block; width: 100%; height:32px;" id="info-header">
    <div style="display: inline-block; width: 978px; margin: 0 auto;" id="info-container">
        <div style="float: right; margin-right: 45px; color: #6b6b6b; font-size: 18px;">
            Call toll free or something?
        </div>
    </div>
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
		