<?php
/**
 * The Header for our theme.
 *
 * @package Betheme
 * @author Muffin group
 * @link http://muffingroup.com
 */
?>
<!DOCTYPE html>
<?php
    if( $_GET && key_exists('mfn-rtl', $_GET) ):
        echo '<html class="no-js" lang="ar" dir="rtl">';
    else:
?>
<html class="no-js<?php echo mfn_user_os(); ?>" <?php language_attributes(); ?><?php mfn_tag_schema(); ?>>
<?php endif; ?>

<!-- head -->
<head>
<link rel="stylesheet" href="https://use.typekit.net/ble8yft.css">
<!--<link rel="stylesheet" href="/wp-content/themes/betheme-child/dist/js/jquery-3.3.1.min.js">-->
<script src="/wp-content/themes/betheme-child/dist/js/jquery-3.3.1.min.js"></script>
<!-- meta -->
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<?php do_action('mml_noindex_check'); ?>
<?php
    if( mfn_opts_get('responsive') ){
        if( mfn_opts_get('responsive-zoom') ){
            echo '<meta name="viewport" content="width=device-width, initial-scale=1" />';
        } else {
            echo '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />';
        }
    }
?>

<?php do_action('wp_seo'); ?>

<link rel="shortcut icon" href="<?php mfn_opts_show( 'favicon-img', THEME_URI .'/images/favicon.ico' ); ?>" />
<?php if( mfn_opts_get('apple-touch-icon') ): ?>
<link rel="apple-touch-icon" href="<?php mfn_opts_show( 'apple-touch-icon' ); ?>" />

<?php endif; ?>

<link rel="stylesheet" href="/wp-content/themes/betheme-child/dist/css/fontawesome/web-fonts-with-css/css/fontawesome-all.min.css">
<!-- wp_head() -->
<?php wp_head(); ?>
</head>

