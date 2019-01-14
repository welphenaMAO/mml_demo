<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bloggist
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="stylesheet" href="/wp-content/themes/bloggist/css/myheader.css">
	<link rel="stylesheet" href="/wp-content/themes/bloggist/css/reset.css">
	<link rel="stylesheet" href="/wp-content/themes/bloggist/css/myfooter.css">
	<script src="/wp-content/themes/bloggist/js/jquery-1.11.3.js"></script>
	<script src="/wp-content/themes/bloggist/js/doMove.js"></script>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="page" class="site">
		<header id="masthead" class="sheader site-header clearfix">
			<nav id="primary-site-navigation" class="primary-menu main-navigation clearfix">
				<a href="#" id="pull" class="smenu-hide toggle-mobile-menu menu-toggle" aria-controls="secondary-menu" aria-expanded="false">
					<?php esc_html_e( 'Menu', 'bloggist' ); ?>
				</a>
				<div class="top-nav-wrapper">
					<div class="content-wrap">
						<div class="logo-container">
							<?php if ( has_custom_logo() ) : ?>
							<?php the_custom_logo(); ?>
						<?php else : ?>
						<!--<a class="logofont" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="Home">-->
							<!--<?php bloginfo( 'name' ); ?>-->
							<a href="http://project1.mml.local/home">
								<img src="/wp-content/themes/bloggist/images/header/retina-garden3.png" alt="">
							</a>
						<!--</a>-->
					<?php endif; ?>
				</div>
				<div class="center-main-menu">
					<?php
					wp_nav_menu( array(
						'theme_location'	=> 'menu-1',
						'menu_id'			=> 'primary-menu',
						'menu_class'		=> 'pmenu'
						) );
						?>
					</div>
				</div>
					<!--<div class="content-hide">-->
						<!--<div class="hide_nav">-->
						<!--</div>-->
					<!--</div>-->
					<div class="navTitle">
						<div class="titleWrap">
							<!--<?php if( is_front_page() ) { ?>-->
								<!--首页-->
							<!--<?php } else { ?>-->
								<!--其他页面-->
							<!--<?php } ?>-->
							<p><?php echo the_title(); ?></p>
						</div>
						<div class="icon"></div>
						<div class="bg">
							<?php if( is_front_page() ) { ?>
								<img src="/wp-content/themes/bloggist/images/header/home_garden3_slider_pic1.png" alt="">
							<?php } ?>
						</div>
					</div>
				</div>
				<!--headerBg-->
				<!--<div id="headerBg">-->
					<!--<?php if(is_front_page()) {?>-->
						<!--<img src="/wp-content/themes/bloggist/images/header/home_garden3_slider_pic1.png" alt="">-->
					<!--<?php }else {?>-->
						<!--<img src="/wp-content/themes/bloggist/images/header/home_garden3_header3.jpg" alt="">-->
					<!--<?php }?>-->
				<!--</div>-->
				<!--/ Hide pop-up-->
				<div class="hidePopUp" id="mfnDemoPanel">
					<div class="inside">
						<div class="box">
							<a href="#">
								<i>400+</i>
								websites
							</a>
						</div>
						<div class="headerTemp">
							<ul class="menu">
								<li><a href="#">HOME</a></li>
								<li><a href="#">FEATURES</a></li>
								<li><a href="#">SHORTCODES</a></li>
								<li><a href="#">BLOG</a></li>
								<li><a href="#">PORTFOLIO</a></li>
								<li><a href="#">SHOP</a></li>
								<li class="active"><a href="#">BUY NOW</a></li>
							</ul>
							<div class="info">
								400+ pre-built websites<br/>
								<span>scroll down for more</span>
							</div>
						</div>
						<div class="demos"></div>
					</div>
				</div>
			</nav>
			<div class="super-menu clearfix">
				<div class="super-menu-inner">
					<a href="#" id="pull" class="toggle-mobile-menu menu-toggle" aria-controls="secondary-menu" aria-expanded="false">

						<?php if ( has_custom_logo() ) : ?>
						<?php the_custom_logo(); ?>
						<?php else : ?>
						<a class="logofont" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<!--<?php bloginfo( 'name' ); ?>-->
							<img src="/wp-content/themes/bloggist/images/header/retina-garden3.png" alt="">
						</a>
						<?php endif; ?>
					</a>
				</div>
			</div>
			<div id="mobile-menu-overlay"></div>
		</header>
	<!-- Header img -->
	<?php if ( get_header_image() ) : ?>
	<div class="bottom-header-wrapper">
		<div class="bottom-header-text">
			<?php if (get_theme_mod('header_img_text') ) : ?>
			<div class="content-wrap">
				<div class="bottom-header-title"><?php echo wp_kses_post(get_theme_mod('header_img_text')) ?></div>
			</div>
		<?php endif; ?>
		<?php if (get_theme_mod('header_img_text_tagline') ) : ?>
		<div class="content-wrap">
			<div class="bottom-header-paragraph"><?php echo wp_kses_post(get_theme_mod('header_img_text_tagline')) ?></div>
		</div>
	<?php endif; ?>
