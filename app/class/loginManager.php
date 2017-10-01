<?php

/**
 * loginManager (c) 2015 Potato4d
 *
 * ログイン関連を司るクラス。
 * ログイン状態のチェックやユーザー登録関連を行う。
 *
 * @package me.potato4d.nagashime
 * @author Hanatani Takuma
 * @since  PHP => 5.5s
 * @version 1.0
**/

class loginManager{

	public static function writeLoginLog($email){
		$id = loginManager::getUserIdFromAddress($email);
		$manager = new pdoWrapper("users");
		$manager->setColumn(array("last_login"=>date("Y/m/d")));
		return $manager->update("id = {$id}");
	}

	public static function doLogin($params){
		$checker = new pdoWrapper("users");
		$isExist = !$checker->isExistMatchColumn(
			"`email` = :email and `password` = :password",
			array(
				'email'   => $params['email'],
				'password'=> hash('sha256', $params["password"] . PW_SALT)
			)
		);

		if($isExist){
			$id = loginManager::getUserIdFromAddress($params['email']);
			$manager = new pdoWrapper("users");
			$manager->setColumn(array("last_login"=>date("Y/m/d")));
			return $manager->update("id = {$id}");
		}
		return $isExist;
	}

	public static function checkRegisterType(){
		if(!isset($_REQUEST["type"])){
			return "forceRedirect";
		}
		return $_REQUEST["type"];
	}

	public static function checkIsLogin(){
		return isset($_SESSION["isLogin"]);
	}

	public static function getUserIdFromAddress($email){
		return loginManager::getUserDetailFromAddress($email)["id"];
	}

	public static function getUserDetailFromAddress($email){
		$register = new pdoWrapper("users");
		return $register->getTargetList("email = :email", array("email"=>$email))[0];
	}

	public static function doRegister($params){
		if(empty($params["allow_send_email"])) $params["allow_send_email"] = 0;

		$register = new pdoWrapper("users");
		$register->setColumn(
			array(
				'email'   => $params['email'],
				'password'=> hash('sha256', $params["password"]),
				'token'   => sha1(uniqid(mt_rand(), true)),
				'last_login'=> date("Y/m/d"),
				'allow_send_email' => $params["allow_send_email"]
			)
		);
		return $register->insert();
	}

	public static function updateUser($id, $params){
		if(!$params["password"]){
			unset($params["password"]);
		}else{
			$params["password"] = hash('sha256', $params["password"]);
		}

		$manager = new pdoWrapper("users");
		$manager->setColumn($params);
		return $manager->update("id = {$id}");
	}

	public static function updateUserPassword($id, $new){
		$manager = new pdoWrapper("users");
		$manager->setColumn(array("password"=>hash('sha256', $new)));
		return $manager->update("id = {$id}");
	}

	public static function updateUserScrollSpeed($id, $speed){
		$manager = new pdoWrapper("users");
		$manager->setColumn(array("scroll"=>$speed));
		return $manager->update("id = {$id}");
	}

	public static function updateAllowSendEmail($id, $allow){
		$manager = new pdoWrapper("users");
		$manager->setColumn(array("allow_send_email"=>$allow));
		return $manager->update("id = {$id}");
	}

}
