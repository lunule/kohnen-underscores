<?php
/**
 * Template Name: Service Pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package kohnen
 */

get_header();
?>

	<main id="primary" class="site-main padding">

		<div class="container--page">

			<?php 
			global $sidebar_enabled;
			$fc_classes = '';
			$fi_classes = '';

			if ( true === $sidebar_enabled ) :

				$fc_classes	= " gx-5 gy-5 mt-md row"; 
				$fi_classes = " col-lg-8";

			endif;
			?>

			<div class="flex-container flex-content--page<?php echo $fc_classes; ?>">

				<div class="flex-item wrap--page<?php echo $fi_classes; ?>">		

					<?php
					while ( have_posts() ) :

						the_post();

						get_template_part( 'template-parts/content', 'services' );

					endwhile; // End of the loop.
					?>

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

	</main><!-- #main -->

	<section class="wrap--contact-us-banner">

		<?php echo kohnen_output_contact_banner(); ?>

	</section>	

<?php
get_footer();