<?php
/*
Template Name: Checkout - Full Width
*/
?>
<!DOCTYPE html >
<html>
<head>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" >
    <title><?php wp_title ( '|', true,'right' ); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
    <?php
    wp_enqueue_script('jquery');
    ?>
</head>
<body <?php body_class(); ?>>
<?php include_once(TT_TPL_ROOT_PATH.'header_tpl.php'); //header content area ?> 
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/fonts/jquery.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/fonts/cufon-yui.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/fonts/Humanst521_BT_400.font.js"></script>
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