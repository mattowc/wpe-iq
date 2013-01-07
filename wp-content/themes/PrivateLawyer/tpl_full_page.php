<?php
/*
Template Name: Page - Full
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
	 	<div class="content content_full">
        	<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Page Content Above')){?><?php } else {?>  <?php }?>                 
            	<div class="entry">
                	<div <?php post_class('single clear'); ?> id="post_<?php the_ID(); ?>">
                    	<div class="post-content"><?php the_content(); ?></div>
                    </div>
                </div>
                <?php // comments_template(); ?>
                <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Page Content Below')){?> <?php } else {?>  <?php }?>
       </div> <!-- full page #end -->
       <?php endwhile; ?>
     <?php endif; ?>
 <?php get_footer(); ?>