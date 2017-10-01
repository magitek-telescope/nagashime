<?php

/**
 * categoryManager (c) 2015 Potato4d
 *
 * カテゴリの編集を司るクラス。
 * 追加/編集/削除等のデータをフロントとサーバーで同期していないと再読込時に問題が発生するため、
 * その転送を行う。
 *
 * @package me.potato4d.nagashime
 * @author Potato4d(Hanatani Takuma)
 * @since  PHP => 5.5
 * @version 1.0
**/

class categoryManager{  
  public function __construct(){
    $this->table = "categories";
  }

  public function addCategory($params, $getSequence=false){
    $manager = new pdoWrapper($this->table);
    $manager->begin();
    $manager->setColumn($params);
    $result = $manager->insert();
    if($result && $getSequence) $result = $manager->lastInsertId();
    $manager->commit();
    return $result;
  }

  public function sortCategory($id, $sort){
    $manager = new pdoWrapper($this->table);
    $manager->setColumn(
      array("sort"=>$sort)
    );
    return $manager->update("id = {$id}");
  }

  public function renameCategory($id, $name){
    $manager = new pdoWrapper($this->table);
    $manager->setColumn(
      array("name"=>$name)
    );
    return $manager->update("id = {$id}");
  }

  public function getCategories($condition=null, $params=null){
    $manager = new pdoWrapper($this->table);
    $manager->setOrder("sort");
    return $manager->getTargetList($condition, $params);
  }


  public function deleteCategory($condition, $params){
    $manager = new pdoWrapper($this->table);
    return $manager->delete($condition, $params);
  }

  public static function makeDefaultCategory($userId){
    $params = array(
      "user"=>$userId,
      "name"=>"Default"
    );
    $manager = new pdoWrapper("categories");
    $manager->setColumn($params);
    return $manager->insert();
  }

}

?>