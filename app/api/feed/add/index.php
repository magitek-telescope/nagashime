<?php
  require_once __DIR__."/../../../autoload.php";
  $feedManager     = new feedManager();
  $categoryManager = new categoryManager();

  $userId = loginManager::getUserIdFromAddress($_REQUEST["email"]);

  $params =array(
    "id"  => $_REQUEST["category"],
    "user_id"=>$userId
  );

  $category = $categoryManager->getCategories("id = :id and user_id = :user_id", $params)[0];
  if(empty($category)){
    header('HTTP/1.0 401 Unauthorized');
    print("Unauthorized.");
    exit();
  }

  $result =$feedManager->addFeed(array(
    "user_id"=>loginManager::getUserIdFromAddress($_REQUEST["email"]),
    "category"=>$_REQUEST["category"],
    "url"=>$_REQUEST["url"]
  ), true);

  if($result){
    if($_REQUEST["html"]){
      $site["id"] = $result;
      $site["url"] = $_REQUEST["url"];
      $feed = simplexml_load_file($_REQUEST["url"], 'SimpleXMLElement', LIBXML_NOCDATA);
      // require __DIR__."/../../includes/articles.php";
    }else{
      header("Content-Type: application/json; charset=utf-8");
      print(json_encode(
        array(
          'id' => $result
        )
      ));
    }
  }else{
    print("Failure add feed '" . h($_REQUEST["url"]) . "'");
  }