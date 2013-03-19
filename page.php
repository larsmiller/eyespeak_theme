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
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
					<header class="entry-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>
					</header><!-- .entry-header -->
					<div class="entry-content">
						<?php the_content(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-<?php the_ID(); ?> -->
			</div><!-- #content -->
		</div><!-- #primary -->
		<?php get_sidebar(); ?>
	</div><!-- .col-full -->
</div><!-- #container -->
<?php get_footer(); ?>