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
				<div class="entry-content">
					<?php get_template_part( 'loop', 'index' ); ?>
				</div><!-- .entry-content -->
			</div><!-- #content -->
		</div><!-- #primary -->
		<?php get_sidebar(); ?>
	</div><!-- .col-full -->
</div><!-- #container -->
<?php get_footer(); ?>