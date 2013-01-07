<?php if (get_option('ptthemes_pagination') != 'AJAX-fetching posts') : ?>
    <div class="pagination">
        <?php previous_posts_link(__('Previous Page')); ?>
        <?php next_posts_link(__('Next Page')); ?>
        <?php if (function_exists('wp_pagenavi')) wp_pagenavi(); ?>
    </div>
    <?php else : ?>
    <div id="pagination"><?php next_posts_link(__('LOAD MORE')); ?></div>
<?php endif; ?>