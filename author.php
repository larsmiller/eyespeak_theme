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
						<?php printf( __( 'Author Archives: <span class="vcard">%s</span>', 'themename' ), "<a class='url fn n' href='" . get_author_posts_url( get_the_author_meta( 'ID' ) ) . "' title='" . esc_attr( get_the_author() ) . "' rel='me'>" . get_the_author() . "</a>" ); ?>
					</h1>
				</header><!-- .entry-header -->
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