<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bloggist
 */

?>
</div>
</div><!-- #content -->

<footer id="colophon" class="site-footer clearfix">

	<div class="content-wrap">
		<?php if ( is_active_sidebar( 'footerwidget-1' ) ) : ?>
			<div class="footer-column-wrapper">
				<div class="footer-column-three footer-column-left">
					<?php dynamic_sidebar( 'footerwidget-1' ); ?>
				</div>
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'footerwidget-2' ) ) : ?>
				<div class="footer-column-three footer-column-middle">
					<?php dynamic_sidebar( 'footerwidget-2' ); ?>
				</div>
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'footerwidget-3' ) ) : ?>
				<div class="footer-column-three footer-column-right">
					<?php dynamic_sidebar( 'footerwidget-3' ); ?>				
				</div>
			<?php endif; ?>

		</div>

		<div class="site-info">
			<div class="widgets_wrapper">
				<div class="container">
					<div class="column one-fourth">
						<aside id="custom_html-2" class="widget_text widget widget_custom_html">
							<div class="textwidget custom-html-widget">
								<ul>
									<li style="margin-bottom: 10px;">
										<span style="color: #6ec656; margin-right: 10px;">→</span>
										<a href="#">Lorem ipsum</a>
									</li>
									<li style="margin-bottom: 10px;">
										<span style="color: #6ec656; margin-right: 10px;">→</span>
										<a href="#">Praesent pretium</a>
									</li>
									<li style="margin-bottom: 10px;">
										<span style="color: #6ec656; margin-right: 10px;">→</span>
										<a href="#">Pellentesque</a>
									</li>
									<li style="margin-bottom: 10px;">
										<span style="color: #6ec656; margin-right: 10px;">→</span>
										<a href="#">Aliquam</a>
									</li>
									<li style="margin-bottom: 10px;">
										<span style="color: #6ec656; margin-right: 10px;">→</span>
										<a href="#">Etiam dapibus</a>
									</li>
								</ul>
							</div>
						</aside>
					</div>
					<div class="column one-fourth">
						<aside id="custom_html-3" class="widget_text widget widget_custom_html">
							<div class="textwidget custom-html-widget">
								<ul>
									<li style="margin-bottom: 10px;">
										<span style="color: #6ec656; margin-right: 10px;">→</span>
										<a href="#">Etiam dapibus</a>
									</li>
									<li style="margin-bottom: 10px;">
										<span style="color: #6ec656; margin-right: 10px;">→</span>
										<a href="#">Nunc sit</a>
									</li>
									<li style="margin-bottom: 10px;">
										<span style="color: #6ec656; margin-right: 10px;">→</span>
										<a href="#">Etiam tempor</a>
									</li>
									<li style="margin-bottom: 10px;">
										<span style="color: #6ec656; margin-right: 10px;">→</span>
										<a href="#">Lorem ipsum</a>
									</li>
									<li style="margin-bottom: 10px;">
										<span style="color: #6ec656; margin-right: 10px;">→</span>
										<a href="#">Praesent pretium</a>
									</li>
								</ul>
							</div>
						</aside>
					</div>
					<div class="column one-fourth">
						<aside id="custom_html-4" class="widget_text widget widget_custom_html">
							<div class="textwidget custom-html-widget">
								<ul>
									<li style="margin-bottom: 10px;">
										<span style="color: #6ec656; margin-right: 10px;">→</span>
										<a href="#">Praesent pretium</a>
									</li>
									<li style="margin-bottom: 10px;">
										<span style="color: #6ec656; margin-right: 10px;">→</span>
										<a href="#">Pellentesque</a>
									</li>
									<li style="margin-bottom: 10px;">
										<span style="color: #6ec656; margin-right: 10px;">→</span>
										<a href="#">Aliquam</a>
									</li>
									<li style="margin-bottom: 10px;">
										<span style="color: #6ec656; margin-right: 10px;">→</span>
										<a href="#">Etiam dapibus</a>
									</li>
								</ul>
							</div>
						</aside>
					</div>
					<div class="column one-fourth">
						<aside id="custom_html-5" class="widget_text widget widget_custom_html">
							<div class="textwidget custom-html-widget">
								<p>Level 13, 2 Elizabeth St,<br> Melbourne, Victoria 3000,<br> Australia</p>
								<p class="big">
									<a href="#">noreply@envato.com</a>
								</p>
								<h3 class="themecolor">+61 (0) 3 8376 6284</h3>
							</div>
						</aside>
					</div>
				</div>
			</div>
			<div class="footer_copy">
				<div class="container">
					<div class="column one">
						<a id="back_to_top" class="button button_js" href="">
							<i class="icon-up-open-big"></i>
						</a>
						<div class="copyright"> © 2019 BeGarden 3 - BeTheme. All Rights Reserved.
							<a target="_blank" rel="nofollow" href="http://muffingroup.com">Muffin group</a>
						</div>
						<ul class="social"></ul>
					</div>
				</div>
			</div>
		</div><!-- .site-info -->
	</div>
</footer><!-- #colophon -->
</div><!-- #page -->

<div id="smobile-menu" class="mobile-only"></div>
<div id="mobile-menu-overlay"></div>

<?php wp_footer(); ?>
</body>
</html>
