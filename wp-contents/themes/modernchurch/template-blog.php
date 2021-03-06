<?php
	/* Template Name: Blog */
	get_header(); 
?>

<div class="content-area">

	<?php
		// Grab needed variables 
		while( have_posts() ) : the_post(); 
		
			//Sidebar Status
			$cpt_side_bar = get_post_meta( get_the_ID(), 'cpt_side_bar', true);

		endwhile;
	?>

	<?php
		if ( $cpt_side_bar == 'left_sidebar' ) {
			$cpt_side_bar_class = ' has-left';
			get_sidebar( 'left' ); 
		} elseif ( $cpt_side_bar == 'right_sidebar' ) {
			$cpt_side_bar_class = ' has-right';
		} elseif ( $cpt_side_bar == 'dual_sidebars' ) {
			$cpt_side_bar_class = ' has-both';
			get_sidebar( 'left' ); 
		} else {
			$cpt_side_bar_class = ' no-bar';
		}
	?>

	<main class="site-main<?php echo $cpt_side_bar_class; ?>" role="main">

		<?php 
			while( have_posts() ) : the_post();
				get_template_part( 'includes/front/partials/content', 'page' );
			endwhile; // end of the loop. 

			$args = array(
				'post_type'		=>		'post',
				'order'			=>		'ASC',
				'orderby'		=>		'menu_order'
			);

			query_posts($args);

			while( have_posts() ) : the_post();
				get_template_part( 'includes/front/partials/content', 'blog');
			endwhile;
		?>

	</main><!-- /.site-main -->


	<?php
		if ( $cpt_side_bar == 'right_sidebar' || $cpt_side_bar == 'dual_sidebars' ) {
			get_sidebar( 'right' ); 
		}
	?>

</div>

<?php get_footer(); ?>