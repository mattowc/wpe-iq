<?php
// =============================== Slider 4 -  Banner Image only  Widget  (geoplaces)======================================
if(!class_exists('templ_nova_slider')){
class templ_nova_slider extends WP_Widget {
	function templ_nova_slider() {
	//Constructor
		$widget_ops = array('classname' => 'widget nova_slider', 'description' =>apply_filters('templ_nova_slider_widget_desc_filter','Nova Slider Widget') );		
		$this->WP_Widget('nova_slider', apply_filters('templ_nova_slider_widget_title_filter','T &rarr; Nova Slider'), $widget_ops);
	}
	function widget($args, $instance) {
	// prints the widget
		extract($args, EXTR_SKIP);
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		$s1 = empty($instance['s1']) ? '' : apply_filters('widget_s1', $instance['s1']);
		$s1link = empty($instance['s1link']) ? '' : apply_filters('widget_s1', $instance['s1link']);
		$s2 = empty($instance['s2']) ? '' : apply_filters('widget_s2', $instance['s2']);
		$s2link = empty($instance['s2link']) ? '' : apply_filters('widget_s2link', $instance['s2link']);
		$s3 = empty($instance['s3']) ? '' : apply_filters('widget_s3', $instance['s3']);
		$s3link = empty($instance['s3link']) ? '' : apply_filters('widget_s3link', $instance['s3link']);
		$s4 = empty($instance['s4']) ? '' : apply_filters('widget_s4', $instance['s4']);
		$s4link = empty($instance['s4link']) ? '' : apply_filters('widget_s4link', $instance['s4link']);
		$s5 = empty($instance['s5']) ? '' : apply_filters('widget_s5', $instance['s5']);
		$s5link = empty($instance['s5link']) ? '' : apply_filters('widget_s5link', $instance['s5link']);
		$s6 = empty($instance['s6']) ? '' : apply_filters('widget_s6', $instance['s6']);
		$s6link = empty($instance['s6link']) ? '' : apply_filters('widget_s6link', $instance['s6link']);
		$s7 = empty($instance['s7']) ? '' : apply_filters('widget_s7', $instance['s7']);
		$s7link = empty($instance['s7link']) ? '' : apply_filters('widget_s7link', $instance['s7link']);
		$s8 = empty($instance['s8']) ? '' : apply_filters('widget_s8', $instance['s8']);
		$s8link = empty($instance['s8link']) ? '' : apply_filters('widget_s8link', $instance['s8link']);
		$s9 = empty($instance['s9']) ? '' : apply_filters('widget_s9', $instance['s9']);
		$s9link = empty($instance['s9link']) ? '' : apply_filters('widget_s9link', $instance['s9link']);
		$s10 = empty($instance['s10']) ? '' : apply_filters('widget_s10', $instance['s10']);
		$s10link = empty($instance['s10link']) ? '' : apply_filters('widget_s10link', $instance['s10link']);
		
		$width = empty($instance['width']) ? '978' : apply_filters('widget_width', $instance['width']);
		$height = empty($instance['height']) ? '425' : apply_filters('widget_height', $instance['height']);
		
		$effect = empty($instance['effect']) ? 'random' : apply_filters('widget_effect', $instance['effect']);
		$slices = empty($instance['slices']) ? '15' : apply_filters('widget_slices', $instance['slices']);
	 	$animSpeed = empty($instance['animSpeed']) ? '700' : apply_filters('widget_animSpeed', $instance['animSpeed']);
		$pauseTime = empty($instance['pauseTime']) ? '3000' : apply_filters('widget_pauseTime', $instance['pauseTime']);
		$startSlide = empty($instance['startSlide']) ? '' : apply_filters('widget_startSlide', $instance['startSlide']);
		$directionNavHide = empty($instance['directionNavHide']) ? '' : apply_filters('widget_directionNavHide', $instance['directionNavHide']);
		$slider_img = empty($instance['slider_img']) ? 'Yes' : apply_filters('widget_slider_img', $instance['slider_img']);
		?>						

<script type="text/javascript" src="<?php echo TT_WIDGET_JS_FOLDER_URL; ?>jquery-1.4.2.js"></script> 
 <script type="text/javascript" src="<?php echo TT_WIDGET_JS_FOLDER_URL; ?>jquery_slider4.js"></script>

<script type="text/javascript" language="javascript">
 var $nivosl = jQuery;
$nivosl(window).load(function() {
	$nivosl('#tslider4').nivoSlider({
		effect:'<?php if (($effect) <> "" ) { echo (($effect)); } else { echo 'random'; } ?>', //Specify sets like: 'random,fold,fade,sliceDown'
		slices:<?php if (($slices) <> "" ) { echo (($slices)); } else { echo '15'; } ?>,
		animSpeed:<?php if (($animSpeed) <> "" ) { echo (($animSpeed)); } else { echo '700'; } ?>,
		pauseTime:<?php if (($pauseTime) <> "" ) { echo (($pauseTime)); } else { echo '3000'; } ?>,
		startSlide:0, //Set starting Slide (0 index)
		directionNav:true, //Next and Prev
		directionNavHide:true, //Only show on hover
		controlNav:true, //1,2,3...
		controlNavThumbs:false, //Use thumbnails for Control Nav
     	controlNavThumbsFromRel:false, //Use image rel for thumbs
		controlNavThumbsSearch: '.jpg', //Replace this with...
		controlNavThumbsReplace: '_thumb.jpg', //...this in thumb Image src
		keyboardNav:true, //Use left and right arrows
		pauseOnHover:true, //Stop animation while hovering
		manualAdvance:false, //Force manual transitions
		captionOpacity:0.8, //Universal caption opacity
		beforeChange: function(){},
		afterChange: function(){},
		slideshowEnd: function(){} //Triggers after all slides have been shown
	});
});
</script>


	                 
                 <style type="text/css">
					.nivoSlider a.nivo-imageLink { height:<?php echo $height; ?>px !important; }
					#tslider4 {height:<?php echo $height; ?>px;  width:<?php echo $width; ?>px; overflow:hidden; }
				</style>
           
             	<div  id="tslider4">
              
             	
               	<?php if ( $s1 <> "" ) { ?>	  
         			<a class="nivo-imageLink" href="<?php echo $s1link; ?>"><img src="<?php echo $s1; ?>"  alt="" width="<?php echo $width; ?>" height="<?php echo $height; ?>" /></a>
         		<?php } ?>
                
                <?php if ( $s2 <> "" ) { ?>	 
         			<a  class="nivo-imageLink" href="<?php echo $s2link; ?>"><img src="<?php echo $s2; ?>" alt="" width="<?php echo $width; ?>" height="<?php echo $height; ?>" /></a>
         		<?php } ?>
                
                <?php if ( $s3 <> "" ) { ?>	 
         			<a  class="nivo-imageLink" href="<?php echo $s3link; ?>"><img src="<?php echo $s3; ?>" alt="" width="<?php echo $width; ?>" height="<?php echo $height; ?>" /></a>
         		<?php } ?>
                
                <?php if ( $s4 <> "" ) { ?>	 
         			<a  class="nivo-imageLink" href="<?php echo $s4link; ?>"><img src="<?php echo $s4; ?>"  alt="" width="<?php echo $width; ?>" height="<?php echo $height; ?>" /></a>
         		<?php } ?>
                
                <?php if ( $s5 <> "" ) { ?>	 
         			<a  class="nivo-imageLink" href="<?php echo $s5link; ?>"><img src="<?php echo $s5; ?>" alt=""  width="<?php echo $width; ?>" height="<?php echo $height; ?>" /></a>
         		<?php } ?>
                
                <?php if ( $s6 <> "" ) { ?>	  
         			<a class="nivo-imageLink" href="<?php echo $s6link; ?>"><img src="<?php echo $s6; ?>" alt="" width="<?php echo $width; ?>" height="<?php echo $height; ?>" /></a>
         		<?php } ?>
                
                <?php if ( $s7 <> "" ) { ?>	 
         			<a class="nivo-imageLink" href="<?php echo $s7link; ?>"><img src="<?php echo $s7; ?>"  alt="" width="<?php echo $width; ?>" height="<?php echo $height; ?>" /></a>
         		<?php } ?>
                
                <?php if ( $s8 <> "" ) { ?>	 
         			<a class="nivo-imageLink" href="<?php echo $s8link; ?>"><img src="<?php echo $s8; ?>" alt=""  width="<?php echo $width; ?>" height="<?php echo $height; ?>" /></a>
         		<?php } ?>
                
                <?php if ( $s9 <> "" ) { ?>	 
         			<a style="display:block;" class="nivo-imageLink" href="<?php echo $s9link; ?>"><img src="<?php echo $s9; ?>" alt=""   width="<?php echo $width; ?>" height="<?php echo $height; ?>" /></a>
         		<?php } ?>
                
                <?php if ( $s10 <> "" ) { ?>	 
         			<a style="display:block;" class="nivo-imageLink" href="<?php echo $s10link; ?>"><img src="<?php echo $s10; ?>"  alt="" width="<?php echo $width; ?>" height="<?php echo $height; ?>" /></a>
         		<?php } ?>
                	
                </div>
            
            
        
            
	<?php
	}
	function update($new_instance, $old_instance) {
	//save the widget
		$instance = $old_instance;		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['s1'] = ($new_instance['s1']);
		$instance['s1link'] = ($new_instance['s1link']);
		$instance['s2'] = ($new_instance['s2']);
		$instance['s2link'] = ($new_instance['s2link']);
		$instance['s3'] = ($new_instance['s3']);
		$instance['s3link'] = ($new_instance['s3link']);
		$instance['s4'] = ($new_instance['s4']);
		$instance['s4link'] = ($new_instance['s4link']);
		$instance['s5'] = ($new_instance['s5']);
		$instance['s5link'] = ($new_instance['s5link']);
		$instance['s6'] = ($new_instance['s6']);
		$instance['s6link'] = ($new_instance['s6link']);
		$instance['s7'] = ($new_instance['s7']);
		$instance['s7link'] = ($new_instance['s7link']);
		$instance['s8'] = ($new_instance['s8']);
		$instance['s8link'] = ($new_instance['s8link']);
		$instance['s9'] = ($new_instance['s9']);
		$instance['s9link'] = ($new_instance['s9link']);
		$instance['s10'] = ($new_instance['s10']);
		$instance['s10link'] = ($new_instance['s10link']);
		
		$instance['width'] = ($new_instance['width']);
		$instance['height'] = ($new_instance['height']);
		$instance['effect'] = ($new_instance['effect']);
		$instance['slices'] = ($new_instance['slices']);
		$instance['animSpeed'] = ($new_instance['animSpeed']);
		$instance['pauseTime'] = ($new_instance['pauseTime']);
		$instance['startSlide'] = ($new_instance['startSlide']);
		$instance['directionNavHide'] = ($new_instance['directionNavHide']);
		$instance['slider_img'] = ($new_instance['slider_img']);
 		return $instance;
	}
	function form($instance) {
	//widgetform in backend
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'desc' => '','actionbtn' => '','actionlink' => '','s1' => '','s2' => '','s3' => '','s4' => '','s5' => '','s6' => '','s7' => '','s8' => '','s9' => '','s10' => '','s1link' => '','s2link' => '','s3link' => '','s4link' => '','s5link' => '','s6link' => '','s7link' => '','s8link' => '','s9link' => '','s10link' => '', 'effect' => '','slices' => '','animSpeed' => '','pauseTime' => '','startSlide' => '','directionNavHide' => '', 'slider_img' => '','width' => '','height' => '' ) );		
		$title = strip_tags($instance['title']);
		$width = ($instance['width']);
		$height = ($instance['height']);
 		$s1 = ($instance['s1']);
		$s1link = ($instance['s1link']);
		$s2 = ($instance['s2']);
		$s2link = ($instance['s2link']);
		$s3 = ($instance['s3']);
		$s3link = ($instance['s3link']);
		$s4 = ($instance['s4']);
		$s4link = ($instance['s4link']);
		$s5 = ($instance['s5']);
		$s5link = ($instance['s5link']);
		$s6 = ($instance['s6']);
		$s6link = ($instance['s6link']);
		$s7 = ($instance['s7']);
		$s7link = ($instance['s7link']);
		$s8 = ($instance['s8']);
		$s8link = ($instance['s8link']);
		$s9 = ($instance['s9']);
		$s9link = ($instance['s9link']);
		$s10 = ($instance['s9']);
		$s10link = ($instance['s10link']);
		
		$effect = ($instance['effect']);
		$slices = ($instance['slices']);
		$animSpeed = ($instance['animSpeed']);
		$pauseTime = ($instance['pauseTime']);
		$startSlide = ($instance['startSlide']);
		$directionNavHide = ($instance['directionNavHide']);
		$slider_img = ($instance['slider_img']);
		 ?>

<p><label for="<?php echo $this->get_field_id('slices'); ?>">Banner Images slices (slider images slice effect): 
<input type="text" class="widefat" id="<?php echo $this->get_field_id('slices'); ?>" name="<?php echo $this->get_field_name('slices'); ?>" value="<?php echo attribute_escape($slices); ?>"></label>
</p> 

<p><label for="<?php echo $this->get_field_id('animSpeed'); ?>">Banner Slider image in time : 
<input type="text" class="widefat" id="<?php echo $this->get_field_id('animSpeed'); ?>" name="<?php echo $this->get_field_name('animSpeed'); ?>" value="<?php echo attribute_escape($animSpeed); ?>"></label>
</p>

<p><label for="<?php echo $this->get_field_id('pauseTime'); ?>">Banner Slider image out time : 
<input type="text" class="widefat" id="<?php echo $this->get_field_id('pauseTime'); ?>" name="<?php echo $this->get_field_name('pauseTime'); ?>" value="<?php echo attribute_escape($pauseTime); ?>"></label>
</p>


<p><label for="<?php echo $this->get_field_id('width'); ?>">Banner image Width (maximum 940px) : 
<input type="text" class="widefat" id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" value="<?php echo attribute_escape($width); ?>"></label>
</p>

<p><label for="<?php echo $this->get_field_id('height'); ?>">Banner image Height (minimum 100px) : 
<input type="text" class="widefat" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" value="<?php echo attribute_escape($height); ?>"></label>
</p>

<p>
  <label for="<?php echo $this->get_field_id('effect'); ?>">Banner Effect:
  <select id="<?php echo $this->get_field_id('effect'); ?>" name="<?php echo $this->get_field_name('effect'); ?>" style="width:50%;">
  <option <?php if(attribute_escape($effect)=='random'){ echo 'selected="selected"';}?>>random</option>
  <option <?php if(attribute_escape($effect)=='fold'){ echo 'selected="selected"';}?>>fold</option>
  <option <?php if(attribute_escape($effect)=='fade'){ echo 'selected="selected"';}?>>fade</option>
  <option <?php if(attribute_escape($effect)=='sliceDown'){ echo 'selected="selected"';}?>>sliceDown</option>
  </select>
  </label>
</p>
 
<p><label for="<?php echo $this->get_field_id('s1'); ?>">Banner Slider Image 1 full URL (size : w940xh425 pixel) (ex.http://templatic.com/images/banner1.png)  : 
<input type="text" class="widefat" id="<?php echo $this->get_field_id('s1'); ?>" name="<?php echo $this->get_field_name('s1'); ?>" value="<?php echo attribute_escape($s1); ?>"></label>
</p> 
<p><label for="<?php echo $this->get_field_id('s1link'); ?>">Banner Slider Image 1 Link (ex.http://templatic.com)  : 
<input type="text" class="widefat" id="<?php echo $this->get_field_id('s1link'); ?>" name="<?php echo $this->get_field_name('s1link'); ?>" value="<?php echo attribute_escape($s1link); ?>"></label>
</p>
<p><label for="<?php echo $this->get_field_id('s2'); ?>">Banner Slider Image 2 full URL : 
<input type="text" class="widefat" id="<?php echo $this->get_field_id('s2'); ?>" name="<?php echo $this->get_field_name('s2'); ?>" value="<?php echo attribute_escape($s2); ?>"></label>
</p> 
<p><label for="<?php echo $this->get_field_id('s2link'); ?>">Banner Slider Image 2 Link :
<input type="text" class="widefat" id="<?php echo $this->get_field_id('s2link'); ?>" name="<?php echo $this->get_field_name('s2link'); ?>" value="<?php echo attribute_escape($s1link); ?>"></label>
</p>
<p><label for="<?php echo $this->get_field_id('s3'); ?>">Banner Slider Image 3 full URL 
<input type="text" class="widefat" id="<?php echo $this->get_field_id('s3'); ?>" name="<?php echo $this->get_field_name('s3'); ?>" value="<?php echo attribute_escape($s3); ?>"></label>
</p> 
<p><label for="<?php echo $this->get_field_id('s3link'); ?>">Banner Slider Image 3 Link 
<input type="text" class="widefat" id="<?php echo $this->get_field_id('s3link'); ?>" name="<?php echo $this->get_field_name('s3link'); ?>" value="<?php echo attribute_escape($s3link); ?>"></label>
</p>
<p><label for="<?php echo $this->get_field_id('s4'); ?>">Banner Slider Image 4 full URL 
<input type="text" class="widefat" id="<?php echo $this->get_field_id('s4'); ?>" name="<?php echo $this->get_field_name('s4'); ?>" value="<?php echo attribute_escape($s4); ?>"></label>
</p> 
<p><label for="<?php echo $this->get_field_id('s4link'); ?>">Banner Slider Image 4 Link 
<input type="text" class="widefat" id="<?php echo $this->get_field_id('s4link'); ?>" name="<?php echo $this->get_field_name('s4link'); ?>" value="<?php echo attribute_escape($s4link); ?>"></label>
</p>
<p><label for="<?php echo $this->get_field_id('s5'); ?>">Banner Slider Image 5 full URL 
<input type="text" class="widefat" id="<?php echo $this->get_field_id('s5'); ?>" name="<?php echo $this->get_field_name('s5'); ?>" value="<?php echo attribute_escape($s5); ?>"></label>
</p> 
<p><label for="<?php echo $this->get_field_id('s5link'); ?>">Banner Slider Image 5 Link 
<input type="text" class="widefat" id="<?php echo $this->get_field_id('s5link'); ?>" name="<?php echo $this->get_field_name('s5link'); ?>" value="<?php echo attribute_escape($s5link); ?>"></label>
</p>
<p><label for="<?php echo $this->get_field_id('s6'); ?>">Banner Slider Image 6 full URL 
<input type="text" class="widefat" id="<?php echo $this->get_field_id('s6'); ?>" name="<?php echo $this->get_field_name('s6'); ?>" value="<?php echo attribute_escape($s6); ?>"></label>
</p> 
<p><label for="<?php echo $this->get_field_id('s6link'); ?>">Banner Slider Image 6 Link 
<input type="text" class="widefat" id="<?php echo $this->get_field_id('s6link'); ?>" name="<?php echo $this->get_field_name('s6link'); ?>" value="<?php echo attribute_escape($s6link); ?>"></label>
</p>
<p><label for="<?php echo $this->get_field_id('s7'); ?>">Banner Slider Image 7 full URL 
<input type="text" class="widefat" id="<?php echo $this->get_field_id('s7'); ?>" name="<?php echo $this->get_field_name('s7'); ?>" value="<?php echo attribute_escape($s7); ?>"></label>
</p> 
<p><label for="<?php echo $this->get_field_id('s7link'); ?>">Banner Slider Image 7 Link 
<input type="text" class="widefat" id="<?php echo $this->get_field_id('s7link'); ?>" name="<?php echo $this->get_field_name('s7link'); ?>" value="<?php echo attribute_escape($s7link); ?>"></label>
</p>
<p><label for="<?php echo $this->get_field_id('s8'); ?>">Banner Slider Image 8 full URL 
<input type="text" class="widefat" id="<?php echo $this->get_field_id('s8'); ?>" name="<?php echo $this->get_field_name('s8'); ?>" value="<?php echo attribute_escape($s8); ?>"></label>
</p> 
<p><label for="<?php echo $this->get_field_id('s8link'); ?>">Banner Slider Image 8 Link 
<input type="text" class="widefat" id="<?php echo $this->get_field_id('s8link'); ?>" name="<?php echo $this->get_field_name('s8link'); ?>" value="<?php echo attribute_escape($s8link); ?>"></label>
</p>
<p><label for="<?php echo $this->get_field_id('s9'); ?>">Banner Slider Image 9 full URL 
<input type="text" class="widefat" id="<?php echo $this->get_field_id('s9'); ?>" name="<?php echo $this->get_field_name('s9'); ?>" value="<?php echo attribute_escape($s9); ?>"></label>
</p> 
<p><label for="<?php echo $this->get_field_id('s9link'); ?>">Banner Slider Image 9 Link 
<input type="text" class="widefat" id="<?php echo $this->get_field_id('s9link'); ?>" name="<?php echo $this->get_field_name('s9link'); ?>" value="<?php echo attribute_escape($s9link); ?>"></label>
</p>
<p><label for="<?php echo $this->get_field_id('s10'); ?>">Banner Slider Image 10 full URL 
<input type="text" class="widefat" id="<?php echo $this->get_field_id('s10'); ?>" name="<?php echo $this->get_field_name('s10'); ?>" value="<?php echo attribute_escape($s10); ?>"></label>
</p> 
<p><label for="<?php echo $this->get_field_id('s10link'); ?>">Banner Slider Image 10 Link 
<input type="text" class="widefat" id="<?php echo $this->get_field_id('s10link'); ?>" name="<?php echo $this->get_field_name('s10link'); ?>" value="<?php echo attribute_escape($s10link); ?>"></label>
</p>
<?php
	}}
register_widget('templ_nova_slider');
}
?>