<div class="banner-wrap">
    <?php if (get_field('banner_heading')) { ?>
        <div class="inner-banner" style="background-image: url('<?php echo the_field('global_banner', 'options'); ?>')">
            <div class="container">
                <div class="banner-title"> <?php the_field('banner_heading'); ?> </div>
            </div>
        </div>
    <?php } else { ?>
        <div class="inner-banner global_banner" style="background-image: url('<?php echo the_field('global_banner', 'options'); ?>')">
            <div class="container">
                <div class="banner-title">
                    <?php
                    if (is_singular('post')):
                      the_field('global_title', 'options');
                    elseif (!is_front_page() && is_home()):
                        the_field('global_title', 'options');
                    elseif (is_singular('cases')):
                        echo "Case Results";
                    elseif ((is_tax())):
                        $current_page = get_queried_object();
                        echo $category = $current_page->name;
                    elseif (is_search()):
                        echo 'Search Result...';
                    elseif (is_404()):
                        echo 'ERROR 404';
                    elseif (get_field('global_title', 'options')):
                        the_field('global_title', 'options');
                    else:
                        the_title();
                    endif;
                    ?>
                </div> 
            </div>
        </div>
    <?php } ?>
</div>