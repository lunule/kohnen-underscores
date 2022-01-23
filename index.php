<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package kohnen
 */

get_header();
?>

	<main id="primary" class="site-main padding">

		<div class="container--index container-lg">

			<?php 
			global $sidebar_enabled;
			$fc_classes = '';
			$fi_classes = '';

			if ( true === $sidebar_enabled ) :

				$fc_classes	= " gx-5 gy-5 mt-md row"; 
				$fi_classes = " col-lg-8";

			endif;
			?>

			<div class="flex-container flex-content--index<?php echo $fc_classes; ?>">

				<div class="flex-item wrap--index<?php echo $fi_classes; ?>">

					<?php
					if ( have_posts() ) :

						if ( is_posts_page() ) :

		   					$acf_pre_title 	= get_field( 'resources_pre_title', get_option('page_for_posts') );
		   					$acf_title 		= get_field( 'resources_title', get_option('page_for_posts') );
		   					$title 			= get_the_title( get_option( 'page_for_posts' ) );
							?>

							<section class="padding">

								<div class="styled-titles">

									<?php
									if ( 
											( '' !== $acf_pre_title ) ||
											( '' !== $acf_title )
										) :

										if ( '' !== $acf_pre_title ) :
											
											echo "<h3 data-sal='fade' data-sal-duration='300'>{$acf_pre_title}</h3>";

										endif;

										if ( '' !== $acf_title ) :

											echo "<h1 data-sal='fade' data-sal-duration='300' data-sal-delay='300'>{$acf_title}</h1>";

										endif;

									else :

										echo "<h1 data-sal='fade' data-sal-duration='300'>{$title}</h1>";

									endif;
									?>

								</div>

							</section>	

							<div class="muuri-post-filter">

								<?php
								$categories = get_categories( array(
								    'orderby' => 'name',
								    'order'   => 'ASC'
								) );

								$url 		= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
								$url_query 	= parse_url($url, PHP_URL_QUERY);
		
								echo "<div class='categories mb-lg' id='categories'><div class='styled-category-buttons'>";

								$all_btn_classes_Arr = array( 
									'btn', 
									'btn-full-transparent', 
									'btn-xxl' 
								);
								if ( NULL == $url_query )
									array_push($all_btn_classes_Arr, 'active');

								?>

									<button type="button" data-slug="all" class="<?php echo implode( ' ', $all_btn_classes_Arr ); ?>">All</button>

									<?php
									foreach( $categories as $category ) :

									    /*$category_link = sprintf( 
									        '<a href="%1$s" alt="%2$s">%3$s</a>',
									        esc_url( get_category_link( $category->term_id ) ),
									        esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ),
									        esc_html( $category->name )
									    );
									     
									    echo '<p>' . sprintf( esc_html__( 'Category: %s', 'textdomain' ), $category_link ) . '</p> ';
									    echo '<p>' . sprintf( esc_html__( 'Description: %s', 'textdomain' ), $category->description ) . '</p>';
									    echo '<p>' . sprintf( esc_html__( 'Post Count: %s', 'textdomain' ), $category->count ) . '</p>';*/
									    
									    $pos_def 	= strpos( $url_query, $category->name );
									    $pos_lc 	= strpos( $url_query, strtolower($category->name) );

									    $cat_btn_classes_Arr = array( 
											'btn', 
											'btn-full-transparent', 
											'btn-xxl' 
										);

									    if ( 
									    		( $pos_def !== false ) || 
									    		( $pos_lc !== false ) 
									    	)
									    	array_push($cat_btn_classes_Arr, 'active');

									    ?>

										<button 
											data-slug="<?php echo $category->slug; ?>" 
											class="<?php echo implode( ' ', $cat_btn_classes_Arr ); ?>"
										><?php echo $category->name; ?></button>

									<?php
									endforeach; 

								echo "</div></div>";								
								?>								
								
								<section class="muuri-grid gx-5 gy-5 row" id="muuri-grid">

									<?php
									/* Start the Loop */
									while ( have_posts() ) :
										
										the_post();
										get_template_part( 'template-parts/content', 'resources' );

									endwhile;
									?>							

								</section>					

								<?php
								/**
								 * Image listener, very basic but very SYMPA, minimalistic lightbox
								 * functionality - not used here, but might come in handy later
								 */
								
								/*<section class="overlay" id="overlay">

									<div class="container-img">

										<button id="btn-close-popup">
											<i class="fas fa-times"></i>
										</button>

										<img src="" alt="">
										
									</div>

									<p class="description"></p>
									
								</section>*/								
								?>							

							</div>

							<?php
							?>
							
						<?php
						else:

							/* Start the Loop */
							while ( have_posts() ) :

								the_post();

								/*
								 * Include the Post-Type-specific template for the content.
								 * If you want to override this in a child theme, then include a file
								 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
								 */
								get_template_part( 'template-parts/content', get_post_type() );

							endwhile;

							the_posts_navigation();							

						endif;

					else :

						get_template_part( 'template-parts/content', 'none' );

					endif;
					?>

				</div>

				<?php
				if ( true === $sidebar_enabled ) : ?>

					<div class="flex-item wrap--sidebar col-lg-4">
						
						<?php
						get_sidebar(); ?>

					</div>

				<?php
				endif; ?>

			</div>

		</div>

	</main><!-- #main -->

<?php
get_footer();
