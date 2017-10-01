<?php
	require_once __DIR__."/../../autoload.php";

	function loginUser(){
		writeSession("isLogin", true);
		writeSession("email" , $_REQUEST["email"]);
	}

	if(loginManager::checkIsLogin()){
		header("Location: /app/");
	}

	switch (loginManager::checkRegisterType()) {
		case "email":
			if(loginManager::doRegister($_REQUEST)){
				$result = categoryManager::makeDefaultCategory(loginManager::getUserIdFromAddress($_REQUEST["email"]));
				if($result){
					loginUser();
					header("Location: /app/");
				}else{
					header("Location: /app/register");
				}
			}else{
				$error = "既にそのメールアドレスは使われています。";
				require_once __DIR__."/../../includes/login.php";
			}
		break;

		case "login":
			if(loginManager::doLogin($_REQUEST)){
				loginUser();
				header("Location: /app/");
			}else{
				$error = "メールアドレスもしくはパスワードが違います。";
				require_once __DIR__."/../../includes/login.php";
			}
		break;

		case "logout":
			writeSession("isLogin", NULL);
			writeSession("email"  , NULL);
			header("Location: ./");
			exit();
		break;

		default:
			require_once __DIR__."/../../includes/login.php";
		break;
	}