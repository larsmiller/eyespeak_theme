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
				<article id="post-0" class="post error404 not-found" role="article">
					<header class="entry-header">
						<h1 class="entry-title">Page Not Found</h1>
					</header><!-- .entry-header -->
					<div class="entry-content">
						<p><a href="<?php echo get_bloginfo('url'); ?>">Please visit the homepage.</a></p>
					</div><!-- .entry-content -->
				</article><!-- #post-<?php the_ID(); ?> -->
			</div><!-- #content -->
		</div><!-- #primary -->
		<?php get_sidebar(); ?>
	</div><!-- .col-full -->
</div><!-- #container -->
<?php get_footer(); ?>