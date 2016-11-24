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
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
$term_list = wp_get_post_terms($post->ID , 'product_cat', array("fields" => "all"));
$term_name = get_the_terms($post->ID , 'product_cat');

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
$terms_ids = array();
foreach($term_list as $term_lists)
{
	$terms_ids[] = $term_lists->term_id;
}
?>
<li data-category="<?php  echo implode(", ",$terms_ids); ?>" <?php post_class('filtr-item'); ?>>
	<?php
	/**
	 * woocommerce_before_shop_loop_item hook.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item' );

	/**
	 * woocommerce_before_shop_loop_item_title hook.
	 *
	 * @hooked woocommerce_show_product_loop_sale_flash - 10
	 * @hooked woocommerce_template_loop_product_thumbnail - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item_title' );

	/**
	 * woocommerce_shop_loop_item_title hook.
	 *
	 * @hooked woocommerce_template_loop_product_title - 10
	 */
	do_action( 'woocommerce_shop_loop_item_title' );

	/**
	 * woocommerce_after_shop_loop_item_title hook.
	 *
	 * @hooked woocommerce_template_loop_rating - 5
	 * @hooked woocommerce_template_loop_price - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item_title' );

	/**
	 * woocommerce_after_shop_loop_item hook.
	 *
	 * @hooked woocommerce_template_loop_product_link_close - 5
	 * @hooked woocommerce_template_loop_add_to_cart - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item' );
	?>

	<div class="detail" style="display:none;" >		
		<?php if( $product->is_type( 'simple' ) ){
		// a simple product
			$class = 'buttton add_to_cart_button ajax_add_to_cart product_type_'.$product->product_type.' ';
		} elseif( $product->is_type( 'variable' ) ){
		// a variable product
		  $class = 'buttton add_to_cart_button  product_type_'.$product->product_type.' ';
		}
		?>
		<div class="flx-div">	
		
			<h3>
				<span class="cat-name">
				<?php foreach($term_name as $term_names){ echo $term_names->name;}?></span>
			<a href="<?php echo $post->guid; ?>" class="product-name"><?php echo $post->post_title; ?></a></h3>
			<span class="price"><?php echo $product->get_price_html(); ?></span>
			<?php 
			echo apply_filters( 'woocommerce_loop_add_to_cart_link',
				sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s">%s</a>',
				esc_url( $product->add_to_cart_url() ),
				esc_attr( isset( $quantity ) ? $quantity : 1 ),
				esc_attr( $product->id ),
				esc_attr( $product->get_sku() ),
				esc_attr( isset( $class ) ? $class : 'button' ),
				esc_html( $product->add_to_cart_text() )
				),
			$product ); ?>
		</div>
	</div>
</li>