<!-- body -->
<body <?php body_class(); ?>>
    <?php do_action( 'mfn_hook_top' ); ?>

    <?php get_template_part( 'includes/header', 'sliding-area' ); ?>

    <?php if( mfn_header_style( true ) == 'header-creative' ) get_template_part( 'includes/header', 'creative' ); ?>

    <?php
        // 如果需要弹出框的 cf7 ，使用下面这一行代码。
        //   取消注释，并且把 Shortcode 作为第一个参数传给 component_popup_cf7 。
        //       第二个参数是一个 css class ，用于最外层 div 。
        // component_popup_cf7('[contact-form-7 id="5" title="Contact form 1"]', 'popup-wrap');
    ?>

    <div id="Wrapper">
        <?php
            // Featured Image | Parallax ----------
            $header_style = '';

            if( mfn_opts_get( 'img-subheader-attachment' ) == 'parallax' ){

                if( mfn_opts_get( 'parallax' ) == 'stellar' ){
                    $header_style = ' class="bg-parallax" data-stellar-background-ratio="0.5"';
                } else {
                    $header_style = ' class="bg-parallax" data-enllax-ratio="0.3"';
                }

            }
        ?>

        <?php if( mfn_header_style( true ) == 'header-below' ) echo mfn_slider(); ?>

            <!-- #Header_bg -->
            <div id="Header_wrapper" <?php echo $header_style; ?>>

                <!-- #Header -->
            <?php
                if ( is_home() || is_front_page() ) {
                    echo '<header id="Header" class="heade-logo">';
                } else {
                    echo '<header id="Header">';
                } 
            ?>
                <?php if( mfn_header_style( true ) != 'header-creative' ) get_template_part( 'includes/header', 'top-area' ); ?>
                <?php if( mfn_header_style( true ) != 'header-below' ) echo mfn_slider(); ?>
            </header>

            <?php
                if( ( mfn_opts_get('subheader') != 'all' ) &&
                    ( ! get_post_meta( mfn_ID(), 'mfn-post-hide-title', true ) ) &&
                    ( get_post_meta( mfn_ID(), 'mfn-post-template', true ) != 'intro' ) ){


                    $subheader_advanced = mfn_opts_get( 'subheader-advanced' );

                    $subheader_style = '';

                    if( mfn_opts_get( 'subheader-padding' ) ){
                        $subheader_style .= 'padding:'. mfn_opts_get( 'subheader-padding' ) .';';
                    }

                    if( is_search() ){
                        // Page title -------------------------

                        echo '<div id="Subheader" style="'. $subheader_style .'">';
                            echo '<div class="container">';
                                echo '<div class="column one">';

                                    if( trim( $_GET['s'] ) ){
                                        global $wp_query;
                                        $total_results = $wp_query->found_posts;
                                    } else {
                                        $total_results = 0;
                                    }

                                    $translate['search-results'] = mfn_opts_get('translate') ? mfn_opts_get('translate-search-results','results found for:') : __('results found for:','betheme');
                                    echo '<h1 class="title">'. $total_results .' '. $translate['search-results'] .' '. esc_html( $_GET['s'] ) .'</h1>';

                                echo '</div>';
                            echo '</div>';
                        echo '</div>';


                    } elseif( ! mfn_slider_isset() || ( is_array( $subheader_advanced ) && isset( $subheader_advanced['slider-show'] ) ) ){
                        // Page title -------------------------

                        // Subheader | Options
                        $subheader_options = mfn_opts_get( 'subheader' );

                        if( is_home() && ! get_option( 'page_for_posts' ) && ! mfn_opts_get( 'blog-page' ) ){
                            $subheader_show = false;
                        } elseif( is_array( $subheader_options ) && isset( $subheader_options[ 'hide-subheader' ] ) ){
                            $subheader_show = false;
                        } elseif( get_post_meta( mfn_ID(), 'mfn-post-hide-title', true ) ){
                            $subheader_show = false;
                        } else {
                            $subheader_show = true;
                        }

                        // title
                        if( is_array( $subheader_options ) && isset( $subheader_options[ 'hide-title' ] ) ){
                            $title_show = false;
                        } else {
                            $title_show = true;
                        }

                        // breadcrumbs
                        if( is_array( $subheader_options ) && isset( $subheader_options[ 'hide-breadcrumbs' ] ) ){
                            $breadcrumbs_show = false;
                        } else {
                            $breadcrumbs_show = true;
                        }

                        if( is_array( $subheader_advanced ) && isset( $subheader_advanced[ 'breadcrumbs-link' ] ) ){
                            $breadcrumbs_link = 'has-link';
                        } else {
                            $breadcrumbs_link = 'no-link';
                        }

                        // Subheader | Print
                        if( $subheader_show ){
                            echo '<div id="Subheader" style="'. $subheader_style .'">';
                                echo '<div class="container">';
                                    echo '<div class="column one">';

                                        // Title
                                        if( $title_show ){
                                            $title_tag = mfn_opts_get( 'subheader-title-tag', 'h1' );
                                            echo '<'. $title_tag .' class="title">'. mfn_page_title() .'</'. $title_tag .'>';
                                        }
                                        // Breadcrumbs
                                        if( $breadcrumbs_show ){
                                            mfn_breadcrumbs( $breadcrumbs_link );
                                        }
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        }

                    }

                }
            ?>

        </div>

        <?php
            // Single Post | Template: Intro
            if( get_post_meta( mfn_ID(), 'mfn-post-template', true ) == 'intro' ){
                get_template_part( 'includes/header', 'single-intro' );
            }
        ?>

        <?php do_action( 'mfn_hook_content_before' ); ?>


    </div>
    <?php if( !is_front_page() && is_page() ) { ?>
    <?php }
// Omit Closing PHP Tags
   ?>
<!--<script type="text/javascript">
    $(window).resize(function () {
        var temp_w = parseInt($("body").css("width"));
        $(".p01 .headerBg").css("height",scaleW(temp_w,1.56,1240,790));
        $(".p01 .subHeader .box h1").css({
            "font-size" : scaleW(temp_w,19.07,1240,65) + "px",
            "line-height" : scaleW(temp_w,19.07,1240,65) + "px"
        });
        // $(".p01 .subHeader").css("left",scaleW(temp_w,8.43,1240,482));
        //console.log(temp_w);
    });
    /**
     *
     * @param w 宽
     * @param reta 缩放比例
     * @param dw  临界点
     * @param def 临界点上的默认值
     * @returns {number | undefined}
     */
    function scaleW(w,reta,dw,def){
        return w >= dw ? def : Math.ceil( w / reta );
    }
</script>-->