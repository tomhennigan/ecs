<?php
// Created in 2012 for "Friends With Benefits"

class HandlerQuestion extends af\RequestHandler
{
	public function request() {
        $user = User::getCurrentUser();
        
        if ($user === null || !$user->hasFacebook() || $user['scraped'] == 0) {
            header('Location: /facebook/connect');
            exit;
        }
	
        $tpl = new Template('home');
		
		// If we have a question the construct a question object.
		$q = '';
		if (isset($_POST['question']) && !empty($_POST['question'])) {
			$q = new Question($_POST['question']);
		}
		$tpl['question'] = $q;
		
		return $tpl;
	}
}
