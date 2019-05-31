<?php
/**
 * W pliku lib.php znajduje się biblioteka funkcji
 */

/**
 * Odfiltruj potencjalnie niebezpieczne znaki
 *
 */

function hsc($html) {
	/*
	 *  htmlspecialchars — Convert special characters to HTML entities
	 *  ENT_QUOTES	Will convert both double and single quotes.
	 *  ENT_SUBSTITUTE	Replace invalid code unit sequences with a Unicode Replacement Character U+FFFD (UTF-8) or &#xFFFD; 
	 *+ (otherwise) instead of returning an empty string.
	 *  UTF-8	 	ASCII compatible multi-byte 8-bit Unicode.
	 */
	return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
}
?>