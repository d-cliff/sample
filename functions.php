<?php
// Child Theme Version
define('CHILD_THEME_VERSION', '1.0.0');

// Adding Styles
function twentytwentyfive_child_enqueue_styles() {
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('animations-style', get_stylesheet_directory_uri() . '/css/animations.css', array(), CHILD_THEME_VERSION);
}
add_action('wp_enqueue_scripts', 'twentytwentyfive_child_enqueue_styles');

// Current Date and Time Shortcode for Central Time
function custom_current_date_shortcode() {
    $date = new DateTime('now', new DateTimeZone('America/Chicago'));

    return $date->format('n/d/Y');
}
add_shortcode('current_date', 'custom_current_date_shortcode');

// Add custom logo to admin bar
function custom_admin_bar_logo() {
    global $wp_admin_bar;

    $wp_admin_bar->add_node([
        'id'    => 'custom-logo',
        'title' => '<img src="' . esc_url('/wp-content/uploads/2025/08/dylan-cliff-headshot.webp') . '" alt="Admin Area Logo" style="height: 22px; padding: 5px 0;" />',
        'href'  => home_url(),
        'meta'  => [
            'class' => 'custom-admin-logo',
        ],
    ]);
}
add_action('admin_bar_menu', 'custom_admin_bar_logo', 10);

// Remove WordPress Logo from admin bar
function remove_wordpress_logo_admin_bar() {
    global $wp_admin_bar;

    $wp_admin_bar->remove_node('wp-logo');
}
add_action('admin_bar_menu', 'remove_wordpress_logo_admin_bar', 999);