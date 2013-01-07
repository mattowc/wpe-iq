<?php	include("shortcodes.php");
// Excerpt length
function bm_better_excerpt($length, $ellipsis) {
$text = get_the_content();
$text = strip_tags($text);
$text = substr($text, 0, $length);
$text = substr($text, 0, strrpos($text, " "));
$text = $text.$ellipsis;
return $text;
}


// Register widgetized areas
if ( function_exists('register_sidebar') ) {
	
    //register_sidebars(1,array('name' => 'Front Page Content','before_widget' => '','after_widget' => '','before_title' => '<h3><span>','after_title' => '</span></h3>'));

 }
	
// Check for widgets in widget-ready areas http://wordpress.org/support/topic/190184?replies=7#post-808787
// Thanks to Chaos Kaizer http://blog.kaizeku.com/
function is_sidebar_active( $index = 1){
	$sidebars	= wp_get_sidebars_widgets();
	$key		= (string) 'sidebar-'.$index;
 
	return (isset($sidebars[$key]));
}

 ///////////NEW FUNCTIONS  START//////
function bdw_get_images($iPostID,$img_size='thumb',$no_images='') 
{
    $arrImages =& get_children('order=ASC&orderby=menu_order ID&post_type=attachment&post_mime_type=image&post_parent=' . $iPostID );
	$counter = 0;
	$return_arr = array();
	if($arrImages) 
	{		
       foreach($arrImages as $key=>$val)
	   {
	   		$id = $val->ID;
			if($img_size == 'large')
			{
				$img_arr = wp_get_attachment_image_src($id,'full');	// THE FULL SIZE IMAGE INSTEAD
				$return_arr[] = $img_arr[0];
			}
			elseif($img_size == 'medium')
			{
				$img_arr = wp_get_attachment_image_src($id, 'medium'); //THE medium SIZE IMAGE INSTEAD
				$return_arr[] = $img_arr[0];
			}
			elseif($img_size == 'thumb')
			{
				$img_arr = wp_get_attachment_image_src($id, 'thumbnail'); // Get the thumbnail url for the attachment
				$return_arr[] = $img_arr[0];
			}
			$counter++;
			if($no_images!='' && $counter==$no_images)
			{
				break;	
			}
	   }
	  return $return_arr;
	}
}

function get_site_emailId()
{
	$generalinfo = get_option('mysite_general_settings');
	if($generalinfo['site_email'])
	{
		return $generalinfo['site_email'];
	}else
	{
		return get_option('admin_email');
	}
}
function get_site_emailName()
{
	$generalinfo = get_option('mysite_general_settings');
	if($generalinfo['site_email_name'])
	{
		return stripslashes($generalinfo['site_email_name']);
	}else
	{
		return stripslashes(get_option('blogname'));
	}
}

// filters add -------------///

add_filter('templ_top_header_nav_below_filter','templ_top_header_nav_below_fun');
function templ_top_header_nav_below_fun()
{
?>
<?php
}


add_filter('wp_head','templ_print_css');
function templ_print_css()
{
?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/library/tpl/print.css" media="print" />
 <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/dhtmlgoodies_calendar.css" />

<style type="text/css">.tabber{display:none;}</style>
 
<?php
}



// /////////////// 
/*
Plugin Name: WP-PageNavi 
Plugin URI: http://www.lesterchan.net/portfolio/programming.php 
*/ 

function wp_pagenavi($before = '', $after = '', $prelabel = '', $nxtlabel = '', $pages_to_show = 5, $always_show = false) {

	global $request, $posts_per_page, $wpdb, $paged;
	if(empty($prelabel)) {
		$prelabel  = '<strong>&laquo;</strong>';
	}
	if(empty($nxtlabel)) {
		$nxtlabel = '<strong>&raquo;</strong>';
	}
	$half_pages_to_show = round($pages_to_show/2);
	if (!is_single()) {
		if(is_tag()) {
			preg_match('#FROM\s(.*)\sGROUP BY#siU', $request, $matches);		
		} elseif (!is_category()) {
			preg_match('#FROM\s(.*)\sORDER BY#siU', $request, $matches);	
		} else {
			preg_match('#FROM\s(.*)\sGROUP BY#siU', $request, $matches);		
		}
		$fromwhere = $matches[1];
		$numposts = $wpdb->get_var("SELECT COUNT(DISTINCT ID) FROM $fromwhere");
		$max_page = ceil($numposts /$posts_per_page);
		if(empty($paged)) {
			$paged = 1;
		}
		if($max_page > 1 || $always_show) {
			echo "$before <div class='Navi'>";
			if ($paged >= ($pages_to_show-1)) {
				echo '<a href="'.str_replace('&paged','&amp;paged',get_pagenum_link()).'">&laquo;</a>';
			}
			previous_posts_link($prelabel);
			for($i = $paged - $half_pages_to_show; $i  <= $paged + $half_pages_to_show; $i++) {
				if ($i >= 1 && $i <= $max_page) {
					if($i == $paged) {
						echo "<strong class='on'>$i</strong>";
					} else {
						echo ' <a href="'.str_replace('&paged','&amp;paged',get_pagenum_link($i)).'">'.$i.'</a> ';
					}
				}
			}
			next_posts_link($nxtlabel, $max_page);
			if (($paged+$half_pages_to_show) < ($max_page)) {
				echo '<a href="'.str_replace('&paged','&amp;paged',get_pagenum_link($max_page)).'">&raquo;</a>';
			}
			echo "</div> $after";
		}
	}
}



