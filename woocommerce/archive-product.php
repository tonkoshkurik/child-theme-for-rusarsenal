<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
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
 * @version     2.0.0
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
		 * @hooked woocommerce_output_content_wrapper - 12 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
	 	// do_action( 'woocommerce_before_main_content' );
		woocommerce_breadcrumb()
	?>
        	<?php
		/**
		 * woocommerce_sidebar hook.
		 *
		 * @hooked woocommerce_get_sidebar - 12
		 */
		do_action( 'woocommerce_sidebar' );
	?>
	   <div id="primary" class="col-md-9 content-area">
	   
            <main id="main" class="site-main" role="main">


		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

			<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>

		<?php endif; ?>
			
			<?php if ( get_bloginfo( 'description' )  !== '' AND is_shop() ) { ?>
			    <p class="site-description"><?php bloginfo( 'description' ); ?></p>
			<?php } ?>

		<?php
			/**
			 * woocommerce_archive_description hook.
			 *
			 * @hooked woocommerce_taxonomy_archive_description - 12
			 * @hooked woocommerce_product_archive_description - 12
			 */
			do_action( 'woocommerce_archive_description' );
		?>
		<ul class="main_categories">
			<?php woocommerce_product_subcategories(); ?>
		</ul>
		<div class="clearfix"></div>
						<div class="cound_and_ordering">
				<?php
				/**
				 * woocommerce_before_shop_loop hook.
				 *
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action( 'woocommerce_before_shop_loop' );
				?>
				</div>
		<?php if ( have_posts() ) : ?>

			<?php woocommerce_product_loop_start(); ?>

			<?php while ( have_posts() ) : the_post(); ?>

					<?php wc_get_template_part( 'content', 'product' ); ?>

			<?php endwhile; // end of the loop. ?>

				<?php woocommerce_product_loop_end(); ?>
				<div class="clearfix"></div>
					<?php
						/**
						 * woocommerce_after_shop_loop hook.
						 *
						 * @hooked woocommerce_pagination - 12
						 */
						do_action( 'woocommerce_after_shop_loop' );
					?>

		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php wc_get_template( 'loop/no-products-found.php' ); ?>

		<?php endif; ?>
		
	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 12 (outputs closing divs for the content)
		 */
	//	do_action( 'woocommerce_after_main_content' );
	?>
  </main><!-- #main -->
           
	    </div><!-- #primary -->
        
        
        
    </div><!-- Container end -->
    </div> <!-- row end -->
</div><!-- Wrapper end -->
<div class="clearfix"></div>

<?php get_footer( 'shop' ); ?>
