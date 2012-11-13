<?php
// Created in 2012 for "Friends With Benefits"

require_once FWB_DIR . '/ext/facebook-php-sdk/src/facebook.php';

class FacebookHelper
{
		public static function getFacebook() {
				static $fb = null;
				
				if ($fb === null) {
					$fb = new Facebook(array(
						'appId' => '317284658320582',
	 					'secret' => file_get_contents(__DIR__.'/FacebookHelperSecret.txt')
					));
				}
				
				return $fb;
		}
}