// =============================== Any thing Slider  - Widget  ======================================
if(!class_exists('templ_anything_slider')){
class templ_anything_slider extends WP_Widget {
	function templ_anything_slider() {
		$widget_ops = array('classname' => 'widget anything_slider','description' =>  apply_filters('templ_anything_slider_widget_desc_filter','Any thing Slider Widget'));
		$this->WP_Widget('anything_slider', apply_filters('templ_anything_slider_widget_title_filter','T &rarr; Any thing Slider'), $widget_ops);
	}
 
	function widget($args, $instance) {
	// prints the widget

		extract($args, EXTR_SKIP);
 
		echo $before_widget;
		$title = empty($instance['title']) ? '&nbsp;' : apply_filters('widget_title', $instance['title']);
		$category = empty($instance['category']) ? '&nbsp;' : apply_filters('widget_category', $instance['category']);
		$delay = empty($instance['delay']) ? '3000' : apply_filters('widget_delay', $instance['delay']);
		$animationTime = empty($instance['animationTime']) ? '600' : apply_filters('widget_animationTime', $instance['animationTime']);
		$height = empty($instance['height']) ? '390' : apply_filters('widget_height', $instance['height']);
		$wcount = empty($instance['wcount']) ? '340' : apply_filters('widget_wcount', $instance['wcount']);
		$readmore = empty($instance['readmore']) ? 'Read More' : apply_filters('widget_readmore', $instance['readmore']);
 		 ?>
 
 <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery-1.8.3.min.js"></script>
		<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.easing.1.3.js"></script>
		<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.coda-slider-2.0.js"></script>
		 <script type="text/javascript">
			$().ready(function() {
				$('#coda-slider-1').codaSlider();
			});
		 </script>
         
         
            <style type="text/css"> .coda-slider { height:<?php echo $height; ?>px !important; }</style>
         <div class="coda-slider-wrapper clearfix">
	<div class="coda-slider preload" id="coda-slider-1" >
         
         <?php global $post;
		$today_special = get_posts('numberposts='.$title.'&category='.$category.'');
		foreach($today_special as $post) :
		setup_postdata($post);
		 ?>
      
	
    
	
		  <?php $post_images = bdw_get_images($post->ID,'large');?>
           <?php $video = get_post_meta($post->ID, 'video', $single = true);	?>
         <?php $fullimg = get_post_meta($post->ID, 'fullimg', $single = true);	?>
    
    	<div class="panel">
			<div class="panel-wrapper">
            
                 <?php if($fullimg != '') { ?> 
                 <div class="full_img">
                 <h2 class="title"><a class="widget-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                  
                  <img src="<?php echo bloginfo('template_url'); ?>/thumb.php?src=<?php echo $fullimg; ?>&amp;w=978&amp;h=400&amp;zc=1&amp;q=80<?php echo $thumb_url;?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"  />
                 
                 </div>
             <?php 
			 } else { 
	 if($video !='') { ?>
     	<div class="video_space"><?php echo $video; ?> </div>
	 <?php } else {
	if(get_the_post_thumbnail( $post	->ID, array())){?>
	<a class="post_img" href="/contact-us/schedule-a-free-consultation/">
	<?php echo get_the_post_thumbnail( $post->ID, array(415,236),array('class'	=> "",));?></a><?php
	}else if($post_images[0]){ global $thumb_url;
	?>
	 <a class="post_img" href="<?php the_permalink(); ?>"><img src="<?php echo bloginfo('template_url'); ?>/thumb.php?src=<?php echo $post_images[0];?>&amp;w=415&amp;h=236&amp;zc=1&amp;q=80<?php echo $thumb_url;?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"  /></a>
	<?php
	} else {?> 
 	<?php } } ?>   
    
				<h2 class="title"><a class="widget-title" href="/contact-us/schedule-a-free-consultation/"><?php the_title(); ?></a></h2>
                  <p><?php echo bm_better_excerpt($wcount, ''); ?> </p>
                
               
                
                <?php if($readmore){?>  <p class="clearfix"><a href="/contact-us/schedule-a-free-consultation/" class="more"><?php echo $readmore; ?></a></p> <?php }?>
                
  		<?php }?>
 			</div>
		</div>
        
        <?php endforeach; ?>
		 
		 
		 
	</div><!-- .coda-slider -->
</div>
           
<?php
		echo $after_widget;
		
	}
 
	function update($new_instance, $old_instance) {
	//save the widget
	
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['category'] = strip_tags($new_instance['category']);
		$instance['delay'] = strip_tags($new_instance['delay']);
		$instance['animationTime'] = strip_tags($new_instance['animationTime']);
		$instance['height'] = strip_tags($new_instance['height']);
		$instance['wcount'] = strip_tags($new_instance['wcount']);
		$instance['readmore'] = strip_tags($new_instance['readmore']);
		return $instance;
	}
 
	function form($instance) {
	//widgetform in backend

		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'category' => '', 'post_number' => '','delay' => '','animationTime' => '','height' => '' ) );
		$title = strip_tags($instance['title']);
		$category = strip_tags($instance['category']);
		$delay = strip_tags($instance['delay']);
		$animationTime = strip_tags($instance['animationTime']);
		$height = strip_tags($instance['height']);
		$wcount = strip_tags($instance['wcount']);
		$readmore = strip_tags($instance['readmore']);
?>
<p>
  <label for="<?php echo $this->get_field_id('title'); ?>">Number of posts:
  <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('category'); ?>">Categories (<code>IDs</code> separated by commas):
  <input class="widefat" id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>" type="text" value="<?php echo attribute_escape($category); ?>" />
  </label>
</p>

<p>
  <label for="<?php echo $this->get_field_id('height'); ?>">Slider Height :
  <input class="widefat" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" type="text" value="<?php echo attribute_escape($height); ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('wcount'); ?>">Slider excerpt content count :
  <input class="widefat" id="<?php echo $this->get_field_id('wcount'); ?>" name="<?php echo $this->get_field_name('wcount'); ?>" type="text" value="<?php echo attribute_escape($wcount); ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('readmore'); ?>">Read More Button Text :
  <input class="widefat" id="<?php echo $this->get_field_id('readmore'); ?>" name="<?php echo $this->get_field_name('readmore'); ?>" type="text" value="<?php echo attribute_escape($readmore); ?>" />
  </label>
</p>
<?php
	}
}
register_widget('templ_anything_slider'); }









