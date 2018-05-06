<?php

/**
 * The Lorem Ipsum
 */
function bar(){

	return 'foo';

}

/**
 * Check if multiple inputs are set
 *
 * @param array string inputs
 * @return boolean
 *
 */
function areset($keys, $forcePOST = FALSE){

	foreach ($keys as $key) {
	    if (!isset($_REQUEST[$key]) || empty($_REQUEST[$key])) {
	    	return false;
	    } else if ($forcePOST && (!isset($_POST[$key]) || empty($_POST[$key]))) {
				return false;
			}
	}

	return true;

}
