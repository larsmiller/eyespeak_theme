<?php
/**
 * @package WordPress
 * @subpackage eyespeak
 */
?><!DOCTYPE html>
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <html <?php language_attributes(); ?> class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'themename' ), max( $paged, $page ) );

	?></title>
	<!-- Place favicon.ico and apple-touch-icon.png in the images folder -->
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.png">
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon.png"><!--60X60-->
	
	<link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory') ?>/style.css" type="text/css" media="all" />
	<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
	<!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
	
	<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<div id="mobile-nav">
			<?php wp_nav_menu( array('menu' => 'menu-1' )); ?>
		</div><!-- #mobile-nav -->
		<div id="page" class="hfeed">
			<div id="header" class="clearfix">
				<div class="col-full">
					<div id="menu-button"><span class="entypo">&#9776;</span></div>
					<div id="logo" class="clearfix">
						<?php if (is_front_page()) { echo "<h1>"; } else { echo "<h2>"; }?>
							<a href="<?php echo get_bloginfo('url') ?>">
								<img src="<?php echo get_bloginfo('stylesheet_directory') ?>/images/logo.png" alt="<?php echo get_bloginfo('name') ?>">
							</a>
						<?php if (is_front_page()) { echo "</h1>"; } else { echo "</h2>"; }?>
					</div><!-- #logo -->
					<div id="nav" class="clearfix" style="display:none;">
						<?php wp_nav_menu( array('menu' => 'menu-1' )); ?>
					</div><!-- #nav -->
				</div><!-- .col-full -->
			</div><!-- #header -->