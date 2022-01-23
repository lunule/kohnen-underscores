<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package kohnen
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">

	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'kohnen' ); ?></a>

	<header id="masthead" class="site-header container-lg">
	
		<div class="flex-container navbar-expand-lg navbar navbar-light">

			<div class="wrap--site-branding flex-item">

				<div class="site-branding">

					<?php
					$site_logo 			= get_custom_logo();
					$home_url 			= esc_url( home_url( '/' ) );
					$site_title 		= get_bloginfo( 'name' );
					$site_description 	= get_bloginfo( 'description', 'display' );

					echo "<div class='wrap--top-logo'>{$site_logo}</div>";

					if ( is_front_page() && is_home() ) :
						echo "<h1 class='site-title'><a href='{$home_url}' rel='home'>{$site_title}</a></h1>";
					else :
						echo "<p class='site-title'><a href='{$home_url}' rel='home'>{$site_title}</a></p>";
					endif;
					
					if ( $site_description || is_customize_preview() ) :
						?>
						<p class="site-description"><?php echo $site_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
					<?php endif; ?>
				
				</div><!-- .site-branding -->

			</div>

			<button aria-controls="basic-navbar-nav" type="button" aria-label="Toggle navigation" class="navbar-toggler collapsed"><span></span></button>

			<div class="wrap--site-navigation flex-item navbar-collapse collapse">

				<nav id="site-navigation" class="site-navigation main-navigation">

					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
							'menu_class' 	 => 'menu justify-content-end navbar-nav',
						)
					);
					?>

				</nav><!-- #site-navigation -->

			</div>

		</div>

	</header><!-- #masthead -->
