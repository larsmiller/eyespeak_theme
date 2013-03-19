<?php
/**
 * @package WordPress
 * @subpackage eyespeak
 */
get_header(); ?>
<div id="container">
	<div class="col-full">
		<div id="primary">
			<div id="content">
				<?php the_post(); ?>
				<header class="entry-header">
					<h1 class="entry-title">
						<?php printf( __( 'Author Archives: <span class="vcard">%s</span>', 'themename' ), "" . get_the_author() . "" ); ?>
					</h1>
				</header><!-- .entry-header -->
				<?php eyespeak_author_box(); ?>
				<div class="entry-content">
					<?php rewind_posts(); ?>	
					<?php get_template_part( 'loop', 'author' ); ?>
				</div><!-- .entry-content -->
			</div><!-- #content -->
		</div><!-- #primary -->
		<?php get_sidebar(); ?>
	</div><!-- .col-full -->
</div><!-- #container -->
<?php get_footer(); ?>