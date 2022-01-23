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

// Hero & Video
$h_vid_Arr 		= get_field('hero_video');
$h_vid_url 		= $h_vid_Arr['url'];

$h_pre_title 	= get_field('hero_pre_title');
$h_title 		= get_field('hero_title');

$h_btn_txt 		= get_field('hero_button_text');
$h_btn_url 		= get_field('hero_button_url');

// Overview
$o_title 		= get_field('overview_title');
$o_txt 			= get_field('overview_text');
$o_btn_txt 		= get_field('overview_button_text');
$o_btn_url 		= get_field('overview_button_url');

/**
 * Services block
 */

$s_q_Arr 			= array(
	'post_type' 		=> 'services',
	'posts_per_page' 	=> -1,
	'post_status' 		=> 'publish',
	'order' 			=> 'ASC',
	'orderby' 			=> 'menu_order',
);
$s_Arr 				= get_posts( $s_q_Arr );
$s_tax_terms_Arr 	= get_terms( array(
	'taxonomy' 		=> 'for',
	'hide_empty' 	=> true,
	'order' 		=> 'DESC',
) );

// Featured Case Studies
$fcs_title 		= get_field('featured_case_studies_title');
$fcs 			= get_field('featured_case_studies');
$fcs_btn_txt 	= get_field('featured_case_studies_button_text');
$fcs_btn_url 	= get_field('featured_case_studies_button_url');
?>

<section class="styled-hero">

	<div class="styled-video">

		<video 
			autoplay="autoplay" 
			loop="true" 
			muted 
			playsinline 
			src="<?php echo $h_vid_url; ?>" 			
			type="video/mp4"
		></video>

	</div>

	<div class="container" style="z-index: 10;">

		<div class="inner">

			<p class="big caps"><?php echo $h_pre_title; ?></p>

			<h1 class="mb-sm"><?php echo $h_title; ?></h1>

			<a href="<?php echo $h_btn_url; ?>">

				<button type="button" class="btn btn-full-primary-to-white btn-xxl"><?php echo $h_btn_txt; ?></button>

			</a>

		</div>

	</div>

</section>

<section class="styled-container home-section home-section--quickabout container-fluid">
	
	<?php
	echo kohnen_output_styled_logo(); 
	?>
	
	<div class="container">
	
		<section class="styled-overview-section padding-large">
	
			<div class="styled-div">
	
				<div class="mb-sm">
	
					<h2 class="secondary-header styled-secondary-header"><?php echo $o_title; ?></h2>
	
				</div>
	
				<p class="big mb-md"><?php echo $o_txt; ?></p>
	
				<a href="<?php echo $o_btn_url; ?>">
	
					<button type="button" class="btn btn-transparent-primary btn-xxl"><?php echo $o_btn_txt; ?></button>
	
				</a>
	
			</div>
	
		</section>
	
	</div>

</section>

