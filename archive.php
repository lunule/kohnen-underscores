<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package kohnen
 */

get_header();
?>

	<main id="primary" class="site-main padding">

		<div class="container--archive container-lg">

			<?php 
			global $sidebar_enabled;
			$fc_classes = '';
			$fi_classes = '';

			if ( true === $sidebar_enabled ) :

				$fc_classes	= " gx-5 gy-5 mt-md row"; 
				$fi_classes = " col-lg-8";

			endif;
			?>

			<div class="flex-container flex-content--archive<?php echo $fc_classes; ?>">

				<div class="flex-item wrap--archive<?php echo $fi_classes; ?>">

					<?php if ( have_posts() ) : ?>

						<header class="page-header padding">

							<div class="styled-titles entry-header">

								<h1 data-sal='fade' data-sal-duration='300' class="page-title">
									<?php the_archive_title(); ?>
								</h1>

								<?php
								//the_archive_description( '<div class="archive-description">', '</div>' );
								?>
							
							</div>

						</header>						

						<section class="archive-postlist">

							<div class="gx-5 gy-5 row">

								<?php
								/* Start the Loop */
								while ( have_posts() ) :
									the_post();

									/*
									 * Include the Post-Type-specific template for the content.
									 * If you want to override this in a child theme, then include a file
									 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
									 */
									get_template_part( 'template-parts/content-archive', get_post_type() );

								endwhile;

								the_posts_navigation();
								?>

							</div>

						</section>

					<?php
					else :

						get_template_part( 'template-parts/content', 'none' );

					endif;
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

<?php
get_footer();
