<?php
  require_once __DIR__."/../../../autoload.php";
  if(!isset($_REQUEST["id"]) || !isset($_REQUEST["email"])){
    header('HTTP', true, 400);
    print("Bad request.");
    exit();
  }
  $categoryManager = new categoryManager();
  $categoryManager->deleteCategory(
    "id = :id and user_id = :user_id",
    array(
      "id"  => $_REQUEST["id"], 
      "user_id"=> loginManager::getUserIdFromAddress($_REQUEST["email"])
    )
  )
?>