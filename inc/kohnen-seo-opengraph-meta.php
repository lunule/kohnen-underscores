<?php
/**
 * OPEN GRAPH
 * Attention: requires the first_n_words() function from 
 * excerpt-with-php.php
 */
 
/*
The first function will ensure that the proper doctype is added 
to our HTML. Without this code, most platforms would simply skip 
over our webpage, and the tags we are about to add would never 
get parsed. The next function is where we will actually add the 
proper metadata for Open Graph to work.
 */
function doctype_opengraph($output) {
    return $output . '
    xmlns:og="http://opengraphprotocol.org/schema/"
    xmlns:fb="http://www.facebook.com/2008/fbml"';
}
add_filter('language_attributes', 'doctype_opengraph');

function rejust_opengraph() {
    
	if ( 
			!is_admin() &&
			!is_404() &&
			!is_search() &&
			!is_archive()
		) :

	    global $post;

	    $og_type = ( is_singular() ) 
	    			? 'article' 
	    			: 'website';
	    
	    if ( is_singular() ) :

		    if ( has_post_thumbnail($post->ID) ) :
		        $img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
		    endif;
		    
		   	$title 			= the_title_attribute( 'echo=0' );;
		   	$permalink 		= get_the_permalink();

		   	$excerpt_base 	= get_the_excerpt( $post->ID );

	   	elseif ( is_archive() ) :

	   		$title 			= get_the_archive_title();
	   		$permalink 		= is_post_type_archive()
		   						? get_post_type_archive_link( get_query_var('post_type') )
		   						// else = is_tax()
		   						: get_term_link( 
		   							get_query_var( 'term' ), 
		   							get_query_var( 'taxonomy' ) 
		   						  );  

		   	$excerpt_base 	= get_the_archive_description();

	   	elseif ( is_posts_page() ) :

		   	$title 			= get_the_title( get_option( 'page_for_posts' ) );
		   	$permalink 		= get_the_permalink( get_option( 'page_for_posts' ) );  

		   	$excerpt_base 	= get_the_excerpt( get_option( 'page_for_posts' ) );

	   	endif;

		$excerpt 	= kohnen_custom_excerpt( $excerpt_base, 35 );
	    $excerpt 	= strip_tags($excerpt);
	    $excerpt 	= str_replace("\"", "'", $excerpt);   	

	   	if ( is_singular() || is_archive() || is_posts_page() ) :
		?>

		<!-- to Facebook & LinkedIn -->

			<meta property="og:url" content="<?php echo $permalink; ?>" />
			<meta property="og:type" content="<?php echo $og_type; ?>" /><!-- note: value is 'article' or 'website' -->
			<meta property="og:title" content="<?php echo $title; ?>" />
			<meta property="og:description" content="<?php echo $excerpt; ?>" />
			<meta property="og:site_name" content="<?php echo get_bloginfo( 'name' ); ?>" />

			<?php
			if ( is_singular() ) : ?>

				<meta property="og:image" content="<?php echo $img_src[0]; ?>" />
				<meta property="og:image:type" content="image/jpeg" />
				<meta property="og:image:width" content="300" />
				<meta property="og:image:height" content="300" />

			<?php
			endif; ?>

			<meta property="fb:app_id" content="<?php echo FB_APP_ID; ?>" />
			<!--<meta property="fb:admins" content="your-facebook-user-id" />-->

		<!-- EOF to Facebook -->

		<!-- to Google Plus -> schema.org markup + traditional meta stuff -->

			<meta itemprop="name" content="<?php echo $title; ?>">
			<meta itemprop="description" content="<?php echo $excerpt; ?>">
			<meta name="description" content="<?php echo $excerpt; ?>" />

			<?php
			if ( is_singular() ) : ?>
			
				<meta itemprop="image" content="<?php echo $img_src[0]; ?>">

			<?php
			endif; ?>

		<!-- EOF to Google Plus -->

		<!-- to Twitter -->

			<meta name="twitter:card" content="summary">
			<meta name="twitter:site" content="<?php echo TWITTER_HANDLE; ?>">
			<meta name="twitter:title" content="<?php echo $title; ?>">
			<meta name="twitter:description" content="<?php echo $excerpt; ?>">
			<meta name="twitter:creator" content="<?php echo TWITTER_HANDLE; ?>">

			<?php
			if ( is_singular() ) : ?>

				<meta name="twitter:image" content="<?php echo $img_src[0]; ?>">

			<?php
			endif; ?>

		<!-- EOF to Twitter -->

		<?php
		endif;

	endif;
	
}

add_action('wp_head', 'rejust_opengraph', 5);