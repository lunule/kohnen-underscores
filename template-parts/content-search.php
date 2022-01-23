<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package kohnen
 */
global $post;

$post_categories 	= wp_get_post_categories( get_the_ID() );
//$cats 				= array();
//$cats_Str 			= '';

$post_tags 			= get_the_tags( get_the_ID() );
$tags 				= array();
$tags_Str 			= '';

$first_cat 			= '';
$tags_Str 			= '';
$pt_name 			= '';

if ( has_category( '', get_the_ID() ) ) :

	/*foreach( $post_categories as $c ) :

	    $cat = get_category( $c );
	    $cats[] = $cat->slug;

	endforeach;*/

	//$cats_Str = implode(' ', $cats);
	$first_cat 	= get_category( $post_categories[0] )->slug;    	

endif;

if ( false !== $post_tags ) :

	foreach( $post_tags as $t ) :

	    $tags[] = $t->slug;
	    $tags[] = $t->name;

	endforeach;

	$tags_Str = implode(' ', $tags);

endif;

$pt_Obj 	= get_post_type_object(get_post_type($post));
$pt_name 	= esc_html($pt_Obj->labels->singular_name);
?>

<div class="item col-xl-4 col-lg-6">

	<div class="item__inner">

		<article id="post-<?php the_ID(); ?>" <?php post_class('styled-post-card'); ?>>

		    <div class="image-wrap">
		        
				<?php 
				if ( has_post_thumbnail() ) : ?>

					<div data-gatsby-image-wrapper="" class="gatsby-image-wrapper gatsby-image-wrapper-constrained" style="height: 100%;">

						<div style="max-width: 500px; display: block;">

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
		     				sizes="(max-width: 50em) 87vw, 680px" 
		     				alt="<?php echo $img_alt; ?>" 
		     				data-description="<?php echo $img_desc; ?>"
		     			/>

					</div>
				
				<?php
				endif; ?>

		    </div>
		    
		    <div class="details">
		    
		        <?php
		        if ( has_category( '', get_the_ID() ) ) :

			        foreach ( $post_categories as $c ) :

			        	$cat = get_category( $c );
						echo "<span class='category'>{$cat->name}</span> ";

			        endforeach;

			    endif;
		        ?>
		    
		    	<h4 class="entry-title mb-xs"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
		    
		        <?php echo kohnen_custom_excerpt( get_the_excerpt(), 22 ); ?>
		    
		        <a href="<?php the_permalink(); ?>"><span class="primary caps link">Read More</span></a>

				<?php if ( get_edit_post_link() ) : ?>
					<footer class="entry-footer">
						<?php
						edit_post_link(
							sprintf(
								wp_kses(
									/* translators: %s: Name of current post. Only visible to screen readers */
									__( 'Edit <span class="screen-reader-text">%s</span>', 'kohnen' ),
									array(
										'span' => array(
											'class' => array(),
										),
									)
								),
								wp_kses_post( get_the_title() )
							),
							'<span class="edit-link">',
							'</span>'
						);
						?>
					</footer><!-- .entry-footer -->
				<?php endif; ?>
		    
		    </div>

		</article>

	</div>

</div>

