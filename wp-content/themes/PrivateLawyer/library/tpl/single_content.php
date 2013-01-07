<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('page_content_above')){?>
<?php } else {?>
<?php }?>
<?php if ( have_posts() ) : ?>
<?php while ( have_posts() ) : the_post(); ?>
 <div class="entry">
  <div <?php post_class('single clear'); ?> id="post_<?php the_ID(); ?>">
    <div class="post-meta"> 
					<small>
					<?php
					if($_SERVER['HTTP_REFERER'] == '' || !strstr($_SERVER['HTTP_REFERER'],$_SERVER['REQUEST_URI']))
					{
					$question_viewed_count = get_post_meta($post->ID,'post_viewed_count',true);
					update_post_meta($post->ID,'post_viewed_count',$question_viewed_count+1);
					}
					?>
					<?php if(get_option('ptthemes_details_author')=='Yes' || get_option('ptthemes_details_author')==''){?> <span>Posted by <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" title="Posts by <?php the_author(); ?>"><?php the_author(); ?></a>,</span>
					<?php } ?>
					  <?php if(get_option('ptthemes_details_date')=='Yes' || get_option('ptthemes_details_date')==''){?><span><?php the_time(templ_get_date_format()) ?></span> 
					<?php } ?>
					<?php if(get_option('ptthemes_details_category')=='Yes' || get_option('ptthemes_details_category')==''){?> <em>&bull; </em>
						<span><?php the_category(', '); ?></span>
					<?php } ?>
					<?php if(get_option('ptthemes_details_comment')=='Yes' || get_option('ptthemes_details_comment')==''){?>  
						<em>&bull; </em>
						<span><?php comments_popup_link(__('No Comments'), __('1 Comment'), __('% Comments'), '', __('Comments Closed')); ?></span>						
					<?php } ?>
						<em>&bull; </em>
						<span><?php _e('Views');?> : <?php echo user_post_visit_count($post->ID);?></span>
					</small>
				</div>
    <div class="post-content">
      <?php the_content(); ?>
    </div>
   <!-- twitter & facebook likethis option-->
	<?php templ_show_twitter_button();
		templ_show_facebook_button();
	?>  <!--#end -->
  </div>
  <div class="post-navigation clear">
    <?php
		$prev_post = get_adjacent_post(false, '', true);
		$next_post = get_adjacent_post(false, '', false); ?>
    <?php if ($prev_post) : $prev_post_url = get_permalink($prev_post->ID); $prev_post_title = $prev_post->post_title; ?>
    <a class="post-prev" href="<?php echo $prev_post_url; ?>"><em>Previous post</em><span><?php echo $prev_post_title; ?></span></a>
    <?php endif; ?>
    <?php if ($next_post) : $next_post_url = get_permalink($next_post->ID); $next_post_title = $next_post->post_title; ?>
    <a class="post-next" href="<?php echo $next_post_url; ?>"><em>Next post</em><span><?php echo $next_post_title; ?></span></a>
    <?php endif; ?>
  </div>
</div>
<?php endwhile; ?>
<?php endif; ?>
<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('single_page_post_below')){?>
<?php } else {?>
<?php }?>
<?php comments_template(); ?>
<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('page_content_below')){?>
<?php } else {?>
<?php }?>