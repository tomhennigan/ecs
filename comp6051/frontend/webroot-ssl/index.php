<?php
// Created in 2012 for "Friends With Benefits"
ini_set('display_errors', true);
ini_set('html_errors', false);
error_reporting(E_ALL);

define('FWB_DIR', dirname(__DIR__) . '/fwb');

// Autoloaders for the lib files and request handlers.
require_once FWB_DIR . '/ext/php-af/src/af/af.php';
require_once FWB_DIR . '/ext/php-af/src/af/web/web.php';
require_once FWB_DIR . '/lib/__autoload.php';
require_once FWB_DIR . '/handlers/__autoload.php';

// Initialise the template engine.
Template::setTemplateDir(FWB_DIR . '/templates');

// Now all the requests we can handle.
$r = new af\Application;
$r->addHandler('', 'HandlerQuestion');
$r->addHandler('ask', 'HandlerAsk');

$r->addHandler('api/friends', 'HandlerApiFriends');
$r->addHandler('api/friend/([0-9]+)', 'HandlerApiFriend');


$r->addHandler('facebook/channel', 'HandlerFacebookChannel');
$r->addHandler('facebook/connect', 'HandlerFacebookConnect');
$r->addHandler('facebook/login', 'HandlerFacebookLogin');
$r->addHandler('facebook/scrape', 'HandlerFacebookScrape');

$r->addHandler('mockups/not-logged-in', 'HandlerMockupNotLoggedIn');
$r->addHandler('mockups/ask-question', 'HandlerMockupAskQuestion');
$r->addHandler('mockups/connect', 'HandlerMockupConnect');

// And try to handle the request.
$path = isset($_GET['path']) ? $_GET['path'] : '';
$method = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'get';

$request = new af\web\HTTPRequest($path);
$request->setMethod($method);

if ($ret = $r->handle($request)) {
	echo $ret;
	exit;
}

$proto = isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.1';
header($proto . ' 404 Not Found');
exit;
