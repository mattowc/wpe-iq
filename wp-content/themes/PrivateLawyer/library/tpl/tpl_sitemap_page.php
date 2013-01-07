<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('page_content_above')){?>
<?php } else {?>
<?php }?>
<?php if ( have_posts() ) : ?>
<?php while ( have_posts() ) : the_post(); ?>
<?php $post_images = bdw_get_images($post->ID,'large'); ?>

<div class="entry">
  <div <?php post_class('single clear'); ?> id="post_<?php the_ID(); ?>">
     
    <div class="post-content">
      <div class="arclist">
        <h3><?php _e('Pages','templatic');?></h3>
        <ul>
          <?php wp_list_pages('title_li='); ?>
        </ul>
      </div>
      <!--/arclist -->
      <div class="arclist">
        <h3><?php _e('Posts','templatic');?></h3>
        <ul>
          <?php $archive_query = new WP_Query('showposts=60');
            while ($archive_query->have_posts()) : $archive_query->the_post(); ?>
          <li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
            <?php the_title(); ?>
            </a> <span class="arclist_comment">
            <?php comments_number('0 comment', '1 comment', '% comments'); ?>
            </span></li>
          <?php endwhile; ?>
        </ul>
      </div>
      <!--/arclist -->
      <div class="arclist">
        <h3><?php _e('Archives','templatic');?></h3>
        <ul>
          <?php wp_get_archives('type=monthly'); ?>
        </ul>
      </div>
      <!--/arclist -->
      <div class="arclist">
        <h3><?php _e('Categories','templatic');?></h3>
        <ul>
          <?php wp_list_categories('title_li=&hierarchical=0&show_count=1') ?>
        </ul>
      </div>
      <!--/arclist -->
      <div class="arclist">
        <h3><?php _e('Meta','templatic');?></h3>
        <ul>
          <li><a href="<?php bloginfo('rdf_url'); ?>" title="RDF/RSS 1.0 feed">
          <acronym title="Resource Description Framework">RDF</acronym>/<acronym title="Really Simple Syndication">RSS</acronym> 1.0 feed</a></li>
          <li><a href="<?php bloginfo('rss_url'); ?>" title="RSS 0.92 feed"><acronym title="Really Simple Syndication">RSS</acronym> 0.92 feed</a></li>
          <li><a href="<?php bloginfo('rss2_url'); ?>" title="RSS 2.0 feed"><acronym title="Really Simple Syndication">RSS</acronym> 2.0 feed</a></li>
          <li><a href="<?php bloginfo('atom_url'); ?>" title="Atom feed">Atom feed</a></li>
        </ul>
      </div>
      <!--/arclist -->
    </div>
    <div class="post-footer">
      <?php the_tags(__('<strong>Tags: </strong>','templatic'), ', '); ?>
    </div>
  </div>
</div>
<?php endwhile; ?>
<?php endif; ?>
<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('page_content_below')){?>
<?php } else {?>
<?php }?>
