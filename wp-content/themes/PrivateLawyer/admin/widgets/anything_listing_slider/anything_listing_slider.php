<?php
// =============================== Any thing list Slider - widget======================================
if(!class_exists('templ_anything_listing_slider')){
class templ_anything_listing_slider extends WP_Widget {

	function templ_anything_listing_slider() {
	//Constructor
	global $thumb_url;
		$widget_ops = array('classname' => 'widget anything_listing_slider', 'description' => apply_filters('templ_anythinglist_slider_widget_desc_filter','Any Thing Slider Listing Widget') );
		$this->WP_Widget('anything_listing_slider', apply_filters('templ_anythinglist_slider_widget_title_filter','T &rarr; Any Thing Slider Listing'), $widget_ops);
	}

	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		echo $before_widget;
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		$height = empty($instance['height']) ? '450' : apply_filters('widget_height', $instance['height']);
		$post_per_slide = empty($instance['post_per_slide']) ? '6' : apply_filters('widget_post_per_slide', $instance['post_per_slide']);
		$number_post = empty($instance['number_post']) ? '12' : apply_filters('widget_number_post', $instance['number_post']);
		$category = empty($instance['category']) ? '' : apply_filters('widget_category', $instance['category']);
		$autoplay = $instance['autoplay'];
		$speed = $instance['speed'];
		if($autoplay==''){$autoplay='false';}
		if($speed==''){$speed='3000';}
		if($autoplay=='false'){$speed='300000';}
?>
<script type="text/javascript" src="<?php echo TT_WIDGET_JS_FOLDER_URL; ?>jquery_slider2.js"></script>
<script src="<?php echo TT_WIDGET_JS_FOLDER_URL; ?>jquery_slider2plus.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
	var $anytsl = jQuery;
	function formatText(index, panel) {
	  return index + "";
	}
	$anytsl(function () {        
		$anytsl('.tslider2').anythingSlider({
			easing: "easeInOutExpo",        // Anything other than "linear" or "swing" requires the easing plugin
			autoPlay: <?php echo $autoplay;?>,                 // This turns off the entire FUNCTIONALY, not just if it starts running or not.
			delay: <?php echo $speed;?>,                    // How long between slide transitions in AutoPlay mode
			startStopped: false,            // If autoPlay is on, this can force it to start stopped
			animationTime: 600,             // How long the slide transition takes
			hashTags: true,                 // Should links change the hashtag in the URL?
			buildNavigation: true,          // If true, builds and list of anchor links to link to each slide
			pauseOnHover: true,             // If true, and autoPlay is enabled, the show will pause on hover
			startText: "Go",             // Start text
			stopText: "Stop",               // Stop text
			navigationFormatter: formatText       // Details at the top of the file on this use (advanced use)
		});
		$anytsl("#slide-jump").click(function(){
			$anytsl('.tslider2').anythingSlider(6);
		});
	});
</script>    
    
     <?php
	  global $post;
	  if($category)
	  {
			$subque = "&category=$category";  
	  }
	  $featureposts = apply_filters('templ_anythinglist_slider_widget_postsobj_filter',get_posts("numberposts=$number_post".$subque));
	 ?>
         <div class="slider_post" style="height:<?php echo $height;?>px !important;">
        <?php if($title){?><h3><?php echo $title;?> </h3><?php }?>
        <div class="tslider2">
                <div class="wrapper" style="height:<?php echo $height;?>px !important;">  
               <ul>
               <?php
               if($featureposts)
               {	
                   $post=$featureposts;
                   setup_postdata($post);
                   $counter=0;
                   $postperslide = $post_per_slide;
                   foreach($post as $featureposts_obj)
                   {								 
                     if($counter=='0' || $counter%$postperslide==0){ echo "<li>";}
                    $custom_design = apply_filters('templ_anythinglist_slider_widget_content_filter',templ_anythinglist_content_fun($featureposts_obj));
                    if(is_object($custom_design))
                    {
					  echo templ_anythinglist_class_fun($featureposts_obj);
                    }else
                    {
                        echo $custom_design;	
                    }
				   $counter++; 
				   if($counter%$postperslide==0){ echo "</li>";}
					   }
				   }
			   ?>
                        </ul></div>
                       </div>
                       </div>   
        <?php		
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['autoplay'] = strip_tags($new_instance['autoplay']);
		$instance['speed'] = strip_tags($new_instance['speed']);
		$instance['height'] = strip_tags($new_instance['height']);
		$instance['post_per_slide'] = strip_tags($new_instance['post_per_slide']);
		$instance['category'] = strip_tags($new_instance['category']);
		$instance['number_post'] = strip_tags($new_instance['number_post']);
 		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => 'Feature Products','speed'=>'3000','autoplay'=>'true', ) );
		$title = strip_tags($instance['title']);
		$height = strip_tags($instance['height']);
		$autoplay = strip_tags($instance['autoplay']);
		$speed = strip_tags($instance['speed']);
		$post_per_slide = strip_tags($instance['post_per_slide']);
		$category = strip_tags($instance['category']);
		$number_post = strip_tags($instance['number_post']);
