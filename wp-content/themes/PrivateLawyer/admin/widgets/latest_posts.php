<?php
// ===============================  Latest Posts - widget ======================================
if(!class_exists('templ_latest_posts_with_images')){
	class templ_latest_posts_with_images extends WP_Widget {
	
		function templ_latest_posts_with_images() {
		//Constructor
		global $thumb_url;
			$widget_ops = array('classname' => 'widget special', 'description' => apply_filters('templ_latestpostwimg_widget_desc_filter','Post with image & date') );
			$this->WP_Widget('latest_posts_with_images',apply_filters('templ_latestpostwimg_widget_title_filter','T &rarr; Post with image & date'), $widget_ops);
		}
	 
		function widget($args, $instance) {
		// prints the widget
	
			extract($args, EXTR_SKIP);
	 
			echo $before_widget;
			$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
			$category = empty($instance['category']) ? '' : apply_filters('widget_category', $instance['category']);
			$number = empty($instance['number']) ? '5' : apply_filters('widget_number', $instance['number']);
			 ?>
			
		 <?php if($title){?> <h3 class="i_publication"><?php echo $title; ?> </h3> <?php }?>
					<ul class="latest_posts"> 
			 <?php 
					global $post;
					if($category)
					{
						$arg = "&category=$category";	
					}
					$today_special = get_posts('numberposts='.$number.$arg);
					foreach($today_special as $post) :
					setup_postdata($post);
					 ?>
			<?php $post_images = bdw_get_images($post->ID); ?>	
			<li>
         
        
         <?php 
            if(get_the_post_thumbnail( $post->ID)){?>
             <a  class="post_img"  href="<?php the_permalink(); ?>">
             <?php echo get_the_post_thumbnail( $post->ID, array(50,50),array('class'	=> "",));?>
             </a>
            <?php }elseif($post_images = bdw_get_images($post->ID)){ ?>
             <a  class="post_img" href="<?php the_permalink(); ?>">
             <img  src="<?php echo templ_thumbimage_filter($post_images[0],'&amp;w=50&amp;h=50&amp;zc=1&amp;q=80');?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"  /> </a>
            <?php
            }?>
					
            <h4> <a class="widget-title" href="<?php the_permalink(); ?>">
                  <?php the_title(); ?>
                  </a> <br />  <span class="post_author">by <?php the_author_posts_link(); ?> at <?php the_time(templ_get_date_format()) ?> <br /> <?php comments_popup_link(__('No Comments','templatic'), __('1 Comment','templatic'), __('% Comments','templatic'), '', __('Comments Closed','templatic')); ?> </span></h4> 
                  
                  <p> <?php echo bm_better_excerpt(175, ''); ?> <a href="<?php the_permalink(); ?>"> <?php _e('more...','templatic');?> </a></p> 
        </li>
	<?php endforeach; ?>
				</ul>
		
	<?php
			echo $after_widget;
		}
		function update($new_instance, $old_instance) {
		//save the widget
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['category'] = strip_tags($new_instance['category']);
			$instance['number'] = strip_tags($new_instance['number']);
			return $instance;
		}
	 
		function form($instance) {
		//widgetform in backend
			$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'category' => '', 'number' => '' ) );
			$title = strip_tags($instance['title']);
			$category = strip_tags($instance['category']);
			$number = strip_tags($instance['number']);
	?>
	<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','templatic');?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
	
	<p>
	  <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts:','templatic');?>
	  <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo attribute_escape($number); ?>" />
	  </label>
	</p>
	<p>
	  <label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Categories (<code>IDs</code> separated by commas):','templatic');?>
	  <input class="widefat" id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>" type="text" value="<?php echo attribute_escape($category); ?>" />
	  </label>
	</p>
	<?php
		}
	}
	register_widget('templ_latest_posts_with_images');
}
?>