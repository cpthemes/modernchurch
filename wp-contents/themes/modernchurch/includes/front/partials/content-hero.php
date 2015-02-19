<section class="hero">
	<ul>
		<?php 
			$args = array(
				'post_type'		=>		'cpt_hero',
				'order'			=>		'ASC',
				'orderby'		=>		'menu_order'
			);

			query_posts($args);
			while( have_posts() ) : the_post();

			// Background Image URL
			$bg_id = get_post_thumbnail_id();
			$bg_url_array = wp_get_attachment_image_src($bg_id, 'full', true);
			$bg_url = $bg_url_array[0];

			// Slideshow Content
			$title = get_the_title();
			$subtitle = get_post_meta( get_the_ID(), 'cpt_hero_text', true);
			$btn_url = get_post_meta( get_the_ID(), 'cpt_hero_btn_url', true);
			$btn_txt = get_post_meta( get_the_ID(), 'cpt_hero_btn_text', true);

		?>

			<li style="background-image: url('<?php echo $bg_url; ?>');">
				<div class="overlay"></div>
				<div class="content">
					<h1><?php echo $title; ?></h1>
					<p><?php echo $subtitle; ?></p>
					<a class="btn primary-btn" href="<?php echo $btn_url; ?>"><?php echo $btn_txt; ?></a>
				</div><!-- /.content -->
			</li>

		<?php 
			endwhile;
		?>
	</ul>
	<div class="scroll-down"></div>
</section><!-- /.hero -->