?>
<p>
  <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','templatic')?>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Category ID (i.e:1,2,3) :','templatic')?>
    <input class="widefat" id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>" type="text" value="<?php echo attribute_escape($category); ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('post_per_slide'); ?>"><?php _e('Post Per Slide :','templatic')?>
    <input class="widefat" id="<?php echo $this->get_field_id('post_per_slide'); ?>" name="<?php echo $this->get_field_name('post_per_slide'); ?>" type="text" value="<?php echo attribute_escape($post_per_slide); ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('number_post'); ?>"><?php _e('Slider Number of Post display (i.e.12,8,4) :','templatic')?>
    <input class="widefat" id="<?php echo $this->get_field_id('number_post'); ?>" name="<?php echo $this->get_field_name('number_post'); ?>" type="text" value="<?php echo attribute_escape($number_post); ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('height'); ?>"><?php _e('Latest menu slider height <br /> (i.e.300) :','templatic')?>
    <input class="widefat" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" type="text" value="<?php echo attribute_escape($height); ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('autoplay'); ?>"><?php _e('Auto Play:','templatic')?>
    <select class="widefat" name="<?php echo $this->get_field_name('autoplay'); ?>" id="<?php echo $this->get_field_id('autoplay'); ?>">
    <option <?php if(attribute_escape($autoplay)=='true'){?> selected="selected"<?php }?> value="true"><?php _e('Yes','templatic')?></option>
    <option <?php if(attribute_escape($autoplay)=='false'){?> selected="selected"<?php }?> value="false"><?php _e('No','templatic')?></option>
    </select>
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('speed'); ?>"><?php _e('Sliding Speed:','templatic')?>
    <input class="widefat" id="<?php echo $this->get_field_id('speed'); ?>" name="<?php echo $this->get_field_name('speed'); ?>" type="text" value="<?php echo attribute_escape($speed); ?>" />
  </label>
</p>
<?php
	}
}
register_widget('templ_anything_listing_slider');
}

function templ_anythinglist_class_fun($post)
{
	ob_start(); // don't remove this code
/////////////////////////////////////////////////////
?>
	<div class="post_img">
    <div class="post_img_in">
    <div class="postimg">
    
     <?php 
            if(get_the_post_thumbnail( $post->ID)){?>
             <a href="<?php the_permalink(); ?>">
             <?php echo get_the_post_thumbnail( $post->ID, array(150,150),array('class'	=> "",));?>
             </a>
            <?php }elseif($post_images = bdw_get_images($post->ID)){ ?>
             <a  href="<?php the_permalink(); ?>">
             <img class="alignleft" src="<?php echo templ_thumbimage_filter($post_images[0],'&amp;w=150&amp;h=150&amp;zc=1&amp;q=80');?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"  /> </a>
            <?php
            } else{
			?>    <a href="<?php echo get_permalink($post->ID);?>">
	<span class="noimage"><?php  _e('Image Not Available','templatic')?></span></a>
    <?php }?>
    </div>
    <div class="postcontent">
    <h3><span class="title"><a href="<?php echo get_permalink ($post->ID);?>" title="<?php echo get_the_title($post->ID);?>" ><?php echo  get_the_title($post->ID);?></a></span></h3>
    <?php
    $text = $post->post_content;
    $text = strip_tags($text);
    $text = substr($text, 0, 100);
    $text = substr($text, 0, strrpos($text, " "));
    ?>
	<p><?php echo $text.$ellipsis;?></p>
   </div></div></div>
   <?php
   /////////////////////////////////////////////////////
	$return = ob_get_contents(); // don't remove this code
	ob_end_clean(); // don't remove this code
	return  $return;	
}
function templ_anythinglist_content_fun($post)
{
	return $post;	
}
?>