<?php
function theme_options_menu() {
    add_theme_page(
        'Theme Options',            // The title to be displayed in the browser window for this page.
        'Theme Options',            // The text to be displayed for this menu item
        'administrator',            // Which type of users can see this menu item
        'theme_options',    // The unique ID - that is, the slug - for this menu item
        'theme_options_display'     // The name of the function to call when rendering this menu's page
    );
    add_settings_section('theme-options-setting-section','Theme Options','theme_options_page_description', 'theme_options');

    register_setting('theme-options-settings-group' , 'facebook_link');
    add_settings_field('facebook_link','Facebook Link' ,'facebookHtmlField','theme_options' ,'theme-options-setting-section');

    register_setting('theme-options-settings-group' , 'twitter_link');
    add_settings_field('twitter_link','Twitter Link' ,'twitterHtmlField','theme_options' ,'theme-options-setting-section');

    register_setting('theme-options-settings-group' , 'instagram_link');
    add_settings_field('instagram_link','Instagram Link' ,'instagramHtmlField','theme_options' ,'theme-options-setting-section');
	
	register_setting('theme-options-settings-group' , 'youtube_link');
    add_settings_field('youtube_link','Youtube Link' ,'youtubeHtmlField','theme_options' ,'theme-options-setting-section');
    /*register_setting('theme-options-settings-group' , 'header_text');
    add_settings_field('header_text','Header Text' ,'headerTextHtmlField','theme_options' ,'theme-options-setting-section');

    register_setting('theme-options-settings-group' , 'header_sub_text');
    add_settings_field('header_sub_text','Header Sub Text' ,'headerSubTextHtmlField','theme_options' ,'theme-options-setting-section');*/
    register_setting('theme-options-settings-group' , 'linkedin_link');
    add_settings_field('linkedin_link','Linkedin Link' ,'linkedinHtmlField','theme_options' ,'theme-options-setting-section');


    register_setting('theme-options-settings-group' , 'pinterest_link');
    add_settings_field('pinterest_link','Pinterest Link' ,'pinterestHtmlField','theme_options' ,'theme-options-setting-section');
    
    register_setting('theme-options-settings-group' , 'signup_bg_img');
    add_settings_field('signup_bg_img','Signup Background Image' ,'signupBGImage','theme_options' ,'theme-options-setting-section');
	
	register_setting('theme-options-settings-group' , 'footer_logo');
    add_settings_field('footer_logo','Footer Logo' ,'footerLogo','theme_options' ,'theme-options-setting-section');

    // register_setting('theme-options-settings-group' , 'signup_text');
    // add_settings_field('signup_text','Signup Text' ,'signupTextHtmlField','theme_options' ,'theme-options-setting-section');

    // register_setting('theme-options-settings-group' , 'look_book_img_home');
    // add_settings_field('look_book_img_home','Lookbook image on homepage' ,'lookBookHomepageImage','theme_options' ,'theme-options-setting-section');

    // register_setting('theme-options-settings-group' , 'blog_img_home');
    // add_settings_field('blog_img_home','Blog image on homepage' ,'blogHomepageImage','theme_options' ,'theme-options-setting-section');
	
	 register_setting('theme-options-settings-group' , 'series_text');
		add_settings_field('series_text','Series Text' ,'seriesTextHtmlField','theme_options' ,'theme-options-setting-section');
	
		register_setting('theme-options-settings-group' , 'series_img_home');
      add_settings_field('series_img_home','Series image on homepage' ,'seriesHomepageImage','theme_options' ,'theme-options-setting-section');
}
add_action('admin_menu', 'theme_options_menu');
 
function theme_options_display() {
    require get_template_directory() . '/inc/theme_options.php';
}
function theme_options_page_description(){
}
function facebookHtmlField(){
    $facebook_link = esc_attr( get_option('facebook_link') );
    echo '<input type="text" name="facebook_link" class="regular-text" value="'. $facebook_link .'" placeholder="Facebook Link" />' ; 
}
function twitterHtmlField(){
    $twitter_link = esc_attr( get_option('twitter_link') );
    echo '<input type="text" name="twitter_link" class="regular-text" value="'. $twitter_link .'" placeholder="Twitter Link" />' ; 
}
function instagramHtmlField(){
    $instagram_link = esc_attr( get_option('instagram_link') );
    echo '<input type="text" name="instagram_link" class="regular-text" value="'. $instagram_link .'" placeholder="Instagram Link" />' ; 
}
function youtubeHtmlField(){
    $youtube_link = esc_attr( get_option('youtube_link') );
    echo '<input type="text" name="youtube_link" class="regular-text" value="'. $youtube_link .'" placeholder="Youtube Link" />' ; 
}
function headerTextHtmlField(){
    $header_text = esc_attr( get_option('header_text') );
    echo '<textarea name="header_text" row="4" style="width:350px;" placeholder="Header Text">'. $header_text .'</textarea>' ;
}
function headerSubTextHtmlField(){
    $header_sub_text = esc_attr( get_option('header_sub_text') );
    echo '<textarea name="header_sub_text" row="4" style="width:350px;" placeholder="Header Sub Text">'. $header_sub_text .'</textarea>' ;
}
function signupBGImage(){
    $signup_bg_img = esc_attr( get_option('signup_bg_img') );
    $hide = "display: none;";
    if(!empty($signup_bg_img))
    {
        $hide = "display: block;";
    }
    echo '<img src="'.$signup_bg_img.'" id="signup_bg_img_preview" alt="" style="width: 150px; '.$hide.'" /><br><input type="button" value="Upload Image" id="upload-button" data-id="signup_bg_img" class="button button-secondary breeze-upload-button"  /><input id="signup_bg_img" type="hidden" name="signup_bg_img" value="'. $signup_bg_img .'" />';
    if(!empty($signup_bg_img)){
        echo '<input type="button" value="remove" id="remove-signup_bg_img" data-id="signup_bg_img" class="button button-secondary breeze-remove-button"  />';
    }
}

