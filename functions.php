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

// adding first and last name to email subject
function skyverge_add_customer_to_email_subject( $subject, $order ) {
    $subject .= ' от ' . $order->billing_first_name . ' ' . $order->billing_last_name;
    return $subject;

}
add_filter( 'woocommerce_email_subject_new_order', 'skyverge_add_customer_to_email_subject', 10, 2 );

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . '/css/child-theme.css', array());
    wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . '/js/child-theme.min.js', array(), '0.1.0', true );
    wp_enqueue_script( 'jquery', get_template_directory_uri() . 'https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js', array(), '1.12.4', true );
}

    if (function_exists('register_sidebar')) {
    	// register_sidebar(array(
    	// 	'name'=> 'Top Tabs',
    	// 	'id' => 'top_tabs',
    	// 	'before_widget' => '<li id="%1$s" class="widget %2$s">',
    	// 	'after_widget' => '</li>',
    	// 	'before_title' => '<h2 class="offscreen">',
    	// 	'after_title' => '</h2>',
    	// ));
    	register_sidebar(array(
    		'name'=> 'Top Sidebar',
    		'id' => 'top_sidebar',
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget' => '</div>',
    		'before_title' => '<h3>',
    		'after_title' => '</h3>',
    	));
    	// register_sidebar(array(
    	// 	'name'=> 'WooCommerce Cart',
    	// 	'id' => 'woo_cart',
    	// 	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	// 	'after_widget' => '</div>',
    	// 	'before_title' => '<h3 class="hidden">',
    	// 	'after_title' => '</h3>',
    	// ));
    	// register_sidebar(array(
    	// 	'name'=> 'Right Sidebar',
    	// 	'id' => 'right_sidebar',
    	// 	'before_widget' => '<li id="%1$s" class="widget %2$s">',
    	// 	'after_widget' => '</li>',
    	// 	'before_title' => '<h3>',
    	// 	'after_title' => '</h3>',
    	// ));
        register_sidebar(array(
            'name'=> 'Right Footer info',
            'id' => 'right_footer',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3>',
            'after_title' => '</h3>',
        ));
    }
// custom filds for price

// Display Fields
add_action( 'woocommerce_product_options_general_product_data', 'woo_add_custom_general_fields' );

// Save Fields
add_action( 'woocommerce_process_product_meta', 'woo_add_custom_general_fields_save' );

function woo_add_custom_general_fields() {

  global $woocommerce, $post;
  
  echo '<div class="options_group">';
  
  echo 'Оптовую цену введите в поле "Базовая цена (Р)"(выше), остальные ценовые диапазоны ниже.';
    // От 50 тыс.р.
    woocommerce_wp_text_input( 
        array( 
            'id'          => '_from_fifty_thousand', 
            'label'       => __( 'От 50 тыс.р.', 'woocommerce' ), 
            'placeholder' => '',
            'desc_tip'    => 'true',
            'description' =>  'Введите цену здесь'
        )
    );
    // По запросу
    woocommerce_wp_text_input( 
        array( 
            'id'          => '_on_request', 
            'label'       => __( 'По запросу', 'woocommerce' ), 
            'placeholder' => '',
            'desc_tip'    => 'true',
            'description' =>  'Введите цену здесь'
        )
    );
    // Под заказ
    woocommerce_wp_text_input( 
        array( 
            'id'          => '_by_order', 
            'label'       => __( 'Под заказ', 'woocommerce' ), 
            'placeholder' => '',
            'desc_tip'    => 'true',
            'description' => 'Введите цену здесь'
        )
    );
  echo '</div>';
    
}

// Save fields
function woo_add_custom_general_fields_save( $post_id ){
    
    // От 50 тыс.р.
    $woocommerce_text_field = $_POST['_from_fifty_thousand'];
    if( !empty( $woocommerce_text_field ) )
        update_post_meta( $post_id, '_from_fifty_thousand', esc_attr( $woocommerce_text_field ) );
    // По запросу    
    $woocommerce_text_field = $_POST['_on_request'];
    if( !empty( $woocommerce_text_field ) )
        update_post_meta( $post_id, '_on_request', esc_attr( $woocommerce_text_field ) );
    // Под заказ
    $woocommerce_text_field = $_POST['_by_order'];
    if( !empty( $woocommerce_text_field ) )
        update_post_meta( $post_id, '_by_order', esc_attr( $woocommerce_text_field ) );
            
}

add_filter( 'woocommerce_product_tabs', 'sb_woo_remove_reviews_tab', 98);
function sb_woo_remove_reviews_tab($tabs) {

 unset($tabs['reviews']);

 return $tabs;
}