<?php get_header(); ?>
	<div class="home-banner feature clearfix">
		<div class="col-sm-10 col-sm-offset-2 banner-width">
			<div class="banner-wrapper">
				<?php
				$page = get_page_by_path("home");
				if(!empty($page) && $page->ID > 0)
				{
					$slider_data = get_post_meta($page->ID, "breeze_slider_data", true);
					if(is_array($slider_data))
					{
						?>
						<div class="banner">
							<ul class="slides">
								<?php
								foreach ($slider_data as $key => $slide)
								{
									?>
									<li>
										<img src="<?php if(!empty($slide['breeze_slider_images']['url'])){ echo $slide['breeze_slider_images']['url']; } ?>" alt="" />
										<p class="flex-caption">
											<span class="rotate">
												<span class="heading-rotate">
													<?php echo $slide['breeze_slider_text'];?>
												</span> 
												<span class="subheading-rotate"><?php echo $slide['breeze_slider_small_text'];?></span>
											</span>
											<?php
											if(!empty($slide['breeze_slider_link']))
											{
												?>
												<a href="<?php echo $slide['breeze_slider_link'];?>" target="_blank">Shop now</a>
												<?php
											}?>
										</p>
									</li>
									<?php
								}
								?>
							</ul>
						</div>
						<div class="slider-function">
							<div id="sliderPrev"></div>
							<div class="slide-count"><span class="current-slide">1</span> <span>of</span> <span class="total-slides"></span></div>
							<div id="sliderNext"></div>
						</div>
						<?php
					}
					else
					{
						?>
						<div class="banner">
							<ul>
								<li>
									<?php
									$banner_url = wp_get_attachment_url( get_post_thumbnail_id($page->ID) );
									?>
									<img src="<?php echo $banner_url; ?>" alt="" />
								</li>
							</ul>
						</div>
						<?php
					}
				}
				?>
			</div>
		</div>
	</div>
	<?php
	$productArr = array();
	$args = array(
        'post_type'   => 'product',
		'showposts'   => 3,
/*
        'stock'       => 1,
        'showposts'   => 3,
*/
/*
        'posts_per_page' => 3,
        'orderby'     => 'rand',
        'order'       => 'DESC' ,
*/
    );
	$loop = new WP_Query( $args );
	$i = 0;
	if ( have_posts() )
	{
		?>
		<div class="breeze-shop">
			<div class="container">
				<ul class="products">
					<?php
					while ( $loop->have_posts() ) :
						$loop->the_post();
						$i++;
						global $product;
						$image = wp_get_attachment_image_src( get_post_thumbnail_id( $loop->post->ID ), 'woo-home-image' );
						?>
						<li class="post-<?php echo $loop->post->ID; ?> product <?php if($i == 1){ echo "first"; }else if($i == 3){ $i = 0; echo "last"; } ?>">
							<a class="woocommerce-LoopProduct-link" href="<?php echo get_permalink(); ?>">
								<img class="woocommerce-placeholder wp-post-image" alt="Placeholder" src="<?php echo $image[0]; ?>">
							</a>
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
								
									<h3><a href="<?php echo $post->guid; ?>"><?php echo $post->post_title; ?></a></h3>
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
						<?php
					endwhile;
					?>
				</ul>
			</div>	
		</div>
		<?php
	} ?>
	<?php wp_reset_query(); ?>

	<?php
	$page = get_page_by_path("look-book");
	if(!empty($page) && $page->ID > 0)
	{
		$banner_url = wp_get_attachment_url( get_post_thumbnail_id($page->ID) );
		$page_link = get_permalink($page->ID);
		$sub_heading = get_post_meta($page->ID, "breeze_custom_sub_heading", true);
		$page_title = nl2br($sub_heading);
		if(empty($page_title))
		{
			$page_title = $page->post_title.".";
		}
		?>
		<div class="home-post look-book">
			<div class="container"> 
				<div class="row"> 
					<div class="col-sm-6">




						<?php 
							//post 4
							if(get_post_thumbnail_id(650)) {


							$featuredimage_id = get_post_thumbnail_id(650);
							$featuredimage_url_array = wp_get_attachment_image_src($featuredimage_id, '580x440', true);
							$featuredimage_url = $featuredimage_url_array[0];
							
							$banner_url = $featuredimage_url;
						} ?>
						<img class="wp-post-image" src="<?php echo $banner_url; ?>" alt="Collections image" />


					</div>	
					<div class="col-sm-3 col-sm-offset-1 rm-pad ">
						<h3><?php echo $page_title; ?></h3>
						<?php echo breeze_get_the_excerpt($page->ID); ?>
						<a class="with-arw" href="<?php echo get_permalink( woocommerce_get_page_id( 'shop' ) ) ; ?>">shop our latest collection</a>						
					</div>
				</div>
			</div>
		</div>
		<?php
	}?>
	<?php
	$page = get_page_by_path("blog");
	if(!empty($page) && $page->ID > 0)
	{
		$banner_url = wp_get_attachment_url( get_post_thumbnail_id($page->ID) );
		$page_link = get_permalink($page->ID);
		$sub_heading = get_post_meta($page->ID, "breeze_custom_sub_heading", true);
		$page_title = nl2br($sub_heading);
		if(empty($page_title))
		{
			$page_title = $page->post_title.".";
		}
		?>
		<div class="home-post journal">
			<div class="container">
				<div class="row">
					<div class="col-sm-6 col-sm-offset-1 pull-right">
						<img class="wp-post-image" src="<?php echo $banner_url; ?>" alt="" />

					</div>
					<div class="col-sm-3 col-sm-offset-2 text-right rm-pad ">
						<h3><?php echo $page_title; ?></h3>
						<?php echo breeze_get_the_excerpt($page->ID); ?>
						<a class="with-arw " href="<?php echo $page_link; ?>">view all posts</a>						
					</div>
				</div>
			</div>
		</div>	
		<?php
	}?>
	<?php
	$page = get_page_by_path("we-are-breeze");
	if(!empty($page) && $page->ID > 0)
	{
		$banner_url = wp_get_attachment_url( get_post_thumbnail_id($page->ID) );
		$page_link = get_permalink($page->ID);
		$sub_heading = get_post_meta($page->ID, "breeze_custom_sub_heading", true);
		$page_title = nl2br($sub_heading);
		if(empty($page_title))
		{
			$page_title = $page->post_title;
		}
		?>
		<div class="home-content">
			<div class="flx"> 
				<div class="home-cn-img">
					<img class="wp-post-image" src="<?php echo $banner_url; ?>" alt="" />
				</div>
				<div class="home-cn cont-right-space">
					<h2><?php echo $page_title; ?></h2>
					<?php echo breeze_get_the_excerpt($page->ID); ?>
<!-- 					<a class="with-arw" href="<?php echo $page_link; ?>">read more</a> -->
					<a class="with-arw" href="<?php echo get_site_url(); ?>/about">read more</a>

				</div>
			</div>
		</div>
		<?php
	}?>
<?php get_footer(); ?>
