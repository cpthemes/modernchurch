<?php
	global $cpthemes;

	// Column 1 Variables
	$col_one_title = $cpthemes['cta-col-one-title'];
	$col_one_desc = $cpthemes['cta-col-one-desc'];
	$col_one_link_txt = $cpthemes['cta-col-one-txt'];
	$col_one_link = $cpthemes['cta-col-one-link'];

	// Column 2 (Sermon) Variables
	$col_two_title = $cpthemes['cta-col-two-title'];
	$col_two_link_txt = $cpthemes['cta-col-two-txt'];

	// Column 3 Variables
	$col_three_title = $cpthemes['cta-col-three-title'];
	$col_three_desc = $cpthemes['cta-col-three-desc'];
	$col_three_link_txt = $cpthemes['cta-col-three-txt'];
	$col_three_link = $cpthemes['cta-col-three-link'];
?>

<section class="hp-ctas">
	<ul>
		<li>
			<h2><?php echo $col_one_title; ?></h2>
			<p><?php echo $col_one_desc; ?></p>
			<a href="<?php echo $col_one_link; ?>"><?php echo $col_one_link_txt; ?> &raquo;</a>
		</li>
		<li>
			<h2><?php echo $col_two_title; ?></h2>
			<?php 
				$args = array(
					'post_type'		=>		'cpt_sermons',
					'order'			=>		'ASC',
					'orderby'		=>		'menu_order'
				);

				query_posts( $args );

				while( have_posts() ) : the_post();

				$title = get_the_title();
				$speaker = get_post_meta( get_the_ID(), 'cpt_sermon_speaker', true );
				$sermon_date = get_post_meta( get_the_ID(), 'cpt_sermon_date', true );

			?>
				<div class="sermon-name"><?php echo $title; ?></div>
				<div class="speaker-date second-line light">
					<span class="speaker"><?php echo $speaker; ?></span>
					<span class="divider">&nbsp;&nbsp;|&nbsp;&nbsp;</span>
					<span class="date"><?php echo $sermon_date; ?></span>
				</div><!-- /.speaker-date -->
				<a href="#"><?php echo $col_two_link_txt; ?> &raquo;</a>
			<?php 
				endwhile;
			?>
		</li>
		<li>
			<h2><?php echo $col_three_title; ?></h2>
			<p>
				<?php echo $col_three_desc; ?>
			</p>
			<a href="<?php echo $col_three_link; ?>"><?php echo $col_three_link_txt; ?> &raquo;</a>
		</li>
	</ul>
</section>