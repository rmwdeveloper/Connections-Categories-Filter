<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


/**
 * The core [connections] shortcode.
 *
 * @package     Connections
 * @subpackage  Shortcode API
 * @copyright   Copyright (c) 2013, Steven A. Zahm
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       0.8
 */
// $plugins_url = plugin_dir_path(__FILE__);
// require $plugins_url . '../../../connections/includes/shortcode/class.shortcode-connections.php';
// class Test extends cnShortcode_Connections{

// }

add_action('__before_content', 'mentors_filter_bar');
function mentors_filter_bar(){
	$page_id = get_the_ID();
	if($page_id != 10) return;
	$html = '';
	$html .= '<div id="mentor_filters">';
	$html .= '<div id="mentor_filters_message">';
	$html .= '<h4>Filter by Industry Experience or Areas of Expertise to find the right mentor to fit your needs.</h2>';
	$html .= '</div>';
			/* Instantiate categories*/
			$retrieve = new cnRetrieve();
			$categories = $retrieve -> categories();
			$children_categories = array();
			$areas_of_expertise_array = array();
			$industry_experience_array =array();
			foreach($categories as $category){
				if (empty($category -> children)) break;
				$category_array = $category -> children ; 
				foreach($category_array as $childcategory){
					array_push($children_categories, $childcategory);
				}
			}
			if ( empty( $children_categories ) ) return NULL;
			foreach($children_categories as $childcategory1){
				if($childcategory1->parent === '2'){ /*category parent is areas of expertise*/
					array_push($areas_of_expertise_array , $childcategory1);
				}
				elseif($childcategory1 ->parent === '11'){ /*category parent is industry experience*/
					array_push($industry_experience_array, $childcategory1);
				}
			}
			$html .= '<select multiple id="industry_experience">';
			foreach($industry_experience_array as $industry_experience){
				$html .= '<option value="' . $industry_experience-> term_id . '" class="industry_experience_option">'.$industry_experience-> name .'</option>';
			}
			$html .= '</select>';

			$html .= '<select multiple id="areas_of_expertise">';
			foreach($areas_of_expertise_array as $areas_of_expertise){
				$html .= '<option value="' . $areas_of_expertise-> term_id . '" class="areas_of_expertise_option">'.$areas_of_expertise-> name .'</option>';
			}
			$html .= '</select>';

			$html .= '<div class="submit-filter">';
			$html .= '<input id="submit-filter-options" class="btn btn-primary btn-block" type="submit" value="Filter Results" style=""';
			$html .= '</div>';
			$html .= '</div>';
			$html .= '</div>';
	echo $html;
}