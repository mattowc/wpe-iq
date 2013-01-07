<?php
define('TEMPL_FRAMWORK_CHANGE_LOG_PATH','http://templatic.com/updates/change_log.txt');
define('TEMPL_FRAMWORK_ZIP_FOLDER_PATH','http://templatic.com/updates/framework.zip');
define('TEMPL_FRAMWORK_CURRENT_VERSION','1.0.1');
define('TT_FRAMEWORK_FOLDER_PATH',TT_ADMIN_FOLDER_PATH);

if(file_exists(TT_ADMIN_FOLDER_PATH . 'constants.php')){
include_once(TT_ADMIN_FOLDER_PATH.'constants.php');  //ALL CONSTANTS FILE INTEGRATOR
}

include_once(TT_ADMIN_FOLDER_PATH.'admin_menu.php');
if(strtolower(get_option('ptthemes_use_third_party_data'))=='no' && strtolower(get_option('pttheme_seo_hide_fields'))=='no')
{
	include_once(TT_ADMIN_FOLDER_PATH.'seo_settings.php');
}
if(file_exists(TT_ADMIN_FOLDER_PATH . 'theme_options/option_settings.php'))
{
	include_once(TT_ADMIN_FOLDER_PATH . 'theme_options/option_settings.php');
}
if(file_exists(TT_ADMIN_FOLDER_PATH . 'theme_options/functions/functions.load.php'))
{
	include_once(TT_ADMIN_FOLDER_PATH.'theme_options/functions/functions.load.php');
}

include_once(TT_ADMIN_FOLDER_PATH.'functions/custom_functions.php');
include_once(TT_ADMIN_FOLDER_PATH.'functions/hooks.php');
include_once(TT_ADMIN_FOLDER_PATH.'functions/manage_post_custom_fields.php');
include_once(TT_ADMIN_FOLDER_PATH.'functions/tpl_control.php');
include_once (TT_ADMIN_FOLDER_PATH . 'breadcrumbs/yoast-canonical.php'); //BREAD CRUMS RELATED FILE FOR WP-ADMIN SETTINGS
include_once (TT_ADMIN_FOLDER_PATH . 'breadcrumbs/yoast-breadcrumbs.php'); //BREAD CRUMS RELATED FILE FOR FRONT END
?>