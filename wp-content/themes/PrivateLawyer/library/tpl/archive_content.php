<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('page_content_above')){?>
<?php } else {?>
<?php }?>
<?php get_template_part('loop'); ?>
<?php get_template_part('pagination'); ?>
<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('page_content_below')){?>
<?php } else {?>
<?php }?>
