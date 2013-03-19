<?php
/**
 * @package WordPress
 * @subpackage eyespeak
 */
?>
<?php /* Start the Loop */ ?>
<?php while ( have_posts() ) : the_post(); ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
		<header class="entry-header">
			<h2 class="entry-title">
				<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'themename' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
					<?php the_title(); ?>
				</a>
			</h2>
			<div class="entry-meta">
				<p>Posted on <?php echo get_the_date('D, M j, Y @ h:ia'); ?></p>
			</div><!-- .entry-meta -->
		</header><!-- .entry-header -->
		<div class="entry-summary">
			<?php 
				$excerpt = excerpt(35);
				echo strip_tags($excerpt);
			?>
		</div><!-- .entry-summary -->
		<p class="comment-number">
			<?php comments_number( 'Comments (0)', 'Comments (1)', 'Comments (%)' ); ?>
		</p>
	</article><!-- #post-<?php the_ID(); ?> -->
<?php endwhile; ?>
<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
	<nav id="nav-below" role="article" class="clearfix">
		<div class="nav-next"><?php previous_posts_link( __( '<span class="meta-nav">&larr;</span> Newer', 'themename' ) ); ?></div>
		<div class="nav-previous"><?php next_posts_link( __( 'Older <span class="meta-nav">&rarr;</span>', 'themename' ) ); ?></div>
	</nav><!-- #nav-below -->
<?php endif; ?>