function footerLogo(){
	 $footer_logo = esc_attr( get_option('footer_logo') );
    $hide = "display: none;";
    if(!empty($footer_logo))
    {
        $hide = "display: block;";
    }
    echo '<img src="'.$footer_logo.'" id="footer_logo_preview" alt="" style="width: 150px; '.$hide.'" /><br><input type="button" value="Upload Image" id="upload-button" data-id="footer_logo" class="button button-secondary breeze-upload-button"  /><input id="footer_logo" type="hidden" name="footer_logo" value="'. $footer_logo .'" />';
    if(!empty($footer_logo)){
        echo '<input type="button" value="remove" id="remove-footer_logo" data-id="footer_logo" class="button button-secondary breeze-remove-button"  />';
    }
}
function seriesTextHtmlField(){
    $series_text = esc_attr( get_option('series_text') );

    $settings = array(
        'type' => 'wysiwyg',
        'std' => '',
        'desc' => '',
        'style' =>'',
        'name' => 'WYSIWYG Editor Field',
        'editor_class' => 'at-wysiwyg',
        'media_buttons' => false,
        'quicktags' => true,
        'textarea_rows' => 5,
        'teeny' => true,
        'wpautop' => false
        );

    $id = "series_text";
    ?>
    <div style="width: 500px;">
        <?php wp_editor( html_entity_decode($series_text), $id, $settings); ?>
    </div>
    <?php
}


function linkedinHtmlField(){
    $linkedin_link = esc_attr( get_option('linkedin_link') );
    echo '<input type="text" name="linkedin_link" class="regular-text" value="'. $linkedin_link .'" placeholder="Linkedin Link" />' ; 
}
function pinterestHtmlField(){
    $pinterest_link = esc_attr( get_option('pinterest_link') );
    echo '<input type="text" name="pinterest_link" class="regular-text" value="'. $pinterest_link .'" placeholder="Pinterest Link" />' ; 
}



function lookBookHomepageImage(){
    $look_book_img_home = esc_attr( get_option('look_book_img_home') );
    $hide = "display: none;";
    if(!empty($look_book_img_home))
    {
        $hide = "display: block;";
    }
    echo '<img src="'.$look_book_img_home.'" id="look_book_img_home_preview" alt="" style="width: 150px; '.$hide.'" /><br><input type="button" value="Upload Image" id="upload-button" data-id="look_book_img_home" class="button button-secondary breeze-upload-button"  /><input id="look_book_img_home" type="hidden" name="look_book_img_home" value="'. $look_book_img_home .'" />';
    if(!empty($look_book_img_home)){
        echo '<input type="button" value="remove" id="remove-look_book_img_home" data-id="look_book_img_home" class="button button-secondary breeze-remove-button"  />';
    }
}
function seriesHomepageImage(){
    $series_img_home = esc_attr( get_option('series_img_home') );
    $hide = "display: none;";
    if(!empty($series_img_home))
    {
        $hide = "display: block;";
    }
    echo '<img src="'.$series_img_home.'" id="series_img_home_preview" alt="" style="width: 150px; '.$hide.'" /><br><input type="button" value="Upload Image" id="upload-button" data-id="series_img_home" class="button button-secondary breeze-upload-button"  /><input id="series_img_home" type="hidden" name="series_img_home" value="'. $series_img_home .'" />';
    if(!empty($series_img_home)){
        echo '<input type="button" value="remove" id="remove-series_img_home" data-id="series_img_home" class="button button-secondary breeze-remove-button"  />';
    }
}
function blogHomepageImage(){
    $blog_img_home = esc_attr( get_option('blog_img_home') );
    $hide = "display: none;";
    if(!empty($blog_img_home))
    {
        $hide = "display: block;";
    }
    echo '<img src="'.$blog_img_home.'" id="blog_img_home_preview" alt="" style="width: 150px; '.$hide.'" /><br><input type="button" value="Upload Image" id="upload-button" data-id="blog_img_home" class="button button-secondary breeze-upload-button"  /><input id="blog_img_home" type="hidden" name="blog_img_home" value="'. $blog_img_home .'" />';
    if(!empty($blog_img_home)){
        echo '<input type="button" value="remove" id="remove-blog_img_home" data-id="blog_img_home" class="button button-secondary breeze-remove-button"  />';
    }
}
?>
