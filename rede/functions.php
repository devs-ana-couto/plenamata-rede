<?php
function register_navwalker() {
    require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';
}

add_action('after_setup_theme', 'register_navwalker');
add_filter('nav_menu_link_attributes', 'prefix_bs5_dropdown_data_attribute', 20, 3);
function prefix_bs5_dropdown_data_attribute($atts, $item, $args) {
    if (is_a($args->walker, 'WP_Bootstrap_Navwalker')) {
        if (array_key_exists('data-toggle', $atts)) {
            unset($atts['data-toggle']);
        }
    }
    return $atts;
}

load_theme_textdomain( 'pl-rede', TEMPLATEPATH.'/languages' );

add_theme_support('post-thumbnails');

function load_scripts() {
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/frameworks/css/bootstrap.min.css');
    wp_enqueue_style('owl', get_template_directory_uri() . '/assets/css/owl.carousel.css');
    wp_enqueue_style('style', get_template_directory_uri() . '/assets/css/style.css');

    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/frameworks/js/bootstrap.min.js', array('jquery'), '1.0', true );
    wp_enqueue_script( 'owl', get_template_directory_uri() . '/assets/frameworks/js/owl.carousel.js', array('jquery'), '1.0', true );
    wp_enqueue_script( 'plenamata-rede', get_template_directory_uri() . '/assets/js/index.js', array('jquery'), '1.0', true );
}
add_action('wp_enqueue_scripts', 'load_scripts');


require_once(get_template_directory() . '/inc/carrossel_home.php');
require_once(get_template_directory() . '/inc/calendario.php');
require_once(get_template_directory() . '/inc/theme.options.php');
require_once(get_template_directory() . '/inc/page.builder/page.builder.php');
require_once(get_template_directory() . '/libs/Mobile_Detect.php');

$detect = new Mobile_Detect;
