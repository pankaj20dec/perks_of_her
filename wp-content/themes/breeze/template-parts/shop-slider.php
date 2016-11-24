<?php
$show_shop_slider = 'no';
if(isset($wp_query->queried_object) && isset($wp_query->queried_object->ID))
{
	if($wp_query->queried_object->ID > 0)
	{
		$show_shop_slider = get_post_meta($wp_query->queried_object->ID, "breeze_custom_show_shop_slider", true);
	}
}
/**********
get_option( 'woocommerce_shop_page_id' );
get_option( 'woocommerce_cart_page_id' );
get_option( 'woocommerce_checkout_page_id' );
get_option( 'woocommerce_pay_page_id' ); 
get_option( 'woocommerce_thanks_page_id' ); 
get_option( 'woocommerce_myaccount_page_id' ); 
get_option( 'woocommerce_edit_address_page_id' ); 
get_option( 'woocommerce_view_order_page_id' ); 
get_option( 'woocommerce_terms_page_id' ); 

***********/
$currPageID = 0;
if(is_shop())
{
	$currPageID = get_option( 'woocommerce_shop_page_id' );;
}
else if(is_cart())
{
	$currPageID = get_option( 'woocommerce_cart_page_id' );;
}
else if(is_checkout())
{
	$currPageID = get_option( 'woocommerce_checkout_page_id' );;
}
if($currPageID > 0)
{
	$show_shop_slider = get_post_meta($currPageID, "breeze_custom_show_shop_slider", true);
}
if(is_home())
{
	$show_shop_slider = "yes";
}
if($show_shop_slider == 'yes')
{
	?>
	<section class="featured-products section">
		<div class="container">
			<h2>shop the faves</h2>
			<div class="slider">
				<div class="featured-slider">
					<?php
					$args = array( 'post_type' => 'product', 'stock' => 1, 'posts_per_page' => 4, 'orderby' =>'date','order' => 'DESC' );
					$loop = new WP_Query( $args );
					while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
						<div class="product post-<?php the_id(); ?>">
							<a href="<?php the_permalink(); ?>">
							<?php
							if (has_post_thumbnail( $loop->post->ID ))
							{
								echo get_the_post_thumbnail($loop->post->ID, 'shop_thumbnail');
							}
							else
							{
								echo '<img src="'.woocommerce_placeholder_img_src().'" alt="<?php the_title(); ?>" height="220" />';
							}
							?></a>
							<div class="product-details">
								<h5 class="product-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
								<p class="price"><?php echo $product->get_price_html(); ?></p>
							</div>
							<?php /*woocommerce_template_loop_add_to_cart( $loop->post, $product );*/ ?>
						</div>
					<?php endwhile; ?>
					<?php wp_reset_query(); ?>
				</div>
				<div class="arrows">
				  <a class="prev"> < </a>
				  <a class="next"> > </a>
				</div>
			</div>
			<a href="<?php echo get_permalink( woocommerce_get_page_id( 'shop' ) ); ?>" class="link-button">Shop All</a>
		</div>
	</section>
	<?php
}?>