<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package kohnen
 */

$post_categories 	= wp_get_post_categories( get_the_ID() );
//$cats 				= array();
//$cats_Str 			= '';

$post_tags 			= get_the_tags( get_the_ID() );
$tags 				= array();
$tags_Str 			= '';

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

$classes_Str = 'styled-div';

if ( 
		!is_singular('post') &&
		!is_singular('team') &&
		!is_singular('casestudies') &&
		!is_singular('services')
	)
	$classes_Str .= ' default-theme-content';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $classes_Str ); ?>>

	<header class="padding">
		
		<?php
		if ( is_singular('post') ) : ?>

			<div class="styled-breadcrumb">

				<a href="<?php the_permalink( get_option( 'page_for_posts' ) ); ?>">

					<span class="caps link primary back"><span></span> All posts </span>

				</a>

				<span class="separator"></span>

				<div>
					<span></span>
					<span class="category"><?php echo ucfirst( get_category( $post_categories[0] )->name ); ?></span>
				</div>

			</div>

		<?php
		endif; ?>

		<h1 class="styled-post-title"><?php the_title(); ?></h1>

	</header>

	<?php 
	if ( has_post_thumbnail() ) : ?>

		<div data-gatsby-image-wrapper="" class="gatsby-image-wrapper gatsby-image-wrapper-constrained" style="height: 100%;">

			<div style="max-width: 2000px; display: block;">

				<img alt="" role="presentation" aria-hidden="true" src="data:image/svg+xml;charset=utf-8,%3Csvg height='299' width='500' xmlns='http://www.w3.org/2000/svg' version='1.1'%3E%3C/svg%3E" style="max-width: 100%; display: block; position: static;"
				>

			</div>

			<div aria-hidden="true" data-placeholder-image="" style="opacity: 0; transition: opacity 500ms linear 0s; background-color: rgb(200, 200, 184); position: absolute; inset: 0px; object-fit: cover;"></div>			

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
				decoding="async" 
 				srcset="<?php echo esc_attr( $img_srcset ); ?>"
 				sizes="(min-width: 2000px) 2000px, 100vw" 
 				alt="<?php echo $img_alt; ?>" 
 				data-description="<?php echo $img_desc; ?>"
 			/>

		</div>
	
	<?php
	endif; ?>

	<section class="styled-post-content">

		<div class="buttons">

			<a href="<?php the_permalink(); ?>">

				<button type="button" class="btn btn-full-primary btn-sm">

					<svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 320 512" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">

						<path d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"></path>

					</svg> Share </button>
			
			</a>

			<a href="<?php the_permalink(); ?>" target="_blank">

				<button type="button" class="btn btn-full-primary btn-sm">
				
					<svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 448 512" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
						
						<path d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z"></path>
					
					</svg> Post </button>
			</a>

			<a href="<?php the_permalink(); ?>" target="_blank">

				<button type="button" class="btn btn-full-primary btn-sm">
					
					<svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
					
						<path d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"></path>
					</svg> Tweet </button>
			
			</a>

		</div>

		<?php the_content(); ?>

	</section>

</article>