<?php

/* ---------------------------------------------------------------------------
 * Child Theme URI | DO NOT CHANGE
 * --------------------------------------------------------------------------- */
define( 'CHILD_THEME_URI', get_stylesheet_directory_uri() );


/* ---------------------------------------------------------------------------
 * Define | YOU CAN CHANGE THESE
 * --------------------------------------------------------------------------- */

// White Label --------------------------------------------
define( 'WHITE_LABEL', false );

// Static CSS is placed in Child Theme directory ----------
define( 'STATIC_IN_CHILD', false );


/* ---------------------------------------------------------------------------
 * Enqueue Style
 * --------------------------------------------------------------------------- */
add_action( 'wp_enqueue_scripts', 'mfnch_enqueue_styles', 101 );
function mfnch_enqueue_styles() {

    // Enqueue the parent stylesheet
//  wp_enqueue_style( 'parent-style', get_template_directory_uri() .'/style.css' );     //we don't need this if it's empty

    // Enqueue the parent rtl stylesheet
    if ( is_rtl() ) {
        wp_enqueue_style( 'mfn-rtl', get_template_directory_uri() . '/rtl.css' );
    }

    // Enqueue the child stylesheet
    wp_dequeue_style( 'style' );
    wp_enqueue_style( 'style', get_stylesheet_directory_uri() .'/style.css' );
    wp_enqueue_style( 'app', get_stylesheet_directory_uri() .'/dist/css/main.css', null, microtime() );

}


/* ---------------------------------------------------------------------------
 * Load Textdomain
 * --------------------------------------------------------------------------- */
add_action( 'after_setup_theme', 'mfnch_textdomain' );
function mfnch_textdomain() {
    load_child_theme_textdomain( 'betheme',  get_stylesheet_directory() . '/languages' );
    load_child_theme_textdomain( 'mfn-opts', get_stylesheet_directory() . '/languages' );
}



/* ---------------------------------------------------------------------------
 * Override theme functions
 *
 * if you want to override theme functions use the example below
 * --------------------------------------------------------------------------- */
// require_once( get_stylesheet_directory() .'/includes/content-portfolio.php' );


function taxonomy_checklist_checked_ontop_filter ($args)
{

    $args['checked_ontop'] = false;
    return $args;

}

add_filter('wp_terms_checklist_args','taxonomy_checklist_checked_ontop_filter');








// remove the old box
function remove_default_categories_box() {
    remove_meta_box('categorydiv', 'post', 'side');
}
add_action( 'admin_head', 'remove_default_categories_box' );


// First we create a function
function list_terms_custom_taxonomy( $atts ) {

// Inside the function we extract custom taxonomy parameter of our shortcode

    extract( shortcode_atts( array(
        'custom_taxonomy' => '',
        'child_of' => '',
        'title' => ''
    ), $atts ) );

// arguments for function wp_list_categories
$args = array(
taxonomy => $custom_taxonomy,
title_li => '',
child_of => $child_of
);

// We wrap it in unordered list
echo '<h2 class="sidebar-cat-title">' . $title . '</h2>';
echo '<ul>';
echo wp_list_categories($args);
echo '</ul>';
}

// Add a shortcode that executes our function
add_shortcode( 'ct_terms', 'list_terms_custom_taxonomy' );

//Allow Text widgets to execute shortcodes

//add_filter('widget_text', 'do_shortcode');

// ================================ 自定义配置 ================================

$customer_settings = array();
function mml_add_customer_setting ($name, $label, $fn, $section = 'general') {
    global $customer_settings;
    $customer_settings[$name] = array(
        'label' => $label,
        'fn' => $fn,
        'section' => $section
    );
}

function mml_reg_customer_setting () {
    global $customer_settings;
    foreach ($customer_settings as $k => $v) {
        register_setting($v['section'], $k);
        add_settings_field($k, $v['label'], $v['fn'], $v['section']);
    }
}

add_filter( 'admin_init' , 'mml_reg_customer_setting');

// --------------------------------  --------------------------------

// 手机、座机、邮箱、地址、社交外链（fb、tw、linkedin、youtube）

function mml_render_footer_phone_setting () {
    $value = get_option('mml_footer_phone', '');
    echo '<input name="mml_footer_phone" type="text" id="mml_footer_phone" placeholder="Mobile Phone" value="' . $value . '" class="regular-text">';
    // echo '<p class="description" id="mml_footer_phone-description">Contect Phone</p>';
}
mml_add_customer_setting('mml_footer_phone', '<label for="mml_footer_phone">Phone</label>', 'mml_render_footer_phone_setting');

