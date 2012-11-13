<?php
// Created in 2012 for "Friends With Benefits"

class HandlerFacebookScrape extends af\web\JSONHTTPRequestHandler
{
	public static function get() {
		$user = User::getCurrentUser();
		
		if ($user === null || !$user->hasFacebook()) {
			header('Location: /facebook/connect');
			exit;
		}
		
		if ($user['scraped'] == 1) {
			header('Location: /facebook/connect');
			exit;
		}
		
		// No time limit.
		set_time_limit(0);
		
		$fb = FacebookHelper::getFacebook();
		
		// Scrape page titles.
/* 		mysql_query('TRUNCATE `fb_page`'); */
		
		// I'm not confident we're getting everything.. Maybe something do 
		// with this bug (although we do request friend_likes as well) 
		// https://developers.facebook.com/bugs/344295515590822
		$query = 'SELECT page_id,name from page WHERE page_id IN (SELECT page_id FROM page_fan WHERE uid IN (SELECT uid2 FROM friend WHERE uid1 = me()))';
		$res = $fb->api(array(
			'method' => 'fql.query',
			'query' => $query
		));
		
		$values = array();
		foreach ($res as $page) {
			$values[] = '(' . (int)$page['page_id'] . ', "' . mysql_escape_string($page['name']) . '")';
		}
		
		if (!empty($values)) {
			mysql_query('INSERT IGNORE INTO `fb_page` (`facebookid`, `name`) VALUES ' . implode(',', $values));
		}
		
		// Now scrape associations.
/* 		mysql_query('TRUNCATE `fb_user_page`'); */
		
		$query = 'SELECT uid, page_id FROM page_fan WHERE uid IN (SELECT uid2 FROM friend WHERE uid1 = me())';
		$res = $fb->api(array(
			'method' => 'fql.query',
			'query' => $query
		));
		
		$values = array();
		foreach ($res as $assoc) {
			$values[] = '(' . (int)$user['id'] . ', '. (int)$assoc['uid'].', ' . (int)$assoc['page_id'] . ')';
		}
		
		if (!empty($values)) {
			mysql_query('INSERT IGNORE INTO `fb_user_page` (`userid`, `facebookid`, `pageid`) VALUES ' . implode(',', $values));
		}
		
		// Mark the user as scraped.
		mysql_query('UPDATE `user` SET `scraped` = 1 WHERE `id` = ' . (int)$user['id']);
		$user['scraped'] = 1;
		
		header('Location: /facebook/connect');
		exit;
	}
}
