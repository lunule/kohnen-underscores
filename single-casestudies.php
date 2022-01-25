<?php
/**
 * The template for displaying all single posts of the 'casestudies' post type
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package kohnen
 */

get_header();
?>

	<main id="primary" class="site-main">

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

						/**
						 * Get the ACF field values
						 */
						$cs_atype 		= get_field('asset_type');
						$cs_sqft 		= get_field('sq_ft');
						$cs_loc 		= get_field('location');
						$cs_challenge 	= get_field('challenge');
						$cs_solution 	= get_field('solution');
						?>

						<article id="post-<?php the_ID(); ?>" <?php post_class('container-lg'); ?>>

							<section class="mt-xl">
							
								<a href="<?php echo site_url(); ?>/case-studies">
									<span class="caps link primary back mb-md">
										<span></span>Case Studies </span>
								</a>
							
								<h1 class="case-study__styled-case-study-title"><?php the_title(); ?></h1>
							
							</section>
							
							<section class="case-study__styled-case-study-image">

								<div data-gatsby-image-wrapper="" class="gatsby-image-wrapper gatsby-image-wrapper-constrained" style="z-index: 0;">

									<div style="max-width: 1900px; display: block;">

										<img alt="" role="presentation" aria-hidden="true" src="data:image/svg+xml;charset=utf-8,%3Csvg height='299' width='500' xmlns='http://www.w3.org/2000/svg' version='1.1'%3E%3C/svg%3E" style="max-width: 100%; display: block; position: static;"
										>

									</div>

									<?php
									$x 			= get_post_thumbnail_id();

									$img_src 	= wp_get_attachment_image_url( $x, 'full' );
									$img_srcset = wp_get_attachment_image_srcset( $x, 'full' );

									$img_alt 	= get_post_meta( $x, '_wp_attachment_image_alt', true );
									$img_title 	= get_post( $x )->post_title;
									$img_capt 	= get_post( $x )->post_excerpt;
									$img_desc 	= get_post( $x )->post_content;
									?>

									<img 
										src="<?php echo esc_url( $img_src ); ?>"
											srcset="<?php echo esc_attr( $img_srcset ); ?>"
											sizes="(min-width: 1000px) 1000px, 100vw" 
											alt="<?php echo $img_alt; ?>" 
											data-description="<?php echo $img_desc; ?>"
										/>

								</div>

								<div data-sal="slide-down" data-sal-duration="500" class="case-study__styled-case-study-hero-card">

									<div class="mb-md">
										<p class="title">Asset Type</p>
										<p><?php echo $cs_atype; ?></p>
									</div>
									
									<div class="mb-md">
										<p class="title">Sq. Ft.</p>
										<p><?php echo $cs_sqft; ?></p>
									</div>
									
									<div class="mb-md">
										<p class="title">Location</p>
										<p><?php echo $cs_loc; ?></p>
									</div>
								
								</div>
							
							</section>
	
							<?php 
							if ( $cs_challenge && $cs_solution ) : ?>

								<section class="case-study__styled-content">
								
									<div>
								
										<h3 class="mb-sm">The Challenge</h3>
								
										<?php echo $cs_challenge; ?>
								
									</div>
								
									<div>
								
										<h3 class="mb-sm">The Solution</h3>
								
										<?php echo $cs_solution; ?>
								
									</div>
								
								</section>

							<?php
							endif; ?>
							
							<section class="padding mt-md">

								<?php
								$block_title = get_field('recent_case_studies_block_title', 'option')
										? get_field('recent_case_studies_block_title', 'option')
										: 'More Case Studies';
								?>

								<h2 class="secondary-header__styled-secondary-header styled-secondary-header"><?php echo $block_title; ?></h2>								

								<div class="gx-5 gy-5 mt-xs row">
									
									<?php
									$cs_q_Arr 		= array(
										'post_type' 		=> 'casestudies',
										'post__not_in'        	=> array( $post->ID ),
										'posts_per_page' 	=> -1,
										'post_status' 		=> 'publish',
										'order' 			=> 'DESC',
										'orderby' 			=> 'date',
									);
									$cs_Arr = get_posts( $cs_q_Arr );

									foreach ( $cs_Arr as $post ) : setup_postdata($post); ?>

										<div class="col-lg-6">

											<div class="case-study-card__styled-case-study">

												<div data-gatsby-image-wrapper="" class="gatsby-image-wrapper gatsby-image-wrapper-constrained" style="z-index: 0;">

													<div style="max-width: 900px; display: block;">

														<img alt="" role="presentation" aria-hidden="true" src="data:image/svg+xml;charset=utf-8,%3Csvg height='600' width='900'
															xmlns='http://www.w3.org/2000/svg' version='1.1'%3E%3C/svg%3E" style="max-width: 100%; display: block; position: static;">

													</div>

													<?php
													$x 			= get_post_thumbnail_id();

													$img_src 	= wp_get_attachment_image_url( $x, 'medium-large' );
													$img_srcset = wp_get_attachment_image_srcset( $x, 'medium-large' );

													$img_alt 	= get_post_meta( $x, '_wp_attachment_image_alt', true );
													$img_title 	= get_post( $x )->post_title;
													$img_capt 	= get_post( $x )->post_excerpt;
													$img_desc 	= get_post( $x )->post_content;
													?>

													<img 
														src="<?php echo esc_url( $img_src ); ?>"
									     				srcset="<?php echo esc_attr( $img_srcset ); ?>"
									     				sizes="(min-width: 900px) 900px, 100vw" 
									     				alt="<?php echo $img_alt; ?>" 
									     				data-description="<?php echo $img_desc; ?>"
									     			/>

												</div>

												<?php
												$cs_atype 		= get_field('asset_type');
												$cs_sqft 		= get_field('sq_ft');
												$cs_loc 		= get_field('location');
												$cs_challenge 	= get_field('challenge');
												$cs_solution 	= get_field('solution');
												?>

												<div data-sal="slide-down" data-sal-duration="500" class="case-study-card__styled-case-study-card">
												
													<div class="top">
												
														<h4 class="mb-md"><?php the_title(); ?></h4>
												
														<div class="mb-md">
															<p class="title">Asset Type</p>
															<p><?php echo $cs_atype; ?></p>
														</div>
												
														<div class="mb-md">
															<p class="title">Sq. Ft.</p>
															<p><?php echo $cs_sqft; ?></p>
														</div>
												
														<div class="mb-md">
															<p class="title">Location</p>
															<p><?php echo $cs_loc; ?></p>
														</div>
												
													</div>
												
													<div class="bottom">
														<a href="<?php the_permalink(); ?>">
															<span class="link caps">View Details</span>
														</a>
													</div>
												
												</div>
											
											</div>
										
										</div>

									<?php
									endforeach;
									wp_reset_postdata();
									?>

								</div>

							</section>

							<div class="case-study___styled-div"></div>

						</article>

						<?php
						// If comments are open or we have at least one comment, load up the comment template.
						/*if ( comments_open() || get_comments_number() ) :
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

