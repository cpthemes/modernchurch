<?php
	// Header
	get_header();

	// -- Hero
	if ( $cpthemes['hero-switch'] == 1 ) {
		get_template_part('includes/front/partials/content', 'hero');
	}

?>
	<!-- This is needed for scroll down to work -->
	<div class="content-top"></div> 
<?php	
	// -- CTA Section
	if ( $cpthemes['cta-switch'] == 1 ) {
		get_template_part('includes/front/partials/content', 'cta');
	}

	// -- Connect Section
	if ( $cpthemes['connect-switch'] == 1 ) {
		get_template_part('includes/front/partials/content', 'connect');
	}

	// Footer
	get_footer(); 
?>