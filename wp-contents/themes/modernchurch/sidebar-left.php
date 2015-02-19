<?php
	if ( ! is_active_sidebar( 'left_sidebar' ) ) {
		return;
	}
?>

<aside class="left-sidebar widget-area" role="complementary">
	<?php dynamic_sidebar( 'left_sidebar' ); ?>
</aside><!-- #secondary -->
