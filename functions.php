<?php
/**
 * @package WordPress
 * @subpackage themename
 */

/* enqueue */
function my_scripts_method() {
	wp_enqueue_script('jquery');
	wp_enqueue_script('eyespeak', get_bloginfo('stylesheet_directory').'/js/eyespeak.js', 'jquery');
}    
add_action('wp_enqueue_scripts', 'my_scripts_method');


/**
 * Remove code from the <head>
 */
//remove_action('wp_head', 'rsd_link'); // Might be necessary if you or other people on this site use remote editors.
//remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
//remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
//remove_action('wp_head', 'index_rel_link'); // Displays relations link for site index
//remove_action('wp_head', 'wlwmanifest_link'); // Might be necessary if you or other people on this site use Windows Live Writer.
//remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
//remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
//remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_filter( 'the_content', 'capital_P_dangit' ); // Get outta my Wordpress codez dangit!
remove_filter( 'the_title', 'capital_P_dangit' );
remove_filter( 'comment_text', 'capital_P_dangit' );
// Hide the version of WordPress you're running from source and RSS feed // Want to JUST remove it from the source? Try: remove_action('wp_head', 'wp_generator');
/*function hcwp_remove_version() {return '';}
add_filter('the_generator', 'hcwp_remove_version');*/
// This function removes the comment inline css
/*function twentyten_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'twentyten_remove_recent_comments_style' );*/

/**
 * Remove meta boxes from Post and Page Screens
 */
function customize_meta_boxes() {
   /* These remove meta boxes from POSTS */
  //remove_post_type_support("post","excerpt"); //Remove Excerpt Support
  //remove_post_type_support("post","author"); //Remove Author Support
  //remove_post_type_support("post","revisions"); //Remove Revision Support
  //remove_post_type_support("post","comments"); //Remove Comments Support
  //remove_post_type_support("post","trackbacks"); //Remove trackbacks Support
  //remove_post_type_support("post","editor"); //Remove Editor Support
  //remove_post_type_support("post","custom-fields"); //Remove custom-fields Support
  //remove_post_type_support("post","title"); //Remove Title Support

  
  /* These remove meta boxes from PAGES */
  //remove_post_type_support("page","revisions"); //Remove Revision Support
  //remove_post_type_support("page","comments"); //Remove Comments Support
  //remove_post_type_support("page","author"); //Remove Author Support
  //remove_post_type_support("page","trackbacks"); //Remove trackbacks Support
  //remove_post_type_support("page","custom-fields"); //Remove custom-fields Support
  
}
add_action('admin_init','customize_meta_boxes');

/**
 * This theme uses wp_nav_menus() for the header menu, utility menu and footer menu.
 */
register_nav_menus( array(
	'menu-1' => __( 'Main Menu', 'themename' ),
) );

/** 
 * Add default posts and comments RSS feed links to head
 */
add_theme_support( 'automatic-feed-links' );

/**
 * This theme uses post thumbnails
 */
add_theme_support( 'post-thumbnails' );

/**
 *	This theme supports editor styles
 */

add_editor_style("/css/layout-style.css");

/**
 * Disable the admin bar in 3.1
 */
//show_admin_bar( false );

/**
 * This enables post formats. If you use this, make sure to delete any that you aren't going to use.
 */