// /////////////////////////////////////////////////////////
class templ_headlines_news extends WP_Widget {
	
		function templ_headlines_news() {
		//Constructor
		global $thumb_url;
			$widget_ops = array('classname' => 'widget Headlines & News', 'description' => __('Headlines & News') );
			$this->WP_Widget('headlines_news', __('T &rarr; Tab - Headlines & News'), $widget_ops);
		}
	 
		function widget($args, $instance) {
		// prints the widget
	
			extract($args, EXTR_SKIP);
	 
			echo $before_widget;
			$title = empty($instance['title']) ? 'Headlines' : apply_filters('widget_title', $instance['title']);
			$title2 = empty($instance['title2']) ? 'News' : apply_filters('widget_title2', $instance['title2']);
			$category = empty($instance['category']) ? '' : apply_filters('widget_category', $instance['category']);
			$category2 = empty($instance['category2']) ? '' : apply_filters('widget_category', $instance['category2']);
			$number = empty($instance['number']) ? '5' : apply_filters('widget_number', $instance['number']);
			$number2 = empty($instance['number2']) ? '5' : apply_filters('widget_number', $instance['number2']);
			 ?>
			
		<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/tabber.js"></script>              
          <div class="widget">
         	<div class="tabber">
             <div class="tabbertab">
              <?php if($title){?> <h2><?php echo $title; ?></h2> <?php }?>
             	<ul class="blog_listing">
                <?php 
					global $post;
					if($category!="")
					$today_special = get_posts('numberposts='.$number.'&category='.$category.'');
					else
					$today_special = get_posts('numberposts='.$number.'');
					foreach($today_special as $post) :
					setup_postdata($post);
					 ?>	
            		 <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a> <br />
					 <small>										   
						 <?php if(get_option('ptthemes_listing_date')=='Yes' || get_option('ptthemes_listing_date')==''){?>                  
						 <?php _e('Posted on','templatic');?> <span class="post-date"><?php the_time(templ_get_date_format()) ?></span> 
						 <?php } ?>					 
						 <?php if(get_option('ptthemes_listing_comment')=='Yes' || get_option('ptthemes_listing_comment')==''){?>  						  
						<span class="single_comments"> // <?php comments_popup_link(__('No Comments','templatic'), __('1 Comment ','templatic'), __('% Comments ','templatic'), '', __('Comments Closed ','templatic')); ?> </span>
             <?php } ?></small>					 
					 </li>
				<?php endforeach; ?>
                 </ul>
             </div>
             <div class="tabbertab">
               <?php if($title2){?> <h2><?php echo $title2; ?></h2> <?php }?>
				<ul class="blog_listing">
                 	<?php 
					global $post;
					if($category2!="")
					$today_special = get_posts('numberposts='.$number2.'&category='.$category2.'');
					else
					$today_special = get_posts('numberposts='.$number2.'');
					foreach($today_special as $post) :
					setup_postdata($post);
					 ?>	
            		 <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a> <br />
					 <small>										   
						 <?php if(get_option('ptthemes_listing_date')=='Yes' || get_option('ptthemes_listing_date')==''){?>                  
						 <?php _e('Posted on','templatic');?> <span class="post-date"><?php the_time(templ_get_date_format()) ?></span> 
						 <?php } ?>					 
						 <?php if(get_option('ptthemes_listing_comment')=='Yes' || get_option('ptthemes_listing_comment')==''){?>  						  
						<span class="single_comments"> // <?php comments_popup_link(__('No Comments','templatic'), __('1 Comment','templatic'), __('% Comments','templatic'), '', __('Comments Closed','templatic')); ?> </span>
             <?php } ?></small>					 
					 </li>
				<?php endforeach; ?>
                 </ul>
             </div>       
        </div>
	</div>  
         
         
		
	
	<?php
			echo $after_widget;
			
		}
	 
		function update($new_instance, $old_instance) {
		//save the widget
		
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['title2'] = strip_tags($new_instance['title2']);
			$instance['category'] = strip_tags($new_instance['category']);
			$instance['category2'] = strip_tags($new_instance['category2']);
			$instance['number'] = strip_tags($new_instance['number']);
			$instance['number2'] = strip_tags($new_instance['number2']);
			return $instance;
		}
	 
