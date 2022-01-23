<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package kohnen
 */

if ( ! function_exists( 'kohnen_custom_excerpt' ) ) :

	function kohnen_custom_excerpt( $content, $wordlimit ) {
 
		// Let's remove Visual Composer shorttags.
		$content = preg_replace("~(?:\[/?)[^/\]]+/?\]~s", '', $content );

		if ( false !== $wordlimit ) :

			$excerpt = force_balance_tags( 
				html_entity_decode( 
					wp_trim_words( 
						htmlentities( 
							wpautop( $content ) 
						), 
						$wordlimit, 
						'...' 
					) 
				) 
			);

		else:
		// If $wordlimit is set to false, there's no trimming. Might come in handy 
		// in case of handcrafted excerpts input in the Excerpt field.		

			$excerpt = force_balance_tags( 
				html_entity_decode( 
					htmlentities( 
						wpautop( $content . '...' ) 
					)			
				) 
			);		

		endif;
	 
		return $excerpt; 
	 
	}

endif;

/**
 * This is only for the pseudo-excerpts in the social meta description tags inside the 
 * head tag.
 *
 * DO NOT USE IT TO GENERATE FRONT-END EXCERPTS!!! The above kohnen_custom_excerpt()
 * custom excerpt function is way more reliable!!!
 */
function first_n_words($text, $number_of_words) {

	// Where excerpts are concerned, HTML tends to behave
	// like the proverbial ogre in the china shop, so best to strip that
	$text = strip_tags($text);

	// \w[\w'-]* allows for any word character (a-zA-Z0-9_) and also contractions
	// and hyphenated words like 'range-finder' or "it's"
	// the /s flags means that . matches \n, so this can match multiple lines
	$text = preg_replace("/^\W*((\w[\w'-]*\b\W*){1,$number_of_words}).*/ms", '\\1', $text);

	// strip out newline characters from our excerpt
	return str_replace("\n", "", $text);

}

// excerpt plus link if shortened
function truncate_to_n_words($text, $number_of_words, $url, $readmore = 'read more') {

	$text 		= strip_tags($text);
	$excerpt 	= first_n_words($text, $number_of_words);

	// we can't just look at the length or try == because we strip carriage returns
	if( str_word_count($text) !== str_word_count($excerpt) )
	  	$excerpt .= '... <a href="'.$url.'">'.$readmore.'</a>';

	return $excerpt;

}

if ( !function_exists('is_posts_page') ) {

	function is_posts_page() {

	  	$page_for_posts   = intval( get_option( 'page_for_posts' ) );
	  	$current_page     = get_queried_object_id();

	  	if ( $page_for_posts === $current_page ) :
			return true;
	  	endif;

	  	return false;
	
	}

}

if ( !function_exists('is_contact_page') ) {

	function is_contact_page() {

		global $post;

		if( class_exists('ACF') ) :

		  	$c_pid   		= intval( get_field( 'contact_pid', 'option' ) );
		  	$current_page 	= get_queried_object_id();	

		  	if ( $c_pid === $current_page ) :
				return true;
		  	endif;		  		

		endif;

		return false;
	
	}

}

if ( !function_exists('is_default_theme_content') ) {

	function is_default_theme_content() {

		global $post;

		if ( is_404() )
			return false;

		if ( 
				is_singular( 
					array(
						'post',
						'services',
						'casestudies',
						'team',
					) 
				) 
			)
			return false;

		if ( 
				( 'about' == get_page_template() ) 			||
				( 'casestudies' == get_page_template() ) 	||
				( 'contact' == get_page_template() ) 		||
				( 'home' == get_page_template() ) 			||
				( 'services' == get_page_template() ) 	
			)
			return false;

		if ( is_search() )
			return false;

		/*if ( is_404() )
			return false;

		if ( is_404() )
			return false;

		if ( is_404() )
			return false;

		if ( is_404() )
			return false;

		if ( is_404() )
			return false;

		if ( is_404() )
			return false;*/						

		return true;
	
	}

}

