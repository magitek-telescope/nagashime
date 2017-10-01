<?php

/**
 * feedManager (c) 2015 Potato4d
 *
 * 登録サイトの編集を司るクラス。
 * 追加/編集/削除等のデータをフロントとサーバーで同期していないと再読込時に問題が発生するため、
 * その転送を行う。
 *
 * @package me.potato4d.nagashime
 * @author Potato4d(Hanatani Takuma)
 * @since  PHP => 5.5
 * @version 1.0
**/

class feedManager{

  private $pdo;
  private $table;
  
  public function __construct(){
    $this->table = "feeds";
    $this->pdo   = connectDB(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);
  }

  public function addFeed($params, $getSequence=false){
    $manager = new pdoWrapper($this->table);
    $manager->begin();
    $manager->setColumn($params);
    $result = $manager->insert();
    if($result && $getSequence) $result = $manager->lastInsertId();
    $manager->commit();
    return $result;
  }

  public function getFeeds($condition=null, $params=null){
    $manager = new pdoWrapper($this->table);
    return $manager->getTargetList($condition, $params);
  }

  public function deleteFeed($condition, $params){
    $manager = new pdoWrapper($this->table);
    return $manager->delete($condition, $params);
  }

}

?>