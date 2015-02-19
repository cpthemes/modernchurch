<article class="post-listing">

	<div class="entry-content">
		<?php 
			$post_format = get_post_format();

			if( $post_format == 'video' ) {
				$video = get_post_meta( get_the_ID(), '_format_video_embed', true );
				if ( !empty( $video ) ) {
		?>
					<div class="video-wrapper">
		<?php
						$url = esc_url( $video );
						if ( $embed = wp_oembed_get( $url ) )
							echo $embed;
						elseif ( !empty( $video ) ) {
							printf( ‘‘, $url );
						} else {
							echo $video;
						}
				}
		?>			</div><!-- /.video-wrapper -->
		<?php
			} elseif ( $post_format == 'image' ) {
		?>
				<div class="image-wrapper">
					<?php the_post_thumbnail('full'); ?>
				</div><!-- /.image-wrapper -->
		<?php
			}
		?>
		<header class="page-header">
			<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
		</header><!-- /.page-header -->

		<div class="entry-meta">
			<?php cpt_theme_posted_on(); ?>
		</div><!-- .entry-meta -->

		<div class="excerpt">
			<?php the_excerpt(); ?>
		</div><!-- /.excerpt -->

	</div><!-- /.entry-content -->

</article>