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
								printf( __( 'Tag Archives: %s', 'themename' ), '<span>' . single_tag_title( '', false ) . '</span>' );
							?>
						</h1>
					</header><!-- .entry-header -->
					<div class="entry-content">
						<?php rewind_posts(); ?>
						<?php get_template_part( 'loop', 'tag' ); ?>
					</div><!-- .entry-content -->	
			</div><!-- #content -->
		</div><!-- #primary -->
		<?php get_sidebar(); ?>
	</div><!-- .col-full -->
</div><!-- #container -->
<?php get_footer(); ?>