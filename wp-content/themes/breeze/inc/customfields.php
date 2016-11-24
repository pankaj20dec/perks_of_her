<?php
require get_template_directory() . "/inc/mbc/mbc.php";

$prefix = 'breeze_';

$config = array(
	'id'             => $prefix.'addition_info',// meta box id, unique per meta box
	'title'          => 'Additional Info',	// meta box title
	'pages'          => array('page'),		// post types
	'context'        => 'normal',		// where appear: normal (default), advanced, side;
	'priority'       => 'high',			// order of meta box: high (default), low; optional
	'fields'         => array(),		// list of meta fields (can be added by field arrays)
	'use_with_theme' => get_template_directory_uri()."/inc/mbc"
);

$addition_info_box =  new AT_Meta_Box($config);
/*$addition_info_box->addRadio($prefix.'custom_show_latest_news',array('yes'=>'Yes','no'=>'No'),array('name'=> 'Show Latest News?', 'std'=> array('yes')));
$addition_info_box->addRadio($prefix.'custom_show_shop_slider',array('yes'=>'Yes','no'=>'No'),array('name'=> 'Show Shop Slider?', 'std'=> array('yes')));
$addition_info_box->addRadio($prefix.'custom_show_on_home_page',array('yes'=>'Yes','no'=>'No'),array('name'=> 'Show on Home Page?', 'std'=> array('no')));*/
$addition_info_box->addTextarea($prefix.'custom_sub_heading',array('name'=> 'Sub heading'));
/*$addition_info_box->addTextarea($prefix.'custom_short_description',array('name'=> 'Short Description'));*/
/*$addition_info_box->addImage($prefix.'custom_secondary_image',array('name'=> 'Secondary Image'));*/

$slider_fields[] = $addition_info_box->addImage($prefix.'slider_images',array('name'=> 'Slider Image'),true);
$slider_fields[] = $addition_info_box->addText($prefix.'slider_text',array('name'=> 'Slider Text'),true);
/*$slider_fields[] = $addition_info_box->addText($prefix.'slider_small_text',array('name'=> 'Slider Text (small)'),true);
$slider_fields[] = $addition_info_box->addText($prefix.'slider_link',array('name'=> 'Shop Now (Link)'),true);*/

$addition_info_box->addRepeaterBlock($prefix.'slider_data', array(
	'inline'   => true, 
	'name'     => 'Add Slider Images',
	'fields'   => $slider_fields, 
	'sortable' => true
));

$addition_info_box->Finish();

/********** Post Fields ***********/
$config = array(
	'id'             => $prefix.'addition_info',// meta box id, unique per meta box
	'title'          => 'Additional Info',	// meta box title
	'pages'          => array('post'),		// post types
	'context'        => 'normal',		// where appear: normal (default), advanced, side;
	'priority'       => 'high',			// order of meta box: high (default), low; optional
	'fields'         => array(),		// list of meta fields (can be added by field arrays)
	'use_with_theme' => get_template_directory_uri()."/inc/mbc"
);

$addition_info_box =  new AT_Meta_Box($config);
$addition_info_box->addTextarea($prefix.'custom_sub_heading',array('name'=> 'Sub heading'));

$option_arr = array(
		'1'=>'1',
		'2'=>'2',
		'3'=>'3',
		'4'=>'4',
		'5'=>'5',
		'6'=>'6',
		'7'=>'7',
		'8'=>'8',
		'9'=>'9',
		'10'=>'10',
		'11'=>'11',
		'12'=>'12'
		);

$addition_info_box->addSelect($prefix.'custom_grid_size', $option_arr,array('name'=> 'Grid Size', 'std'=> array('6')));

$addition_info_box->Finish();
/********** Post Fields ***********/