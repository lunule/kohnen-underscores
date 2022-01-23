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
$s_pre_title 		= get_field('service_pre_title');
$s_title 			= get_field('service_title');
$s_img 				= get_field('service_image');
$s_c 				= get_field('service_text_content');
$s_for_term_ID 		= get_field('for_term');

/**
 * Services block
 */

$s_q_Arr 			= array(
	'post_type' 		=> 'services',
	'posts_per_page' 	=> -1,
	'post_status' 		=> 'publish',
	'order' 			=> 'DESC',
	'orderby' 			=> 'ID',
    'tax_query' => array(
        array(
            'taxonomy' => 'for',
            'field'    => 'term_id',
            'terms'    => $s_for_term_ID,
        ),
    ),	
);
$s_Arr 				= get_posts( $s_q_Arr );
?>

<section class="padding mb-md">

	<div class="container-lg">

		<div class="styled-titles">

			<?php
			if ( 
					( '' !== $s_pre_title ) ||
					( '' !== $s_title )
				) :

				if ( '' !== $s_pre_title ) :
					
					echo "<h3 data-sal='fade' data-sal-duration='300'>{$s_pre_title}</h3>";

				endif;

				if ( '' !== $s_title ) :

					echo "<h1 data-sal='fade' data-sal-duration='300' data-sal-delay='300'>{$s_title}</h1>";

				endif;

			else :

				echo "<h1 data-sal='fade' data-sal-duration='300'>{$title}</h1>";

			endif;
			?>

		</div>

		<div class="gx-5 gy-5 mt-xs row">

			<div class="col-lg-6">

				<div data-gatsby-image-wrapper="" class="gatsby-image-wrapper gatsby-image-wrapper-constrained" style="height: 100%;">

					<div style="max-width: 500px; display: block;">

						<img alt="" role="presentation" aria-hidden="true" src="data:image/svg+xml;charset=utf-8,%3Csvg height='299' width='500' xmlns='http://www.w3.org/2000/svg' version='1.1'%3E%3C/svg%3E" style="max-width: 100%; display: block; position: static;"
						>

					</div>

					<?php
					$img_src 	= $s_img;
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
	     				sizes="(min-width: 900px) 900px, 100vw" 
	     				alt="<?php echo $img_alt; ?>" 
	     				data-description="<?php echo $img_desc; ?>"
	     			/>

				</div>

			</div>

			<div class="col-lg-6">

				<div class="services__styled-content">

					<?php echo $s_c; ?>

				</div>

			</div>

		</div>

	</div>

</section>

<?php
if ( count( $s_Arr ) > 0 ) : ?>

	<section>

		<div class="container-lg">

			<div class="services__styled-services-grid padding">
			
				<div class="mt-md">
			
					<div class="gx-5 gy-5 row">

						<?php
						foreach ( $s_Arr as $post ) : setup_postdata($post);  ?>

							<div class="col-lg-6">						

								<div id="<?php echo $post->post_name; ?>" class="services__styled-service-card styled-service-card">

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
						     				srcset="<?php echo $img_src; ?> 53w, <?php echo $img_src; ?> 105w, <?php echo $img_src; ?> 210w"
						     				sizes="(min-width: 210px) 210px, 100vw" 
						     				alt="<?php echo $img_alt; ?>" 
						     				data-description="<?php echo $img_desc; ?>"
						     			/>

									</div>

									<h3 class="mt-md mb-sm"><?php echo $post->post_title; ?></h3>
									<?php the_content(); ?>

								</div>

							</div>					

						<?php
						endforeach;
						wp_reset_postdata(); ?>

					</div>

				</div>

			</div>

		</div>

	</section>

<?php 
endif; ?>