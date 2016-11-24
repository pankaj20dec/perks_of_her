<?php
function breeze_setup()
{
    add_filter('show_admin_bar', '__return_false');
    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_theme_support('custom-logo', array(
        'height' => 69,
        'width' => 280,
        'flex-height' => true
    ));
    add_theme_support('post-thumbnails');
    register_nav_menus(array(
        'primary-left' => __('Primary Menu (Left)', 'breeze'),
        'primary-right' => __('Primary Menu (Right)', 'breeze'),
        'secondary' => __('Secondary Menu', 'breeze')
    ));
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption'
    ));
    add_theme_support('post-formats', array(
        'aside',
        'image',
        'video',
        'quote',
        'link',
        'gallery',
        'status',
        'audio',
        'chat'
    ));
    add_editor_style(array(
        'css/editor-style.css',
        breeze_fonts_url()
    ));
    add_theme_support('customize-selective-refresh-widgets');
    add_image_size( 'woo-home-image', 310, 418, true );
    add_image_size( 'post-slider-img-large', 560, 510, true );
    
    add_image_size( '1500x600', 1500, 600, true );

    add_image_size( '580x440', 580, 440, true );


    add_image_size( '240Height', 9999, 240, true );
    
    add_image_size( '320x410', 320, 410, true );
    
    add_image_size( '500Height', 999, 500, true );
    add_image_size( 'latest-img', 380, 380, true );
    add_image_size( 'home-blog', 646, 336, true );
    

    
}
add_action('after_setup_theme', 'breeze_setup');
function breeze_widgets_init()
{
    register_sidebar(array(
        'name' => __('Sidebar', 'breeze'),
        'id' => 'sidebar-1',
        'description' => __('Add widgets here to appear in your sidebar.', 'breeze'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>'
    ));
    register_sidebar(array(
        'name' => __('Sidebar 2', 'breeze'),
        'id' => 'sidebar-2',
        'description' => __('Appears at the bottom of the content on posts and pages.', 'breeze'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>'
    ));


    register_sidebar(array(
        'name' => __('Mailchimp', 'dapper'),
        'id' => 'mailchimp-1',
        'description' => __('Appears at the bottom.', 'dapper'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>'
    ));

    register_sidebar(array(
        'name' => __('Contact page', 'dapper'),
        'id' => 'contact-page-1',
        'description' => __('Appears at the bottom.', 'dapper'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>'
    ));

    register_sidebar(array(
        'name' => __('Instagram', 'dapper'),
        'id' => 'instagram-1',
        'description' => __('Appears at the bottom.', 'dapper'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>'
    ));

}
add_action('widgets_init', 'breeze_widgets_init');
function breeze_fonts_url()
{
    $fonts_url = '';
    $fonts     = array();
    $subsets   = 'latin,latin-ext';
    if ('off' !== _x('on', 'Merriweather font: on or off', 'breeze')) {
        $fonts[] = 'Merriweather:400,700,900,400italic,700italic,900italic';
    }
    if ('off' !== _x('on', 'Montserrat font: on or off', 'breeze')) {
        $fonts[] = 'Montserrat:400,700';
    }
    if ('off' !== _x('on', 'Inconsolata font: on or off', 'breeze')) {
        $fonts[] = 'Inconsolata:400';
    }
    if ($fonts) {
        $fonts_url = add_query_arg(array(
            'family' => urlencode(implode('|', $fonts)),
            'subset' => urlencode($subsets)
        ), 'https://fonts.googleapis.com/css');
    }
    return $fonts_url;
}
function breeze_scripts()
{
    wp_enqueue_style('breeze-bootstrap-style', get_template_directory_uri() . '/css/bootstrap.css', array());
    wp_enqueue_style('breeze-fonts', get_template_directory_uri() . '/fonts/stylesheet.css', array());
    wp_enqueue_style('font-awesome-style', get_template_directory_uri() . '/css/font-awesome.css', array());
	wp_enqueue_style('font-genericon-style', get_template_directory_uri() . '/css/genericons.css', array());
    wp_enqueue_style('breeze-owl-carousel', get_template_directory_uri() . '/css/owl.carousel.css', array());
	wp_enqueue_style('breeze-style', get_stylesheet_uri());
    wp_enqueue_style('breeze-theme-style', get_template_directory_uri() . '/css/theme.css', array());
    wp_enqueue_style('breeze-media-style', get_template_directory_uri() . '/css/media.css', array());

    // Load the Internet Explorer specific stylesheet.
    wp_enqueue_style( 'breeze-ie', get_template_directory_uri() . '/css/ie.css', array( 'breeze-style' ), '20160412' );
    wp_style_add_data( 'breeze-ie', 'conditional', 'lt IE 10' );

    // Load the Internet Explorer 8 specific stylesheet.
    wp_enqueue_style( 'breeze-ie8', get_template_directory_uri() . '/css/ie8.css', array( 'breeze-style' ), '20160412' );
    wp_style_add_data( 'breeze-ie8', 'conditional', 'lt IE 9' );

    // Load the Internet Explorer 7 specific stylesheet.
    wp_enqueue_style( 'breeze-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'breeze-style' ), '20160412' );
    wp_style_add_data( 'breeze-ie7', 'conditional', 'lt IE 8' );

    // Load the html5 shiv.
    wp_enqueue_script( 'breeze-html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3' );
    wp_enqueue_script( 'breeze-owl-carousel', get_template_directory_uri() . '/js/owl.carousel.js' );
    wp_enqueue_script('breeze-masonry', get_template_directory_uri() . '/js/masonry.js');
    wp_script_add_data( 'breeze-html5', 'conditional', 'lt IE 9' );

    wp_enqueue_script('breeze-bootstrap-script', get_template_directory_uri() . '/js/bootstrap.min.js', array(
        'jquery'
    ), '3.3.7', true);

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    if ( is_singular() && wp_attachment_is_image() ) {
        wp_enqueue_script( 'breeze-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20160412' );
    }
    wp_enqueue_script('breeze-instafeed', get_template_directory_uri() . '/js/instafeed.min.js');
    wp_enqueue_script('breeze-flexslider-js', get_template_directory_uri() . '/js/jquery.flexslider.js');
    wp_enqueue_script('breeze-script', get_template_directory_uri() . '/js/script.js');
}
add_action('wp_enqueue_scripts', 'breeze_scripts');
function body_classes($classes)
{
    global $wp_query;
    if (get_background_image()) {
        $classes[] = 'custom-background-image';
    }
    if (is_multi_author()) {
        $classes[] = 'group-blog';
    }
    if (!is_active_sidebar('sidebar-1')) {
        $classes[] = 'no-sidebar';
    }
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }
    if ( isset( $post ) ) {
        $classes[] = $post->post_type.'-'.$post->post_name;
    }
    if(is_page())
    {
        $classes[] = 'page-'.$wp_query->query_vars["pagename"];
        $classes[] = $wp_query->query_vars["pagename"].'-page';
        $classes[] = $wp_query->query_vars["pagename"];
    }
    return $classes;
}
add_filter('body_class', 'body_classes');

function breeze_get_the_excerpt($post_id) {
    global $post;
    $save_post = $post;
    $post = get_post( $post_id );
    setup_postdata( $post );
    $excerpt = get_the_excerpt();
    $post = $save_post;
    wp_reset_postdata( $post );
    return $excerpt;
}
function get_product_category_by_id( $category_id ) {
    $term = get_term_by( 'id', $category_id, 'product_cat', 'ARRAY_A' );
    return $term['name'];
}
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
function breeze_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'breeze_content_width', 990 );
}
add_action( 'after_setup_theme', 'breeze_content_width', 0 );
add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10 );
add_filter( 'image_send_to_editor', 'remove_width_attribute', 10 );
function remove_width_attribute( $html ) {
    $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
    return $html;
}
function breeze_hex2rgb( $color ) {
    $color = trim( $color, '#' );

    if ( strlen( $color ) === 3 ) {
        $r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
        $g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
        $b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
    } else if ( strlen( $color ) === 6 ) {
        $r = hexdec( substr( $color, 0, 2 ) );
        $g = hexdec( substr( $color, 2, 2 ) );
        $b = hexdec( substr( $color, 4, 2 ) );
    } else {
        return array();
    }

    return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}
function breeze_load_admin_scripts( $hook ){
    wp_enqueue_media();
    wp_enqueue_script('breeze-script', get_template_directory_uri() . '/js/admin-script.js', array('wp-color-picker','jquery'), '1.0.0' , true);
}

add_action('admin_enqueue_scripts' , 'breeze_load_admin_scripts');
function showLimitedText($text, $limit = 20)
{
    return substr($text, 0, $limit);
}

require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/global-variables.php';
require get_template_directory() . '/inc/theme_options_setting.php';
/*require get_template_directory() . '/inc/ajax_signup_login_forgotpass.php';*/
require get_template_directory() . '/inc/customposts.php';
require get_template_directory() . '/inc/customfields.php';
include( get_template_directory() . '/inc/gwf-options/gwf-options.php');

// Remove excerpt continue reading
function new_excerpt_more( $more ) {
  global $post;
  if ($post->post_type == 'post'){
    return '';
  }
}
add_filter('excerpt_more', 'new_excerpt_more');

/************* Remove  filters  and result*******/
add_action('init','delay_remove_result_count');
 
function delay_remove_result_count() {
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
}
add_action('woocommerce_before_shop_loop_item_title','add_title_wrapper');
function add_title_wrapper(){
	echo "<div class='product-details'>";
}


//  Product gallery thumbs columns
add_filter ( 'woocommerce_product_thumbnails_columns', 'product_thumb_cols' );
 function product_thumb_cols() {
     return 3; 
}

add_filter('get_custom_logo','change_logo_class');


function change_logo_class($html)
{
    $html = str_replace('class="custom-logo-link"', 'class="custom-logo-link navbar-brand"', $html);
    return $html;
}


// Remvoe tabs
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
function woo_remove_product_tabs( $tabs ) {

    unset( $tabs['reviews'] );    // Remove the reviews tab
    unset( $tabs['additional_information'] );   // Remove the additional information tab
    return $tabs;
}

add_filter('woocommerce_product_description_heading',
'isa_product_description_heading');

function isa_product_description_heading() {
return __('description', 'woocommerce');
} 

add_filter( 'woocommerce_product_add_to_cart_text' , 'custom_woocommerce_product_add_to_cart_text' );
/**
 * custom_woocommerce_template_loop_add_to_cart
*/
function custom_woocommerce_product_add_to_cart_text() {
	global $product;
	
	$product_type = $product->product_type;
	
	switch ( $product_type ) {
		case 'external':
			return __( 'Buy product', 'woocommerce' );
		break;
		case 'grouped':
			return __( 'View products', 'woocommerce' );
		break;
		case 'simple':
			return __( 'Shop Now', 'woocommerce' );
		break;
		case 'variable':
			return __( 'Shop Now', 'woocommerce' );
		break;
		default:
			return __( 'Read more', 'woocommerce' );
	}
	
}

// Single product page
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );

add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 20 );


