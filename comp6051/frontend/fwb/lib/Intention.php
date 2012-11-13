<?php
// Created in 2012 for "Friends With Benefits"

class Intention
{
	const UNKNOWN = 'unknown';
	const FIND    = 'find';
	const HELP    = 'help';
	const BUY     = 'buy';
	const SELL    = 'sell';
	
	public static function getIntention($question) {
		if (stripos($question, 'where') !== false) {
			return self::FIND;
		}
		
		// TODO
		
		return self::UNKNOWN;
	}
}
