<?php
/*
Template Name: Page - Gallery
*/
?>
<?php
add_action('wp_head','templ_header_tpl_gallery');
function templ_header_tpl_gallery()
{
	?>
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
    <script type="text/javascript">
    var $n = jQuery.noConflict();
        $n(document).ready(function() {    
            $n("a[rel=example_group]").fancybox({
                'transitionIn'		: 'none',
                'transitionOut'		: 'none',
                'titlePosition' 	: 'over',
                'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
                    return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
                }
            });    
        });
    </script> 
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
$file = TT_TPL_ROOT_PATH."tpl_gallery_page.php";
$arg=array('default'=>'Page 2 column - Left Sidebar');
templ_the_content($file,$arg);
?>
<?php get_footer(); ?>