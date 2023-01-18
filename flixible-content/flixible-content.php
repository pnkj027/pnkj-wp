<?php get_header(); ?>
<?php include get_template_directory() . '/inc/banners/banner-inner.php'; ?>
<div class="static-page section-pd fullwidth">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 static-page-details list-style">
                <div class="default_content">
                    <?php
                    while (have_posts()): the_post();
                        the_content();
                    endwhile;
                    ?>
                </div>

                <div class="flixible_content">
                    <?php if (have_rows('flexible_content')): ?>
                        <?php while (have_rows('flexible_content')): the_row(); ?>
                            <?php if (get_row_layout() == 'normal_content'): ?>
                                <div class="normal_content">
                                    <?php the_sub_field('simple_paragraph'); ?>
                                </div>
                                <?php
                            elseif (get_row_layout() == 'content_with_image'):
                                $image = get_sub_field('image');
                                $content = get_sub_field('content');
                                if ($image):
                                    ?>
                                    <div class="content_with_image">
                                        <?php if ($image): ?>
                                            <div class="image_wrap">
                                                <?php echo wp_get_attachment_image($image['ID'], 'full'); ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if ($content): ?>
                                            <div class="content_wrap">
                                                <?php echo $content; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <?php
                                endif;
                                ?>
                                <?php
                            elseif (get_row_layout() == 'image_with_content'):
                                $image = get_sub_field('image');
                                $content = get_sub_field('content');
                                if ($image):
                                    ?>
                                    <div class="content_with_image">
                                        <?php if ($content): ?>
                                            <div class="content_wrap">
                                                <?php echo $content; ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if ($image): ?>
                                            <div class="image_wrap">
                                                <?php echo wp_get_attachment_image($image['ID'], 'full'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <?php
                                endif;
                            endif;
                            ?>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>