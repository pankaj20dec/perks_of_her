<?php
add_action( 'init', 'create_editorial_post' );
function create_editorial_post() {
  register_post_type( 'editorial',
    array(
      'labels' => array(
        'name' => __( 'Editorial' ),
        'singular_name' => __( 'Editorial' )
      ),
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'editorial'),
	  'supports'=> array( 'title', 'editor', 'excerpt', 'author', 
'thumbnail', 'custom-fields', ),
    )
  );
}
add_action( 'init', 'create_shop_slider' );
function create_shop_slider() {
  register_post_type( 'shop-slider',
    array(
      'labels' => array(
        'name' => __( 'Shop Slider' ),
        'singular_name' => __( 'Shop Slider' )
      ),
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'shop-slider'),
	  'supports'=> array( 'title', 'thumbnail' ),
    )
  );
}

?>