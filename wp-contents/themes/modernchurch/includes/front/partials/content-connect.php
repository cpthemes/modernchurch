<?php
	global $cpthemes;
	
	// Column 1 Variables
	$connect_title = $cpthemes['connect-title'];
	$connect_desc = $cpthemes['connect-desc'];
	$connect_btn_txt = $cpthemes['connect-btn-txt'];
	$connect_btn_link = $cpthemes['connect-btn-link'];
?>

<section class="contact-cta">
	<div class="wrapper">
		<h3><?php echo $connect_title; ?></h3>
		<p><?php echo $connect_desc; ?></p>
		<a class="btn secondary-btn" href="<?php echo $connect_btn_link; ?>"><?php echo $connect_btn_txt; ?></a>
	</div>
</section>