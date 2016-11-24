<?php
get_header(); ?>
<?php
while ( have_posts() ) : the_post();
	$sub_heading = get_post_meta($post->ID, "breeze_custom_sub_heading", true);

	?>	
	<div class="banner-slider page-default clearfix">
		<div class="col-sm-9 col-sm-offset-3 banner-width">
			<?php
			if(!empty($sub_heading))
			{
				?>
				<h1 class="title"><?php echo nl2br($sub_heading); ?></h1>
				<?php
			}
			else
			{
				the_title( '<h1 class="title">', '</h1>' );
			}
			?>
			<div class="banner-wrapper">
				<?php
				$slider_data = get_post_meta($post->ID, "breeze_slider_data", true);
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
						<ul class="slides">
							<li>
								<?php breeze_post_thumbnail(); ?>
							</li>
						</ul>
					</div>
					<?php
				}?>
			</div>
		</div>
	</div>
	<div class="default-page">
		<div class="bg-default-half"></div>
		<div class="container">
			<div class="content">
				<?php the_content();?>
			</div>
		</div>
	</div>
	<?php
endwhile;
?>
<?php get_footer(); ?>
