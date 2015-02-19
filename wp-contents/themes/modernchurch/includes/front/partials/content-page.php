<article <?php post_class(); ?>>
	<header class="page-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- /.page-header -->

	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- /.entry-content -->

	<footer class="entry-footer">
		<?php edit_post_link( __( 'Edit', 'cpt_theme' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- /.entry-footer -->
</article>