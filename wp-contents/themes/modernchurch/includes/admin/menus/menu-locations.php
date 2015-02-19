<?php

if ( ! function_exists( 'cpt_register_my_menus' ) ) {

	add_action( 'init', 'cpt_register_my_menus' );

	function cpt_register_my_menus() {
	  register_nav_menus(
	    array(
	      'main-navigation-menu' => __( 'Header', 'cpt_theme' ),
	      'footer-navigation-menu' => __( 'Footer', 'cpt_theme' )
	    )
	  );
	} // END cpt_register_my_menus()

} // ENDIF

?>