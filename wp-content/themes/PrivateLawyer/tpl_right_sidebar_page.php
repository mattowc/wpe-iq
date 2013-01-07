<?php
/*
Template Name: Page - Right Sidebar
*/
?>
<?php get_header(); ?>
 <?php if ( have_posts() ) : ?>
    	<?php while ( have_posts() ) : the_post(); ?>
        <div class="breadcrumb_box clearfix">
            <div class="content-title">
            	<h1><?php the_title(); ?></h1>
            </div>
            <?php templ_set_breadcrumbs_navigation();?>
       	</div>    
       	<div class="shadowbox"></div> 

	   <!-- Content  2 column - Right Sidebar  -->
               <div class="content left">
               	<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Page Content Above')){?><?php } else {?>  <?php }?>
                	<div class="entry">
                    	<div <?php post_class('single clear'); ?> id="post_<?php the_ID(); ?>">
                        	<div class="post-content"><?php the_content(); ?></div>
                        </div>
                     </div>                                    
                <?php // comments_template(); ?>                                
                <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Page Content Below')){?> <?php } else {?>  <?php }?>
             </div> <!-- /Content -->
             <?php endwhile; ?>
          <?php endif; ?>            
       	<div class="sidebar right" >
        	<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Inner Page Sidebar Right')){?> <?php } else {?>  <?php }?>
        </div>  <!-- sidebar #end -->
		 <!--Page 2 column - Right Sidebar #end  -->

 
<?php get_footer(); ?>