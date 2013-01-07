<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('page_content_above')){?>
<?php } else {?>
<?php }?>
<?php if ( have_posts() ) : ?>
<?php while ( have_posts() ) : the_post(); ?>

<div class="entry">
  <div <?php post_class('single clear'); ?> id="post_<?php the_ID(); ?>">
     <div class="post-content">
      <?php the_content(); ?>
    </div>
   </div>
</div>
<?php endwhile; ?>
<?php endif; ?>
<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('page_content_below')){?>
<?php } else {?>
<?php }?>




