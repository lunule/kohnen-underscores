<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package kohnen
 */

get_header();
?>

	<main id="primary" class="site-main padding">

		<div class="container--search container-lg">

			<?php 
			global $sidebar_enabled;
			$fc_classes = '';
			$fi_classes = '';

			if ( true === $sidebar_enabled ) :

				$fc_classes	= " gx-5 gy-5 mt-md row"; 
				$fi_classes = " col-lg-8";

			endif;
			?>

			<div class="flex-container flex-content--search<?php echo $fc_classes; ?>">

				<div class="flex-item wrap--search<?php echo $fi_classes; ?>">

					<?php if ( have_posts() ) : ?>

						<header class="page-header padding">

							<div class="styled-titles entry-header">

								<h1 data-sal='fade' data-sal-duration='300' class="page-title">
									<?php
									/* translators: %s: search query. */
									printf( esc_html__( 'Search Results for: %s', 'kohnen' ), '<span>' . get_search_query() . '</span>' );
									?>
								</h1>
							
							</div>

						</header>						

						<section class="search-results">

							<div class="gx-5 gy-5 row">

								<?php
								/* Start the Loop */
								while ( have_posts() ) :
									the_post();

									/**
									 * Run the loop for the search to output the results.
									 * If you want to overload this in a child theme then include a file
									 * called content-search.php and that will be used instead.
									 */
									get_template_part( 'template-parts/content', 'search' );

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