add_action('woocommerce_after_single_product_summary','detail_back_link');

function detail_back_link(){
	?>
	<div class="back_link_wrapper"><a class="back_link" href="<?php echo home_url('/shop'); ?>">BACK TO PRODUCTS</a></div>
	
	<?php
}
add_action('woocommerce_before_single_product_summary','detail_title');

function detail_title(){
	?>
	<h1 class="title">shop.</h1>
	<?php
}


//change product per page
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 6;' ), 20 );

add_filter ( 'woocommerce_product_thumbnails_columns', 'xx_thumb_cols' );
 function xx_thumb_cols() {
     return 2; // .last class applied to every 4th thumbnail
}

/*add_filter('mce_buttons', 'add_font_selection_to_tinymce');

function add_font_selection_to_tinymce($buttons) {
    array_push($buttons, 'fontselect');
    return $buttons;
}*/


// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );
function woocommerce_header_add_to_cart_fragment( $fragments ) {
	ob_start();
	?>
		<a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>">
			<i class="fa fa-shopping-basket" aria-hidden="true"></i>
			&nbsp; <?php echo sprintf ( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?> 
		</a>
	<?php
	
	$fragments['a.cart-contents'] = ob_get_clean();
	
	return $fragments;
}

/*
 * wc_remove_related_products
 * 
 * Clear the query arguments for related products so none show.
 * Add this code to your theme functions.php file.  
 
function wc_remove_related_products( $args ) {
	return array();
}
add_filter('woocommerce_related_products_args','wc_remove_related_products', 10);
*/

function skandi_move_comment_field_to_bottom( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
}

add_filter( 'comment_form_fields', 'skandi_move_comment_field_to_bottom' ); 



/* 	Publish page
================================================ */

function custom_button_example($wp_admin_bar){
	$args = array(
		'id' => 'push-live-button',
		'title' => 'Push live!',
		'href' => "mailto:support@firstflightstudio.com?&subject=Push my site live!&body=Hey%20First%20Flight%20crew,%0A%0AAll%20my%20content%20is%20set%20up%20and%20I'm%20ready%20to%20push%20this%20site%20live!%0A%0AI%20hereby%20also%20confirm%20that%20I've%20provided%20all%20the%20necessary%20login%20details%20of%20my%20domain%20registrar%20and%20current%20web%20hosting%20details.",
		'meta' => array(
		'class' => 'push-live-button',
	)
);
$wp_admin_bar->add_node($args);
}
add_action('admin_bar_menu', 'custom_button_example', 50);

// Change number or products per row to 4
add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 4; 
	}
}
