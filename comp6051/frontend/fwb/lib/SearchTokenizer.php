<?php
// Created in 2012 for "Friends With Benefits"

class SearchTokenizer
{
	/**
	 * TODO(tomhennigan) This is just a proof of concept 
	 */
	public static function tokenize($input) {
		$input = (string) $input;
		
		if ($input === '') {
			return array();
		}
		
		// Process the input into individual words.
		$input = str_replace(',', '', $input);
		$input = str_replace(array("\t", "\n", "\r", ' '), ' ', $input);
		$input = str_replace(array('?', '.', '!'), '', $input);
		$input = strtolower($input);
		$parts = explode(' ', $input);
		
		// A simple way of dropping boring generic words this would need to be more comprehensive.
		$dropwords = array('where', 'i', 'can', 'get', 'in', 'a', 'an', 'some', 'bit');
		foreach ($parts as $idx => $word) {
			if (in_array($word, $dropwords)) {
				unset($parts[$idx]);
			}
		}
		
		// Now process keywords by expanding anything we know about already.
		/*$mappings = array(
			'curry' => array('indian food', 'cooking'),
			'soho' => array('westminister', 'london', 'west end'),
			'coffee' => array('espresso', 'mocha', 'cappuchino'),
			'espresso' => array('coffee')
		);
		$keys = array_keys($parts);
		$toadd = array();
		foreach ($parts as $idx => $word) {
			if (isset($mappings[$word])) {
				$toadd = array_merge($toadd, $mappings[$word]);
			}
		}
		$parts = array_merge($parts, $toadd);
		
		$parts = array_unique($parts);*/
		
		return $parts;
	}
}
