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
						<?php
							printf( __( 'Category Archives: %s', 'themename' ), '<span>' . single_cat_title( '', false ) . '</span>' );
						?>
					</h1>
				</header><!-- .entry-header -->
				<div class="entry-content">
					<?php $categorydesc = category_description(); if ( ! empty( $categorydesc ) ) echo apply_filters( 'archive_meta', '<div class="archive-meta">' . $categorydesc . '</div>' ); ?>
					<?php get_template_part( 'loop', 'category' ); ?>
				</div><!-- .entry-content -->
			</div><!-- #content -->
		</div><!-- #primary -->
		<?php get_sidebar(); ?>
	</div><!-- .col-full -->
</div><!-- #container -->
<?php get_footer(); ?>