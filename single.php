<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package kohnen
 */

get_header();
?>

	<main id="primary" class="site-main">

		<div class="container--single container-lg">

			<?php 
			global $sidebar_enabled;
			$fc_classes = '';
			$fi_classes = '';

			if ( true === $sidebar_enabled ) :

				$fc_classes	= " gx-5 gy-5 mt-md row"; 
				$fi_classes = " col-lg-8";

			endif;
			?>

			<div class="flex-container flex-content--single<?php echo $fc_classes; ?>">

				<div class="flex-item wrap--single<?php echo $fi_classes; ?>">

					<?php
					while ( have_posts() ) :
						the_post();

						get_template_part( 'template-parts/content', get_post_type() );
						?>

						<div class="single__styled-div"></div>

						<?php
						/**
						 * Related Posts
						 * ========================================================================
						 */
						if ( is_singular('post') ) :

							global $post;

							// Get the category IDs.
							$categories = get_the_category( $post->ID );

							// Get the URL of this category.
							$category_link = get_category_link( $categories[0] );

							if ( $categories ) :

								$category_ids = array();

								foreach ( $categories as $individual_category )
									$category_ids[] = $individual_category->term_id;

								$args = array(
									'post_type'        		=> array('post'),
									'post__not_in'        	=> array( $post->ID ),
									'posts_per_page'      	=> 3,
									'ignore_sticky_posts' 	=> true,
								);

								$rp_query = new wp_query( $args );

								if ( $rp_query->have_posts() ) : ?>

									<section class="padding mt-md styled-recent-posts">

										<div class="container">

											<div class="mb-lg">

												<h2 class="styled-secondary-header">Recent Posts</h2>

											</div>

											<div class="gx-5 gy-5 row">
									
												<?php
												while ( $rp_query->have_posts() ) :
													
													$rp_query->the_post();

													get_template_part( 'template-parts/content', 'resources' );

												endwhile;
												?>

											</div>

										</div>

									</section>
								
								<?php
								endif;
							
							endif;

							wp_reset_postdata();

						endif;

						/**
						 * EOF Related Posts
						 * ========================================================================
						 */																

						/*the_post_navigation(
							array(
								'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'kohnen' ) . '</span> <span class="nav-title">%title</span>',
								'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'kohnen' ) . '</span> <span class="nav-title">%title</span>',
							)
						);

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;*/

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

<?php
get_footer();