		function form($instance) {
		//widgetform in backend
	
			$instance = wp_parse_args( (array) $instance, array( 'title' => 'Headlines', 'title2' => 'News','number' => '5', 'number2' => '5' ) );
			$title = strip_tags($instance['title']);
			$category = strip_tags($instance['category']);
			$number = strip_tags($instance['number']);
			$title2 = strip_tags($instance['title2']);
			$category2 = strip_tags($instance['category2']);
			$number2 = strip_tags($instance['number2']);
			
	?>
	<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title 1:');?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
	
	<p>
	  <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Headlines Number of posts:');?>
	  <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo attribute_escape($number); ?>" />
	  </label>
	</p>
	<p>
	  <label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Headlines Categories (<code>IDs</code> separated by commas):');?>
	  <input class="widefat" id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>" type="text" value="<?php echo attribute_escape($category); ?>" />
	  </label>
	</p>
    <p><label for="<?php echo $this->get_field_id('title2'); ?>"><?php _e('Title 2:');?> <input class="widefat" id="<?php echo $this->get_field_id('title2'); ?>" name="<?php echo $this->get_field_name('title2'); ?>" type="text" value="<?php echo attribute_escape($title2); ?>" /></label></p>
	
	<p>
	  <label for="<?php echo $this->get_field_id('number2'); ?>"><?php _e('News number of posts:');?>
	  <input class="widefat" id="<?php echo $this->get_field_id('number2'); ?>" name="<?php echo $this->get_field_name('number2'); ?>" type="text" value="<?php echo attribute_escape($number2); ?>" />
	  </label>
	</p>
	<p>
	  <label for="<?php echo $this->get_field_id('category2'); ?>"><?php _e('Headlines Categories (<code>IDs</code> separated by commas):');?>
	  <input class="widefat" id="<?php echo $this->get_field_id('category2'); ?>" name="<?php echo $this->get_field_name('category2'); ?>" type="text" value="<?php echo attribute_escape($category2); ?>" />
	  </label>
	</p>
	<?php
		}
	}
register_widget('templ_headlines_news');





// Get Number of visits of post
function user_post_visit_count($pid)
{
	if(get_post_meta($pid,'post_viewed_count',true))
	{
		return get_post_meta($pid,'post_viewed_count',true);
	}else
	{
		return '0';	
	}
}
function templ_listing_pagination_form()
{
	if(apply_filters('templ_listing_pagination_filter',true))
	{
		global $paged;
		if($_REQUEST['per_pg']=='')
		{
			$_REQUEST['per_pg'] = $paged;	
		}
	?>
    <div class="per-page">
    <form method="get"  name="post_per_page_frm" id="post_per_page_frm" action="<?php echo templ_current_url();?>" >
    <div>
    <?php _e('Per Page :');?>
        <?php foreach($_REQUEST as $key=>$val){?>
		<input type="hidden" name="<?php echo $key;?>" value="<?php echo $val;?>" />	
		<?php }?>
        <select name="per_pg"  onchange="document.post_per_page_frm.submit()">
        <option <?php if($_REQUEST['per_pg']=='10'){echo 'selected="selected"';}?> >10</option> 
        <option <?php if($_REQUEST['per_pg']=='20'){echo 'selected="selected"';}?>>20</option> 
        <option <?php if($_REQUEST['per_pg']=='30'){echo 'selected="selected"';}?>>30</option> 
        <option <?php if($_REQUEST['per_pg']=='40'){echo 'selected="selected"';}?>>40</option> 
        <option <?php if($_REQUEST['per_pg']=='50'){echo 'selected="selected"';}?>>50</option> 
        <option <?php if($_REQUEST['per_pg']=='100'){echo 'selected="selected"';}?>>100</option> 
        </select>
        </div>
    </form></div>
    <?php
	}
}

function templ_current_url()
{
	global $paged;
	return  get_pagenum_link($paged);
}
add_filter('get_pagenum_link','get_pagenum_link_filter');

function get_pagenum_link_filter($link)
{
	return $link;
}

// /////////////////////////////////////////////////////////
class templ_services_listing extends WP_Widget {
	
		function templ_services_listing() {
		//Constructor
		global $thumb_url;
			$widget_ops = array('classname' => 'widget services list', 'description' => __('Services Listing') );
			$this->WP_Widget('services_listing', __('T &rarr; Services list'), $widget_ops);
		}
	 
		function widget($args, $instance) {
		// prints the widget
	
			extract($args, EXTR_SKIP);
	 
			echo $before_widget;
			$title1 = empty($instance['title1']) ? '' : apply_filters('widget_title', $instance['title1']);
			$image1 = empty($instance['image1']) ? '' : apply_filters('widget_image', $instance['image1']);
			$desc1 = empty($instance['desc1']) ? '' : apply_filters('widget_desc', $instance['desc1']);
			$link1 = empty($instance['link1']) ? '' : apply_filters('widget_link', $instance['link1']);
			
			$title2 = empty($instance['title2']) ? '' : apply_filters('widget_title', $instance['title2']);
			$image2 = empty($instance['image2']) ? '' : apply_filters('widget_image', $instance['image2']);
			$desc2 = empty($instance['desc2']) ? '' : apply_filters('widget_desc', $instance['desc2']);
			$link2= empty($instance['link2']) ? '' : apply_filters('widget_link', $instance['link2']);
			
			$title3 = empty($instance['title3']) ? '' : apply_filters('widget_title', $instance['title3']);
			$image3 = empty($instance['image3']) ? '' : apply_filters('widget_image', $instance['image3']);
			$desc3 = empty($instance['desc3']) ? '' : apply_filters('widget_desc', $instance['desc3']);
			$link3 = empty($instance['link3']) ? '' : apply_filters('widget_link', $instance['link3']);
			
			$title4 = empty($instance['title4']) ? '' : apply_filters('widget_title', $instance['title4']);
			$image4 = empty($instance['image4']) ? '' : apply_filters('widget_image', $instance['image4']);
			$desc4 = empty($instance['desc4']) ? '' : apply_filters('widget_desc', $instance['desc4']);
			$link4 = empty($instance['link4']) ? '' : apply_filters('widget_link', $instance['link4']);
			
			$more1 = empty($instance['more1']) ? 'Read More' : apply_filters('widget_more1', $instance['more1']);
			$more2 = empty($instance['more2']) ? 'Read More' : apply_filters('widget_more2', $instance['more2']);
			$more3 = empty($instance['more3']) ? 'Read More' : apply_filters('widget_more3', $instance['more3']);
			$more4 = empty($instance['more4']) ? 'Read More' : apply_filters('widget_more4', $instance['more4']);
			 ?>			
      
         
		<div class="services_content">
         	<div class="service_box">
				<?php if($title1){?> <h4><?php echo $title1; ?></h4> <?php }?>
				<?php if($image1){?> <img src="<?php echo $image1; ?>" alt="" /> <?php }?>
				<?php if($desc1){?> <?php echo $desc1; ?> <?php }?>
				<?php if($link1){?> <a href="<?php echo $link1; ?>" class="read" title="Read More"><?php echo $more1; ?></a><?php }?>					
            </div>       
            
            <div class="service_box">
				<?php if($title2){?> <h4><?php echo $title2; ?></h4> <?php }?>
				<?php if($image2){?> <img src="<?php echo $image2; ?>" alt="" /> <?php }?>
				<?php if($desc2){?> <?php echo $desc2; ?> <?php }?>
				<?php if($link2){?> <a href="<?php echo $link2; ?>" class="read" title="Read More"><?php echo $more2; ?></a><?php }?>					
            </div>       
            
            <div class="service_box">
				<?php if($title3){?> <h4><?php echo $title3; ?></h4> <?php }?>
				<?php if($image3){?> <img src="<?php echo $image3; ?>" alt="" /> <?php }?>
				<?php if($desc3){?> <?php echo $desc3; ?> <?php }?>
				<?php if($link3){?> <a href="<?php echo $link3; ?>" class="read" title="Read More"><?php echo $more3; ?></a><?php }?>					
            </div>       
            
            <div class="service_box">
				<?php if($title4){?> <h4><?php echo $title4; ?></h4> <?php }?>
				<?php if($image4){?> <img src="<?php echo $image4; ?>" alt="" /> <?php }?>
				<?php if($desc4){?> <?php echo $desc4; ?> <?php }?>
				<?php if($link4){?> <a href="<?php echo $link4; ?>" class="read" title="Read More"><?php echo $more4; ?></a><?php }?>					
            </div>  
            
          </div>     
		
	<?php
			echo $after_widget;
			
		}
	 
