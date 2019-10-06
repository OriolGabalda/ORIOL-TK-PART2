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
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

get_header();
?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		$first_query = new WP_Query(array(
			'post_status' => 'publish',
			'orderby' => 'publish_date',
			'order' => 'DES',
			'post_per_page' => '10',
			'category__not_in' => '2',

		));
		$second_query = new WP_Query(array(
			'post_status' => 'publish',
			'orderby' => 'publish_date',
			'order' => 'DES',
			'post_per_page' => '6',
			'category__in' => '2',

		));

		$post_carrousel = 4;

		//------------------------------------------------------------------------------ FIRST LOOP START ---------------------------------------------------------------
		if ( $first_query->have_posts() ) {

			$x = 0;

			// Load posts loop.

			?>
			
			<div class="wrapper">
				<div class="title">
					<h3>LATEST POSTS</h3>
				</div>
				<ul class="carousel" data-target="carousel">
			<?php
			while ( $first_query->have_posts() && $x < $post_carrousel ) { 
				$first_query->the_post();
				$titulo = get_the_title(); // almacenamos el título del post en la variable titulo
				$imagen_destacada = get_the_post_thumbnail(); // almacenamos la imangen destacada del post en la variable imagen_destacada

				echo '<li class="card" data-target="card">'.$titulo.'</br>'.$imagen_destacada.'</li>'; //imprimimos en pantalla el resultado

				$x ++; // sumamos uno a x para que cuando llegue a 3 y sea < 4 se para el bucle y salga.

			};
			?>
				</ul>
				<div class="button-wrapper">
					<button class="arrow" data-action="slideLeft"><</button>
				    <button class="arrow" data-action="slideRight">></button>
				</div>
			</div>

			<?php

		} else {


			// If no content, include the "No posts found" template.
			get_template_part( 'template-parts/content/content', 'none' );

		}
		//-----------------------------------------------------------------------------FIRST LOOP FINISH-----------------------------------------------------------------------





		//-----------------------------------------------------------------------------SECOND LOOP START-----------------------------------------------------------------------
		if ( $second_query->have_posts() ) {

			$x = 0;
			$y = 0;
			// Load posts loop.

			?>
			<div class="container popular_posts">
				<div class="row">
					<div class="title">
						<h3>POPULAR POSTS</h3>
					</div>
				</div>
				<div class="row">
					<table class="table">
						<tr>
			<?php
			while ( $second_query->have_posts() ) { 
				$second_query->the_post();
				$titulo = get_the_title(); // almacenamos el título del post en la variable titulo
				$resumen = get_the_excerpt(); // almacenamos el resumen del post en la variable resumen
				$imagen_destacada = get_the_post_thumbnail_url(); // almacenamos la url de la imangen destacada del post en la variable imagen_destacada
				
				if($y == 3){
					echo '</tr><tr>';
					$y = 0;
				}
				if( $x%2==0){
					echo '<td style="background: linear-gradient(0deg,rgba(0,0,205,0.6),rgba(0,0,205,0.6)), url('.$imagen_destacada.')"><h4>'.$titulo.'</h4><p>'.$resumen.'</p></td>';
				}
				else{
					echo '<td style="background: linear-gradient(0deg,rgba(0,0,139,0.6),rgba(0,0,139,0.6)), url('.$imagen_destacada.')"><h4>'.$titulo.'</h4><p>'.$resumen.'</p></td>';
				}
				

				$x ++; // sumamos uno a x para ocupar la siguiente posición en el próximo bucle.
				$y ++;
				
			};
			?>
						</tr>
					</table>
				</div>
			</div>
			<?php

		} else {
			

			// If no content, include the "No posts found" template.
			get_template_part( 'template-parts/content/content', 'none' );

		}

		//---------------------------------------------------------------------------- SECOND LOOP FINISH ---------------------------------------------------------------------




		//----------------------------------------------------------------------------- THIRD LOOP START ----------------------------------------------------------------------

		if ( $first_query->have_posts() ) {

			$x = $post_carrousel;
			$y = 0;
			// Load posts loop.

			?>
			
			<div class="container latest_posts">
				<div class="row">
					<div class="title">
						<h3>LATEST POSTS</h3>
					</div>
				</div>
				<div class="row">
					<table class="table">
						<tr>
			<?php
			while ( $first_query->have_posts() && $x < 10 ) { 
				$first_query->the_post();
				$titulo = get_the_title(); // almacenamos el título del post en la variable titulo
				$resumen = get_the_excerpt(); // almacenamos el resumen del post en la variable resumen
				$imagen_destacada = get_the_post_thumbnail_url(); // almacenamos la url de la imangen destacada del post en la variable imagen_destacada
				
				if($y == 3){
					echo '</tr><tr>';
					$y = 0;
				}
				if( $x%2==0){
					echo '<td style="background: linear-gradient(0deg,rgba(220,20,60,0.6),rgba(220,20,60,0.6)), url('.$imagen_destacada.')"><h4>'.$titulo.'</h4><p>'.$resumen.'</p></td>';
				}
				else{
					echo '<td style="background: linear-gradient(0deg,rgba(139,0,0,0.6),rgba(139,0,0,0.6)), url('.$imagen_destacada.')"><h4>'.$titulo.'</h4><p>'.$resumen.'</p></td>';
				}
				

				$x ++; // sumamos uno a x para ocupar la siguiente posición en el próximo bucle.
				$y ++;
				
			};
			?>
						</tr>
					</table>
				</div>
			</div>
			<?php


		} else {


			// If no content, include the "No posts found" template.
			get_template_part( 'template-parts/content/content', 'none' );

		}

		//--------------------------------------------------------------------------- THIRD LOOP FINISH ----------------------------------------------------------------------

		?>


		<div class="row footer_pagination">
				<?php
				// Protect against arbitrary paged values
				$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
				 
				$args = array(
				    'post_type' => 'post',
				    'post_status'=>'publish',
				    'posts_per_page' => 1,
				    'paged' => $paged,
				);
				 
				$the_query = new WP_Query($args);
				
				if ( $the_query->have_posts() ){
				     
				    while ( $the_query->have_posts() ){ 
				    	$the_query->the_post();
				        // Post content goes here...
				    } 

				    ?>
				 
				    <div class="pagination">
				        <?php
				        echo paginate_links( array(
				            'format'  => 'page/%#%',
				            'current' => $paged,
				            'total'   => $the_query->max_num_pages,
				            'mid_size'        => 3,
				            'prev_text'       => __('&laquo;'),
				            'next_text'       => __('&raquo;')
				        ) );
				        ?>
				    </div>
				     
				<?php 
				}
				?>
		</div>
		</main><!-- .site-main -->
	</section><!-- .content-area -->

<?php
get_footer();
