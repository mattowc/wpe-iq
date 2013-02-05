<?php
/********************************************************************
You can add your filetes in this file and it will affected.
This is the common filter functions file where you can add you filtes.
********************************************************************/

add_filter('templ_page_title_filter','templ_page_title_fun');
function templ_page_title_fun($title)
{
	return '<h1>'.$title.'</h1>';
}


add_filter('templ_theme_guide_link_filter','templ_theme_guide_link_fun');
function templ_theme_guide_link_fun($guidelink)
{
	$guidelink .= "/test123_guidelink"; // templatic.com site theme guide url here
	return $guidelink;
}

add_filter('templ_theme_forum_link_filter','templ_theme_forum_link_fun');
function templ_theme_forum_link_fun($forumlink)
{
	$forumlink .= "/test123form_link"; // templatic.com site Forum url here
	return $forumlink;
}

add_filter('templ_sidebar_widget_box_filter','templ_sidebar_widget_box_fun');
function templ_sidebar_widget_box_fun($content)
{
	//$content['top_navigation_above']='';
	//$content['slider_above']='';
	//$content['home_slider']='';
	//$content['slider_below']='';
	//$content['header_logo_right_side']='';
	
	//  Start Remove Side bar Widgets Area  Page Layout option wise
	if(get_option('ptthemes_page_layout')=='Full Page')
	{
		$content['sidebar_left']=''; 
	    $content['sidebar_right']='';
		$content['sidebar_2col_merge']='';
		
	}else if(get_option('ptthemes_page_layout')=='Page 2 column - Right Sidebar' || get_option('ptthemes_page_layout')=='')
	{
		$content['sidebar_left']='';
	    $content['sidebar_2col_merge']='';
		
	}else if(get_option('ptthemes_page_layout')=='Page 2 column - Left Sidebar')
	{
		$content['sidebar_right']='';
	    $content['sidebar_2col_merge']='';
		
	}else if(get_option('ptthemes_page_layout')=='Page 3 column - Fixed')
	{
		 $content['sidebar_2col_merge']='';
		 
	}else if(get_option('ptthemes_page_layout')=='Page 3 column - Right Sidebar')
	{
	}else if(get_option('ptthemes_page_layout')=='Page 3 column - Left Sidebar')
	{
	}
	//  End Remove Side bar Widgets Area  Page Layout option wise
	
	
	// Start Remove Footer Widgets Area Page Layout option wise
	if(get_option('ptthemes_bottom_options')=='Two Column - Right(one third)')
	{
		$content['bottom_2column_equal_left']=''; 
	    $content['bottom_2column_equal_right']='';
		$content['bottom_3column_first']='';
		$content['bottom_3column_second']=''; 
	    $content['bottom_3column_third']='';
		$content['bottom_4column_first']='';
		$content['bottom_4column_second']='';
		$content['bottom_4column_third']='';
		$content['bottom_4column_fourth']='';
		$content['bottom_full_width']='';
		
		
	}else if(get_option('ptthemes_bottom_options')=='Two Column - Left(one third)')
	{
	
		$content['bottom_2column_equal_left']=''; 
	    $content['bottom_2column_equal_right']='';
		$content['bottom_3column_first']='';
		$content['bottom_3column_second']=''; 
	    $content['bottom_3column_third']='';
		$content['bottom_4column_first']='';
		$content['bottom_4column_second']='';
		$content['bottom_4column_third']='';
		$content['bottom_4column_fourth']='';
		$content['bottom_full_width']='';
		
	}else if(get_option('ptthemes_bottom_options')=='Equal Column')
	{
		
		$content['bottom_2column_left']=''; 
	    $content['bottom_2column_right']='';
		$content['bottom_3column_first']='';
		$content['bottom_3column_second']=''; 
	    $content['bottom_3column_third']='';
		$content['bottom_4column_first']='';
		$content['bottom_4column_second']='';
		$content['bottom_4column_third']='';
		$content['bottom_4column_fourth']='';
		$content['bottom_full_width']='';
	}else if(get_option('ptthemes_bottom_options')=='Three Column')
	{
		$content['bottom_2column_equal_left']=''; 
	    $content['bottom_2column_equal_right']='';
		$content['bottom_2column_left']=''; 
	    $content['bottom_2column_right']='';
		$content['bottom_4column_first']='';
		$content['bottom_4column_second']='';
		$content['bottom_4column_third']='';
		$content['bottom_4column_fourth']='';
		$content['bottom_full_width']='';
		
	}else if(get_option('ptthemes_bottom_options')=='Fourth Column' || get_option('ptthemes_bottom_options')=='')
	{
		$content['bottom_2column_left']=''; 
	    $content['bottom_2column_right']='';
		$content['bottom_3column_first']='';
		$content['bottom_3column_second']=''; 
	    $content['bottom_3column_third']='';
		$content['bottom_2column_equal_left']=''; 
	    $content['bottom_2column_equal_right']='';
		$content['bottom_full_width']='';
	}else if(get_option('ptthemes_bottom_options')=='Full Width')
	{
		$content['bottom_2column_left']=''; 
	    $content['bottom_2column_right']='';
		$content['bottom_2column_equal_left']=''; 
	    $content['bottom_2column_equal_right']='';
		$content['bottom_3column_first']='';
		$content['bottom_3column_second']=''; 
	    $content['bottom_3column_third']='';
		$content['bottom_4column_first']='';
		$content['bottom_4column_second']='';
		$content['bottom_4column_third']='';
		$content['bottom_4column_fourth']='';
	}
	
	// End Remove Footer Widgets Area Page Layout option wise
	$content['top_navigation_above']='';
	$content['main_navigation']='';
	$content['header_above']='';
	$content['header_logo_right_side']='';
	$content['container_below']='';
	$content['slider_above']='';
	$content['slider_below']='';
	$content['header_logo_right_side']='';
	$content['bottom_2column_equal_left']=''; 
	$content['bottom_2column_equal_right']='';
	$content['bottom_2column_left']=''; 
	$content['bottom_2column_right']='';
	$content['bottom_3column_first']='';
	$content['bottom_3column_second']=''; 
	$content['bottom_3column_third']='';
	$content['bottom_4column_first']='';
	$content['bottom_4column_second']='';
	$content['bottom_4column_third']='';
	$content['bottom_4column_fourth']='';
	$content['bottom_full_width']='';
	$sidebar_widget_arr = array();
	$sidebar_widget_arr['front_page_content'] =array(1,array('name' => 'Front Page Content','id' => 'front_page_content','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
	array_splice($content, 1, 0, $sidebar_widget_arr);
	$sidebar_widget_arr = array();
	$sidebar_widget_arr['index_page_sidebar_left'] =array(1,array('name' => 'Index Page Sidebar Left','id' => 'index_page_sidebar_left','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
	$sidebar_widget_arr['inner_page_sidebar_left'] =array(1,array('name' => 'Inner Page Sidebar Left','id' => 'inner_page_sidebar_left','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
	$sidebar_widget_arr['inner_page_sidebar_right'] =array(1,array('name' => 'Inner Page Sidebar Right','id' => 'inner_page_sidebar_right','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
	array_splice($content, count($content)-1, 0, $sidebar_widget_arr);
	
	//print_r($content);
	
	return $content;
}


/*add_filter('templ_msg_notifications_filter','templ_msg_notifications_fun');
function templ_msg_notifications_fun($content)
{
	unset($content[0]);
	return $content;
}*/
/*add_filter('templ_sidebar_widget_box_filter','templ_sidebar_widget_box_fun');
function templ_sidebar_widget_box_fun($content)
{
	return $content;
}*/
/*add_filter('templ_widgets_listing_filter','templ_widgets_listing_fun');
function templ_widgets_listing_fun($content)
{
	return $content;
}
*/
add_filter('templ_admin_menu_title_filter','templ_admin_menu_title_fun');
function templ_admin_menu_title_fun($content)
{
	return $content=__('Theme Menu','templatic');
}

/////////search widget filter start/////////////
add_action('pre_get_posts', 'search_filter');
function search_filter($local_wp_query) 
{
	if(is_search())
	{
		add_filter('posts_where', 'searching_filter_where');
	}else
	{
		remove_filter('posts_where', 'searching_filter_where');	
	}
}

function searching_filter_where($where) {
	global $wpdb;
	$scat = trim($_REQUEST['catdrop']);
	$todate = trim($_REQUEST['todate']);
	$frmdate = trim($_REQUEST['frmdate']);
	$articleauthor = trim($_REQUEST['articleauthor']);
	$exactyes = trim($_REQUEST['exactyes']);
	if($scat>0)
	{
		$where .= " AND  $wpdb->posts.ID in (select $wpdb->term_relationships.object_id from $wpdb->term_relationships join $wpdb->term_taxonomy on $wpdb->term_taxonomy.term_taxonomy_id=$wpdb->term_relationships.term_taxonomy_id and $wpdb->term_taxonomy.term_id=\"$scat\" ) ";
	}
	if($todate!="")
	{
		$where .= " AND   DATE_FORMAT($wpdb->posts.post_date,'%Y-%m-%d') >='".$todate."'";
	}
	else if($frmdate!="")
	{
		$where .= " AND  DATE_FORMAT($wpdb->posts.post_date,'%Y-%m-%d') <='".$frmdate."'";
	}
	else if($todate!="" && $frmdate!="")
	{
		$where .= " AND  DATE_FORMAT($wpdb->posts.post_date,'%Y-%m-%d') BETWEEN '".$todate."' and '".$frmdate."'";
	}
	if($articleauthor!="" && $exactyes!=1)
	{
		$where .= " AND  $wpdb->posts.post_author in (select $wpdb->users.ID from $wpdb->users where $wpdb->users.display_name  like '".$articleauthor."') ";
	}
	if($articleauthor!="" && $exactyes==1)
	{
		$where .= " AND  $wpdb->posts.post_author in (select $wpdb->users.ID from $wpdb->users where $wpdb->users.display_name  = '".$articleauthor."') ";
	}
	return $where;
}
/////////search widget filter end/////////////



add_filter('templ_admin_post_custom_fields_filter','templ_admin_post_custom_fields_fun');
function templ_admin_post_custom_fields_fun($array)
{
	$pt_metaboxes = $array;
	$pt_metaboxes = array(
		"fullimg" => array (
			"name"		=> "fullimg",
			"default" 	=> "",
			"label" 	=> __("Full Image (only for slider)"),
			"type" 		=> "text",
			"desc"      => __("Enter full image URL (image size: width - 978px x height - 400px) eg. : <strong>http://myplace.com/image.jpg</strong>",'templatic')
		),
		"video" => array (
			"name"  => "video",
			"label" => __("Custom Video code (only for slider)"),
			"type" => "textarea",
			"desc" => __("Enter embed code for video. (Ideal Size: width - 300px x height - 199px) eg. : code from youtube, vimeo, etc",'templatic')
		),
		
	);
	return $pt_metaboxes;
}


add_filter('templ_pikachoose_slider_widget_content_filter','templ_anything_slider_widget_content_fun');
function templ_anything_slider_widget_content_fun($post)
{
	ob_start(); // don't remove this code

	$post_images = bdw_get_images($post->ID,'large');
	if(get_the_post_thumbnail( $post->ID, array())){?>
	<a href="<?php the_permalink(); ?>">
	<?php echo get_the_post_thumbnail( $post->ID, array(930,950),array('class'	=> "",));?></a><?php
	}else if($post_images[0]){ global $thumb_url;
	 ?>
	 <a  href="<?php the_permalink(); ?>"><img src="<?php echo bloginfo('template_url'); ?>/thumb.php?src=<?php echo $post_images[0];?>&amp;w=955&amp;h=500&amp;zc=1&amp;q=80<?php echo $thumb_url;?>" alt="<?php get_the_title($post->ID); ?>" title="<?php get_the_title($post->ID); ?>"  /></a>
	<?php
	}?> 
	<span><?php echo get_the_title($post->ID); ?></span>
<?php

	$return = ob_get_contents(); // don't remove this code
	ob_end_clean(); // don't remove this code
	return  $return;
}

/*add_filter('templ_breadcrumbs_navigation_filter','templ_breadcrumbs_navigation_fun');
function templ_breadcrumbs_navigation_fun($bc)
{
	return '<b>'.$bc.'</b>';	
}*/


/*add_filter('templ_anything_slider_widget_postsobj_filter','templ_anything_slider_widget_postsobj_fn');
function templ_anything_slider_widget_postsobj_fn($post)
{
	global $wpdb;
	$sql = "select t.term_id from $wpdb->terms t join $wpdb->term_taxonomy tt on tt.term_id=t.term_id where tt.taxonomy=\"category\"   $sub_sql_cat order by t.name";
	$catids = $wpdb->get_col($sql);
	foreach($catids as $key=>$catid)
	{
		if($catid)
		{
			$sql = "select p.* from $wpdb->posts p where p.post_type='post' and p.ID in (select tr.object_id from $wpdb->term_relationships tr join $wpdb->term_taxonomy t on t.term_taxonomy_id=tr.term_taxonomy_id where t.term_id=\"$catid\"  ) order by order by p.post_date desc,p.ID desc limit 1";
			$post=$wpdb->get_results($sql);
			$post[0]->termid = $catid;
			$rposts[]=$post[0];
		}
	}
	return $rposts;
}*/

add_filter('templ_anything_slider_widget_content_filter','templ_anything_slider_widget_content_fn');
function templ_anything_slider_widget_content_fn($post)
{
	ob_start(); // don't remove this code
/////////////////////////////////////////////////////
	echo  get_cat_name($post->termid);
	if(get_the_post_thumbnail( $post->ID, array())){
	?>
	<a class="post_img" href="<?php echo get_permalink($post->ID);?>">
	<?php echo  get_the_post_thumbnail( $post->ID, array(220,220),array('class'	=> "",));?></a>
	<?php
    }else if($post_images = bdw_get_images($post->ID,'large')){ 
	global $thumb_url;
	?>
	<a class="post_img" href="<?php echo get_permalink($post->ID);?>">
	 <img src="<?php echo get_bloginfo('template_url');?>/thumb.php?src=<?php echo $post_images[0];?>&amp;w=220&amp;h=220&amp;zc=1&amp;q=80<?php echo $thumb_url;?>" alt="<?php echo get_the_title($post->ID);?>" title="<?php echo get_the_title($post->ID);?>"  /></a>
	<?php } ?>
    <div class="tslider3_content">
    <h4> <a class="widget-title" href="<?php echo get_permalink($post->ID);?>"><?php echo get_the_title($post->ID);?></a></h4>
    <p><?php echo bm_better_excerpt(605, ' ... ');?></p>
    <p><a href="<?php echo get_permalink($post->ID);?>" class="more"><?php _e('Read More','templatic')?></a></p>
   </div>
<?php
/////////////////////////////////////////////////////
	$return = ob_get_contents(); // don't remove this code
	ob_end_clean(); // don't remove this code
	return  $return;	
}

//add_action('templ_page_title_above','templ_page_title_below_fun'); //page title above action hook
add_action('templ_page_title_below','templ_page_title_below_fun');  //page title below action hook
function templ_page_title_below_fun()
{
	templ_set_breadcrumbs_navigation();
}


add_filter('sidebar_left_widget_filter','sidebar_left_widget_fun');
function sidebar_left_widget_fun($text)
{
	if(is_page())
	{
		$text = 'inner_page_sidebar_left';
	} 
	return $text;
}

add_filter('sidebar_right_widget_filter','sidebar_right_widget_fun');
function sidebar_right_widget_fun($text)
{
	if(is_page())
	{
		$text = 'inner_page_sidebar_right';
	} 
	return $text;
}
?>