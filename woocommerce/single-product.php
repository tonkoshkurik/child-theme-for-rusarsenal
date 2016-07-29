<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>
<div class="wrapper " id="woocommerce-wrapper">
    
    <div class="container">
    	<div class="row">
			<?php
				/**
				 * woocommerce_before_main_content hook.
				 *
				 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
				 * @hooked woocommerce_breadcrumb - 20
				 */
				// do_action( 'woocommerce_before_main_content' );
				woocommerce_breadcrumb();
				// print_r(get_the_terms( $post->ID, 'product_cat'));

				$descendant = get_the_terms( $post->ID, 'product_cat' );
		        $descendant = array_reverse($descendant);
		        $descendant = $descendant[0];
		        $descendant_id = $descendant->term_id;
 				$descendant_term = get_term_by("id", $descendant_id, "product_cat");
        		$descendant_link = get_term_link( $descendant_term->slug, $descendant_term->taxonomy );
        		echo '<div class="reutn_to_main">';
		        // echo '<a href="' . $descendant_link . '" class="descendant">' . $descendant->name . '</a>';
		        echo "<a href='{$descendant_link}' class='descendant'><i class='fa fa-reply'></i> {$descendant->name}</a>";
		        echo '</div>';
			?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php wc_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>

	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		// do_action( 'woocommerce_after_main_content' );
	?>

<!-- 	<?php
		/**
		 * woocommerce_sidebar hook.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		// do_action( 'woocommerce_sidebar' );
		// woocommerce_get_sidebar();
	?> -->

<?php get_footer( 'shop' ); ?>
