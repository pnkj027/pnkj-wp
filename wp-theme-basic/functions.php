<?php

/* Set Featured Image for pages */
add_theme_support('post-thumbnails', array('post', 'page'));

/* Featured Image URL */

function featured_img_url($mdw_featured_img_size, $id = NULL) {
    if ($id != NULL) {
        $mdw_image_id = get_post_thumbnail_id($id);
    } else {
        $mdw_image_id = get_post_thumbnail_id();
    }
    $mdw_image_url = wp_get_attachment_image_src($mdw_image_id, $mdw_featured_img_size);
    $mdw_image_url = $mdw_image_url[0];
    return $mdw_image_url;
}

/* logo */
/** use to add the logo through Customize option * */
define('theme_dir', get_template_directory_uri());

/* Custom Menus */
register_nav_menus(array(
    'primary' => __('Primary Navigation', 'header-nav'),
    'footer' => __('Footer Navigation', 'footer-nav')
));

/* Adding link-item for bootstrap4 menu */

function add_classes_on_li($classes) {
    $classes[] = 'nav-item';
    return $classes;
}

add_filter('nav_menu_css_class', 'add_classes_on_li', 1, 3);

add_filter('nav_menu_link_attributes', function($atts) {
    $atts['class'] = "nav-link";
    return $atts;
}, 100, 1);


/* Wrap Div on Post image in Editor */

add_filter('image_send_to_editor', 'wp_image_wrap_init', 10, 8);

function wp_image_wrap_init($html, $id, $caption, $title, $align, $url, $size, $alt) {
    if ($align == none):
        return '<div id="wp-image-wrap-' . $id . '" class="wp-image-wrap overlay">' . $html . '</div>';
    else:
        return $html;
    endif;
}

//* Enable shortcodes in text widgets
add_filter('widget_text', 'do_shortcode');



/* Upload Folder URL */

function upload_url($file) {
    $url = bloginfo('url') . '/wp-content/uploads/' . $file;
    return $url;
}

//*Custome Thumbnail size*//

add_image_size('blogthumb_size', 760, 450, true);
add_image_size('custom_size_gallery', 1200, 600, true);

/* Custom post type archieve */

function my_custom_post_type_archive_where($where, $args) {
    $post_type = isset($args['post_type']) ? $args['post_type'] : 'post';
    $where = "WHERE post_type = '$post_type' AND post_status = 'publish'";
    return $where;
}

add_filter('getarchives_where', 'my_custom_post_type_archive_where', 10, 2);

/* Widgets */
if (function_exists('register_sidebar')) {
    register_sidebar(array(
        'name' => __('Main Sidebar', 'textdomain'),
        'id' => 'sidebar-1',
        'description' => __('Widgets in this area will be shown on all posts and pages.', 'textdomain'),
        'before_widget' => '<div id="%1$s" class="sidebar-widget fullwidth %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="h3">',
        'after_title' => '</div>',
    ));
}

//REMOVING THE TEXT '[.....] FROM EXCERPT
function new_excerpt_more($more) {
    return '<div class="clearfix"></div><a class="learnmore" href="' . get_permalink() . '">Read More</a>';
}

add_filter('excerpt_more', 'new_excerpt_more');

function excerpt($limit) {
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    if (count($excerpt) >= $limit) {
        array_pop($excerpt);
        $excerpt = implode(" ", $excerpt) . '.';
    } else {
        $excerpt = implode(" ", $excerpt);
    }
    $excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);
    return $excerpt;
}

function content($limit) {
    $content = explode(' ', get_the_content(), $limit);
    if (count($content) >= $limit) {
        array_pop($content);
        $content = implode(" ", $content) . '.';
    } else {
        $content = implode(" ", $content);
    }
    $content = preg_replace('/\[.+\]/', '', $content);
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    return $content;
}

// Blog excerpt word limit 
function custom_echo($x, $length) {
    if (strlen($x) <= $length) {
        echo $x;
    } else {
        $y = substr($x, 0, $length) . '.';
        echo $y;
    }
}

//Get First Image
function catch_that_image() {
    global $post, $posts;
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    $first_img = $matches[1][0];

    if (empty($first_img)) {
        $first_img = "";
    }
    return $first_img;
}

if (function_exists('add_theme_support')) {
    add_theme_support('post-thumbnails');
    // set_post_thumbnail_size(290, 170);
}


/* ===== Register and enqueue css ===== */

