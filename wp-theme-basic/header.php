<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta name="google-site-verification" content="6t11WDUzoEpXkFE3_k8GunkvA8XynBTvXp0UHKTe9mM" />
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--[if lt IE 9]>
              <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
              <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <?php if (is_home() || is_front_page()) { ?>
            <title> Home | <?php bloginfo('name'); ?></title>
        <?php } else { ?>
            <title> <?php wp_title("", true); ?> </title>
        <?php } ?>
        <?php wp_enqueue_script('jquery'); ?>
        <script>
            var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
        </script>
        <?php if (get_field('favicon', 'option')) { ?> <link rel="shortcut icon" href="<?php the_field('favicon', 'option'); ?>" /><?php } ?>
        <?php the_field('header_script', 'options'); ?>
        <?php
            wp_head();
        ?>
    </head>
    <body <?php body_class(); ?>>
        <header id="header">
            <?php
            $header_logo = get_field('header_logo', 'option');
            $header_phone = get_field('header_phone', 'option');
            $phone_text = get_field('phone_text', 'option');
            ?>
            <div class="header-top">
                <div class="container">
                    <div class="row align-items-center justify-content-between">
                        <div class="header-left-logo">
                            <div class="logo-wrapper"> 
                                <?php if ($header_logo) { ?>   
                                    <a href="<?php echo site_url(); ?>"> <img class="main-logo" src="<?php the_field('header_logo', 'option'); ?>" alt="logo"></a>
                                <?php } ?>
                            </div> 
                        </div>
                        
                        <div class="nav-phone d-none d-lg-block">
                            <div class="header-phn-wrap">
                                <?php if ($header_phone) { ?> 
                                    <a href="tel:<?php echo preg_replace('/\D+/', '', $header_phone); ?>" class="call-num">
                                        <div class="ipad-phn-wrap">
                                            <div class="phone_number"> <?php echo $phone_text; ?> <?php echo $header_phone; ?> </div>
                                        </div>
                                    </a>
                                <?php } ?>
                            </div>
                            
                            <div class="navigation-wrap">
                                <?php if (!wp_is_mobile()) { ?>
                                    <div class="nav-menu menu-header"> 
                                        <?php
                                        wp_nav_menu(array(
                                            'menu' => 'Main-Menu', // Do not fall back to first non-empty menu.
                                            'menu_class' => 'menu-top',
                                            'theme_location' => 'primary',
                                            'container' => false,
                                        ));
                                        ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="menu-button d-lg-none d-xl-none">
                            <div class="menu-bar menu-bar-top"></div>
                            <div class="menu-bar menu-bar-middle"></div>
                            <div class="menu-bar menu-bar-bottom"></div>
                        </div>

                        <div class="menu-wrap d-lg-none d-xl-none">
                            <div class="menu-full-wrapper">
                                <div class="menu-sidebar">
                                    <?php
                                    wp_nav_menu(array(
                                        'menu' => 'Main-Menu', // Do not fall back to first non-empty menu.
                                        'theme_location' => '__no_such_location',
                                        'menu_id' => 'top-nav',
                                        'menu_class' => 'menu-bar-wrapper',
                                        'container' => '',
                                        'fallback_cb' => false // Do not fall back to wp_page_menu()
                                    ));
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div> 
            </div>
        </header>