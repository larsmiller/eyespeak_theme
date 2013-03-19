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
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>		
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
						<header class="entry-header">
							<h1 class="entry-title"><?php the_title(); ?></h1>
							<div class="entry-meta">
								<p>Posted on <?php echo get_the_date('D, M j, Y @ h:ia'); ?></p>
							</div><!-- .entry-meta -->
						</header><!-- .entry-header -->
						<div class="entry-content">
							<?php the_content(); ?>
						</div><!-- .entry-content -->	
					</article><!-- #post-<?php the_ID(); ?> -->	
					<?php comments_template( '', true ); ?>
				<?php endwhile; // end of the loop. ?>
			</div><!-- #content -->
		</div><!-- #primary -->
		<?php get_sidebar(); ?>
	</div><!-- .col-full -->
</div><!-- #container -->
<?php get_footer(); ?>