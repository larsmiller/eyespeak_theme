<?php

/**
 * @package WordPress
 * @subpackage eyespeak
 */


$fields =  array(
	'author' => '<input id="author" name="author" placeholder="Name*" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />',
	'email' => '<input id="email" name="email" placeholder="Email*" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />',
	'url' => '<input id="url" name="url" type="text" placeholder="Website" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" />'
);
$args = array(
	'fields' => apply_filters('comment_form_default_fields', $fields ),
	'comment_field' => '<textarea id="comment" name="comment" placeholder="Comment" aria-required="true"></textarea>',
	'comment_notes_after' => '',
	'title_reply'          => __( 'Comment' ),
	'title_reply_to'       => __( 'Leave a Comment to %s' ),
	'cancel_reply_link'    => __( 'Cancel Comment' ),
	'label_submit'         => __( 'SUBMIT' ),
);

comment_form($args, '');


if ( ! function_exists( 'eyespeak_comment' ) ) :
/**
 * Template for comments and pingbacks.
 */
function eyespeak_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment clearfix" role="article">
			<div class="gravatar">
				<?php echo get_avatar( $comment, 80 ); ?>
			</div><!-- .gravatar -->
			<div class="post-extra-content">
				<div class="comment-author vcard">
					<?php printf( __( '%s', 'eyespeak' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
				</div><!-- .comment-author .vcard -->
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'eyespeak' ); ?></em>
					<br />
				<?php endif; ?>
	
				<div class="post-extra-meta commentmetadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time pubdate datetime="<?php comment_time( 'c' ); ?>">
					<?php
						/* translators: 1: date, 2: time */
						printf( __( '%1$s at %2$s', 'eyespeak' ), get_comment_date(),  get_comment_time() ); ?>
					</time></a>
					<?php edit_comment_link( __( '(Edit)', 'eyespeak' ), ' ' );
					?>
				</div><!-- .post-extra-meta .commentmetadata -->
				<div class="comment-body"><?php comment_text(); ?></div>
				<div class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div><!-- .reply -->
			</div><!-- .comment-content -->
		</article><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'eyespeak' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'eyespeak'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif; // ends check for eyespeak_comment()

?>
<?php if ( have_comments() ) : ?>

	<div id="comments">
	<?php if ( post_password_required() ) : ?>
		<div class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'eyespeak' ); ?></div>
	</div><!-- .comments -->
	<?php return;
		endif;
	?>

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h2 id="comments-title">
			<?php
			    printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), 'eyespeak' ),
			        number_format_i18n( get_comments_number() ), '<em>' . get_the_title() . '</em>' );
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above" role="article">
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'eyespeak' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'eyespeak' ) ); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>

		<ol class="commentlist">
			<?php wp_list_comments( array( 'callback' => 'eyespeak_comment' ) ); ?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" role="article">
			<h1 class="section-heading"><?php _e( 'Comment navigation', 'eyespeak' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'eyespeak' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'eyespeak' ) ); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>

	<?php else : // this is displayed if there are no comments so far ?>

		<?php if ( comments_open() ) : // If comments are open, but there are no comments ?>

		<?php else : // or, if we don't have comments:

			/* If there are no comments and comments are closed,
			 * let's leave a little note, shall we?
			 * But only on posts! We don't really need the note on pages.
			 */
			if ( ! comments_open() && ! is_page() ) :
			?>
			<p class="nocomments"><?php _e( 'Comments are closed.', 'eyespeak' ); ?></p>
			<?php endif; // end ! comments_open() && ! is_page() ?>


		<?php endif; ?>

	<?php endif; ?>

</div><!-- #comments -->

<?php endif; // end if have comments ?>