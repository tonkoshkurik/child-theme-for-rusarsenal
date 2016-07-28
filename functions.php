<?php
function understrap_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );

add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 12;' ), 20 );

function wc_remove_related_products( $args ) {
    return array();
}
add_filter('woocommerce_related_products_args','wc_remove_related_products', 10);

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . '/css/child-theme.css', array());
    wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . '/js/child-theme.min.js', array(), '0.1.0', true );
}
    if (function_exists('register_sidebar')) {
    	register_sidebar(array(
    		'name'=> 'Top Tabs',
    		'id' => 'top_tabs',
    		'before_widget' => '<li id="%1$s" class="widget %2$s">',
    		'after_widget' => '</li>',
    		'before_title' => '<h2 class="offscreen">',
    		'after_title' => '</h2>',
    	));
    	register_sidebar(array(
    		'name'=> 'Top Sidebar',
    		'id' => 'top_sidebar',
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget' => '</div>',
    		'before_title' => '<h3>',
    		'after_title' => '</h3>',
    	));
    	register_sidebar(array(
    		'name'=> 'WooCommerce Cart',
    		'id' => 'woo_cart',
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget' => '</div>',
    		'before_title' => '<h3 class="hidden">',
    		'after_title' => '</h3>',
    	));
    	register_sidebar(array(
    		'name'=> 'Right Sidebar',
    		'id' => 'right_sidebar',
    		'before_widget' => '<li id="%1$s" class="widget %2$s">',
    		'after_widget' => '</li>',
    		'before_title' => '<h3>',
    		'after_title' => '</h3>',
    	));
        register_sidebar(array(
            'name'=> 'Right Footer info',
            'id' => 'right_footer',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3>',
            'after_title' => '</h3>',
        ));
    }
