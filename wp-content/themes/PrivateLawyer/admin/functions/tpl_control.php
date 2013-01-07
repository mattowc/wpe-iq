<?php
////////////SIDEBAR RIGHT///////////
function templ_sidebar_right_st($class='')
{
	$class = apply_filters('templ_sidebar_right_css_filter',$class);
	if($class){ $class = 'class="'.$class.'"';}
	return apply_filters('templ_sidebar_right_st_filter',"<div  $class >");
}

function templ_sidebar_right_end()
{
	return apply_filters('templ_sidebar_right_end_filter','</div>');
}
function templ_sidebar_right($class='sidebar right')
{
	echo templ_sidebar_right_st($class);
	$widget = apply_filters('sidebar_right_widget_filter','sidebar_right');
	if (function_exists('dynamic_sidebar') && $widget){ dynamic_sidebar($widget); }
	do_action('templ_sidebar_right');
	echo templ_sidebar_right_end();
}

//////////SIDEBAR LEFT///////////////
function templ_sidebar_left_st($class='')
{
	$class = apply_filters('templ_sidebar_left_css_filter',$class);
	if($class){ $class = 'class="'.$class.'"';}
	return apply_filters('templ_sidebar_left_st_filter',"<div  $class >");
}

function templ_sidebar_left_end()
{
	return apply_filters('templ_sidebar_left_end_filter','</div>');
}
function templ_sidebar_left($class='sidebar left')
{
	echo templ_sidebar_left_st($class);
	$widget = apply_filters('sidebar_left_widget_filter','sidebar_left');
	if (function_exists('dynamic_sidebar') && $widget){ dynamic_sidebar($widget); }
	do_action('templ_sidebar_right');
	echo templ_sidebar_left_end();
}

//////////MIDDEL CONTENT///////////////
function templ_middle_st($class='')
{
	$class = apply_filters('templ_middle_css_filter',$class);
	if($class){ $class = 'class="'.$class.'"';}
	return apply_filters('templ_middle_st_filter',"<div  $class >");
}

function templ_middle_end()
{
	return apply_filters('templ_middle_end_filter','</div>');
}
function templ_middle($class='content right',$file='')
{
	echo templ_middle_st($class);
	if(file_exists($file)){include_once($file);}
	do_action('templ_sidebar_middle');
	echo templ_middle_end();
}


function templ_the_content($file,$arg=array())
{
	do_action('templ_before_the_content');
	$file = apply_filters('ptthemes_content_file_filter',$file);
	if(get_option('ptthemes_page_layout')){
		$layout = get_option('ptthemes_page_layout');
	}else{
		$layout = $arg['default'];
	}
	$layout = apply_filters('templ_include_tpl_file_filter',$layout);
	
	if($layout=='Page 3 column - Fixed')
	{
		templ_middle('content content_3col column_spacer left',$file);
		templ_sidebar_left('sidebar sidebar_3col_l left');
		templ_sidebar_right('sidebar sidebar_3col_r right');
	}
	else if($layout=='Page 3 column - Left Sidebar')
	{
		templ_middle('content content_3col_right right',$file);
		echo apply_filters('templ_3col_merge_left_st_filter','<div class="sidebar sidebar_3col_merge_l left">');
		$widget = apply_filters('sidebar_2col_merge_widget_filter','sidebar_2col_merge');
		if (function_exists('dynamic_sidebar') && $widget){ dynamic_sidebar($widget); }
		templ_sidebar_left('sidebar_3col_l_m left');
		templ_sidebar_right('sidebar_3col_r_m right');
		echo apply_filters('templ_3col_merge_left_end_filter','</div>');
	}
	elseif($layout=='Page 3 column - Right Sidebar')
	{
		templ_middle('content content_3col_left left',$file);
		echo apply_filters('templ_3col_merge_right_st_filter','<div class="sidebar sidebar_3col_merge_r right">');
		$widget = apply_filters('sidebar_2col_merge_widget_filter','sidebar_2col_merge');
		if (function_exists('dynamic_sidebar') && $widget){ dynamic_sidebar($widget); }
		templ_sidebar_left('sidebar_3col_l_m left');
		templ_sidebar_right('sidebar_3col_r_m right');
		echo apply_filters('templ_3col_merge_right_end_filter','</div>');
	}
	elseif($layout=='Full Page')
	{	
		templ_middle('content content_full',$file);
	}
	else if($layout=='Page 2 column - Right Sidebar')
	{
		templ_middle('content left',$file);
		templ_sidebar_right('sidebar right');
	}
	else //if($layout=='Page 2 column - Left Sidebar')
	{
		templ_middle('content right',$file);
		templ_sidebar_left('sidebar left');
	}
	do_action('templ_after_the_content');
}


/************************************
//FUNCTION NAME : templ_template_include
//ARGUMENTS : None
//RETURNS : Site page template file as per desing settings
***************************************/
add_filter('template_include','templ_template_include');
function templ_template_include($template)
{
	return apply_filters('templ_add_template_page_filter',$template);
}
?>