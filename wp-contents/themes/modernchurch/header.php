<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">

		<link href='http://fonts.googleapis.com/css?family=Roboto:400,500,700,300' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
		
		<link href="<?php echo get_stylesheet_directory_uri(); ?>/style.css" rel='stylesheet' type='text/css'>

        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">
	
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">

		<?php wp_head(); ?>

	</head>
	<body <?php body_class(); ?>>

	<?php
		//Initialize Theme Options
		global $cpthemes;

		// Logo URL
		$logo_url = $cpthemes['header-logo']['url'];

		// Is this page home
		$trigger_front = ' home';
		if ( ! is_front_page() ) {
			$trigger_front = ' sublevel';
		}
	?>
	
		<header class="global-header<?php echo $trigger_front; ?>">
			<div class="wrapper">
				<div class="logo-wrapper">
					<a href="<?php bloginfo('url'); ?>">
						<img src="<?php echo $logo_url; ?>">
					</a>
				</div><!-- /.logo-wrapper -->

				<?php 
					$defaults = array(
						'theme_location'		=>		'main-navigation-menu',
						'container'				=>		'nav',
						'container_class'		=>		'global-nav',
						'depth'					=>		2
					);
					wp_nav_menu( $defaults );
				?>

				<div class="header-search"></div>

			</div><!-- /.wrapper -->
			<?php
				get_template_part('includes/front/partials/search','header');
			?>
		</header>