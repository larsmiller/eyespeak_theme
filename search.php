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
				<?php if ( have_posts() ) { ?>
					<header class="entry-header">
						<h1 class="entry-title">
							<?php
								printf( __( 'Search Results for: %s', 'themename' ), '<span>' . get_search_query() . '</span>' ); 
							?>
						</h1>
					</header><!-- .entry-header -->
					<div class="entry-content">
						<?php get_template_part( 'loop', 'search' ); ?>
					</div><!-- .entry-content -->
				<?php } else { ?>
					<article id="post-0" class="post error404 not-found" role="article">
						<header class="entry-header">
							<h1 class="entry-title">Page Not Found</h1>
						</header><!-- .entry-header -->
						<div class="entry-content">
							<p><a href="<?php echo get_bloginfo('url'); ?>">Please visit the homepage.</a></p>
						</div><!-- .entry-content -->
					</article><!-- #post-<?php the_ID(); ?> -->
				<?php } ?>
			</div><!-- #content -->
		</div><!-- #primary -->
		<?php get_sidebar(); ?>
	</div><!-- .col-full -->
</div><!-- #container -->
<?php get_footer(); ?>