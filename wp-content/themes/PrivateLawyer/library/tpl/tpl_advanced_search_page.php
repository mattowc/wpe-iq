<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('page_content_above')){?>
<?php } else {?>
<?php }?>
<?php if ( have_posts() ) : ?>
<?php while ( have_posts() ) : the_post(); ?>
<?php $post_images = bdw_get_images($post->ID,'large'); ?>
<div class="entry">
  <div <?php post_class('single clear'); ?> id="post_<?php the_ID(); ?>">
     <div class="post-content">
      <?php endwhile; ?>
      <?php endif; ?>
      <div id="advancedsearch">
        <h4> <?php _e('Search this website','templatic') ?></h4>
        <script type="text/javascript" >
			function sformcheck()
			{
			if(document.getElementById('adv_s').value=="")
			{
				alert('<?php _e('Please enter word you want to search','templatic') ?>');
				document.getElementById('adv_s').focus();
				return false;
			}
			return true;
			}
		</script>
        <form method="get"  action="<?php bloginfo('url'); ?>" name="searchform" onsubmit="return sformcheck();">
          <div class="advanced_left">
            <p>
              <input class="adv_input" name="s" id="adv_s" type="text" onfocus="if(this.value=='Search') this.value='';" onblur="if(this.value=='') this.value='Search';" value="Search" />
            </p>
            <p>
              <?php wp_dropdown_categories( array('name' => 'catdrop','orderby'=> 'name','show_option_all' => 'select category') ); ?>
            </p>
            <p>
              <label>
                <?php _e('Date','templatic');?>
                <input name="todate" type="text" class="textfield" />
                <img src="<?php echo bloginfo('template_directory');?>/images/cal.gif" alt="Calendar" onclick="displayCalendar(document.searchform.todate,'yyyy-mm-dd',this)"  />
                <?php _e('<span>to</span>','templatic');?>
                <input name="frmdate" type="text" class="textfield"  />
                <img src="<?php echo bloginfo('template_directory');?>/images/cal.gif" alt="Calendar"  onclick="displayCalendar(document.searchform.frmdate,'yyyy-mm-dd',this)"  /></label>
            </p>
            <p>
              <label>
                <?php _e('Author','templatic');?>
                <input name="articleauthor" type="text" class="textfield"  />
                <span>
                <?php _e('Exact author','templatic');?>
                </span>
                <input name="exactyes" type="checkbox" value="1" />
              </label>
            </p>
          </div>
          <input type="submit" value="Submit" class="adv_submit" />
        </form>
      </div>
    </div>
  </div>
</div>
<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('page_content_below')){?>
<?php }?>