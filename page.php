<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package kohnen
 */

get_header();
?>

	<main id="primary" class="site-main padding">

		<div class="container--page container-lg">

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

						get_template_part( 'template-parts/content', 'page' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

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

	<div class="default-page__styled-div"></div>

<?php
get_footer();
