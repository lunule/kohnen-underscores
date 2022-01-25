<?php
function my_acf_init() {

	acf_update_setting('google_api_key', 'AIzaSyCYjJ4QWKI8OIrMkjcOcghv-YRVmqTtDKE');

}
add_action('acf/init', 'my_acf_init');

function register_acf_options_pages() {

	// check function exists
	if (!function_exists('acf_add_options_page')) {
		return;
	}

	// register options page
	$options_parent = acf_add_options_page(array(
		'page_title'      	=> __('Options Page'),
		'menu_title'      	=> __('Options Page'),
		'menu_slug'       	=> 'options-page',
		'capability'      	=> 'edit_posts',
		'show_in_graphql' 	=> true,
		'redirect'			=> true, 		// If set to true, this options page will redirect to 
											// the first child page (if a child page exists). If
											// set to false, this parent page will appear 
											// alongside any child pages as its own page. 
											// 
											// Defaults to true.		
	));

	$options_child_footer = acf_add_options_page(array(
		'page_title' 	=> 'Site Settings',
		'menu_title'	=> 'Site Settings',
		'parent_slug'	=> 'options-page',
	));

	$options_child_footer = acf_add_options_page(array(
		'page_title' 	=> 'Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'options-page',
	));
	
	$options_child_contact = acf_add_options_page(array(
		'page_title' 	=> 'Contact',
		'menu_title'	=> 'Contact Settings',
		'parent_slug'	=> 'options-page',
	));

	$options_child_social = acf_add_options_page(array(
		'page_title' 	=> 'Sidebar',
		'menu_title'	=> 'Sidebar Settings',
		'parent_slug'	=> 'options-page',
		// Disable this to re-enable sidebar functionality
		'capability' 	=> 'temp_hide_acf_sub_page',
	));	

}
add_action('acf/init', 'register_acf_options_pages');

// Disable this to re-enable sidebar functionality
add_action( 'admin_head', function () { 

      echo '<style type="text/css">#acf-group_61e42eb1ad2ba, tr#post-920, tr#post-922 {display: none!important;}</style>';

});
