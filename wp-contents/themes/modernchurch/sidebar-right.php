<?php
	if ( ! is_active_sidebar( 'right_sidebar' ) ) {
		return;
	}
?>

<aside class="right-sidebar widget-area" role="complementary">
	<?php dynamic_sidebar( 'right_sidebar' ); ?>
</aside><!-- #secondary -->