//add_theme_support( 'post-formats', array( 'aside', 'audio', 'image', 'video', 'gallery', 'chat', 'link', 'quote', 'status' ) );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function eyespeak_widgets_init() {
	register_sidebar( array (
		'name' => __( 'Sidebar', 'themename' ),
		'id' => 'sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s" role="complementary">',
		'after_widget' => "</aside>",
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
}
add_action( 'init', 'eyespeak_widgets_init' );

/*
 * Remove senseless dashboard widgets for non-admins. (Un)Comment or delete as you wish.
 */
function remove_dashboard_widgets() {
	global $wp_meta_boxes;

	//unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']); // Plugins widget
	//unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']); // WordPress Blog widget
	//unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']); // Other WordPress News widget
	//unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']); // Right Now widget
	//unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']); // Quick Press widget
	//unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']); // Incoming Links widget
	//unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']); // Recent Drafts widget
	//unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']); // Recent Comments widget
}

/**
 *	Hide Menu Items in Admin
 */
function themename_configure_dashboard_menu() {
	global $menu,$submenu;

	global $current_user;
	get_currentuserinfo();

		// $menu and $submenu will return all menu and submenu list in admin panel
		
		// $menu[2] = ""; // Dashboard
		// $menu[5] = ""; // Posts
		// $menu[15] = ""; // Links
		// $menu[25] = ""; // Comments
		// $menu[65] = ""; // Plugins

		// unset($submenu['themes.php'][5]); // Themes
		// unset($submenu['themes.php'][12]); // Editor
}


// For non-admins, add action to Hide Dashboard Widgets and Admin Menu Items you just set above
// Don't forget to comment out the admin check to see that changes :)
if (!current_user_can('manage_options')) {
	add_action('wp_dashboard_setup', 'remove_dashboard_widgets'); // Add action to hide dashboard widgets
	add_action('admin_head', 'themename_configure_dashboard_menu'); // Add action to hide admin menu items
}

/**
 * Change the Excerpt
 */
function excerpt($limit) {
$linking = get_permalink();
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...<br><a href="'.$linking.'">...</a>';
  } else {
    $excerpt = implode(" ",$excerpt);
  }	
  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
  return $excerpt;
}
function new_excerpt_more($more) {
       global $post;
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');


?>
<?php // asynchronous google analytics: mathiasbynens.be/notes/async-analytics-snippet
//	 change the UA-XXXXX-X to be your site's ID
/*add_action('wp_footer', 'async_google_analytics');
function async_google_analytics() { ?>
	<script>
	var _gaq = [['_setAccount', 'UA-XXXXX-X'], ['_trackPageview']];
		(function(d, t) {
			var g = d.createElement(t),
				s = d.getElementsByTagName(t)[0];
			g.async = true;
			g.src = ('https:' == location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			s.parentNode.insertBefore(g, s);
		})(document, 'script');
	</script>
<?php }*/ ?>
<?php /*
 * A default custom post type. DELETE from here to the end if you don't want any custom post types
 */
/*add_action('init', 'create_boilertemplate_cpt');
function create_boilertemplate_cpt() 
{
  $labels = array(
    'name' => _x('eyespeakTemplate CPT', 'post type general name'),
    'singular_name' => _x('eyespeakTemplate CPT Item', 'post type singular name'),
    'add_new' => _x('Add New', 'eyespeaktemplate_robot'),
    'add_new_item' => __('Add New Item'),
    'edit_item' => __('Edit Item'),
    'new_item' => __('New Item'),
    'view_item' => __('View Item'),
    'search_items' => __('Search Items'),
    'not_found' =>  __('No items found'),
    'not_found_in_trash' => __('No items found in Trash'), 
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'show_ui' => true, 
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'page',
    'hierarchical' => false,
    'menu_position' => 20,
    'supports' => array('title','editor')
  ); 
  register_post_type('eyespeaktemplate_robot',$args);
}*/
/*
 * This is for a custom icon with a colored hover state for your custom post types. You can download the custom icons here 
 http://randyjensenonline.com/thoughts/wordpress-custom-post-type-fugue-icons/
 */
/*add_action( 'admin_head', 'cpt_icons' );
function cpt_icons() {
    ?>
    <style type="text/css" media="screen">
        #menu-posts-eyespeaktemplaterobot .wp-menu-image {
            background: url(<?php bloginfo('template_url') ?>/images/robot.png) no-repeat 6px -17px !important;
        }
		#menu-posts-eyespeaktemplaterobot:hover .wp-menu-image, #menu-posts-eyespeaktemplaterobot.wp-has-current-submenu .wp-menu-image {
            background-position:6px 7px!important;
        }
    </style>
<?php }*/ ?>
<?php
//
//  profile subtractions/additions
//
 
function add_twitter_contactmethod( $contactmethods ) {
  unset($contactmethods['aim']);
  unset($contactmethods['jabber']);
  unset($contactmethods['yim']);
  unset($contactmethods['admin_color']);
  return $contactmethods;
}
add_filter('user_contactmethods','add_twitter_contactmethod',10,1);

add_action( 'show_user_profile', 'show_extra_profile_fields', 10 );
add_action( 'edit_user_profile', 'show_extra_profile_fields', 10 );
 
function show_extra_profile_fields( $user ) { ?>
	<table class="form-table">
		<tr>
			<th><label for="twitter"><?php _e('Twitter', 'frontendprofile'); ?></label></th>
			<td>
				<input type="text" name="twitter" id="title" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php _e('include full URL to profile', 'frontendprofile'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="facebook"><?php _e('Facebook', 'frontendprofile'); ?></label></th>
			<td>
				<input type="text" name="facebook" id="title" value="<?php echo esc_attr( get_the_author_meta( 'facebook', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php _e('include full URL to profile', 'frontendprofile'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="linkedin"><?php _e('LinkedIn', 'frontendprofile'); ?></label></th>
			<td>
				<input type="text" name="linkedin" id="title" value="<?php echo esc_attr( get_the_author_meta( 'linkedin', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php _e('include full URL to profile', 'frontendprofile'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="pinterest"><?php _e('Pinterest', 'frontendprofile'); ?></label></th>
			<td>
				<input type="text" name="pinterest" id="title" value="<?php echo esc_attr( get_the_author_meta( 'pinterest', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php _e('include full URL to profile', 'frontendprofile'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="instagram"><?php _e('Instagram', 'frontendprofile'); ?></label></th>
			<td>
				<input type="text" name="instagram" id="title" value="<?php echo esc_attr( get_the_author_meta( 'instagram', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php _e('include full URL to profile', 'frontendprofile'); ?></span>
			</td>
		</tr>
	</table>
<?php }


	
add_action( 'personal_options_update', 'save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_profile_fields' );
 
function save_extra_profile_fields( $user_id ) {
 
	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;
 
	update_user_meta( $user_id, 'twitter', $_POST['twitter'] );
	update_user_meta( $user_id, 'facebook', $_POST['facebook'] );
	update_user_meta( $user_id, 'linkedin', $_POST['linkedin'] );
	update_user_meta( $user_id, 'pinterest', $_POST['pinterest'] );
	update_user_meta( $user_id, 'instagram', $_POST['instagram'] );
}

function eyespeak_author_box() { ?>
	<div id="author-box" class="clearfix">
		<div class="gravatar">
			<?php echo get_avatar( get_the_author_meta('ID'), 80 ); ?>
		</div><!-- .gravatar -->
		<div class="post-extra-content">
			<div class="clearfix">
				<?php if (!is_author()) { ?>
					<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
				<?php } ?>
						<?php echo get_the_author_meta('display_name'); ?>
				<?php if (!is_author()) { ?>
					</a>
				<?php } ?>
			</div>
			<div class="clearfix">
				<?php echo get_the_author_meta('description'); ?>
			</div>
			<?php if (get_the_author_meta('twitter') || get_the_author_meta('facebook') || get_the_author_meta('linkedin') || get_the_author_meta('pinterest') || get_the_author_meta('instagram') || get_the_author_meta('user_url')) { ?>
				<div class="post-extra-footer">
					<div class="author-social">
						<span class="connect">Connect with <?php echo get_the_author_meta('first_name'); ?>:</span>
						<?php if (get_the_author_meta('twitter')) { ?>
							<a target="_blank" href="<?php echo get_the_author_meta('twitter'); ?>"><span class="entypo-social twitter">&#62217;</span></a>
						<?php } ?>
						<?php if (get_the_author_meta('facebook')) { ?>
							<a target="_blank" href="<?php echo get_the_author_meta('facebook'); ?>"><span class="entypo-social facebook">&#62220;</span></a>
						<?php } ?>
						<?php if (get_the_author_meta('linkedin')) { ?>
							<a target="_blank" href="<?php echo get_the_author_meta('linkedin'); ?>"><span class="entypo-social linkedin">&#62232;</span></a>
						<?php } ?>
						<?php if (get_the_author_meta('pinterest')) { ?>
							<a target="_blank" href="<?php echo get_the_author_meta('pinterest'); ?>"><span class="entypo-social pinterest">&#62226;</span></a>
						<?php } ?>
						<?php if (get_the_author_meta('instagram')) { ?>
							<a target="_blank" href="<?php echo get_the_author_meta('instagram'); ?>"><span class="entypo-social instagram">&#62253;</span></a>
						<?php } ?>
						<?php if (get_the_author_meta('user_url')) { ?>
							<a target="_blank" href="<?php echo get_the_author_meta('user_url'); ?>"><span class="entypo website">&#127758;</span></a>
						<?php } ?>
					</div>
				</div>
			<?php } // end if checking for author meta ?>
		</div><!-- .post-extra-content -->
	</div><!-- #author-box -->
<?php }

function eyespeak_post_meta() { ?>
	<div class="post-extra-footer">
		<div class="post-tax-list clearfix">
			<span class="entypo">&#128196;</span>Categories:&nbsp;
			<?php 
				$variable = wp_list_categories( 'style=none&echo=0' );
				$variable = str_replace('<br />', '&nbsp;&nbsp;|&nbsp;&nbsp;', $variable);
				echo $variable; ?>
		</div>
		<?php if (has_tag()) { ?>
			<div class="post-tax-list clearfix">
				<?php the_tags('<span class="entypo">&#59148;</span>Tags:&nbsp;', '&nbsp;&nbsp;|&nbsp;&nbsp;', ''); ?>
			</div>
		<?php } ?>
	</div>

<?php }

?>