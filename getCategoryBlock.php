<?php
/**
 * @package    Connections-card-template
 * @subpackage getCategoryBlock
 * @author     Robert Westenberger
 * @since      0.1
 * @link       http://rmwdeveloper@gmail.com
 */


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


function getCategoryBlock( $atts = array(), $entry ) {
		$defaults = array(
			'list'      => 'unordered',
			'separator' => NULL,
			'before'    => NULL,
			'after'     => NULL,
			'label'     => __( 'Categories:', 'connections') . ' ',
			'parents'   => TRUE,
			'return'    => FALSE
		);

		$defaults = apply_filters( 'cn_output_default_atts_category' , $defaults );

		$atts = $entry->validate->attributesArray( $defaults, $atts );

		$out = '';
		$categories = $entry->getCategory();
		/*Two empty arrays for both parent categories*/
		if(empty($categories)){
			// print_r('test');
		}
		$areas_of_expertise_array = array();
		$industry_experience_array = array();
		if ( empty( $categories ) ) return NULL;

		if ( !empty( $atts['before'] ) ) $out .= $atts['before'];

		if ( !empty( $atts['label'] ) ) $out .= '<span class="cn_category_label">' . $atts['label'] . '</span>';

		/* Put the categories into their respective arrays, whether they are 
			areas of expertise or industry experience*/
		foreach($categories as $category){
			if($category->parent === '2'){ /*category parent is areas of expertise*/
				array_push($areas_of_expertise_array , $category);
			}
			elseif($category ->parent === '11'){ /*category parent is industry experience*/
				array_push($industry_experience_array, $category);
			}
			/*else{
				$out .= '<span>' . $category->parent .  '</span>'; 
			}*/
		}
		$out .= '<div class="areas_of_expertise">';
		$out .= '<span>Areas of Expertise</span>'; 
		$out .= '<ul class="cn_category_list">';
		foreach($areas_of_expertise_array as $area_of_expertise){
			$out .= '<li class = "cn_category" id="cn_category_' . $area_of_expertise->term_id . '"><p>' . $area_of_expertise->name . '</p></li>';
		}
		$out .= '</ul>';
		$out .= '</div>';
		$out .= '<div class="industry_experience">';
		$out .= '<span>Industry Experience</span>';
		$out .= '<ul class="cn_category_list">';
		foreach($industry_experience_array as $industry_experience){
			$out .= '<li class = "cn_category" id="cn_category_' . $industry_experience->term_id . '"><p>' . $industry_experience->name .', '. '</p></li>';
		}
		$out .= '</ul>';
		$out .= '</div>';


		/*else {
			$i = 0;

			foreach ( $categories as $category ) {
				$out .= '<span class="cn_category" id="cn_category_' . $category->term_id . '">' . $category->name . '</span>';

				$i++;
				if ( count( $categories ) > $i ) $out .= $atts['separator'];
			}
		}*/

		if ( ! empty( $atts['after'] ) ) $out .= $atts['after'];

		if ( $atts['return'] ) return $out;

		echo $out;
	}