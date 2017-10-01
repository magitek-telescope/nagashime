<?php
/**
 * /feed/get/artcles
 *
 * 指定されたfeedの記事一覧を取得
**/
  require_once __DIR__."/../../../../autoload.php";

  $feed = simplexml_load_file($_REQUEST["feed"], 'SimpleXMLElement', LIBXML_NOCDATA);
  $articles = $feed->channel->item ?: $feed->entry ?: $feed;
  
  $result = array();
  foreach ($articles as $key => $article) {
    $result[] = $article;
  }
  header("Content-Type: application/json; charset=utf-8");
  print(json_encode($result));