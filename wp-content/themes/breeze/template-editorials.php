<?php
/*
Template Name: Editorials
*/
get_header();
while ( have_posts() ) : the_post();
	$sub_heading = get_post_meta($post->ID, "breeze_custom_sub_heading", true);
	?>
	<div class="col-sm-12 col-introduce text-center text-uppercase">
		<h2><?php the_title(); ?></h2>
	</div>
	<?php
endwhile;
?>

<div class="container editorial-container">
<?php
//Front End Code To Call Custom Post Type
$args = array( 'post_type' => 'editorial', 'posts_per_page' => 10);
$loop = new WP_Query( $args );
$i=1;
$style = "";
$p=array();
$l =array();
while ( $loop->have_posts() ) : $loop->the_post();
?>
<?php 
	$tn_id = get_post_thumbnail_id( $loop->ID );
	$img = wp_get_attachment_image_src( $tn_id, '' );
	$img_width = $img[1];
	$img_height = $img[2];
	
	if($img_width <= $img_height){
		$style ="potrait";
		$p[] =$img_width;
	}
	else{
		$style = "landscape";
		$l[]=$img_width;
	}
	
	
	

?>

<div class="editorial-item-block col-sm-4 <?php echo $style ?> ">
		<div class="editorial-item text-center">
			<div class="item-content">
				
				<?php the_post_thumbnail(); ?>
				
				<div class="item-desc">					
				<a href="<?php echo get_the_permalink(); ?>">
				<span class="date"> <?php echo get_the_date('j/m/y'); ?> </span>
				<h3><?php the_title(); ?></h3>
				</a>
				</div>
				
			</div>
			<a href="<?php echo get_the_permalink(); ?>" class="item-content-hover"></a>
		</div>
</div>

<?php  $i++;
 endwhile; 
 ?>
</div>
<?php get_footer(); ?>
