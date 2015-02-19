<?php
	global $cpthemes;

	//Footer Variables
	$footer_logo = $cpthemes['footer-logo']['url'];

	// Social Networking Variables
	$fb_link = $cpthemes['fb-link'];
	$twit_link = $cpthemes['twit-link'];
	$vm_link = $cpthemes['vm-link'];
	$insta_link = $cpthemes['insta-link'];

	// Copyright Text
	$copyright = $cpthemes['copyright'];

?>
		<footer class="global-footer">
			<div class="wrapper">
				<div class="church-info">
					<div class="ftr-logo-wrapper">
						<a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/includes/front/img/global/img-ftr-logo.png"></a>
					</div><!-- /.ftr-logo-wrapper -->
					<?php if ( $cpthemes['sn-switch'] == 1 ) { ?>
						<ul class="ftr-social-networking">
							<?php if ( $cpthemes['fb-switch'] == 1 ) { ?>
								<li>
									<a class="facebook" href="<?php echo $fb_link; ?>">
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/includes/front/img/global/img-ftr-fb.png">
									</a><!-- /.facebook -->
								</li>
							<?php } ?>
							<?php if ( $cpthemes['twit-switch'] == 1 ) { ?>
								<li>
									<a class="twitter" href="<?php echo $twit_link; ?>">
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/includes/front/img/global/img-ftr-twitter.png">
									</a><!-- /.twitter -->
								</li>
							<?php } ?>
							<?php if ( $cpthemes['vm-switch'] == 1 ) { ?>
								<li>
									<a class="vimeo" href="<?php echo $vm_link; ?>">
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/includes/front/img/global/img-ftr-vimeo.png">
									</a><!-- /.vimeo -->
								</li>
							<?php } ?>
							<?php if ( $cpthemes['insta-switch'] == 1 ) { ?>
								<li>
									<a class="instagram" href="<?php echo $insta_link; ?>">
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/includes/front/img/global/img-ftr-instagram.png">
									</a><!-- /.instagram -->
								</li>
							<?php } ?>
						</ul><!-- /.ftr-social-networking -->
					<?php } ?>
					<div class="copyright">
						&copy; <?php echo $copyright; ?>
					</div>
				</div><!-- /.church-info -->
				<?php 
					$defaults = array(
						'theme_location'		=>		'footer-navigation-menu',
						'container'				=>		'div',
						'container_class'		=>		'footer-nav',
						'depth'					=>		2
					);
					wp_nav_menu( $defaults );
				?>
				<!--
				<ul class="footer-nav">	
					<li>
						<a class="level-one" href="#">About</a>
						<ul>
							<li><a href="#">Welcome</a></li>
							<li><a href="#">Locations</a></li>
							<li><a href="#">Vision &amp; Values</a></li>
							<li><a href="#">What We Believe</a></li>
							<li><a href="#">Pastors</a></li>
							<li><a href="#">Staff</a></li>
						</ul>
					</li>
					<li>
						<a class="level-one" href="#">Next Steps</a>
						<ul>
							<li><a href="#">Meet a Pastor</a></li>
							<li><a href="#">What's the Gospel?</a></li>
							<li><a href="#">Community Groups</a></li>
							<li><a href="#">Baptism</a></li>
							<li><a href="#">Serve</a></li>
							<li><a href="#">Partnership</a></li>
						</ul>
					</li>
					<li>
						<a class="level-one" href="#">Ministries</a>
						<ul>
							<li><a href="#">Kids</a></li>
							<li><a href="#">Youth</a></li>
							<li><a href="#">Ladies</a></li>
							<li><a href="#">Men</a></li>
							<li><a href="#">Music+Media</a></li>
							<li><a href="#">Outreach</a></li>
						</ul>
					</li>
				</ul>--><!-- /.footer-nav -->
			</div><!-- /.wrapper -->
		</footer>

		<?php wp_footer(); ?>

	</body>
</html>