if ( ! function_exists( 'kohnen_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function kohnen_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'kohnen' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'kohnen_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function kohnen_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'kohnen' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'kohnen_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function kohnen_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'kohnen' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'kohnen' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'kohnen' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'kohnen' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'kohnen' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);
			echo '</span>';
		}

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
	}
endif;

if ( ! function_exists( 'kohnen_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function kohnen_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
					the_post_thumbnail(
						'post-thumbnail',
						array(
							'alt' => the_title_attribute(
								array(
									'echo' => false,
								)
							),
						)
					);
				?>
			</a>

			<?php
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;

if ( ! function_exists( 'kohnen_output_styled_logo' ) ) :

	function kohnen_output_styled_logo() {

		ob_start();
		?>

			<div class="styled-logo-wrap">
			
				<svg width="935px" height="652px" viewBox="0 0 935 652" version="1.1">
			
					<title>Group 23</title>
			
					<desc>Created with Sketch.</desc>
			
					<g id="Fonts" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">

						<g id="Group-23">
						
							<g id="Group-22" transform="translate(467.000000, 325.500000) scale(1, -1) translate(-467.000000, -325.500000) ">
								
								<path d="M329.846691,44 C426.581192,44 505,122.797884 505,220 L505,220 L317.002115,220 L316.99985,44.4662059 C321.242021,44.1571957 325.526087,44 329.846691,44 Z" id="Combined-Shape" fill="#EFEFEF"></path>
								
								<path d="M596.668627,487 C683.007901,487 752.999712,557.291294 752.999712,644 L752.999712,644 L585.002128,644 L585.000454,487.430704 C588.852704,487.145255 592.743775,487 596.668627,487 Z" id="Combined-Shape" fill="#EFEFEF" transform="translate(668.999856, 565.500000) scale(-1, -1) translate(-668.999856, -565.500000) "></path>
								
								<rect id="Rectangle" stroke="#EFEFEF" x="318" y="220" width="451" height="218"></rect>
								
								<rect id="Rectangle" fill="#EFEFEF" x="506" y="269" width="79" height="169"></rect>
								
								<rect id="Rectangle" fill="#EFEFEF" x="0" y="385" width="169" height="157"></rect>
								
								<rect id="Rectangle" fill="#EFEFEF" x="426" y="487" width="159" height="157"></rect>
								
								<rect id="Rectangle" fill="#EFEFEF" x="585" y="171" width="79" height="267"></rect>
								
								<rect id="Rectangle" fill="#EFEFEF" transform="translate(633.500000, 30.500000) scale(1, -1) translate(-633.500000, -30.500000) " x="603" y="0" width="61" height="61"></rect>
								
								<rect id="Rectangle" fill="#EFEFEF" transform="translate(704.500000, 234.500000) scale(1, -1) translate(-704.500000, -234.500000) " x="664" y="101" width="81" height="267"></rect>
								
								<rect id="Rectangle" fill="#FFFFFF" x="585" y="316" width="79" height="121"></rect>
								
								<rect id="Rectangle" stroke="#EFEFEF" fill="#FFFFFF" x="664" y="0" width="270" height="270" rx="66"></rect>
								
								<rect id="Rectangle" stroke="#EFEFEF" fill="#FFFFFF" x="318" y="383" width="108" height="108" rx="54"></rect>
								
								<rect id="Rectangle" stroke="#EFEFEF" fill="#FFFFFF" x="452" y="512" width="108" height="108" rx="54"></rect>
								
								<rect id="Rectangle" fill="#FFFFFF" x="425" y="558" width="160" height="93"></rect>
								
								<path d="M317,383 L317,491 L317,491 C287.728908,491 264,467.271092 264,438 L264,436 C264,406.728908 287.728908,383 317,383 Z" id="Combined-Shape" fill="#EFEFEF"></path>
								
								<path d="M263.999,383 L263.999,491 L263,491 C233.176624,491 209,466.823376 209,437 C209,407.176624 233.176624,383 263,383 L263.999,383 Z" id="Combined-Shape" fill="#EFEFEF"></path>
								
								<path d="M12.6686268,384 C99.0079009,384 168.999712,454.291294 168.999712,541 L168.999712,541 L1.00212798,541 L1.0004542,384.430704 C4.85270396,384.145255 8.7437746,384 12.6686268,384 Z" id="Combined-Shape" fill="#FFFFFF" transform="translate(84.999856, 462.500000) scale(-1, -1) translate(-84.999856, -462.500000) "></path>
							
							</g>
						
						</g>
					
					</g>
				
				</svg>
			
			</div>

		<?php
		return ob_get_clean();

	}

endif;

	function kohnen_output_contact_banner() {

		global $post;

		// Contact
		$c_title 		= get_field('contact_us_title', 'option');
		$c_txt 			= get_field('contact_us_text', 'option');
		$c_btn_txt 		= get_field('contact_us_button_text', 'option');
		$c_btn_url 		= get_field('contact_us_button_url', 'option');

		ob_start();
		?>

			<div id="contact-wrap">

				<div class="contact-us-banner__styled-contact-us-banner contact-us-banner padding-large bg-primary">

					<div class="contact-us-banner__styled-magnetic-wrap">

						<div class="inner-wrap">

							<div id="wrapper">

								<div class="cub-item" style="transform: rotate(-143.13deg);"></div>
								<div class="cub-item" style="transform: rotate(-169.38deg);"></div>
								<div class="cub-item" style="transform: rotate(-173.884deg);"></div>
								<div class="cub-item" style="transform: rotate(-175.711deg);"></div>
								<div class="cub-item" style="transform: rotate(-176.698deg);"></div>
								<div class="cub-item" style="transform: rotate(-177.316deg);"></div>
								<div class="cub-item" style="transform: rotate(-177.739deg);"></div>
								<div class="cub-item" style="transform: rotate(-178.047deg);"></div>
								<div class="cub-item" style="transform: rotate(-178.282deg);"></div>
								<div class="cub-item" style="transform: rotate(-178.466deg);"></div>
								<div class="cub-item" style="transform: rotate(-178.614deg);"></div>
								<div class="cub-item" style="transform: rotate(-178.736deg);"></div>
								<div class="cub-item" style="transform: rotate(-104.931deg);"></div>
								<div class="cub-item" style="transform: rotate(-136.848deg);"></div>
								<div class="cub-item" style="transform: rotate(-151.821deg);"></div>
								<div class="cub-item" style="transform: rotate(-159.444deg);"></div>
								<div class="cub-item" style="transform: rotate(-163.909deg);"></div>
								<div class="cub-item" style="transform: rotate(-166.809deg);"></div>
								<div class="cub-item" style="transform: rotate(-168.835deg);"></div>
								<div class="cub-item" style="transform: rotate(-170.327deg);"></div>
								<div class="cub-item" style="transform: rotate(-171.469deg);"></div>
								<div class="cub-item" style="transform: rotate(-172.372deg);"></div>
								<div class="cub-item" style="transform: rotate(-173.103deg);"></div>
								<div class="cub-item" style="transform: rotate(-173.706deg);"></div>
								<div class="cub-item" style="transform: rotate(-98.427deg);"></div>
								<div class="cub-item" style="transform: rotate(-120.651deg);"></div>
								<div class="cub-item" style="transform: rotate(-136.042deg);"></div>
								<div class="cub-item" style="transform: rotate(-145.981deg);"></div>
								<div class="cub-item" style="transform: rotate(-152.56deg);"></div>
								<div class="cub-item" style="transform: rotate(-157.126deg);"></div>
								<div class="cub-item" style="transform: rotate(-160.442deg);"></div>
								<div class="cub-item" style="transform: rotate(-162.943deg);"></div>
								<div class="cub-item" style="transform: rotate(-164.89deg);"></div>
								<div class="cub-item" style="transform: rotate(-166.446deg);"></div>
								<div class="cub-item" style="transform: rotate(-167.716deg);"></div>
								<div class="cub-item" style="transform: rotate(-168.771deg);"></div>
								<div class="cub-item" style="transform: rotate(-95.856deg);"></div>
								<div class="cub-item" style="transform: rotate(-112.306deg);"></div>
								<div class="cub-item" style="transform: rotate(-125.676deg);"></div>
								<div class="cub-item" style="transform: rotate(-135.725deg);"></div>
								<div class="cub-item" style="transform: rotate(-143.13deg);"></div>
								<div class="cub-item" style="transform: rotate(-148.643deg);"></div>
								<div class="cub-item" style="transform: rotate(-152.835deg);"></div>
								<div class="cub-item" style="transform: rotate(-156.098deg);"></div>
								<div class="cub-item" style="transform: rotate(-158.694deg);"></div>
								<div class="cub-item" style="transform: rotate(-160.801deg);"></div>
								<div class="cub-item" style="transform: rotate(-162.541deg);"></div>
								<div class="cub-item" style="transform: rotate(-163.999deg);"></div>
								<div class="cub-item" style="transform: rotate(-94.4846deg);"></div>
								<div class="cub-item" style="transform: rotate(-107.418deg);"></div>
								<div class="cub-item" style="transform: rotate(-118.768deg);"></div>
								<div class="cub-item" style="transform: rotate(-128.108deg);"></div>
								<div class="cub-item" style="transform: rotate(-135.556deg);"></div>
								<div class="cub-item" style="transform: rotate(-141.45deg);"></div>
								<div class="cub-item" style="transform: rotate(-146.136deg);"></div>
								<div class="cub-item" style="transform: rotate(-149.906deg);"></div>
								<div class="cub-item" style="transform: rotate(-152.978deg);"></div>
								<div class="cub-item" style="transform: rotate(-155.518deg);"></div>
								<div class="cub-item" style="transform: rotate(-157.643deg);"></div>
								<div class="cub-item" style="transform: rotate(-159.444deg);"></div>
								<div class="cub-item" style="transform: rotate(-93.633deg);"></div>
								<div class="cub-item" style="transform: rotate(-104.25deg);"></div>
								<div class="cub-item" style="transform: rotate(-113.962deg);"></div>
								<div class="cub-item" style="transform: rotate(-122.412deg);"></div>
								<div class="cub-item" style="transform: rotate(-129.536deg);"></div>
								<div class="cub-item" style="transform: rotate(-135.451deg);"></div>
								<div class="cub-item" style="transform: rotate(-140.343deg);"></div>
								<div class="cub-item" style="transform: rotate(-144.401deg);"></div>
								<div class="cub-item" style="transform: rotate(-147.789deg);"></div>
								<div class="cub-item" style="transform: rotate(-150.642deg);"></div>
								<div class="cub-item" style="transform: rotate(-153.066deg);"></div>
								<div class="cub-item" style="transform: rotate(-155.145deg);"></div>

							</div>

						</div>

					</div>

					<div class="container-lg">

						<div class="contact-us-banner__styled-div inner padding-large text-center" data-sal="slide-up" data-sal-duration="500">

							<h3 class="mb-sm"><?php echo $c_title; ?></h3>

							<p class="big mb-lg"><?php echo $c_txt; ?></p>

							<a class="contact-us-banner__styled-link" href="<?php echo $c_btn_url; ?>">
								<button type="button" class="btn btn-transparent-primary btn-xxl"><?php echo $c_btn_txt; ?></button>
							</a>

						</div>

					</div>

				</div>

			</div>

		<?php
		return ob_get_clean();

	}