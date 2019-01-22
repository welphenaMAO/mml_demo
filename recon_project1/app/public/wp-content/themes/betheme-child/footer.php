<?php
/**
 * The template for displaying the footer.
 *
 * @package Betheme
 * @author Muffin group
 * @link http://muffingroup.com
 */


$back_to_top_class = mfn_opts_get('back-top-top');

if( $back_to_top_class == 'hide' ){
    $back_to_top_position = false;
} elseif( strpos( $back_to_top_class, 'sticky' ) !== false ){
    $back_to_top_position = 'body';
} elseif( mfn_opts_get('footer-hide') == 1 ){
    $back_to_top_position = 'footer';
} else {
    $back_to_top_position = 'copyright';
}

?>

<?php do_action( 'mfn_hook_content_after' ); ?>

<?php if( 'hide' != mfn_opts_get( 'footer-style' ) ) { ?>
    <!--<div class="cta">-->
        <!--<div class="container">-->
            <!--<img src="/wp-content/themes/betheme-child/dist/img/footer-img.png">-->
            <!--<h2>Build Your Own USB Cable Today!</h2>-->
            <!--<a href="/contact/">Get In Touch<i class="fas fa-paper-plane"></i></a>-->
        <!--</div>-->
    <!--</div>-->
    <!-- #Footer -->
    <footer id="Footer" class="clearfix">
        <?php if ( $footer_call_to_action = mfn_opts_get('footer-call-to-action') ) { ?>
        <div class="footer_action">
            <div class="container">
                <div class="column one column_column">
                    <?php echo do_shortcode( $footer_call_to_action ); ?>
                </div>
            </div>
        </div>
        <?php } ?>

        <?php
            $sidebars_count = 0;
            for( $i = 1; $i <= 5; $i++ ){
                if ( is_active_sidebar( 'footer-area-'. $i ) ) $sidebars_count++;
            }

            if( $sidebars_count > 0 ){

                $footer_style = '';

                if( mfn_opts_get( 'footer-padding' ) ){
                    $footer_style .= 'padding:'. mfn_opts_get( 'footer-padding' ) .';';
                }

                echo '<div class="widgets_wrapper" style="'. $footer_style .'">';
                    echo '<div class="container">';

                        if( $footer_layout = mfn_opts_get( 'footer-layout' ) ){
                            // Theme Options

                            $footer_layout  = explode( ';', $footer_layout );
                            $footer_cols    = $footer_layout[0];

                            for( $i = 1; $i <= $footer_cols; $i++ ){
                                if ( is_active_sidebar( 'footer-area-'. $i ) ){
                                    echo '<div class="column '. $footer_layout[$i] .'">';
                                        dynamic_sidebar( 'footer-area-'. $i );
                                    echo '</div>';
                                }
                            }

                        } else {
                            // Default - Equal Width

                            $sidebar_class = '';
                            switch( $sidebars_count ){
                                case 2: $sidebar_class = 'one-second'; break;
                                case 3: $sidebar_class = 'one-third'; break;
                                case 4: $sidebar_class = 'one-fourth'; break;
                                case 5: $sidebar_class = 'one-fifth'; break;
                                default: $sidebar_class = 'one';
                            }

                            for( $i = 1; $i <= 5; $i++ ){
                                if ( is_active_sidebar( 'footer-area-'. $i ) ){
                                    echo '<div class="column '. $sidebar_class .'">';
                                        dynamic_sidebar( 'footer-area-'. $i );
                                    echo '</div>';
                                }
                            }

                        }

                    echo '</div>';
                echo '</div>';
            }
        ?>

        <?php if( mfn_opts_get('footer-hide') != 1 ) { ?>
            <div class="footer-wrapper">
                <div class="container">
                    <div class="column one-fourth">
                        <ul>
                            <li><span>→</span><a href="#">Lorem ipsum</a></li>
                            <li><span>→</span><a href="#">Praesent pretium</a></li>
                            <li><span>→</span><a href="#">Pellentesque</a></li>
                            <li><span>→</span><a href="#">Aliquam</a></li>
                            <li><span>→</span><a href="#">Etiam dapibus</a></li>
                        </ul>
                    </div>
                    <div class="column one-fourth">
                        <ul>
                            <li><span>→</span><a href="#">Etiam dapibus</a></li>
                            <li><span>→</span><a href="#">Nunc sit</a></li>
                            <li><span>→</span><a href="#">Etiam tempor</a></li>
                            <li><span>→</span><a href="#">Lorem ipsum</a></li>
                            <li><span>→</span><a href="#">Praesent pretium</a></li>
                        </ul>
                    </div>
                    <div class="column one-fourth">
                        <ul>
                            <li><span>→</span><a href="#">Praesent pretium</a></li>
                            <li><span>→</span><a href="#">Pellentesque</a></li>
                            <li><span>→</span><a href="#">Aliquam</a></li>
                            <li><span>→</span><a href="#">Etiam dapibus</a></li>
                        </ul>
                    </div>
                    <div class="column one-fourth">
                        <p>Level 13, 2 Elizabeth St,<br> Melbourne, Victoria 3000,<br> Australia</p>
                        <p><a href="#">noreply@envato.com</a></p>
                        <h3>+61 (0) 3 8376 6284</h3>
                    </div>
                </div>
            </div>
            <div class="footer_copy">
                <div class="container">
                    <div class="column one">

                        <?php
                            if( $back_to_top_position == 'copyright' ){
                                echo '<a id="back_to_top" class="button button_js" href=""><i class="icon-up-open-big"></i></a>';
                            }
                        ?>

                        <!-- Copyrights -->
                        <div class="copyright">
                            <?php
                                if( mfn_opts_get('footer-copy') ){
                                    echo do_shortcode( mfn_opts_get('footer-copy') );
                                } else {
                                    echo ' &copy; '. date( 'Y' ) .' '. get_bloginfo( 'name' ) .'  All Rights reserved.';
                                }
                            ?>
                        </div>



                        <?php
                            if( has_nav_menu( 'social-menu-bottom' ) ){
                                mfn_wp_social_menu_bottom();
                            } else {
                                get_template_part( 'includes/include', 'social' );
                            }
                        ?>

                    </div>
                </div>
            </div>

        <?php } ?>

        <?php
            if( $back_to_top_position == 'footer' ){
                echo '<a id="back_to_top" class="button button_js in_footer" href=""><i class="icon-up-open-big"></i></a>';
            }
        ?>

    </footer>
<?php } ?>

