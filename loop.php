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
				<?php eyespeak_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php
				if ( has_post_thumbnail() )
					the_post_thumbnail('large');
			?>
		</header><!-- .entry-header -->
		<div class="entry-content">
			<?php 
			//	display custom excerpt length
			//	echo "<p>";
			//	echo excerpt(30);
			//	echo "</p>";
			?>
			<?php the_content(); ?>
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