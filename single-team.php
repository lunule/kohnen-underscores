<?php
/**
 * The template for displaying all single posts of the 'team' post type
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

						$m_txt 	= get_field('team_member_intro_text');
						$m_pos 	= get_field('team_member_position');
						$m_mail = get_field('team_member_e-mail');
						$m_li 	= get_field('team_member_linkedin');
						?>

						<article id="post-<?php the_ID(); ?>" <?php post_class('container-lg'); ?>>

							<section class="mt-xl">

								<a href="<?php echo site_url(); ?>/about">
									<span class="caps link primary back">
										<span></span>Back to About </span>
								</a>
								<div class="bio__styled-team-member padding">

									<div data-sal="slide-right" data-sal-duration="500">

										<div data-gatsby-image-wrapper="" class="gatsby-image-wrapper gatsby-image-wrapper-constrained">

											<div style="max-width: 800px; display: block;">

												<img alt="" role="presentation" aria-hidden="true" src="data:image/svg+xml;charset=utf-8,%3Csvg height='299' width='500' xmlns='http://www.w3.org/2000/svg' version='1.1'%3E%3C/svg%3E" style="max-width: 100%; display: block; position: static;"
												>

											</div>

											<?php
											$x 			= get_post_thumbnail_id();

											$img_src 	= wp_get_attachment_image_url( $x, 'medium' );
											$img_srcset = wp_get_attachment_image_srcset( $x, 'medium' );

											$img_alt 	= get_post_meta( $x, '_wp_attachment_image_alt', true );
											$img_title 	= get_post( $x )->post_title;
											$img_capt 	= get_post( $x )->post_excerpt;
											$img_desc 	= get_post( $x )->post_content;
											?>

											<img 
												src="<?php echo esc_url( $img_src ); ?>"
							     				srcset="<?php echo esc_attr( $img_srcset ); ?>"
							     				sizes="(min-width: 531px) 531px, 100vw" 
							     				alt="<?php echo $img_alt; ?>" 
							     				data-description="<?php echo $img_desc; ?>"
							     			/>

										</div>

									</div>
									<div class="details">
										<h1 class="mb-sm"><?php the_title(); ?></h1>
										<h4 class="mb-md"><?php echo $m_pos; ?></h4>
										<div class="buttons">
											<a href="mailto:<?php echo $m_mail; ?>">
												<button type="button" class="btn btn-full-primary btn-sm">
													<svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
														<path d="M424 80H88a56.06 56.06 0 00-56 56v240a56.06 56.06 0 0056 56h336a56.06 56.06 0 0056-56V136a56.06 56.06 0 00-56-56zm-14.18 92.63l-144 112a16 16 0 01-19.64 0l-144-112a16 16 0 1119.64-25.26L256 251.73l134.18-104.36a16 16 0 0119.64 25.26z"></path>
													</svg> Email </button>
											</a>
											<a href="<?php echo $m_li; ?>" target="_blank">
												<button type="button" class="btn btn-full-primary btn-sm">
													<svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 448 512" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
														<path d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z"></path>
													</svg> linkedin </button>
											</a>
										</div>
									</div>
								</div>
							</section>
							<section class="bio__styled-team-member-content">
								
								<p class="big"><?php echo $m_txt; ?></p>

								<div class="mt-sm small">
									<?php the_content(); ?>
								</div>

							</section>
							<div class="bio__styled-div"></div>

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

