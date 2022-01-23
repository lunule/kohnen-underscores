<?php
/**
 * Template part for displaying the Home Page page template content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package kohnen
 */

/**
 * Case studies
 */

$cs_q_Arr 		= array(
	'post_type' 		=> 'casestudies',
	'posts_per_page' 	=> -1,
	'post_status' 		=> 'publish',
	'order' 			=> 'DESC',
	'orderby' 			=> 'date',
);
$cs_Arr = get_posts( $cs_q_Arr );
?>

<section class="padding-large">

	<div class="container-lg">

		<div class="page-titles__styled-titles styled-titles">
			<h3 data-sal="fade" data-sal-duration="300">Company</h3>
			<h1 data-sal="fade" data-sal-duration="300" data-sal-delay="300">Case Studies</h1>
		</div>

		<div class="gx-5 gy-5 mt-xs row">

			<?php
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
	</div>
</section>

<div class="container">
	<div class="case-studies___styled-div"></div>
</div>