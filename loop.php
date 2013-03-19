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
				<p>Posted on <?php echo get_the_date('D, M j, Y @ h:ia'); ?> by <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author_meta('display_name'); ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<?php comments_number( 'No Comments', 'One Comment', '% Comments' ); ?></p>
			</div><!-- .entry-meta -->
		</header><!-- .entry-header -->
		<div class="entry-summary">
			<p>
				<?php 
					$excerpt = excerpt(50);
					echo strip_tags($excerpt);
				?>
			</p>
			<?php eyespeak_post_meta(); ?>
		</div><!-- .entry-summary -->
	</article><!-- #post-<?php the_ID(); ?> -->
<?php endwhile; ?>
<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
	<nav id="nav-below" role="article" class="clearfix">
		<div class="nav-next"><?php previous_posts_link( __( '<span class="meta-nav">&larr;</span> Newer', 'themename' ) ); ?></div>
		<div class="nav-previous"><?php next_posts_link( __( 'Older <span class="meta-nav">&rarr;</span>', 'themename' ) ); ?></div>
	</nav><!-- #nav-below -->
<?php endif; ?>