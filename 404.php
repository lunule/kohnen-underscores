<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package kohnen
 */

get_header();
?>

	<main id="primary" class="site-main padding">

		<div class="container--404 container-lg">

			<?php 
			global $sidebar_enabled;
			$fc_classes = '';
			$fi_classes = '';

			if ( true === $sidebar_enabled ) :

				$fc_classes	= " gx-5 gy-5 mt-md row"; 
				$fi_classes = " col-lg-8";

			endif;
			?>

			<div class="flex-container flex-content--404<?php echo $fc_classes; ?>">

				<div class="flex-item wrap--404<?php echo $fi_classes; ?>">

					<section class="error-404 not-found padding">

						<div class="styled-titles">

							<h3 data-sal='fade' data-sal-duration='300'>
								<?php esc_html_e( 'Sorry 😔 we couldn’t find what you were looking for.', 'kohnen' ); ?>
							</h3>

							<h1 data-sal='fade' data-sal-duration='300' data-sal-delay='300'><a href="<?php echo site_url(); ?>"><?php _e( 'Go Home', 'kohnen' ) ?></a></h1>
						
						</div>

					</section>	

					<div class="error-404__styled-div"></div>

				</div>

				<?php
				if ( true === $sidebar_enabled ) : ?>

					<div class="flex-item wrap--sidebar col-lg-4">
						
						<?php
						get_sidebar(); ?>

					</div>

				<?php
				endif; ?>

			</div>

		</div>

<?php
get_footer();
