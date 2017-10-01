<?php
  require_once __DIR__."/../../../autoload.php";
  $categoryManager = new categoryManager();

  $userId = loginManager::getUserIdFromAddress($_REQUEST["email"]);

  $sortMax = call_user_func(function ($user){
    $pdo = new pdoWrapper("categories");
    return $pdo->getMax("SELECT MAX(sort) FROM categories WHERE user = {$user}")[0]["MAX(sort)"];
  }, $userId);

  $params = array(
    "user_id"  =>$userId,
    "name"  => $_REQUEST["name"],
    "sort"=>((int)$sortMax+1)
  );

  $result = $categoryManager->addCategory($params, true);

  if($result !== false){
    
    $name = $_REQUEST["name"];
    $category = array(
      "id"=>$result,
      "feeds"=>null,
      "sort"=>((int)$sortMax+1)
    );
    
    if($_REQUEST["html"]){
      require __DIR__."/../../../includes/column.php";
    }else{
      $category["name"] = $_REQUEST["name"];
      header("Content-Type: application/json; charset=utf-8");
      print(json_encode($category));  
    }
  }else{
    print("Failure add category '" . h($_REQUEST["name"]) . "'");
  }