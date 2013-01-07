<?php get_header(); ?>
<div class="breadcrumb_box clearfix">
     <?php templ_page_title_above(); //page title above action hook?>
    <div class="content-title"> 
<?php echo templ_page_title_filter( $current_user->display_name); //page tilte filter?> 
<a href="javascript: void(0);" id="mode"<?php if ($_COOKIE['mode'] == 'grid') echo ' class="flip"'; ?>></a> 
</div>
      <?php templ_page_title_below(); //page title below action hook?>
</div>
 <div class="shadowbox"></div> 
<?php 
$file = TT_TPL_ROOT_PATH."author_content.php";
$arg=array('default'=>'Page 2 column - Left Sidebar');
templ_the_content($file,$arg);
?>
<?php get_footer(); ?>