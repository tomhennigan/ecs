<?php
// Created in 2012 for "Friends With Benefits"

class HandlerMockupConnect extends af\web\HTTPRequestHandler
{
	public function get() {
		$tpl = new Template('mockups/connect');
		return $tpl;
	}
}
