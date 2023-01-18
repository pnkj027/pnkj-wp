<?php get_header(); ?>
<?php include get_template_directory() . '/inc/banners/banner-inner.php'; ?>
<?php
$post_type = "";
if (isset($_GET['s'])) {
    $keyword = $_GET['s'];
}
if (isset($_GET['post_type'])) {
    $post_type = $_GET['post_type'];
}
?>
<?php if ($keyword && $post_type == "post") { ?>
    <div class="fullwidth section-pd blog-page" id="searchPage">           
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8 col-sm-12"> 
                    <header class="page-header fullwidth">
                        <?php if (have_posts()) : ?>
                            <h2 class="page-title"><?php printf(__('Search Results for: %s', ''), '<span>' . get_search_query() . '</span>'); ?></h2>
                        <?php else : ?>
                            <h2 class="page-title"><?php _e('Nothing Found', ''); ?></h2>
                        <?php endif; ?>
                    </header><!-- .page-header -->
                    <div class="search_result blog-page fullwidth">
                        <?php if (have_posts()) : ?>
                            <div class="blog-listing-row loadmore">
                                <?php
                                while (have_posts()) : the_post();
                                    get_template_part('inc/blog/blog', 'search');
                                endwhile;
                                ?>
                            </div>
                            <div class="fullwidth">
                                <?php load_more_button(); ?>
                            </div>
                        <?php else:
                            ?>
                            <p><?php _e('Sorry No Result Found. Please try a different search term', ''); ?> <a href="<?php echo esc_url(home_url('/')); ?>" class="click-here">click here</a> for back to home.</p>
                        <?php
                        endif;
                        ?>
                    </div>
                </div> 
                <div class="col-lg-4">
                    <?php get_template_part('inc/blog/blog', 'sidebar'); ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($keyword && empty($post_type) || $keyword && $post_type == "undefined" || $keyword && $post_type == "") { ?>
    <div class="fullwidth section-pd blog-page" id="searchPage">           
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8 col-sm-12"> 
                    <header class="page-header fullwidth">
                        <?php if (have_posts()) : ?>
                            <h2 class="page-title"><?php printf(__('Search Results for: %s', ''), '<span>' . get_search_query() . '</span>'); ?></h2>
                        <?php else : ?>
                            <h2 class="page-title"><?php _e('Nothing Found', ''); ?></h2>
                        <?php endif; ?>
                    </header><!-- .page-header -->
                    <div class="search_result blog-page fullwidth">
                        <?php if (have_posts()) : ?>
                            <div class="blog-listing-row loadmore">
                                <?php
                                while (have_posts()) : the_post();
                                    get_template_part('inc/blog/blog', 'search');
                                endwhile;
                                ?>
                            </div>
                            <div class="fullwidth">
                                <?php load_more_button(); ?>
                            </div>
                        <?php else:
                            ?>
                            <p><?php _e('Sorry No Result Found. Please try a different search term', ''); ?> <a href="<?php echo esc_url(home_url('/')); ?>" class="click-here">click here</a> for back to home.</p>
                        <?php
                        endif;
                        ?>
                    </div>
                </div> 
                <div class="col-lg-4">
                    <?php get_sidebar(); ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php
get_footer();
