<?php
  require_once __DIR__."/../../../autoload.php";

  $feedManager = new feedManager();
  $feedManager->deleteFeed(
    "id = :id and user_id = :user_id",
    array(
      "id"  => $_REQUEST["id"], 
      "user_id"=> loginManager::getUserIdFromAddress($_REQUEST["email"])
    )
  )
?>