		function update($new_instance, $old_instance) {
		//save the widget
		
			$instance = $old_instance;
			$instance['title1'] = strip_tags($new_instance['title1']);
			$instance['image1'] = strip_tags($new_instance['image1']);
			$instance['desc1'] = $new_instance['desc1'];
			$instance['link1'] = strip_tags($new_instance['link1']);
			
			
			$instance['title2'] = strip_tags($new_instance['title2']);
			$instance['image2'] = strip_tags($new_instance['image2']);
			$instance['desc2'] = $new_instance['desc2'];
			$instance['link2'] = strip_tags($new_instance['link2']);
			
			
			$instance['title3'] = strip_tags($new_instance['title3']);
			$instance['image3'] = strip_tags($new_instance['image3']);
			$instance['desc3'] = $new_instance['desc3'];
			$instance['link3'] = strip_tags($new_instance['link3']);
			
			
			$instance['title4'] = strip_tags($new_instance['title4']);
			$instance['image4'] = strip_tags($new_instance['image4']);
			$instance['desc4'] = $new_instance['desc4'];
			$instance['link4'] = strip_tags($new_instance['link4']);
			
			$instance['more1'] = strip_tags($new_instance['more1']);
			$instance['more2'] = strip_tags($new_instance['more2']);
			$instance['more3'] = strip_tags($new_instance['more3']);
			$instance['more4'] = strip_tags($new_instance['more4']);
			
			
			
			return $instance;
		}
		function form($instance) {
		//widgetform in backend
			$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'image' => '','desc' => '','link' => '' ) );
			$title1 = strip_tags($instance['title1']);
			$image1 = strip_tags($instance['image1']);
			$desc1 = $instance['desc1'];
			$link1 = strip_tags($instance['link1']);		
			
			$title2 = strip_tags($instance['title2']);
			$image2 = strip_tags($instance['image2']);
			$desc2 = $instance['desc2'];
			$link2 = strip_tags($instance['link2']);	
			
			$title3 = strip_tags($instance['title3']);
			$image3 = strip_tags($instance['image3']);
			$desc3 = $instance['desc3'];
			$link3 = strip_tags($instance['link3']);	
			
			$title4 = strip_tags($instance['title4']);
			$image4 = strip_tags($instance['image4']);
			$desc4 = $instance['desc4'];
			$link4 = strip_tags($instance['link4']);
			
			$more1 = strip_tags($instance['more1']);
			$more2 = strip_tags($instance['more2']);
			$more3 = strip_tags($instance['more3']);
			$more4 = strip_tags($instance['more4']);
	?>
	<p><label for="<?php echo $this->get_field_id('title1'); ?>"><?php _e('Title 1:');?> <input class="widefat" id="<?php echo $this->get_field_id('title1'); ?>" name="<?php echo $this->get_field_name('title1'); ?>" type="text" value="<?php echo attribute_escape($title1); ?>" /></label></p>
	
	
	<p><label for="<?php echo $this->get_field_id('image1'); ?>"><?php _e('Image 1:');?> <input class="widefat" id="<?php echo $this->get_field_id('image1'); ?>" name="<?php echo $this->get_field_name('image1'); ?>" type="text" value="<?php echo attribute_escape($image1); ?>" /></label></p>
	<p><label for="<?php echo $this->get_field_id('desc1'); ?>"><?php _e('Description 1:  (html tag use ex.&lt;p&gt;text &lt;/p&gt;)','templatic');?> <textarea class="widefat" rows="6" cols="20" id="<?php echo $this->get_field_id('desc1'); ?>" name="<?php echo $this->get_field_name('desc1'); ?>"><?php echo $desc1; ?></textarea></label></p>
	
	<p><label for="<?php echo $this->get_field_id('link1'); ?>"><?php _e('Link 1:');?> <input class="widefat" id="<?php echo $this->get_field_id('link1'); ?>" name="<?php echo $this->get_field_name('link1'); ?>" type="text" value="<?php echo attribute_escape($link1); ?>" /></label></p>
    <p><label for="<?php echo $this->get_field_id('more1'); ?>"><?php _e('Read More text 1:');?> <input class="widefat" id="<?php echo $this->get_field_id('more1'); ?>" name="<?php echo $this->get_field_name('more1'); ?>" type="text" value="<?php echo attribute_escape($more1); ?>" /></label></p>
	
    
    
    <p><label for="<?php echo $this->get_field_id('title2'); ?>"><?php _e('Title 2:');?> <input class="widefat" id="<?php echo $this->get_field_id('title2'); ?>" name="<?php echo $this->get_field_name('title2'); ?>" type="text" value="<?php echo attribute_escape($title2); ?>" /></label></p>
	
	<p><label for="<?php echo $this->get_field_id('image2'); ?>"><?php _e('Image 2:');?> <input class="widefat" id="<?php echo $this->get_field_id('image2'); ?>" name="<?php echo $this->get_field_name('image2'); ?>" type="text" value="<?php echo attribute_escape($image2); ?>" /></label></p>
	<p><label for="<?php echo $this->get_field_id('desc2'); ?>"><?php _e('Description 2:  (html tag use ex.&lt;p&gt;text &lt;/p&gt;)','templatic');?> <textarea class="widefat" rows="6" cols="20" id="<?php echo $this->get_field_id('desc2'); ?>" name="<?php echo $this->get_field_name('desc2'); ?>"><?php echo $desc2; ?></textarea></label></p>
	
	<p><label for="<?php echo $this->get_field_id('link2'); ?>"><?php _e('Link 2:');?> <input class="widefat" id="<?php echo $this->get_field_id('link2'); ?>" name="<?php echo $this->get_field_name('link2'); ?>" type="text" value="<?php echo attribute_escape($link2); ?>" /></label></p>
     <p><label for="<?php echo $this->get_field_id('more2'); ?>"><?php _e('Read More text 2:');?> <input class="widefat" id="<?php echo $this->get_field_id('more2'); ?>" name="<?php echo $this->get_field_name('more2'); ?>" type="text" value="<?php echo attribute_escape($more2); ?>" /></label></p>
    
    
    
    <p><label for="<?php echo $this->get_field_id('title3'); ?>"><?php _e('Title 3:');?> <input class="widefat" id="<?php echo $this->get_field_id('title3'); ?>" name="<?php echo $this->get_field_name('title3'); ?>" type="text" value="<?php echo attribute_escape($title3); ?>" /></label></p>
	
	<p><label for="<?php echo $this->get_field_id('image3'); ?>"><?php _e('Image 3:');?> <input class="widefat" id="<?php echo $this->get_field_id('image3'); ?>" name="<?php echo $this->get_field_name('image3'); ?>" type="text" value="<?php echo attribute_escape($image3); ?>" /></label></p>
	<p><label for="<?php echo $this->get_field_id('desc3'); ?>"><?php _e('Description 3:  (html tag use ex.&lt;p&gt;text &lt;/p&gt;)','templatic');?> <textarea class="widefat" rows="6" cols="20" id="<?php echo $this->get_field_id('desc3'); ?>" name="<?php echo $this->get_field_name('desc3'); ?>"><?php echo $desc3; ?></textarea></label></p>
	
	<p><label for="<?php echo $this->get_field_id('link3'); ?>"><?php _e('Link 3:');?> <input class="widefat" id="<?php echo $this->get_field_id('link3'); ?>" name="<?php echo $this->get_field_name('link3'); ?>" type="text" value="<?php echo attribute_escape($link3); ?>" /></label></p>
     <p><label for="<?php echo $this->get_field_id('more3'); ?>"><?php _e('Read More text 3:');?> <input class="widefat" id="<?php echo $this->get_field_id('more3'); ?>" name="<?php echo $this->get_field_name('more3'); ?>" type="text" value="<?php echo attribute_escape($more3); ?>" /></label></p>
    
    
       <p><label for="<?php echo $this->get_field_id('title4'); ?>"><?php _e('Title 4:');?> <input class="widefat" id="<?php echo $this->get_field_id('title4'); ?>" name="<?php echo $this->get_field_name('title4'); ?>" type="text" value="<?php echo attribute_escape($title4); ?>" /></label></p>
	
	<p><label for="<?php echo $this->get_field_id('image4'); ?>"><?php _e('Image 4:');?> <input class="widefat" id="<?php echo $this->get_field_id('image4'); ?>" name="<?php echo $this->get_field_name('image4'); ?>" type="text" value="<?php echo attribute_escape($image4); ?>" /></label></p>
	<p><label for="<?php echo $this->get_field_id('desc4'); ?>"><?php _e('Description 4:  (html tag use ex.&lt;p&gt;text &lt;/p&gt;)','templatic');?> <textarea class="widefat" rows="6" cols="20" id="<?php echo $this->get_field_id('desc4'); ?>" name="<?php echo $this->get_field_name('desc4'); ?>"><?php echo $desc4; ?></textarea></label></p>
	
	<p><label for="<?php echo $this->get_field_id('link4'); ?>"><?php _e('Link 4:');?> <input class="widefat" id="<?php echo $this->get_field_id('link4'); ?>" name="<?php echo $this->get_field_name('link4'); ?>" type="text" value="<?php echo attribute_escape($link4); ?>" /></label></p>
    <p><label for="<?php echo $this->get_field_id('more4'); ?>"><?php _e('Read More text 4:');?> <input class="widefat" id="<?php echo $this->get_field_id('more4'); ?>" name="<?php echo $this->get_field_name('more4'); ?>" type="text" value="<?php echo attribute_escape($more4); ?>" /></label></p>
	<?php
		}
	}
