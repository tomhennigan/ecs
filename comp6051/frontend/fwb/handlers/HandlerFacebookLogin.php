<?php
// Created in 2012 for "Friends With Benefits"

class HandlerFacebookLogin extends af\web\HTTPRequestHandler
{
	public function get() {
		$fb = FacebookHelper::getFacebook();
		$user = $fb->getUser();
		
		if ($user) {
		  header('Location: /facebook/connect');
		  exit;
		}
		
        $url = $fb->getLoginUrl(array(
            'scope' => implode(',', array(
            	'user_likes',				'friends_likes',
            	'user_checkins',			'friends_checkins',
            	'user_location',			'friends_location',
            	'user_status',				'friends_status',
            	'user_groups',				'friends_groups',
            	'user_interests',			'friends_interests',
            	'user_activities',			'friends_activities',
            	'user_hometown',			'friends_hometown',
            	'user_religion_politics',	'friends_religion_politics'
            ))));
        
        header('Location: '.$url);
        exit;
	}
}
