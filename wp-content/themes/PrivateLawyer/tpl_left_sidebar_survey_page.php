<?php
/*
Template Name: Page - Survey Post Below Page
*/
?>
<?php
/*
Author: Jonathon McDonald
Company: One Web Centric
Date: 07/03/2012
Description: This is simply a basic template for content, that has a sidebar on the left
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
                   
       	<!-- sidebar #end -->
		 <!--Page 2 column - Right Sidebar #end  -->
		<div class="content right">
            <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Single Page Post Below')){?><?php } else {?>  <?php }?>
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
 
<?php get_footer(); ?>