function enqueue_my_css() {
    wp_enqueue_style('Bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', false, 'all');
    wp_enqueue_style('owlCss', get_template_directory_uri() . '/css/owl.carousel.min.css', false, 'all');
    wp_enqueue_style('Font', get_template_directory_uri() . '/fonts/fonts.css', false, 'all');
    wp_enqueue_style('slick', get_template_directory_uri() . '/css/slick.css', false, 'all');
    wp_enqueue_style('slick', get_template_directory_uri() . '/css/slick-theme.css', false, 'all');
    wp_enqueue_style('StyleCss', get_template_directory_uri() . '/style.css', false, 'all');
    wp_enqueue_style('ResponsiveCss', get_template_directory_uri() . '/css/responsive.css', false, 'all');
}

add_action('wp_enqueue_scripts', 'enqueue_my_css');


/* ===== Register and enqueue js ===== */

function enqueue_my_script() {
    wp_enqueue_script('BootstrapJS', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), false, true);
    wp_enqueue_script('slick.min', get_template_directory_uri() . '/js/slick.min.js', array('jquery'), false, true);
    wp_enqueue_script('Owljs', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'), false, true);
    wp_enqueue_script('lazyJS', get_template_directory_uri() . '/js/jquery.lazy.min.js', array('jquery'), false, true);
    wp_enqueue_script('html5lightbox', get_template_directory_uri() . '/js/html5lightbox.js', array('jquery'), false, true);
    wp_enqueue_script('main', get_template_directory_uri() . '/js/main.js', array('jquery'), false, true);
}

add_action('wp_enqueue_scripts', 'enqueue_my_script');

//Badvalue error Handling 
remove_action('wp_head', 'rest_output_link_wp_head');

/* Remove type attribute */
add_filter('style_loader_tag', 'clean_style_tag');
add_filter('script_loader_tag', 'clean_script_tag');

/**
 * Clean up output of stylesheet <link> tags
 */
function clean_style_tag($input) {
    preg_match_all("!<link rel='stylesheet'\s?(id='[^']+')?\s+href='(.*)' type='text/css' media='(.*)' />!", $input, $matches);
    if (empty($matches[2])) {
        return $input;
    }
    // Only display media if it is meaningful
    $media = $matches[3][0] !== '' && $matches[3][0] !== 'all' ? ' media="' . $matches[3][0] . '"' : '';
    return '<link rel="stylesheet" href="' . $matches[2][0] . '"' . $media . '>' . "\n";
}

/**
 * Clean up output of <script> tags
 */
function clean_script_tag($input) {
    $input = str_replace("type='text/javascript' ", '', $input);
    return str_replace("'", '"', $input);
}

/* new theme options for header and footer */
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title' => 'Theme General Settings',
        'menu_title' => 'Theme Settings',
        'menu_slug' => 'theme-general-settings',
        'capability' => 'edit_posts',
        'redirect' => false
    ));
}

// For NAP 
function create_posttype() {
    register_post_type('nap', array(
        'labels' => array(
            'name' => __('NAP'),
            'singular_name' => __('nap')
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'nap'),
        'supports' => array('title', 'thumbnail'),
        'exclude_from_search' => true,
    ));

    register_post_type('testimonial', array(
        'labels' => array(
            'name' => __('Testimonials'),
            'singular_name' => __('Testimonial')
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'Testimonial'),
        'supports' => array('title', 'thumbnail', 'editor'),
    ));

    register_post_type('team', array(
        'labels' => array(
            'name' => __('Our Team'),
            'singular_name' => __('Our Teams')
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'teams'),
        'supports' => array('title', 'thumbnail', 'editor'),
    ));
}

add_action('init', 'create_posttype');


/* * **** taxonomy ***** */

//register_taxonomy('gallery-cat', 'gallery', array(
//    'hierarchical' => true,
//    'rewrite' => array(
//        'slug' => 'gallery-categories',
//        'with_front' => false,
//        'hierarchical' => true
//    ),
//));

function the_archive_count($links) {
    $links = str_replace('</a>&nbsp;(', '<span class="archiveCount">&nbsp;(', $links);
    $links = str_replace(')', ')</span> </a>', $links);
    return $links;
}

add_filter('get_archives_link', 'the_archive_count');
/* for archive list in sidebar end */

add_filter('disable_wpseo_json_ld_search', '__return_true');


/* for mobile */
add_filter('wp_is_mobile', 'mobile_edits');

function mobile_edits() {
    static $is_mobile;

    if (isset($is_mobile))
        return $is_mobile;

    if (empty($_SERVER['HTTP_USER_AGENT'])) {
        $is_mobile = false;
    } elseif (
            strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'Silk/') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false) {
        $is_mobile = true;
    } elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false && strpos($_SERVER['HTTP_USER_AGENT'], 'iPad') == false) {
        $is_mobile = true;
    } elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'iPad') !== false) {
        $is_mobile = false;
    } else {
        $is_mobile = false;
    }

    return $is_mobile;
}

