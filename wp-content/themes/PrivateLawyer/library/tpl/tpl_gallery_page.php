<?php if (function_exists('dynamic_sidebar')){ dynamic_sidebar('page_content_above'); }?>
<?php if ( have_posts() ) : ?>
<?php while ( have_posts() ) : the_post(); ?>
<?php
$post_large = bdw_get_images(get_the_ID(),'large');
$post_images = bdw_get_images(get_the_ID(),'thumb'); 
?>

<div class="entry">
  <div <?php post_class('single clear'); ?> id="post_<?php the_ID(); ?>">
    <div class="post-content">
      <?php the_content(); ?>
      <ul class="gallery">
        <?php
			if(count($post_images))
			{
				for($im=0;$im<count($post_images);$im++)
				{
					if($post_images[$im]){
				?>
				<li> <a  href="<?php echo $post_large[$im];?>" rel="example_group"  > <img class="alignleft" src="<?php echo $post_images[$im];?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" style="height:125px;"  /> </a> </li>
				<?php	
				}
				}
			}
			?>
      </ul>
    </div>
  </div>
</div>
<?php endwhile; ?>
<?php endif; ?>
<?php if (function_exists('dynamic_sidebar')){ dynamic_sidebar('page_content_below'); }?>