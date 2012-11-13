<?php
// Created in 2012 for "Friends With Benefits"

class HandlerMockupAskQuestion extends af\web\HTTPRequestHandler
{
	public function get() {
		$tpl = new Template('mockups/ask-question');
		return $tpl;
	}
}
