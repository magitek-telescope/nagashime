<?php

/**
 * cacheManager (c) 2015 Potato4d
 *
 * キャッシュの編集を司るクラス。
 * 追加/編集/削除等のデータをフロントとサーバーで同期していないと再読込時に問題が発生するため、
 * その転送を行う。
 *
 * @package me.potato4d.nagashime
 * @author Potato4d(Hanatani Takuma)
 * @since  PHP => 5.5
 * @version 1.0
**/

class cacheManager{  
  public function __construct(){
    $this->table = "article_caches";
  }

  public function addCache($page_url, $img_url){
    $params = array(
      'page_url'=>$page_url,
      "img_url"=>$img_url
    );

    $manager = new pdoWrapper($this->table);
    $manager->begin();
    $manager->setColumn($params);
    $result = $manager->insert();
    $manager->commit();
    return $result;
  }

  public function getCache($condition=null, $params=null){
    $manager = new pdoWrapper($this->table);
    return $manager->getTargetList($condition, $params);
  }

}

?>