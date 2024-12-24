<?php
/**
 * Plugin Name:       Section Nav
 * Requires at least: 5.8
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       section-nav
 *
 * @package           create-block
 */

 define( 'MY_PLUGIN_INCLUDES_DIR', plugin_dir_path( __FILE__ ) . 'includes/' );

 require_once MY_PLUGIN_INCLUDES_DIR . 'section_wp_nav_menu_walker.php';
 
 

function create_block_section_nav_render_callback( $attr ) {
// Include the required file

	global $post;

	ob_start();

	

		$topAncestorid = get_the_top_ancestor_id();
		$topTitle = get_the_title( $topAncestorid );
		$topLink = get_permalink( $topAncestorid );

		$ipm_menu_return = wp_list_pages( array(
				'child_of' => get_the_top_ancestor_id(),
				'title_li' => '',
        		'walker' => new BS_Page_Walker(),
				'echo' => false,
			) );
			$output = '<nav class="section-navigation"><div class="section-navigation-inner"><div class="section-menu"><a class="section-navigation-back" tabindex="0" href="#" style="display:none;"><img src="/wp-content/plugins/section-nav/includes/section-nav-back.svg" /> Back</a><ul class="" id="section-nav-ul"><li class="current-page"><a class="menu-parent-link" href="'.$topLink.'">'.$topTitle.'<span class="caret"></span></a></li>'. $ipm_menu_return  .'</ul></div><a class="section-menu-btn section-navigation-toggler" href="#" type="button" aria-controls="sectionNavigation" tabindex="0"><span class="open-btn">Menu</span><span class="close-btn" style="display:none;">Close</span></a></div></nav>';
			return $output;


}


function section_nav_plugin_block_init() {
	register_block_type( __DIR__ . '/build', array(
		'render_callback' => 'create_block_section_nav_render_callback'
	) );
	
}
add_action( 'init', 'section_nav_plugin_block_init' );