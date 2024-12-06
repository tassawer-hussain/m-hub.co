<?php
/**
 *
 * @author     Gaviasthemes Team
 * @copyright  Copyright (C) 2022 Gaviasthemes. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */

function fioxen_child_init_scripts() {

	// Enqueue child theme stylesheet.
	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css' );

	wp_enqueue_script( 'child-script', get_stylesheet_directory_uri() . '/script.js', array( 'jquery' ), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'fioxen_child_init_scripts', 999 );


function th_string_to_bool( $value ) {
	return ( is_bool( $value ) && $value ) || in_array( $value, array( 1, '1', 'true', 'yes' ), true );
}
