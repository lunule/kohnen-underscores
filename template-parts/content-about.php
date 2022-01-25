<?php
/**
 * Template part for displaying the Home Page page template content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package kohnen
 */

/**
 * Get the ACF field values
 */
$intro_title 	= get_field('intro_title');
$intro_logo 	= get_field('intro_logo');
$intro_txt 		= get_field('intro_text');

$mission_title 	= get_field('mission_title');
$mission 		= get_field('mission');

$approach_title = get_field('approach_title');
$approach 		= get_field('work_approach');
$approach_img 	= get_field('mission_approach_image');

$team_img 		= get_field('team_main_image');
$cs_btn_label 	= get_field('cs_btn_label');
$cs_btn_url 	= get_field('cs_btn_url');

/**
 * Team
 */

$tm_q_Arr 		= array(
	'post_type' 		=> 'team',
	'posts_per_page' 	=> -1,
	'post_status' 		=> 'publish',
	'order' 			=> 'ASC',
	'orderby' 			=> 'menu_order',
);
$tm_Arr = get_posts( $tm_q_Arr );
?>

<section class="padding mb-md">

	<div class="container-lg">

		<div class="page-titles__styled-titles styled-titles about__styled-titles">

			<h3 data-sal="fade" data-sal-duration="300" class="about__styled-h is-in"><?php echo $intro_title; ?></h3>

			<div data-sal="fade" data-sal-duration="300" data-sal-delay="300" class="mt-md mb-md is-in">

				<div data-gatsby-image-wrapper="" class="gatsby-image-wrapper gatsby-image-wrapper-constrained">

					<?php
					$img_src 	= $intro_logo;
					$x 			= attachment_url_to_postid( $img_src );

					$img_srcset = wp_get_attachment_image_srcset( $x, 'medium' );

					$img_alt 	= get_post_meta( $x, '_wp_attachment_image_alt', true );
					$img_title 	= get_post( $x )->post_title;
					$img_capt 	= get_post( $x )->post_excerpt;
					$img_desc 	= get_post( $x )->post_content;
					?>

					<img 
						src="<?php echo esc_url( $img_src ); ?>"
	     				alt="<?php echo $img_alt; ?>" 
	     				data-description="<?php echo $img_desc; ?>"
	     			/>

				</div>

			</div>			

		</div>

		<p class="about__styled-main-text"><?php echo $intro_txt; ?></p>

	</div>

</section>

<section class="about__styled-mission padding">

	<div class="container-lg">

		<div class="gx-5 gy-5 row">

			<div class="col-lg-6">

				<div class="inner">

					<h3 class="mb-sm"><?php echo $mission_title; ?></h3>

					<p><?php echo $mission; ?></p>

					<hr>

					<div class="d-lg-none">

						<div style="padding: 2rem 0px 4rem;">

							<?php
							$img_src 	= $approach_img;
							$x 			= attachment_url_to_postid( $img_src );

							$img_srcset = wp_get_attachment_image_srcset( $x, 'medium-large' );

							$img_alt 	= get_post_meta( $x, '_wp_attachment_image_alt', true );
							$img_title 	= get_post( $x )->post_title;
							$img_capt 	= get_post( $x )->post_excerpt;
							$img_desc 	= get_post( $x )->post_content;
							?>

							<img 
								src="<?php echo esc_url( $img_src ); ?>"
			     				srcset="<?php echo esc_attr( $img_srcset ); ?>"
			     				sizes="(min-width: 600px) 600px, 100vw" 
			     				alt="<?php echo $img_alt; ?>" 
			     				data-description="<?php echo $img_desc; ?>"
			     			/>

			     		</div>

					</div>

					<h3 class="mb-sm"><?php echo $approach_title; ?></h3>

					<p><?php echo $approach; ?></p>

				</div>

			</div>

			<div class="col-lg-6">

				<div data-sal="slide-up" data-sal-duration="500" class="is-in">

					<div class="d-none d-lg-block">

						<?php
						$img_src 	= $approach_img;
						$x 			= attachment_url_to_postid( $img_src );

						$img_srcset = wp_get_attachment_image_srcset( $x, 'medium-large' );

						$img_alt 	= get_post_meta( $x, '_wp_attachment_image_alt', true );
						$img_title 	= get_post( $x )->post_title;
						$img_capt 	= get_post( $x )->post_excerpt;
						$img_desc 	= get_post( $x )->post_content;
						?>

						<img 
							src="<?php echo esc_url( $img_src ); ?>"
		     				srcset="<?php echo esc_attr( $img_srcset ); ?>"
		     				sizes="(min-width: 600px) 600px, 100vw" 
		     				alt="<?php echo $img_alt; ?>" 
		     				data-description="<?php echo $img_desc; ?>"
		     			/>

					</div>

				</div>

			</div>

		</div>

	</div>

</section>

<section class="padding">

	<div class="container-lg">

		<div class="about__team-main-image">

			<?php
			$img_src 	= $team_img;
			$x 			= attachment_url_to_postid( $img_src );

			$img_srcset = wp_get_attachment_image_srcset( $x, 'full' );

			$img_alt 	= get_post_meta( $x, '_wp_attachment_image_alt', true );
			$img_title 	= get_post( $x )->post_title;
			$img_capt 	= get_post( $x )->post_excerpt;
			$img_desc 	= get_post( $x )->post_content;
			?>

			<img 
				src="<?php echo esc_url( $img_src ); ?>"
				srcset="<?php echo esc_attr( $img_srcset ); ?>"
				sizes="(min-width: 1096px) 1096px, 100vw" 
				alt="<?php echo $img_alt; ?>" 
				data-description="<?php echo $img_desc; ?>"
			/>

		</div>

		<?php 
		if ( count( $tm_Arr ) > 0 ) : ?>

			<div>

				<?php
				foreach ( $tm_Arr as $post ) : setup_postdata($post); ?>

					<div class="about__styled-team-member">

						<div data-sal="slide-right" data-sal-duration="500" class="is-in">

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

						<div>

							<?php
							$m_txt 	= get_field('team_member_intro_text');
							$m_pos 	= get_field('team_member_position');
							$m_mail = get_field('team_member_e-mail');
							$m_li 	= get_field('team_member_linkedin');
							?>

							<h4 class="mb-sm"><?php echo ucfirst($m_pos); ?></h4>

							<p class="big"><?php echo $m_txt; ?></p>

							<a href="<?php the_permalink(); ?>">
								<span class="primary caps link">Read More</span>
							</a>

						</div>

					</div>

				<?php
				endforeach; 
				wp_reset_postdata(); 
				?>

			</div>

		<?php
		endif; ?>			

		<div class="about__styled-div text-center">

			<a href="<?php echo $cs_btn_url; ?>">

				<button type="button" class="btn btn-transparent-primary btn-xxl"><?php echo $cs_btn_label; ?></button>

			</a>

		</div>

	</div>

</section>