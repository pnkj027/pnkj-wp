<?php get_header(); ?>
<?php include get_template_directory() . '/inc/banners/banner-inner.php'; ?>
<div class="static-page section-pd fullwidth">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 static-page-details list-style">
                <h1 class="heading"><?php the_title(); ?></h1>
                <?php
                while (have_posts()): the_post();
                    the_content();
                endwhile;
                ?>
            </div>

            <div class="col-lg-4 col-md-12">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>