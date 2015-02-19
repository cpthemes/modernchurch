<?php
// Register CPT widgetized areas.

if ( ! function_exists ('cpt_widgets_init') ) {

	add_action( 'widgets_init', 'cpt_widgets_init' );

	function cpt_widgets_init() {

		// Left Sidebar
		register_sidebar( 
			array(
				'name' 			=> __('Left Sidebar', 'cpt_theme'),
				'id' 			=> 'left_sidebar',
				'before_widget' => '<div id="%1$s" class="sidebar-wrapper widget %2$s">',
				'after_widget' 	=> '</div>',
				'before_title' 	=> '<h2 class="sidebar-widget-title left-sidebar-title">',
				'after_title' 	=> '</h2>',
			) 
		);

		// Right Sidebar
		register_sidebar( 
			array(
				'name' 			=> __('Right Sidebar', 'cpt_theme'),
				'id'			=> 'right_sidebar',
				'before_widget' => '<div class="sidebar-wrapper widget %2$s">',
				'after_widget' 	=> '</div>',
				'before_title' 	=> '<h2 class="sidebar-widget-title right-sidebar-title">',
				'after_title' 	=> '</h2>',
			) 
		);

	} // END cpt_widgets_init()
} // ENDIF
?>