register_widget('templ_services_listing');

// /////////////////////////////////////////////////////////
class templ_team_list extends WP_Widget {
	
		function templ_team_list() {
		//Constructor
		global $thumb_url;
			$widget_ops = array('classname' => 'widget team list', 'description' => __('Team Listing') );
			$this->WP_Widget('team_list', __('T &rarr; Team list'), $widget_ops);
		}
	 
		function widget($args, $instance) {
		// prints the widget
	
			extract($args, EXTR_SKIP);
	 
			echo $before_widget;
			$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
			$name1 = empty($instance['name1']) ? '' : apply_filters('widget_name1', $instance['name1']);
			$image1 = empty($instance['image1']) ? '' : apply_filters('widget_image1', $instance['image1']);
			$qualification1 = empty($instance['qualification1']) ? '' : apply_filters('widget_qualification1', $instance['qualification1']);
			$desc1 = empty($instance['desc1']) ? '' : apply_filters('widget_desc1', $instance['desc1']);
			$link1 = empty($instance['link1']) ? '' : apply_filters('widget_link1', $instance['link1']);
			
			$name2 = empty($instance['name2']) ? '' : apply_filters('widget_name2', $instance['name2']);
			$image2 = empty($instance['image2']) ? '' : apply_filters('widget_image2', $instance['image2']);
			$qualification2 = empty($instance['qualification2']) ? '' : apply_filters('widget_qualification2', $instance['qualification2']);
			$desc2 = empty($instance['desc2']) ? '' : apply_filters('widget_desc2', $instance['desc2']);
			$link2 = empty($instance['link2']) ? '' : apply_filters('widget_link2', $instance['link2']);
			
			$more1 = empty($instance['more1']) ? 'Read More' : apply_filters('widget_more1', $instance['more1']);
			$more2 = empty($instance['more2']) ? 'Read More' : apply_filters('widget_more2', $instance['more2']);
			
			
			
			 ?>			
         
		 <div class="widget team_left">
         	<?php if($title){?> <h3><?php echo $title; ?></h3> <?php }?>
            <ul class="team_list">
				<li>
					<?php if($image1){?> <img src="<?php echo $image1; ?>" alt="" /><?php }?>
					<?php if($name1){?> <strong><?php echo $name1; ?></strong><?php }?>
					<?php if($qualification1){?> <small><?php echo $qualification1; ?></small><?php }?>
					<?php if($desc1){?> <?php echo $desc1; ?><?php }?>
					<?php if($link1){?> <a href="<?php echo $link1; ?>" class="read"><?php echo $more1; ?></a><?php }?>					
				</li>
				<li>
					<?php if($image2){?> <img src="<?php echo $image2; ?>" alt="" /><?php }?>
					<?php if($name2){?> <strong><?php echo $name2; ?></strong><?php }?>
					<?php if($qualification2){?> <small><?php echo $qualification2; ?></small><?php }?>
					<?php if($desc2){?> <?php echo $desc2; ?><?php }?>
					<?php if($link2){?> <a href="<?php echo $link2; ?>" class="read"><?php echo $more2; ?></a><?php }?>	
				</li>
			</ul>     
		</div>  	
	
	<?php
			echo $after_widget;
			
		}
	 
