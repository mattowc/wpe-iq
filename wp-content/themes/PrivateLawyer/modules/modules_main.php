<?php
if(file_exists(TT_MODULES_FOLDER_PATH . 'custom_post_type/custom_post_type_lang.php'))
{
	include_once(TT_MODULES_FOLDER_PATH.'custom_post_type/custom_post_type_lang.php');
}

if(file_exists(TT_MODULES_FOLDER_PATH . 'custom_post_type/custom_post_type.php'))
{
	include_once(TT_MODULES_FOLDER_PATH.'custom_post_type/custom_post_type.php');
}

if(file_exists(TT_MODULES_FOLDER_PATH . 'coupon/function_coupon.php'))
{
	include_once (TT_MODULES_FOLDER_PATH . 'coupon/function_coupon.php');
}

if(file_exists(TT_MODULES_FOLDER_PATH . 'paymethods/paymethods_functons.php'))
{
	include_once (TT_MODULES_FOLDER_PATH . 'paymethods/paymethods_functons.php');
}

if(file_exists(TT_MODULES_FOLDER_PATH . 'package/db_package.php'))
{
	include_once (TT_MODULES_FOLDER_PATH . 'package/db_package.php');
}

if(file_exists(TT_MODULES_FOLDER_PATH . 'notifications/notification_functions.php'))
{
	include_once (TT_MODULES_FOLDER_PATH . 'notifications/notification_functions.php');
}

if(file_exists(TT_MODULES_FOLDER_PATH . 'manage_city/city_functions.php'))
{
	include_once (TT_MODULES_FOLDER_PATH . 'manage_city/city_functions.php');
}

if(file_exists(TT_MODULES_FOLDER_PATH . 'bulk_upload/bulk_upload_function.php'))
{
	include_once (TT_MODULES_FOLDER_PATH . 'bulk_upload/bulk_upload_function.php');
}

if(file_exists(TT_MODULES_FOLDER_PATH . 'manage_custom_fields/post_custom_settings.php'))
{
	include_once(TT_MODULES_FOLDER_PATH . 'manage_custom_fields/post_custom_settings.php');
}
?>