<?php 
if ( 
		!empty($s_Arr) &&
		!empty($s_tax_terms_Arr)
	) : ?>

	<section class="styled-tabs-section padding-large">
		
		<div class="container">

			<div class="wrap--styled-tabs tabs">

				<ul class="styled-tabs mb-lg text-center nav nav-tabs horizontal" role="tablist">

					<?php
					foreach ( $s_tax_terms_Arr as $s_term ) : ?>

						<li class="nav-item" role="presentation">
				
							<?php
							$x 		= $s_term->name;
							$pos 	= strpos( $x, 'Occupiers' );
							
							if ($pos !== false)
								$x = __( 'For Occupants', 'kohnen' );
							?>

							<a 
								href="#tab-<?php echo $s_term->slug ?>"
								role="tab" 
								data-rr-ui-event-key="occupiers" 
								class="nav-link active"><?php echo $x; ?></a>
				
						</li>

					<?php 
					endforeach; ?>
					
				</ul>

			</div>
		
			<div class="tab-content" id="tabs_container">
		
				<?php
				foreach ( $s_tax_terms_Arr as $s_term ) :  

					$term_name 		= $s_term->name;
					$term_page_url 	= get_field('for_term_page_url', $s_term);

					//var_dump( $term_name );
					//var_dump( $term_page_url );
					?>
					
					<div class="tab-pane" id="tab-<?php echo $s_term->slug ?>">

						<div class="gx-3 gy-3 row wrap--styled-service-card">
								
							<?php
							foreach ( $s_Arr as $post ) :

								$term_objects_Arr 	= get_the_terms( $post->ID, 'for' );
								$terms_list_Arr 	= [];

								foreach ( $term_objects_Arr as $term )
									$terms_list_Arr[] = $term->name;

								if ( in_array($term_name, $terms_list_Arr) ) :
								?>
	
									<div class="col-lg-4 col-md-6">						

										<div id="site-selection" class="styled-service-card">

											<a href="<?php echo $term_page_url . '/#' . $post->post_name; ?>">

												<div data-gatsby-image-wrapper="" class="gatsby-image-wrapper gatsby-image-wrapper-constrained">

													<?php
													$img_src 	= get_field('icon', $post->ID);
													$x 			= attachment_url_to_postid( $img_src );
													//$img_srcset deosn't work here - maybe the small size?
													//$img_srcset = wp_get_attachment_image_srcset( $x, );

													//var_dump( $img_srcset );

													$img_alt 	= get_post_meta( $x, '_wp_attachment_image_alt', true );
													$img_title 	= get_post( $x )->post_title;
													$img_capt 	= get_post( $x )->post_excerpt;
													$img_desc 	= get_post( $x )->post_content;
													?>

													<img 
														src="<?php echo esc_url( $img_src ); ?>"
									     				srcset="<?php echo $img_src; ?> 40w, <?php echo $img_src; ?> 80w, <?php echo $img_src; ?> 160w"
									     				sizes="(min-width: 160px) 160px, 100vw" 
									     				alt="<?php echo $img_alt; ?>" 
									     				data-description="<?php echo $img_desc; ?>"
									     			/>

												</div>

												<h3 class="mt-md mb-sm"><?php echo $post->post_title; ?></h3>
											
											</a>

										</div>

									</div>
																		
								<?php
								endif;

							endforeach;
							?>

						</div>

					</div>

				<?php
				endforeach; ?>

			</div>

		</div>

	</section>

<?php
endif;

if ( $fcs ) :
?>

	<section class="mb-xl wrap--featured-case-studies">

		<div class="container-md container">

			<div class="text-center mb-lg">

				<h2 class="secondary-header styled-secondary-header">Featured Case Studies</h2>

			</div>

			<div class="gx-5 gy-5 row">

				<div class="col-lg-3">

					<div class="styled-carousel-counter">

						<span class="current">1</span>
						<span>/ <?php echo count($fcs); ?></span>

					</div>

					<div class="styled-carousel-controls d-none d-lg-block">

						<?php /* Link access bloker for the time of the slide animation */  ?>
						<span class="block-link-access"></span>

						<a class="carousel-control-prev" role="button" tabindex="0"></a>
						<a class="carousel-control-next" role="button" tabindex="0"></a>
						
					</div>				

				</div>

				<div class="col-lg-9">

					<div class="styled-carousel carousel slide carousel-dark">

						<div class="carousel-inner">

					    	<?php 
					    	foreach( $fcs as $post ) : 

					        setup_postdata($post); 
					        ?>

								<div class="active carousel-item">

									<div class="styled-case-study-card">

										<div class="inner">

											<h4 class="mb-md"><?php the_title(); ?></h4>

											<div class="mb-md">

												<p class="title">Asset Type</p>
												<p><?php echo get_field('asset_type') ?></p>

											</div>

											<div class="mb-md">

												<p class="title">Sq. Ft.</p>
												<p><?php echo get_field('sq_ft') ?></p>

											</div>
											
											<div>

												<p class="title">Location</p>
												<p><?php echo get_field('location') ?></p>

											</div>

										</div>

										<div class="bottom">

											<a href="<?php the_permalink(); ?>">
												<span class="link caps">View Details</span>
											</a>

										</div>

									</div>

								</div>

							<?php
							endforeach; 
							wp_reset_postdata();
							?>

						</div>

					</div>

					<div class="styled-carousel-controls d-lg-none">

						<?php /* Link access bloker for the time of the slide animation */  ?>
						<span class="block-link-access"></span>						
						
						<a class="carousel-control-prev" role="button" tabindex="0"></a>
						<a class="carousel-control-next" role="button" tabindex="0"></a>

					</div>

				</div>

			</div>

			<div class="mt-lg text-center">

				<a href="<?php echo site_url(); ?>/case-studies">
					<button class="btn btn-transparent-primary btn-xxl">More Case Studies</button>
				</a>

			</div>

		</div>

	</section>

<?php
endif; ?>

<section class="wrap--contact-us-banner">

	<?php echo kohnen_output_contact_banner(); ?>

</section>