		function update($new_instance, $old_instance) {
		//save the widget
		
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['name1'] = strip_tags($new_instance['name1']);
			$instance['image1'] = strip_tags($new_instance['image1']);
			$instance['qualification1'] = strip_tags($new_instance['qualification1']);
			$instance['desc1'] = $new_instance['desc1'];
			$instance['link1'] = strip_tags($new_instance['link1']);
			$instance['more1'] = strip_tags($new_instance['more1']);
			$instance['more2'] = strip_tags($new_instance['more2']);
			
			$instance['name2'] = strip_tags($new_instance['name2']);
			$instance['image2'] = strip_tags($new_instance['image2']);
			$instance['qualification2'] = strip_tags($new_instance['qualification2']);
			$instance['desc2'] = $new_instance['desc2'];
			$instance['link2'] = strip_tags($new_instance['link2']);
			
			return $instance;
		}
		function form($instance) {
		//widgetform in backend
			$instance = wp_parse_args( (array) $instance, array( 'title' => '','name1' => '', 'qualification1' => '','desc1' => '','link1' => '','name2' => '', 'qualification2' => '','desc2' => '','link2' => '' ) );
			$title = strip_tags($instance['title']);
			$name1 = strip_tags($instance['name1']);
			$image1 = strip_tags($instance['image1']);
			$qualification1 = strip_tags($instance['qualification1']);
			$desc1 = $instance['desc1'];
			$link1 = strip_tags($instance['link1']);
			
			$name2 = strip_tags($instance['name2']);
			$image2 = strip_tags($instance['image2']);
			$qualification2 = strip_tags($instance['qualification2']);
			$desc2 = $instance['desc2'];
			$link2 = strip_tags($instance['link2']);
			
			$more1 = strip_tags($instance['more1']);
			$more2 = strip_tags($instance['more2']);

			
	?>
	<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:');?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
	<p><label for="<?php echo $this->get_field_id('name1'); ?>"><?php _e('Name1:');?> <input class="widefat" id="<?php echo $this->get_field_id('name1'); ?>" name="<?php echo $this->get_field_name('name1'); ?>" type="text" value="<?php echo attribute_escape($name1); ?>" /></label></p>
	<p><label for="<?php echo $this->get_field_id('image1'); ?>"><?php _e('Image1:');?> <input class="widefat" id="<?php echo $this->get_field_id('image1'); ?>" name="<?php echo $this->get_field_name('image1'); ?>" type="text" value="<?php echo attribute_escape($image1); ?>" /></label></p>	
	<p><label for="<?php echo $this->get_field_id('qualification1'); ?>"><?php _e('Qualification1:');?> <input class="widefat" id="<?php echo $this->get_field_id('qualification1'); ?>" name="<?php echo $this->get_field_name('qualification1'); ?>" type="text" value="<?php echo attribute_escape($qualification1); ?>" /></label></p>
	<p><label for="<?php echo $this->get_field_id('desc1'); ?>"><?php _e('Description1 :  (html tag use ex.&lt;p&gt;text &lt;/p&gt;)','templatic');?> <textarea class="widefat" rows="6" cols="20" id="<?php echo $this->get_field_id('desc1'); ?>" name="<?php echo $this->get_field_name('desc1'); ?>"><?php echo $desc1; ?></textarea></label></p>	
	<p><label for="<?php echo $this->get_field_id('link1'); ?>"><?php _e('Link1:');?> <input class="widefat" id="<?php echo $this->get_field_id('link1'); ?>" name="<?php echo $this->get_field_name('link1'); ?>" type="text" value="<?php echo attribute_escape($link1); ?>" /></label></p>
    
    <p><label for="<?php echo $this->get_field_id('more1'); ?>"><?php _e('Read More Text 1:');?> <input class="widefat" id="<?php echo $this->get_field_id('more1'); ?>" name="<?php echo $this->get_field_name('more1'); ?>" type="text" value="<?php echo attribute_escape($more1); ?>" /></label></p>
	
	<p><label for="<?php echo $this->get_field_id('name2'); ?>"><?php _e('Name2:');?> <input class="widefat" id="<?php echo $this->get_field_id('name2'); ?>" name="<?php echo $this->get_field_name('name2'); ?>" type="text" value="<?php echo attribute_escape($name2); ?>" /></label></p>
	<p><label for="<?php echo $this->get_field_id('image2'); ?>"><?php _e('Image2:');?> <input class="widefat" id="<?php echo $this->get_field_id('image2'); ?>" name="<?php echo $this->get_field_name('image2'); ?>" type="text" value="<?php echo attribute_escape($image2); ?>" /></label></p>	
	<p><label for="<?php echo $this->get_field_id('qualification2'); ?>"><?php _e('Qualification2:');?> <input class="widefat" id="<?php echo $this->get_field_id('qualification2'); ?>" name="<?php echo $this->get_field_name('qualification2'); ?>" type="text" value="<?php echo attribute_escape($qualification2); ?>" /></label></p>
	<p><label for="<?php echo $this->get_field_id('desc2'); ?>"><?php _e('Description :  (html tag use ex.&lt;p&gt;text &lt;/p&gt;)','templatic');?> <textarea class="widefat" rows="6" cols="20" id="<?php echo $this->get_field_id('desc2'); ?>" name="<?php echo $this->get_field_name('desc2'); ?>"><?php echo $desc2; ?></textarea></label></p>	
	<p><label for="<?php echo $this->get_field_id('link2'); ?>"><?php _e('Link2:');?> <input class="widefat" id="<?php echo $this->get_field_id('link2'); ?>" name="<?php echo $this->get_field_name('link2'); ?>" type="text" value="<?php echo attribute_escape($link2); ?>" /></label></p>
    <p><label for="<?php echo $this->get_field_id('more2'); ?>"><?php _e('Read More Text 2:');?> <input class="widefat" id="<?php echo $this->get_field_id('more2'); ?>" name="<?php echo $this->get_field_name('more2'); ?>" type="text" value="<?php echo attribute_escape($more2); ?>" /></label></p>
	
	<?php
		}
	}
