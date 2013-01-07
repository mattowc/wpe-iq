<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('page_content_above')){ }?>

 <div class="entry">
  <div <?php post_class('single clear'); ?> id="post_<?php the_ID(); ?>">
    <div class="post-content">
      <p>
        <?php _e("The page you've requested can not be displayed. It appears you've missed your intended destination, either through a bad or outdated link, or a typo in the page you were hoping to reach.",'templatic');?>
      </p>
    </div>
  </div>
</div>
<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('page_content_below')){  }?>
