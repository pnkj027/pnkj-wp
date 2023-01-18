<?php get_header(); ?>
<?php include get_template_directory() . '/inc/banners/banner-inner.php'; ?>
<div class="blog-section section-pd">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="blog-single-row loadmore list-style">
                    <?php
                    while (have_posts()) : the_post();
                        get_template_part('inc/blog/blog', 'single');
                    endwhile;
                    ?>
                </div> 
            </div>
            <div class="col-lg-4">
                <?php get_template_part('inc/blog/blog', 'sidebar'); ?>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
