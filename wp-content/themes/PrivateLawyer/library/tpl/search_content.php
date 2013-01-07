<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('page_content_above')){?>
<?php } else {?>
<?php }?>
<?php if ( have_posts() ) : ?>
<?php get_template_part('loop'); ?>
<?php else : ?>
<div class="content-title">
  <?php ob_start(); // don't remove this code?>
  <?php __('Search Result for ','templatic');?>
  <?php the_search_query(); ?>
  <?php
        $page_title = ob_get_contents(); // don't remove this code
		ob_end_clean(); // don't remove this code
		?>
  <?php echo templ_page_title_filter($page_title); //page tilte filter?>
   </div>
<div class="entry">
  <div class="single clear">
    <div class="post-content">
       		<?php include_once('searchform.php'); // search form ?> 
     </div>
  </div>
</div>
<?php endif; ?>
<?php get_template_part('pagination'); ?>
<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('page_content_below')){?>
<?php } else {?>
<?php }?>
