<?php
/**
 * @package Connections-Child
 * @version 0.1
 */
/*
Plugin Name: Connections Child Search
Plugin URI: http://www.rmwdeveloper.com
Description: Extends Connections-Child to add a search bar and filterable categories. 
Author: Robert Westenberger
Version: 0.1
Author URI: http://www.rmwdeveloper.com
*/
add_filter('cn-results-filter', 'filter_mentors');
add_action('wp_ajax_filter_mentors','filter_mentors');
add_action('wp_ajax_nopriv_filter_mentors', 'filter_mentors');
add_action("wp_ajax_get_filter_mentors", "filter_mentors");
function filter_mentors() {
	$retriever = new cnRetrieve();
	if(count($_POST) === 0){
		$retriever = new cnRetrieve();
		return $retriever -> entries();
	}

	$retriever = new cnRetrieve();
	if($_POST['checked_array'] === ''){
		die();
		return;
	}
	// echo gettype($_POST['checked_array']);
	$id_array = $_POST['checked_array'];

	$category_array = array();
	$entry_array = $retriever -> entries();
	foreach($id_array as $id_value){
		array_push($category_array, $retriever->category($id_value));
	}
	$test = $retriever->entryCategories($entry_array[0]->id);
	foreach($entry_array as $entry){
		$entry_category_array = $retriever->entryCategories($entry->id);
		$unset_entry = true;
		foreach($category_array as $category) {
			if(in_array($category, $entry_category_array)) {
				$unset_entry = false;
				break;
			}
		}
		if(($entry = array_search($entry, $entry_array)) !== false && $unset_entry) {
    		unset($entry_array[$entry]);
		}
	}
	foreach($entry_array as $entry){
		echo $entry -> slug;
		echo ',';
	}
	die();
}

function enqueue_script(){
	wp_enqueue_script('filter-mentors-button', get_theme_root_uri().'/customizr-child/inc/js/filter-mentors-button.js','jquery',true);
	wp_localize_script('filter-mentors-button','ajax_object', array( 'ajax_url'=>admin_url('admin-ajax.php'), 
																	  'checked_array'=>'test'));
}

add_action('wp_enqueue_scripts', 'enqueue_script');

?>