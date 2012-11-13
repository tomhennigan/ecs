<?php
// Created in 2012 for "Friends With Benefits"

class HandlerMockupNotLoggedIn extends af\web\HTTPRequestHandler
{
	public function get() {
		$tpl = new Template('mockups/not-logged-in');
		return $tpl;
	}
}
