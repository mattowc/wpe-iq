<?php
/**
 * Adds shortcodes for specific forms.  
 * 
 * @author Jonathon McDonald <jon@onewebcentric.com>
 */

class Jam_Form_Shortcode 
{
	function __construct() 
	{
		add_shortcode( 'include-form', array( &$this, 'output_html' ) );
	}

	function output_html($atts, $content="") 
	{
		extract(
			shortcode_atts(
				array(
					'name' => 'first-form'
				)
			)
		);

		$file = file_get_contents( '../view/' . $name . '.html', FILE_USE_INCLUDE_PATH );
		return $file;
	}
}

new Jam_Form_Shortcode();