<?php
ini_set("session.cookie_domain", ".nagashi.me");

//session_set_cookie_params (0 , '/', 'nagashi.me');
header("Access-control-allow-origin: *");
header("Access-Control-Allow-Credentials: true");

require_once __DIR__."/define.php";

spl_autoload_register(function ($class) {
	include 'class/' . $class . '.php';
});

if(! isset($isCache)){
	header("Content-Type: text/html; charset=UTF-8");
	header("Expires: Thu, 01 Dec 1994 16:00:00 GMT");
	header("Last-Modified: ". gmdate("D, d M Y H:i:s"). " GMT");
	header("Cache-Control: no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
}

if(mb_strstr("api.nagashi.me", $_SERVER["HTTP_HOST"]) !== FALSE){
	if(!$notAuth){
		if(
			loginManager::getUserDetailFromAddress($_REQUEST["email"])["token"] != $_REQUEST["token"] ||
			empty($_REQUEST["email"]) ||
			empty($_REQUEST["token"])
		){
			header('HTTP/1.0 401 Unauthorized');
			print("Unauthorized.");
			exit();
		}
	}
}
