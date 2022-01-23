<?php
/**
 * Template part for displaying the Contact Page page template content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package kohnen
 */

/**
 * Get the ACF field values
 */
$c_pre_title 		= get_field('contact_pre_title');
$c_title 			= get_field('contact_title');
$c_loc 				= get_field('location');
$c_form_to 			= get_field('form_to');
$c_form 			= get_field('contact_form');
?>

<section class="padding mb-md">

	<div class="container-lg">
	
		<div class="page-titles__styled-titles styled-titles">
			<h3 data-sal="fade" data-sal-duration="300">Contact</h3>
			<h1 data-sal="fade" data-sal-duration="300" data-sal-delay="300">Get in Touch</h1>
		</div>
	
		<div class="gx-5 gy-5 mt-md row">
	
			<div class="col-lg-4">
	
				<div class="contact__styled-details">
	
					<div class="mb-md">
	
						<h5>ADDRESS</h5>
						<p>Torrey Reserve North Court <br>11622El Camino Real, Suite 100 <br>San Diego, CA 92130 </p>
	
					</div>
	
					<div class="map">

						<?php
						if( $c_loc ): ?>


							<div class="contact__google-map" data-zoom="13">
								        
						        <div 
						        	class="contact__styled-pin" 
						        	data-lat="<?php echo esc_attr($c_loc['lat']); ?>" 
						        	data-lng="<?php echo esc_attr($c_loc['lng']); ?>">
						       	</div>

							</div>
							    
						<?php endif; ?>

					</div>
					
					<div class="mb-sm mt-md">
						<h5>PHONE</h5>
						<a href="tel:+1 (858) 206-8333">+1 (858) 206-8333</a>
					</div>
					
					<div>
						<h5>EMAIL</h5>
						<a href="mailto:info@kohnengroup.com">info@kohnengroup.com</a>
					</div>
				
				</div>
			
			</div>
			
			<div class="col-lg-8">
			
				<?php 
				echo "<div class='contact__styled-form'>{$c_form}</div>";  
				?>
			
			</div>
		
		</div>
	
	</div>

</section>

<div class="container">
	<div class="contact___styled-div"></div>
</div>