register_widget('templ_team_list');

// /////////////////////////////////////////////////////////
class templ_practice_listing extends WP_Widget {
	
		function templ_practice_listing() {
		//Constructor
		global $thumb_url;
			$widget_ops = array('classname' => 'widget practice list', 'description' => __('Practice Listing') );
			$this->WP_Widget('practice_listing', __('T &rarr; Practice list'), $widget_ops);
		}
		function widget($args, $instance) {
		// prints the widget
	
			extract($args, EXTR_SKIP);
	 
			echo $before_widget;
			$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
			$desc = empty($instance['desc']) ? '' : apply_filters('widget_desc', $instance['desc']);
			 ?>			
         
			<div class="widget practice_right">         	
				<?php if($title){?> <h3><?php echo $title; ?></h3> <?php }?>
				<?php if($desc){?> <?php echo $desc; ?> <?php }?>			      
			</div>  	
	<?php
			echo $after_widget;
			
		}
		function update($new_instance, $old_instance) {
		//save the widget
		
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['desc'] = $new_instance['desc'];
			
			return $instance;
		}
		function form($instance) {
		//widgetform in backend
			$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'image' => '','desc' => '','link' => '' ) );
			$title = strip_tags($instance['title']);
			$desc = $instance['desc'];	
	?>
	<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:');?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
	<p><label for="<?php echo $this->get_field_id('desc'); ?>"><?php _e('Description :  (html tag use ex.&lt;p&gt;text &lt;/p&gt;)','templatic');?> <textarea class="widefat" rows="6" cols="20" id="<?php echo $this->get_field_id('desc'); ?>" name="<?php echo $this->get_field_name('desc'); ?>"><?php echo $desc; ?></textarea></label></p>	
	<?php
		}
	}
register_widget('templ_practice_listing');
?>