/* * *current Class in Archive **** */

function theme_get_archives_link($link_html) {
    global $wp;
    static $current_url;
    if (empty($current_url)) {
        $current_url = add_query_arg($_SERVER['QUERY_STRING'], '', home_url($wp->request));
    }
    if (stristr($link_html, $current_url) !== false) {
        $link_html = preg_replace('/(<[^\s>]+)/', '\1 class="archive-active"', $link_html, 1);
    }
    return $link_html;
}

add_filter('get_archives_link', 'theme_get_archives_link');



/* * *current Class in Custom Archive **** */

function wpse_62509_current_month_selector($link_html) {
    if (is_month()) {
        $current_month = get_the_date("F Y");
        if (preg_match('/' . $current_month . '/i', $link_html))
            $link_html = preg_replace('/<li>/i', '<li class="archive-active">', $link_html);
    }
    return $link_html;
}

add_filter('get_archives_link', 'wpse_62509_current_month_selector');


/* for yoast website schema */

function bybe_remove_yoast_json($data) {
    $data = array();
    return $data;
}

add_filter('wpseo_json_ld_output', 'bybe_remove_yoast_json', 10, 1);

/* For Thank You Pages */

//add_action('wp_footer', 'redirect_cf7');

function redirect_cf7() {
    ?>
    <script>
        document.addEventListener('wpcf7mailsent', function (event) {
            if ('263' == event.detail.contactFormId) {
                location = '/thank-you-sidebar/';
            } else if ('286' == event.detail.contactFormId) {  //other or 404
                location = '/thank-you-error/';
            }else if ('5' == event.detail.contactFormId) {  //other or 404
                location = '/thank-you-home/';
            } else{
                  location = '/thank-you/';
            }
        }, false);
    </script>
    <?php

}

/* check browser */

function mv_browser_body_class($classes) {
    global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
    if ($is_lynx)
        $classes[] = 'lynx';
    elseif ($is_gecko)
        $classes[] = 'gecko';
    elseif ($is_opera)
        $classes[] = 'opera';
    elseif ($is_NS4)
        $classes[] = 'ns4';
    elseif ($is_safari)
        $classes[] = 'safari';
    elseif ($is_chrome)
        $classes[] = 'chrome';
    elseif ($is_IE) {
        $classes[] = 'ie';
        if (preg_match('/MSIE ([0-9]+)([a-zA-Z0-9.]+)/', $_SERVER['HTTP_USER_AGENT'], $browser_version))
            $classes[] = 'ie' . $browser_version[1];
    } else
        $classes[] = 'unknown';
    if ($is_iphone)
        $classes[] = 'iphone';
    if (stristr($_SERVER['HTTP_USER_AGENT'], "mac")) {
        $classes[] = 'osx';
    } elseif (stristr($_SERVER['HTTP_USER_AGENT'], "linux")) {
        $classes[] = 'linux';
    } elseif (stristr($_SERVER['HTTP_USER_AGENT'], "windows")) {
        $classes[] = 'windows';
    }
    return $classes;
}

add_filter('body_class', 'mv_browser_body_class');


// Remove WP Version From Styles	
add_filter('style_loader_src', 'sdt_remove_ver_css_js', 9999);
// Remove WP Version From Scripts
add_filter('script_loader_src', 'sdt_remove_ver_css_js', 9999);

// Function to remove version numbers
function sdt_remove_ver_css_js($src) {
    if (strpos($src, 'ver='))
        $src = remove_query_arg('ver', $src);
    return $src;
}

/* * ************************************* */
add_action('wp_head', 'header_script', 20);

function header_script() {
    if (get_field('header_script', 'option')):
        the_field('header_script', 'option');
    endif;
}

function footer_script() {
    if (get_field('footer_script', 'option')):
        the_field('footer_script', 'option');
    endif;
}

add_action('wp_footer', 'footer_script');

add_filter('use_block_editor_for_post', '__return_false');

/* * ************ */

/**
 * Disable the emoji's
 */
function disable_emojis() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

    // Remove from TinyMCE
    add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
}

add_action('init', 'disable_emojis');

/**
 * Filter out the tinymce emoji plugin.
 */
function disable_emojis_tinymce($plugins) {
    if (is_array($plugins)) {
        return array_diff($plugins, array('wpemoji'));
    } else {
        return array();
    }
}

/* * *********Svg Code*********** */

function enable_extended_upload($mime_types = array()) {
    $mime_types['svg'] = 'application/svg';
    return $mime_types;
}

add_filter('upload_mimes', 'enable_extended_upload');
