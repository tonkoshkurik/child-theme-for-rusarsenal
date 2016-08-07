<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.9
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

?>
<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">

	<p class="price">
		
		<?php
		 $_from_fifty_thousand = get_post_meta( $product->id, '_from_fifty_thousand', true );
		 $_on_request = get_post_meta( $product->id, '_on_request', true );
		 $_by_order = get_post_meta($product->id, '_by_order', true);
		 $rur = '<span class="woocommerce-Price-currencySymbol"><span class="rur">р<span>уб.</span></span></span>';		 
		 if($_on_request !== ''){
		 	echo "<br><strong>По запросу</strong> $_on_request $rur <br>";
		 } else { ?>
		 	<strong>ОПТ</strong> <?php echo $product->get_price_html();
		 	echo "<br>";  
		 	} 
		 if($_by_order !== ''){
		 	echo "<strong>Под заказ</strong> $_by_order $rur ";
		 } else {
		 	if($_from_fifty_thousand !== ''){ echo "<strong>От 50 тыс.р.</strong> $_from_fifty_thousand $rur <br>"; }
		 	 
		 }
		 	?>
	</p>
	<meta itemprop="price" content="<?php echo esc_attr( $product->get_display_price() ); ?>" />
	<meta itemprop="priceCurrency" content="<?php echo esc_attr( get_woocommerce_currency() ); ?>" />
	<link itemprop="availability" href="http://schema.org/<?php echo $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>" />

</div>
