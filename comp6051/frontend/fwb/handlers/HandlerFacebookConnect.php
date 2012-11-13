<?php
// Created in 2012 for "Friends With Benefits"

class HandlerFacebookConnect extends af\web\HTTPRequestHandler
{
    public static function get() {
        $fb = FacebookHelper::getFacebook();
        $fbuser = $fb->getUser();
		$user = User::getCurrentUser();
		
		if (!$fbuser || !$user || !$user->hasFacebook()) {
		  header('Location: /facebook/login');
		  exit;
		}
		
		if ($user['scraped'] == 0) {
		  header('Location: /facebook/scrape');
		  exit;
		}
		
		header('Location: /');
		exit;
    }
}
