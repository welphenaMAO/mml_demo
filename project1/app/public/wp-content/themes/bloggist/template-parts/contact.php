<?php
/*
Template Name: Contact

 * Home Page Template for our theme
 *
 * @package WordPress
 * @subpackage Integral
 * @since Integral 1.0
 */
?>

<?php get_header(); ?>
<!--resetStyle-->
<link rel="stylesheet" href="/wp-content/themes/bloggist/css/reset.css">
<link rel="stylesheet" href="/wp-content/themes/bloggist/css/mycontact.css">


<div id="Content">
    <div class="content_wrapper">
        <div class="sections_group">
            <div class="entry-content">
                <div class="section mcb-section">
                    <div class="section_wrapper mcb-section-inner">
                        <div class="wrap mcb-wrap one-second  valign-top">
                            <div class="mcb-wrap-inner">
                                <div class="column mcb-column one column_column  column-margin-20px">
                                    <div class="column_attr">
                                        <h2>BeGarden Design</h2>
                                    </div>
                                </div>
                                <div class="column mcb-column one-second column_column ">
                                    <div class="column_attr">
                                        <p>Level 13, 2 Elizabeth St,<br> Melbourne, Victoria 3000,<br> Australia</p>
                                        <p>
                                            <a href="#">noreply@envato.com</a>
                                        </p>
                                        <p>+61 (0) 3 8376 6284</p>
                                    </div>
                                </div>
                                <div class="column mcb-column one-second column_column ">
                                    <div class="column_attr">
                                        <p>Monday - Friday<br> 11:00 am - 11:30 pm</p>
                                        <p>Saturday - Sunday<br> 14:00 am - 11:30 pm</p>
                                    </div>
                                </div>
                                <div class="column mcb-column one column_column ">
                                    <div class="column_attr ">
                                        <div role="form" class="wpcf7" id="wpcf7-f76-p9-o1" lang="en-US" dir="ltr">
                                            <div class="screen-reader-response"></div>
                                            <form action="/be/garden3/contact/#wpcf7-f76-p9-o1" method="post" class="wpcf7-form" novalidate="novalidate">
                                                <div>
                                                    <input type="hidden" name="_wpcf7" value="76">
                                                    <input type="hidden" name="_wpcf7_version" value="5.1">
                                                    <input type="hidden" name="_wpcf7_locale" value="en_US">
                                                    <input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f76-p9-o1">
                                                    <input type="hidden" name="_wpcf7_container_post" value="9">
                                                    <input type="hidden" name="g-recaptcha-response" value="">
                                                </div>
                                                <div class="column one-second">
                                                    <span class="wpcf7-form-control-wrap your-name">
                                                        <input type="text" name="your-name" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="Your name">
                                                    </span>
                                                </div>
                                                <div class="column one-second">
                                                    <span class="wpcf7-form-control-wrap your-email">
                                                        <input type="email" name="your-email" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email" aria-required="true" aria-invalid="false" placeholder="Your e-mail">
                                                    </span>
                                                </div>
                                                <div class="column one">
                                                    <span class="wpcf7-form-control-wrap your-subject">
                                                        <input type="text" name="your-subject" value="" size="40" class="wpcf7-form-control wpcf7-text" aria-invalid="false" placeholder="Subject">
                                                    </span>
                                                </div>
                                                <div class="column one">
                                                    <span class="wpcf7-form-control-wrap your-message">
                                                        <textarea name="your-message" cols="40" rows="4" class="wpcf7-form-control wpcf7-textarea" aria-invalid="false" placeholder="Message"></textarea>
                                                    </span>
                                                </div>
                                                <div class="column one">
                                                    <input type="submit" value="Send a message" class="wpcf7-form-control wpcf7-submit button_full_width">
                                                    <span class="ajax-loader"></span>
                                                </div>
                                                <div class="wpcf7-response-output wpcf7-display-none"></div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wrap mcb-wrap one-second  valign-top move-up" data-mobile="no-up">
                            <div class="mcb-wrap-inner">
                                <div class="column mcb-column one column_image ">
                                    <div class="image_frame image_item no_link scale-with-grid aligncenter no_border">
                                        <div class="image_wrapper">
                                            <img class="scale-with-grid" src="https://themes.muffingroup.com/be/garden3/wp-content/uploads/2018/04/home_garden3_contact2.jpg" alt="home_garden3_contact2" title="home_garden3_contact2" width="780" height="964">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="section mcb-section"></div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>