</div>
<img src="<?php echo esc_url(( get_header_image()) ); ?>" alt="<?php echo esc_attr(( get_bloginfo( 'title' )) ); ?>" />
</div>
<?php endif; ?>
<!-- / Header img -->
<div class="content-wrap">
	<!-- Upper widgets -->
	<div class="header-widgets-wrapper">
		<?php if ( is_active_sidebar( 'headerwidget-1' ) ) : ?>
		<div class="header-widgets-three header-widgets-left">
			<?php dynamic_sidebar( 'headerwidget-1' ); ?>
		</div>
	<?php endif; ?>
	<?php if ( is_active_sidebar( 'headerwidget-2' ) ) : ?>
	<div class="header-widgets-three header-widgets-middle">
		<?php dynamic_sidebar( 'headerwidget-2' ); ?>
	</div>
<?php endif; ?>

<?php if ( is_active_sidebar( 'headerwidget-3' ) ) : ?>
	<div class="header-widgets-three header-widgets-right">
		<?php dynamic_sidebar( 'headerwidget-3' ); ?>				
	</div>
<?php endif; ?>
</div>
<!-- / Upper widgets -->
</div>
<div id="content" class="site-content clearfix">
	<div class="content-wrap">
	</div>
</div>
</div>
<script type="text/javascript">
    $(()=>{
		// $(".content-hide").hide();
		// $(window).scroll(()=>{
         //    if($(document).scrollTop()>= 120){
         //        $(".content-hide").show().slideDown();
         //    }else{
         //        $(".content-hide").hide();
         //    }
		// })
		// hide pop-up
        //var count = 0.4;
		//var temp = 1;
		var counter = 0.2;
		var step = 0.04;
		setInterval(()=>{
			counter += step;
			$(".hidePopUp a i").css("opacity",Math.abs(counter));
			if(counter>=1||counter<=0.2){
			    step = -step;
			}
		},100);
		var onOff = true;
		var end = -367;
		$(".hidePopUp a").click(()=>{
			var $hideDiv = $(".hidePopUp .inside");
    		var $right = parseInt( $hideDiv.css("right") );
    		if(onOff){
				var timer = setInterval(()=>{
					$right += 10;
					if ($right >= 0) {
						$right = 0;
						clearInterval(timer);
					}
					$hideDiv.css("right", $right + "px");
				},20)
				onOff = false;
            }else{
                var timer = setInterval(()=>{
                    $right -= 10;
                if ($right <= end) {
                    $right = end;
                    clearInterval(timer);
                }
                	$hideDiv.css("right", $right + "px");
            	},20)
                onOff = true;
			}
		})
    })
</script>