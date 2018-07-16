<?php
/**
 * 
 * Plugin Name: Lead
 * Plugin URI: https://github.com/bailylex/lead
 * Description: Additional field for post lead paragraph. Simply get post meta field in your theme where you want to see a lead paragraph.
 * Version: 1.0.0
 * Author: Alexander Fedorov
 * Author URI: https://bailylex.github.io/portfolio/
 * License: GNU General Public License v2 or later
 * License URI: LICENSE
 * 
 * @package lead
 */

// Init editor
function lead_post_editor() {
	global $post;

	echo '<h2>Lead Paragraph</h2>';

	$lead_content = get_post_meta($post->ID, '_lead_editor', true);
	$lead_editor = '_lead_editor';

	wp_editor($lead_content, $lead_editor, array(
		'textarea_name' => '_lead_editor',
		'media_buttons' => false,
		'textarea_rows' => 5,
		'tinymce'       => false,
		'quicktags'     => false
	));
}
add_action('edit_form_after_title', 'lead_post_editor');

// At saving post
function save_lead($post_id) {
	global $post;
	if (isset($_REQUEST['_lead_editor'])) {
		update_post_meta($post->ID, '_lead_editor', wp_kses_post($_POST['_lead_editor']));
	}
}
add_action('save_post', 'save_lead');