</div><!-- #Wrapper -->

<?php
    // Responsive | Side Slide
    if( mfn_opts_get( 'responsive-mobile-menu' ) ){
        get_template_part( 'includes/header', 'side-slide' );
    }
?>

<?php
    if( $back_to_top_position == 'body' ){
        echo '<a id="back_to_top" class="button button_js '. $back_to_top_class .'" href=""><i class="icon-up-open-big"></i></a>';
    }
?>

<?php if( mfn_opts_get('popup-contact-form') ){ ?>
    <div id="popup_contact">
        <a class="button button_js" href="#"><i class="<?php mfn_opts_show( 'popup-contact-form-icon', 'icon-mail-line' ); ?>"></i></a>
        <div class="popup_contact_wrapper">
            <?php echo do_shortcode( mfn_opts_get('popup-contact-form') ); ?>
            <span class="arrow"></span>
        </div>
    </div>
<?php } ?>

<?php do_action( 'mfn_hook_bottom' ); ?>

<!-- wp_footer() -->
<?php wp_footer(); ?>
<?php
    global $component_popup_cf7;
    if (isset($component_popup_cf7) && $component_popup_cf7 === true) {
?>
        <script>
            $(document).ready(function () {
                $('.close-popup').click(function (e) {
                    e.preventDefault()
                    $('.popup-wrap').hide()
                })

                $('.pro-btn').click(function (e) { //按钮点击事件
                    e.preventDefault()
                    $('.popup-wrap').css('display', 'flex')
                });
            })
        </script>
<?php } ?>
<script src="/wp-content/themes/betheme-child/dist/js/lazysizes.min.js"></script>
<script>
jQuery(document).ready(function(){
    var $ = jQuery;
    $('#menu-nbrising > li:nth-child(2) > a > span').append(' <i class="fas fa-angle-down"></i>');

    $(document).ready(function(){
    $('#back-to-top').on('click', function(){
        $('html, body').animate({ scrollTop: 0 }, 500);
    });
    $(".drop-down").click(function() {
            $("html,body").animate({scrollTop:800}, 500);
        });
   });

    var post = document.getElementsByClassName('post-template-default'),
        blogsWrapper = document.getElementsByClassName('blog_wrapper');

    if(post && post.length > 0){
        $('#Header_wrapper').after('<div class="row breadcrumbs"><div class="inner"><a href="/home">Home</a>&gt;<a href="/blog">Blog</a>&gt;<span><?php the_title(); ?></span></div></div>');
    }
    if(blogsWrapper && blogsWrapper.length > 0){
        // blogs page
        document.getElementById('Content').style.background = '#fff';
        var dates = $('.date_label');
        dates.each(function(){
            var txt = this.textContent;
            txt = txt.split(',')[0];
            txt = txt.split(' ');
            this.innerHTML = txt[1] +'<br>'+ txt[0];
        });
    }

});

</script>
</body>
</html>