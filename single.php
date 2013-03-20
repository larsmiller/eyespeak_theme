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
								<?php eyespeak_posted_on(); ?>
							</div><!-- .entry-meta -->
							<?php
								if ( has_post_thumbnail() )
									the_post_thumbnail('large');
							?>
						</header><!-- .entry-header -->
						<div class="entry-content">
							<?php the_content(); ?>
							<?php eyespeak_post_meta(); ?>
						</div><!-- .entry-content -->	
					</article><!-- #post-<?php the_ID(); ?> -->	
					<?php eyespeak_author_box(); ?>
					<?php comments_template( '', true ); ?>
				<?php endwhile; // end of the loop. ?>
			</div><!-- #content -->
		</div><!-- #primary -->
		<?php get_sidebar(); ?>
	</div><!-- .col-full -->
</div><!-- #container -->
<?php get_footer(); ?>