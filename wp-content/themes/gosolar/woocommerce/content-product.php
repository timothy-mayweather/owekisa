<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;
// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
$cat_count = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
?>
<li <?php post_class(); ?>>
	<?php
	/**
	 * woocommerce_before_shop_loop_item hook.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item' ); ?>
	
	<div class="product-box-wrapper">
		<div class="product-img-box">
			<a href="<?php the_permalink(); ?>" class="product-image">
			
				<?php
					/**
					 * woocommerce_before_shop_loop_item_title hook
					 *
					 * @hooked woocommerce_show_product_loop_sale_flash - 10
					 * @hooked woocommerce_template_loop_product_thumbnail - 10
					 */
					do_action( 'woocommerce_before_shop_loop_item_title' );
				?>
				
			</a>
			
			<div class="product-buttons-overlay">
				<?php
					/**
					 * woocommerce_after_shop_loop_item hook.
					 *
					 * @hooked woocommerce_template_loop_product_link_close - 5
					 * @hooked woocommerce_template_loop_add_to_cart - 10
					 */
					remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
					do_action( 'woocommerce_after_shop_loop_item' );
			
				?>
			</div>
			
		</div>
		
		<div class="product-details-wrapper">
			<div class="product-details clearfix">
				
				<div class="product-inner">
				<?php 
					add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_price', 20 );
					do_action( 'woocommerce_shop_loop_item_title' );
				?>
				</div>
						
				
				<div class="product-info">
					<?php
						//wc_get_template( 'loop/rating.php' );
						/**
						 * woocommerce_after_shop_loop_item_title hook
						 *
						 * @hooked woocommerce_template_loop_rating - 5
						 * @hooked woocommerce_template_loop_price - 10
						 */
						remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 5 );
						
						add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 5 );
						add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 10 );
						do_action( 'woocommerce_after_shop_loop_item_title' );
					?>
				</div>
				
			</div>		
		</div>
	</div>
</li>