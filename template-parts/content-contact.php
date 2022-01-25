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

$address_btitle 	= get_field('address_block_title', 'option')
						? get_field('address_block_title', 'option')
						: 'Address';
$phone_btitle 		= get_field('phone_block_title', 'option')
						? get_field('phone_block_title', 'option')
						: 'Phone';
$email_btitle 		= get_field('email_block_title', 'option')
						? get_field('email_block_title', 'option')
						: 'Email';

$address 			= get_field('address', 'option');
$phone 				= get_field('phone', 'option');
$email 				= get_field('email', 'option');
?>

<section class="padding mb-md">

	<div class="container-lg">
	
		<div class="page-titles__styled-titles styled-titles">
			<h3 data-sal="fade" data-sal-duration="300"><?php echo $c_pre_title; ?></h3>
			<h1 data-sal="fade" data-sal-duration="300" data-sal-delay="300"><?php echo $c_title; ?></h1>
		</div>
	
		<div class="gx-5 gy-5 mt-md row">
	
			<div class="col-lg-4">
	
				<div class="contact__styled-details">
	
					<div class="mb-md">
	
						<h5><?php echo $address_btitle; ?></h5>
						<p><?php echo $address; ?></p>
	
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
						<h5><?php echo $phone_btitle; ?></h5>
						<a href="tel:<?php echo $phone ?>"><?php echo $phone ?></a>
					</div>
					
					<div>
						<h5><?php echo $email_btitle; ?></h5>
						<a href="mailto:<?php echo $email ?>"><?php echo $email ?></a>
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
