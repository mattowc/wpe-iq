<?php
// Register widgetized areas
if ( function_exists('register_sidebar') ) {
	$sidebar_widget_arr = array();
	$sidebar_widget_arr['top_navigation_above'] =array(1,array('name' => 'Top Navigation Above','id' => 'top_navigation_above','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
	
	$sidebar_widget_arr['top_navigation'] =array(1,array('name' => 'Top Navigation','id' => 'top_navigation','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
	
	$sidebar_widget_arr['main_navigation'] =array(1,array('name' => 'Main Navigation','id' => 'main_navigation','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
	
	$sidebar_widget_arr['header_above'] =array(1,array('name' => 'Header Above','id' => 'header_above','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
	
	$sidebar_widget_arr['header_logo_right_side'] =array(1,array('name' => 'Header Logo Right Side','id' => 'header_logo_right_side','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
	
	$sidebar_widget_arr['slider_above'] =array(1,array('name' => 'Slider Above','id' => 'slider_above','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
	
	$sidebar_widget_arr['home_slider'] =array(1,array('name' => 'Home Slider','id' => 'home_slider','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
	
	$sidebar_widget_arr['slider_below'] =array(1,array('name' => 'Slider Below','id' => 'slider_below','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
	
	$sidebar_widget_arr['index_content_above'] =array(1,array('name' => 'Index Content Above','id' => 'index_content_above','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
	
	$sidebar_widget_arr['index_content_below'] =array(1,array('name' => 'Index Content Below','id' => 'index_content_below','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
	
	$sidebar_widget_arr['single_page_post_below'] =array(1,array('name' => 'Single Page Post Below','id' => 'single_page_post_below','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
	
	$sidebar_widget_arr['page_content_above'] =array(1,array('name' => 'Page Content Above','id' => 'page_content_above','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
	
	$sidebar_widget_arr['page_content_below'] =array(1,array('name' => 'Page Content Below','id' => 'page_content_below','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
	
	$sidebar_widget_arr['container_below'] =array(1,array('name' => 'Container Below','id' => 'container_below','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
	
	$sidebar_widget_arr['sidebar_2col_merge'] =array(1,array('name' => 'Sidebar 2col Merge','id' => 'sidebar_2col_merge','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
	
	$sidebar_widget_arr['sidebar_left'] =array(1,array('name' => 'Sidebar Left','id' => 'sidebar_left','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
	
	$sidebar_widget_arr['sidebar_right'] =array(1,array('name' => 'Sidebar Right','id' => 'sidebar_right','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
	
	$sidebar_widget_arr['bottom_2column_left'] =array(1,array('name' => 'Bottom 2column - Left','id' => 'bottom_2column_left','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
	
	$sidebar_widget_arr['bottom_2column_right'] =array(1,array('name' => 'Bottom 2column - Right','id' => 'bottom_2column_right','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
	
	$sidebar_widget_arr['bottom_2column_equal_left'] =array(1,array('name' => 'Bottom 2column Equal - Left','id' => 'bottom_2column_equal_left','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
	
	$sidebar_widget_arr['bottom_2column_equal_right'] =array(1,array('name' => 'Bottom 2column Equal - Right','id' => 'bottom_2column_equal_right','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
	
	$sidebar_widget_arr['bottom_3column_first'] =array(1,array('name' => 'Bottom 3column - First','id' => 'bottom_3column_first','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
	
	$sidebar_widget_arr['bottom_3column_second'] =array(1,array('name' => 'Bottom 3column - Second','id' => 'bottom_3column_second','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
	
	$sidebar_widget_arr['bottom_3column_third'] =array(1,array('name' => 'Bottom 3column - Third','id' => 'bottom_3column_third','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
	
	$sidebar_widget_arr['bottom_4column_first'] =array(1,array('name' => 'Bottom 4column - First','id' => 'bottom_4column_first','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
	
	$sidebar_widget_arr['bottom_4column_second'] =array(1,array('name' => 'Bottom 4column - Second','id' => 'bottom_4column_second','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
	
	$sidebar_widget_arr['bottom_4column_third'] =array(1,array('name' => 'Bottom 4column - Third','id' => 'bottom_4column_third','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
	
	$sidebar_widget_arr['bottom_4column_fourth'] =array(1,array('name' => 'Bottom 4column - Fourth','id' => 'bottom_4column_fourth','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
	
	$sidebar_widget_arr['bottom_full_width'] =array(1,array('name' => 'Bottom Full Width','id' => 'bottom_full_width','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
	
	$sidebar_widget_arr['footer_above'] =array('1',array('name' => 'Footer Above', 'id' => 'footer_above', 'before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
	
	$sidebar_widget_arr = apply_filters('templ_sidebar_widget_box_filter',$sidebar_widget_arr);
	foreach($sidebar_widget_arr as $key=>$val)
	{
		if($val){
		register_sidebars($val[0],$val[1]);
		}
	}

}
?>