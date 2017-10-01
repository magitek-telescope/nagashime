<?php
  require_once __DIR__."/../../../../autoload.php";
  $userId = loginManager::getUserDetailFromAddress($_REQUEST["email"])["id"];
  $result = loginManager::updateAllowSendEmail($userId, (int)$_REQUEST["allow"]);
  header("Content-Type: application/json; charset=utf-8");
  print(json_encode(array("result"=>$result)));
?>