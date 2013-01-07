<?php
$ptthemes_fonts = get_option('ptthemes_fonts');
$body_background_color = get_option('ptthemes_body_background_color');
$body_background_image = get_option('ptthemes_body_background_image');
$body_bg_postions = get_option('ptthemes_body_bg_postions');
$link_color_normal = get_option('ptthemes_link_color_normal');
$main_title_color = get_option('ptthemes_main_title_color');
$button_normal = get_option('ptthemes_button_normal');
$button_hover = get_option('ptthemes_button_hover');
?>
<style type="text/css">
body, input, textarea, select { 
<?php if(get_option('ptthemes_fonts')){?>
font-family:<?php echo get_option('ptthemes_fonts');?>; 
<?php }?>
background: <?php if(get_option('ptthemes_body_background_color')){ echo get_option('ptthemes_body_background_color'); }?>  <?php if(get_option('ptthemes_body_background_image')){?>url(<?php echo get_option('ptthemes_body_background_image');?>)<?php }?> <?php if(get_option('ptthemes_body_bg_postions')){ echo get_option('ptthemes_body_bg_postions');}?>; }

<?php if(get_option('ptthemes_link_color_normal')){?>
a { color:<?php echo get_option('ptthemes_link_color_normal');?> !important;  }
<?php }?>
<?php if(get_option('ptthemes_link_color_hover')){?>
a:hover { color:<?php echo get_option('ptthemes_link_color_hover');?> !important;   }
<?php }?>

<?php if(get_option('ptthemes_main_title_color')){?>
h1, h2, h3, h4, h5, h6 { color:<?php echo get_option('ptthemes_main_title_color');?> !important; }
<?php }?>
</style>