<?php get_header(); ?>
<div class="breadcrumb_box clearfix">
     <?php templ_page_title_above(); //page title above action hook?>
     <div class="content-title">
       <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
  <?php /* If this is a category archive */ if (is_category()) { ?>
  <?php $ptitle=sprintf(__('%s','templatic'), single_cat_title('', false)); ?>
  <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
  <?php $ptitle=sprintf(__('Posts tagged &quot;%s&quot;','templatic'), single_tag_title('', false) ); ?>
  <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
  <?php $ptitle=sprintf(__('Daily archive %s','templatic'), get_the_time(__('M j, Y','templatic'))); ?>
  <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
  <?php $ptitle=sprintf(__('Monthly archive %s','templatic'), get_the_time('F, Y')); ?>
  <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
  <?php $ptitle=sprintf(__('Yearly archive %s','templatic'), get_the_time('Y')); ?>
  <?php /* If this is an author archive */ } elseif (is_author()) { ?>
  <?php $ptitle= __('Author Archive','templatic'); ?>
  <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
    <?php $ptitle=__('Blog Archives','templatic'); ?>
    <?php } ?>
  <?php echo templ_page_title_filter($ptitle); //page tilte filter?> <a href="javascript: void(0);" id="mode"<?php if ($_COOKIE['mode'] == 'grid') echo ' class="flip"'; ?>></a>
     </div>
      <?php templ_page_title_below(); //page title below action hook?>
</div>
 <div class="shadowbox"></div>  
<?php 
$file = TT_TPL_ROOT_PATH."archive_content.php";
$arg=array('default'=>'Page 2 column - Left Sidebar');
templ_the_content($file,$arg);
?>
<?php get_footer(); ?>