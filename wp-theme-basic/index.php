<?php get_header(); ?>
<?php include get_template_directory() . '/inc/banners/banner-inner.php'; ?>
<div class="blog-page section-pd">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="blog-listing-row loadmore">
                    <?php
                    while (have_posts()) : the_post();
                        get_template_part('inc/blog/blog', 'loop');
                    endwhile;
                    ?>
                </div> 
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>