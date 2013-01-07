<?php
global $current_user;
if(isset($_GET['author_name'])) :
	$curauth = get_userdatabylogin($author_name);
else :
	$curauth = get_userdata(intval($author));
endif;
?>
<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('page_content_above')){?>
<?php } else {?>
<?php }?>

<?php get_template_part('loop'); ?>
<?php get_template_part('pagination'); ?>
<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('page_content_below')){?>
<?php } else {?>
<?php }?>
