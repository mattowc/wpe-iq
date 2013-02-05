<?php
// =============================== Slider 1 - Event Theme (particular category ) ======================================
if(!class_exists('templ_pika_choose_slider')){
	class templ_pika_choose_slider extends WP_Widget {
		function templ_pika_choose_slider() {
		//Constructor
			$widget_ops = array('classname' => 'widget pika_choose_slider', 'description' => apply_filters('templ_pikachoose_slider_widget_desc_filter','List of featured slider post in particular category or latest posts') );
			$this->WP_Widget('pika_choose_slider', apply_filters('templ_pikachoose_slider_widget_title_filter','T &rarr; Pika Choose Slider'), $widget_ops);
		}
	
		function widget($args, $instance) {
			extract($args, EXTR_SKIP);
			echo $before_widget;
			$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
			$category = empty($instance['category']) ? '' : apply_filters('widget_category', $instance['category']);
			$post_number = empty($instance['post_number']) ? '5' : apply_filters('widget_post_number', $instance['post_number']);
			$post_link = empty($instance['post_link']) ? '#' : apply_filters('widget_post_link', $instance['post_link']);
			$character_cout = empty($instance['character_cout']) ? '15' : apply_filters('widget_character_cout', $instance['character_cout']);
		?>
<script type="text/javascript" src="<?php echo TT_WIDGET_JS_FOLDER_URL; ?>jquery_slider1.js"></script>
<script language="javascript" type="text/javascript">
				 var $pk = jQuery;
				$pk(document).ready(
					function (){
						$pk("#pikame").PikaChoose();
				});
			</script>
			<div class="pikachoose">
		<?php if($title){?><span class="head"><?php echo $title; ?> </span><?php }?>
		<ul id="pikame" class="jcarousel-skin-pika">
		<?php 
            global $post;
            $latest_menus = apply_filters('templ_pikachoose_slider_widget_postsobj_filter',get_posts('numberposts='.$post_number.'postlink='.$post_link.'&category='.$category.''));
		   $pcount=0;
            foreach($latest_menus as $post) :
            setup_postdata($post);
            $pcount++;
        	?>
			<li> 
	 <?php
	$custom_design = apply_filters('templ_pikachoose_slider_widget_content_filter',templ_pikachoose_slider_fun($post));
	if(is_object($custom_design))
	{
	  	echo templ_pikachoose_class_fun($post);
	}else
	{
		echo $custom_design;	
	}
	?>
    </li>
	<?php endforeach; ?>
	</ul>
	</div>
	<?php
			echo $after_widget;
		}
	
		function update($new_instance, $old_instance) {
		//save the widget
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['category'] = strip_tags($new_instance['category']);
			$instance['post_number'] = strip_tags($new_instance['post_number']);
			$instance['post_link'] = strip_tags($new_instance['post_link']);
			$instance['character_cout'] = strip_tags($new_instance['character_cout']);
			return $instance;
	
		}
	
		function form($instance) {
		//widgetform in backend
			$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'category' => '', 'post_number' => '','character_cout' => '' ) );
			$title = strip_tags($instance['title']);
			$category = strip_tags($instance['category']);
			$post_number = strip_tags($instance['post_number']);
			$post_link = strip_tags($instance['post_link']);
			$character_cout = strip_tags($instance['character_cout']);
	
	?>
	<p>
	  <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','templatic')?>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" />
	  </label>
	</p>
	<p>
	  <label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Categories (<code>IDs</code> separated by commas):','templatic')?>
	  <input class="widefat" id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>" type="text" value="<?php echo attribute_escape($category); ?>" />
	  </label>
	</p>
	<p>
	  <label for="<?php echo $this->get_field_id('post_number'); ?>"><?php _e('Number of posts:','templatic')?>
	  <input class="widefat" id="<?php echo $this->get_field_id('post_number'); ?>" name="<?php echo $this->get_field_name('post_number'); ?>" type="text" value="<?php echo attribute_escape($post_number); ?>" />
	  </label>
	</p>
	<?php
		}
	}
	register_widget('templ_pika_choose_slider');
}


function templ_pikachoose_slider_fun($post)
{
	return $post;
}

function templ_pikachoose_class_fun($post)
{
	ob_start(); // don't remove this code
/////////////////////////////////////////////////////

	$post_images = bdw_get_images($post->ID,'large');
	if(get_the_post_thumbnail( $post->ID, array())){?>
	<a href="<?php the_permalink(); ?>">
	<?php echo get_the_post_thumbnail( $post->ID, array(930,950),array('class'	=> "",));?></a><?php
	}else if($post_images[0]){ global $thumb_url;
	 ?>
	 <a  href="<?php the_permalink(); ?>"><img src="<?php echo bloginfo('template_url'); ?>/thumb.php?src=<?php echo $post_images[0];?>&amp;w=955&amp;h=500&amp;zc=1&amp;q=80<?php echo $thumb_url;?>" alt="<?php echo get_the_title($post->ID); ?>" title="<?php echo get_the_title($post->ID); ?>"  /></a>
	<?php
	}?> 
	<span><?php echo get_the_title($post->ID); ?> </span>
<?php
	/////////////////////////////////////////////////////
	$return = ob_get_contents(); // don't remove this code
	ob_end_clean(); // don't remove this code
	return  $return;	
} 
?>
