<?php
// Created in 2012 for "Friends With Benefits"

class HandlerAsk extends af\web\JSONHTTPRequestHandler
{
    public static function get() {
        $_POST = $_GET;
        return self::post();
    }

	public static function post() {
		if (!isset($_POST['question'])) {
			return;
		}
		
		$q = new Question($_POST['question']);
        $a = $q->getAnswer();
	
		return array(
			'tokens' => $q->getTokens(),
			'answer' => $a->getAnswer()
		);
	}
}
