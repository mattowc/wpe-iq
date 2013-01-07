<?php get_header(); // git testing ?>
	<!-- BOF Slider -->		
	 <?php templ_home_page_slider(); //home header slider ?>    
	
	<!-- Content  2 column - left Sidebar  -->
    <div class="content right">
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Index Content Above')){?><?php } else {?>  <?php }?>
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Front Page Content')){?><?php } else {?>  <?php }?>
        <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Index Content Below')){?><?php } else {?>  <?php }?>
	</div> <!-- /Content -->
	<div class="sidebar left" >
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Index Page Sidebar Left')){?> <?php } else {?>  <?php }?>
	</div>  <!-- sidebar #end --> 
<?php get_footer(); ?>