<?php

/**
 * Bolota
 * A small package with functions to websites development.
 *
 * @copyright 2016 Arco Websites & Mobile Apps
 * @author Dian Carlos <dian.cabral@gmail.com>
 * @version 1.0.6
 *
 */

class Bolota {

	public function link_active($links, $class_active){

		$url = basename($_SERVER['SCRIPT_NAME'], '.php');

		$active = in_array($url, explode(',', preg_replace('/\s+/', '', $links))) ? $class_active : '';

		return $active;

	}

	/* */

	private static function comp_html($buffer){

	    $search = array(
	        '/\>[^\S ]+/s',
	        '/[^\S ]+\</s',
	        '/(\s)+/s'
	    );

	    $replace = array(
	        '>',
	        '<',
	        '\\1'
	    );

	    $buffer = str_replace('à', '&agrave;', $buffer);
	    $buffer = preg_replace($search, $replace, $buffer);

	    return $buffer;

	}

	public function compress_html(){

		ob_start(array($this, 'comp_html'));

	}

	/* */

	function mailtemplate($file, $dados){

		ob_start();

		include $file;
		$html = ob_get_contents();

		ob_end_clean();

		return $html;

	}

	/* */

	// To escape the values in a SQL query, use the prepare() statement
	function strtoobject($array){

	    return json_decode(json_encode($array));

	}

}
