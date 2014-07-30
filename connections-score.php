<?php
/**
 * @package Connections-SCORE
 * @version 0.1
 */
/*
Plugin Name: Connections SCORE
Plugin URI: http://www.rmwdeveloper.com
Description: Alters output of mentors page to look like micromentors page.
Version: 0.1
Author URI: http://www.rmwdeveloper.com
*/

if ( ! defined( 'ABSPATH' ) ) exit;


class cnOutputExtended extends cnOutput{
	public function getReadMoreBlock (){
		// Adds a 'Read More' tab on the bottom of a mentors page.
		
		global $connections;
	}
}
