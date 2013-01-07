<?php if ( have_posts() ) : ?>

    <div id="loop" class="<?php if ($_COOKIE['mode'] == 'grid') echo 'grid'; else echo 'list'; ?> clear">

    <?php while ( have_posts() ) : the_post(); ?>
 <?php 
 $post_images = bdw_get_images($post->ID,'large');?>
<?php $video = get_post_meta($post->ID, 'video', $single = true);	?>
<?php $fullimg = get_post_meta($post->ID, 'fullimg', $single = true);	?>

        <div <?php post_class('post clear'); ?> id="post_<?php the_ID(); ?>">           
            <h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
            <div class="post-meta"> 
				<small>				
				<?php if(get_option('ptthemes_listing_author')=='Yes' || get_option('ptthemes_listing_author')==''){?>  
				by <span class="post-author">
				<a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" title="Posts by <?php the_author(); ?>"><?php the_author(); ?></a>
				</span>
				<?php } ?>
									   
				 <?php if(get_option('ptthemes_listing_date')=='Yes' || get_option('ptthemes_listing_date')==''){?>                  
				 on <span class="post-date"><?php the_time(templ_get_date_format()) ?></span> 
				 <?php } ?>
				 
				 <?php if(get_option('ptthemes_listing_comment')=='Yes' || get_option('ptthemes_listing_comment')==''){?>  
				 <em>&bull; </em>
				 <?php comments_popup_link(__('No Comments'), __('1 Comment'), __('% Comments'), '', __('Comments Closed')); ?>
				 <?php } ?>
				  
				  
				  <?php if(get_option('ptthemes_listing_tags')=='Yes' || get_option('ptthemes_listing_tags')==''){?>
				  <em>&bull; </em>
				  <?php the_tags('<span class="post-tags">', ', ', '</span>'); ?>
				<?php } ?>				 
				 </small>
            </div>
            <div class="post-content">
					 <?php 
            if(get_the_post_thumbnail( $post->ID, array())){?>
             <a href="<?php the_permalink(); ?>">
             <?php echo get_the_post_thumbnail( $post->ID, array(150,150),array('class'	=> "alignleft",));?>
             </a>
            <?php }else if($post_images[0]){ global $thumb_url;             
                $thumb_url1 = $thumb_url;
            ?>
             <a  href="<?php the_permalink(); ?>">
             <img class="alignleft" src="<?php echo bloginfo('template_url'); ?>/thumb.php?src=<?php echo $post_images[0];?>&amp;w=150&amp;h=150&amp;zc=1&amp;q=80<?php echo $thumb_url1;?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"  /> </a>
            <?php
            } else { ?> <?php }?>
					<?php templ_get_listing_content()?>
			</div>
            
            <div class="post_bottom"> </div>
        </div>

    <?php endwhile; ?>

    </div>

<?php endif; ?>