function mml_render_footer_tel_setting () {
    $value = get_option('mml_footer_tel', '');
    echo '<input name="mml_footer_tel" type="text" id="mml_footer_tel" placeholder="Telephone, on desk" value="' . $value . '" class="regular-text">';
    // echo '<p class="description" id="mml_footer_tel-description">Contect tel</p>';
}
mml_add_customer_setting('mml_footer_tel', '<label for="mml_footer_tel">Telephone</label>', 'mml_render_footer_tel_setting');

function mml_render_footer_email_setting () {
    $value = get_option('mml_footer_email', '');
    echo '<input name="mml_footer_email" type="text" id="mml_footer_email" placeholder="Email" value="' . $value . '" class="regular-text">';
    // echo '<p class="description" id="mml_footer_email-description">Email</p>';
}
mml_add_customer_setting('mml_footer_email', '<label for="mml_footer_email">Email</label>', 'mml_render_footer_email_setting');

function mml_render_footer_address_setting () {
    $value = get_option('mml_footer_address', '');
    echo '<input name="mml_footer_address" type="text" id="mml_footer_address" placeholder="Address" value="' . $value . '" class="regular-text">';
    // echo '<p class="description" id="mml_footer_address-description">Address</p>';
}
mml_add_customer_setting('mml_footer_address', '<label for="mml_footer_address">Address</label>', 'mml_render_footer_address_setting');

function mml_render_footer_copyright_setting () {
    $value = get_option('mml_footer_copy_right', '');
    echo '<input name="mml_footer_copy_right" type="text" id="mml_footer_copy_right" placeholder="Copy Right" value="' . $value . '" class="regular-text">';
}
mml_add_customer_setting('mml_footer_copy_right', '<label for="mml_footer_copy_right">Copy Right</label>', 'mml_render_footer_copyright_setting');

function mml_render_footer_link_facebook_setting () {
    $value = get_option('mml_footer_link_facebook', '');
    echo '<input name="mml_footer_link_facebook" type="text" id="mml_footer_link_facebook" placeholder="Link of Facebook" value="' . $value . '" class="regular-text">';
    // echo '<p class="description" id="mml_footer_link_facebook-description">Contect link_facebook</p>';
}
mml_add_customer_setting('mml_footer_link_facebook', '<label for="mml_footer_link_facebook">Facebook</label>', 'mml_render_footer_link_facebook_setting');

function mml_render_footer_link_twitter_setting () {
    $value = get_option('mml_footer_link_twitter', '');
    echo '<input name="mml_footer_link_twitter" type="text" id="mml_footer_link_twitter" placeholder="Link of Twitter" value="' . $value . '" class="regular-text">';
    // echo '<p class="description" id="mml_footer_link_twitter-description">Contect link_twitter</p>';
}
mml_add_customer_setting('mml_footer_link_twitter', '<label for="mml_footer_link_twitter">Twitter</label>', 'mml_render_footer_link_twitter_setting');

function mml_render_footer_link_linkedin_setting () {
    $value = get_option('mml_footer_link_linkedin', '');
    echo '<input name="mml_footer_link_linkedin" type="text" id="mml_footer_link_linkedin" placeholder="Link of Linkedin" value="' . $value . '" class="regular-text">';
    // echo '<p class="description" id="mml_footer_link_linkedin-description">Contect link_linkedin</p>';
}
mml_add_customer_setting('mml_footer_link_linkedin', '<label for="mml_footer_link_linkedin">Linkedin</label>', 'mml_render_footer_link_linkedin_setting');

function mml_render_footer_link_youtube_setting () {
    $value = get_option('mml_footer_link_youtube', '');
    echo '<input name="mml_footer_link_youtube" type="text" id="mml_footer_link_youtube" placeholder="Link of Youtube" value="' . $value . '" class="regular-text">';
    // echo '<p class="description" id="mml_footer_link_youtube-description">Contect link_youtube</p>';
}
mml_add_customer_setting('mml_footer_link_youtube', '<label for="mml_footer_link_youtube">Youtube</label>', 'mml_render_footer_link_youtube_setting');

