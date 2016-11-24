<?php
	
/*
Template Name: Home
*/
	
	
	get_header(); ?>
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

	<div class="container"> 
		<?php 	$args = array(
				'post_type'=> 'editorial',
				'posts_per_page'=> 1,
				'order'=>'ASC'
				);
			$the_query = new WP_Query( $args ); ?>
			<?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
				<div class="row blog-post">
					<div class="col-sm-6 post-content-img">
						<a href="https://firstflightstudio.com/weekend/editorial/editorial-4/">
							<?php the_post_thumbnail(); ?>
						</a>
					</div> 
					<div class="col-sm-6 blog-text-area">
						<div class=" blog-post-content">
						   <h2 class="section-heding">latest in editorial /</h2>
						   <div class="black-border"></div>
						   <div class="content-wrap">
							   
								<?php echo wp_trim_words( get_the_content(), 40, '' );?>
							  
							   <h5><a href="<?php echo site_url();?>/editorials" class="link-button">go to editorial / </a></h5>
							</div>
						</div>
					</div>			
				</div>
			<?php  endwhile;
			wp_reset_query();
			?>
		<div class="other-news">	
			<div class="container">
				<div class="row blog-post">
					<div class="col-sm-8 blog-text-area pull-right">
						<div class="blog-post-content">
							<h2 class="section-heding"> in other news /</h2>
							<div class="black-border"></div>
						</div>
					</div>
				</div>
			</div>
			<?php 	$args = array(
				'post_type'=> 'post',
				'posts_per_page'=> 2,
				'order'=>'DESC'
				);
			$the_query = new WP_Query( $args ); ?>
			<?php 
			$i = 1;
			while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
				<div class="home-post <?php if($i % 2 == 0){ echo 'journal';}else{ echo 'look-book';}?>">
					<div class="container"> 
						<div class="row"> 
							<div class="col-sm-6 <?php if($i % 2==0){ echo 'pull-right';}else{ echo '';}?>">
								<?php the_post_thumbnail(); ?>
							</div>	
							<div class="col-sm-6 rm-pad padding-box <?php if($i % 2==0){ echo 'text-right';}else{ echo '';}?> ">
								<h3><?php the_title(); ?></h3>
								<div class="home-blog-content">
									<?php echo wp_trim_words( get_the_content(), 30, '' );?>
								</div>	
							</div>
						</div>
					</div>
				</div>
			<?php  $i++; endwhile;
			wp_reset_query();
			?>	
		</div>
		<div class="get-series">
			<div class="row blog-post">
				<div class="col-sm-6 blog-text-area">
					<div class="blog-post-content">
						<h2 class="section-heding"> the get real series /</h2>
						<div class="black-border"></div>
					</div>
				</div>
			</div>
			<div class="div row col-md-12">
				<div class="series-content">
					<?php echo SERIES_TEXT; ?>	
				</div>
				<div class="series-img">
					<img src="<?php echo SERIES_IMG; ?>" />
				</div>
			</div>
		</div>	
	</div>	
<?php get_footer(); ?>
