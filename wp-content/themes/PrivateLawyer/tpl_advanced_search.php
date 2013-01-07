<?php
/*
Template Name: Page - Advanced Search
*/
?>
<?php
add_action('wp_head','templ_header_tpl_advsearch');
function templ_header_tpl_advsearch()
{
	?>
	<script>var rootfolderpath = '<?php echo bloginfo('template_directory');?>/images/';</script>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/dhtmlgoodies_calendar.js"></script>
    <?php
}
?>
<?php get_header(); ?>
<div class="breadcrumb_box clearfix">
     <?php templ_page_title_above(); //page title above action hook?>
     <div class="content-title">
      <?php echo templ_page_title_filter(get_the_title()); //page tilte filter?>
     </div>
      <?php templ_page_title_below(); //page title below action hook?>
</div>
 <div class="shadowbox"></div>
<?php
$file = TT_TPL_ROOT_PATH."tpl_advanced_search_page.php";
$arg=array('default'=>'Page 2 column - Left Sidebar');
templ_the_content($file,$arg);
?>
<?php get_footer(); ?>