function mml_reg_seo_noindex_setting () {
    register_setting('reading', 'mml_seo_noindex');
    add_settings_field('mml_seo_noindex', '<label for="mml_seo_noindex">"noindex" links</label>', 'mml_seo_noindex_setting', 'reading');
}
function mml_seo_noindex_setting () {
    $value = get_option('mml_seo_noindex', '');
    echo '<textarea name="mml_seo_noindex" id="mml_seo_noindex" class="regular-text" rows="5" cols="30" placeholder="Example: /a-type/">' . $value . '</textarea>';
    echo '<p class="description" id="mml_seo_noindex-description">"http://www.xxx.com" is NOT need.<br />';
    echo 'Each URI one row.<br />Starts with "/" and ends with "/" .</p>';
}
add_filter( 'admin_init' , 'mml_reg_seo_noindex_setting');

// ================================ 自定义配置 END ================================

// ================================ 组件 ================================

// ---------------- popup-cf7 ----------------

global $component_popup_cf7;
function component_popup_cf7 ($shortcode, $wrap_class) {
	global $component_popup_cf7;
	$component_popup_cf7 = true;
	echo '	<div class="' . $wrap_class . '">';
	echo '		<div class="the-popup">';
	echo '			<a class="close-popup" href="#">✖️</a>';
	echo do_shortcode($shortcode);
	echo '		</div>';
	echo '	</div>';
}

// ---------------- popup-cf7 END ----------------

// ================================ 组件 END ================================

// ================================ ACTION ================================

/** 检查当前页面是否需要输出 noindex
 * 其配置由 mml_seo_noindex 的值决定。配置页面在 setting -> reading 。
 */
function mml_noindex_check () {
    $uri = $_SERVER['REQUEST_URI'];
    $value = get_option('mml_seo_noindex', '');
    if ($value) {
        if (strpos($uri, '?')) {
            $uri = explode('?', $uri)[0];
        }
        $arr = explode("\n", $value);
        foreach ($arr as $v) {
            if ($v && strtolower($v) === strtolower($uri)) { // strtoupper
                echo '<meta name="robots" content="noindex">';
            }
        }
    }
}
add_action('mml_noindex_check', 'mml_noindex_check');

// ================================ ACTION END ================================

/*
*   获取某张经后台media上传的图片的Alt Text
*/
function getImageAlt($url){
	if (!$url) {
		return 'image';
	}
	$id = attachment_url_to_postid($url);
	if (isset($id) && $id) {
		$alt = get_post_meta($id, '_wp_attachment_image_alt')[0];
		if (isset($alt) && $alt != '') {
			return $alt;
		}
	}

	$url_arr = explode('/', $url);
	$file_name = end($url_arr);
	$strrev_str = strrev($file_name);
	$strpos_res = strpos($strrev_str, '.');
	$fileName = substr($strrev_str, $strpos_res + 1, strlen($strrev_str));
	$fileName = preg_replace(['/_/','/-/'], ' ', $fileName);
	$fileName = preg_replace(['/\d+\w\d+$/'], '', $fileName);
	//return ucwords(strrev($fileName));
	return strrev($fileName);
}

if( function_exists( 'ubermenu' ) ){
    function mfn_wp_nav_menu(){
        ubermenu( 'main' , array( 'theme_location' => 'main-menu' ) );
    }
}

function mml_get_image_by_url( $url = null,  $size = 'full', $attr = [])
{

    $post_thumbnail_id = attachment_url_to_postid($url);

    $post = get_post($post_thumbnail_id);

    if (!$post) {

        return '';

    }

    if (empty($attr) || !array_key_exists('alt',$attr)) {

        $attr = [
            'alt' => getImageAlt($url),
        ];

    }

    $size = apply_filters('post_thumbnail_size', $size, $post->ID);

    if ($post_thumbnail_id) {

        do_action('begin_fetch_post_thumbnail_html', $post->ID, $post_thumbnail_id, $size);

        if (in_the_loop()) {

            update_post_thumbnail_cache();

        }

        $html = wp_get_attachment_image($post_thumbnail_id, $size, false, $attr);

        do_action('end_fetch_post_thumbnail_html', $post->ID, $post_thumbnail_id, $size);

    } else {

        $html = '';

    }

    return apply_filters('post_thumbnail_html', $html, $post->ID, $post_thumbnail_id, $size, $attr);

}
