<?php
/*** Theme setup ***/
add_theme_support( 'post-thumbnails' );
add_theme_support( 'automatic-feed-links' );

global $blog_id;
if($blog_id){ $thumb_url = "&amp;bid=$blog_id";}

if(!defined('TT_ADMIN_FOLDER_NAME')): define('TT_ADMIN_FOLDER_NAME','admin'); endif;
define('TT_ADMIN_FOLDER_URL',get_bloginfo( 'template_directory', 'display' ).'/'.TT_ADMIN_FOLDER_NAME.'/'); //css folder url
define('TT_THEME_OPTIONS_FOLDER_URL',get_bloginfo( 'template_directory', 'display' ).'/'.TT_ADMIN_FOLDER_NAME.'/theme_options/'); //css folder url
define('TT_WIDGETS_FOLDER_URL',get_bloginfo( 'template_directory', 'display' ).'/'.TT_ADMIN_FOLDER_NAME.'/widgets/'); //WIDGET folder url
define('TT_WIDGET_JS_FOLDER_URL',TT_WIDGETS_FOLDER_URL.'widget_js/'); //widget javascript folder url
define('TT_TPL_FOLDER_URL',get_bloginfo( 'template_directory', 'display' ).'/library/tpl/'); //theme template folder url
define('TT_FUNCTIONS_FOLDER_URL',get_bloginfo( 'template_directory', 'display' ).'/library/functions/'); //theme functions folder url
define('TT_INCLUDES_FOLDER_URL',get_bloginfo( 'template_directory', 'display' ).'/library/includes/'); //theme includes folder url
define('TT_CSS_FOLDER_URL',get_bloginfo( 'template_directory', 'display' ).'/library/css/'); //theme css folder url


if(!defined('TT_ADMIN_FOLDER_NAME')): define('TT_ADMIN_FOLDER_PATH',TEMPLATEPATH.'/'.TT_ADMIN_FOLDER_NAME.'/'); endif;//admin folder path
define('TT_MODULES_FOLDER_PATH',TEMPLATEPATH.'/modules/'); //addons folder path
define('TT_WIDGET_FOLDER_PATH',TT_ADMIN_FOLDER_PATH.'widgets/'); //widget folder path
define('TT_LIBRARY_FOLDER_PATH',TEMPLATEPATH.'/library/'); //library folder path
define('TT_FUNCTIONS_FOLDER_PATH',TT_LIBRARY_FOLDER_PATH . 'functions/'); //functions folder path
define('TT_JSCRIPT_FOLDER_PATH',TT_LIBRARY_FOLDER_PATH . 'js/'); //javascript folder path
define('TT_CSS_FOLDER_PATH',TT_LIBRARY_FOLDER_PATH . 'css/'); //css folder path
define('TT_INCLUDES_FOLDER_PATH',TT_LIBRARY_FOLDER_PATH . 'includes/'); //includes folder path
define('TT_TPL_ROOT_PATH',TT_LIBRARY_FOLDER_PATH.'tpl/');  //tpl folder path
define('TT_TPL_STRUCTURE_PATH',TT_TPL_ROOT_PATH.'structure/');  //structure folder path

?>