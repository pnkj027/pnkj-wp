<div class="blog-loop">
    <div class="blog-content-wrap">
        <?php if (!is_search()) { ?>
            <?php $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full'); ?>  
            <a href="<?php the_permalink(); ?>" class="blog-img-link">
                <?php if ($thumb) { ?>
                    <img src="<?php bloginfo('template_directory'); ?>/img/must/spacer.gif" style="background-image: url('<?php echo $thumb['0']; ?>');" class="featured-img-blog" alt="<?php the_title(); ?>">
                <?php } else { ?>
                    <img src="<?php bloginfo('template_directory'); ?>/img/must/spacer.gif" style="background-image: url('<?php bloginfo('template_directory'); ?>/img/default.jpg');" class="no-feature" alt="<?php the_title(); ?>">
                <?php } ?>
            </a>                                   
        <?php } ?>
        <div class="bottom-wrap">
            <div class="blog-title title">
                <?php the_title(); ?>
            </div>
            <a href="<?php the_permalink(); ?>" class="blog-content">
                <?php
                echo wp_trim_words(get_the_content(), 20, '...');
                ?>
            </a>
            <a href="<?php the_permalink(); ?>" class="blog-btn">  
                READ MORE 
            </a>
        </div>
    </div>
</div>