<?php

/**
 * pdoWrapper (c) 2015 Potato4d
 *
 * PDOのラッパークラス。直で書くのしんどい。
 *
 * @package me.potato4d.pdoWrap
 * @author  Hanatani Takuma
 * @since  PHP => 5.5
 * @version 0.1
**/
class pdoWrapper
{
  private $pdo;
  private $table;
  private $columns;
  private $order;

  function __construct($name=null){
    $this->table = $name;
    $this->pdo   = connectDB(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);
  }

  public function begin(){
    $this->pdo->beginTransaction();
  }

  public function commit(){
    $this->pdo->commit();
  }

  public function rollback(){
    $this->pdo->rollback();
  }

  public function lastInsertId(){
    return $this->pdo->lastInsertId();
  }

  public function setTable($name){
    $this->table = $name;
  }

  public function clearColumns(){
    $this->columns = array();
  }

  public function setOrder($column, $desc=null){
    $this->order = " ORDER BY {$column} " . (!$desc ? "ASC" : "DESC");
  }

  /**
   * setColumn
   *
   * @param array $params
  **/
  public function setColumn($params){
    foreach ($params as $key => $param) {
      $this->columns[$key] = $param;
    }
  }

  /**
   * insert
   *
   * @return bool
  **/
  public function insert(){
    $sql = "INSERT INTO `{$this->table}`";

    $keys   = "(`"       . implode(array_keys($this->columns), "`, `") . "`)";
    $values = "VALUES(:" . implode(array_keys($this->columns),  ", :") .  ")";

    $sql   .= "{$keys} {$values};";
    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute($this->columns);
  }

  public function update($condition){
    $sql = "UPDATE `{$this->table}` SET ";

    $elements = array();

    foreach ($this->columns as $key => $value) {
      $elements[] = "{$key} = :{$key}";
    }

    $sql   .= implode($elements, ",") . " WHERE {$condition}";
    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute($this->columns);
  }

  public function delete($condition, $params){
    $sql = "DELETE FROM `{$this->table}` WHERE {$condition}";
    $stmt = $this->pdo->prepare($sql);
    
    $stmt->execute($params);
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getDetailTarget(){
    $sql = "SELECT * FROM `{$this->table}` WHERE {$condition} LIMIT 1";
    $stmt = $this->pdo->prepare($sql);
    if(!is_null($params)){
      $stmt->execute($params);
    }else{
      $stmt->execute();
    }

    return $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
  }

  public function getTargetList($condition=null, $params=null){
    if(empty($condition)){
      $sql = "SELECT * FROM `{$this->table}`";
    }else{
      $sql = "SELECT * FROM `{$this->table}` WHERE {$condition}";
    }
    if($this->order){
      $sql .= $this->order;
      $this->order = "";
    }
    $stmt = $this->pdo->prepare($sql);
    
    if(!is_null($params)){
      $stmt->execute($params);
    }else{
      $stmt->execute();
    }

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function isExistMatchColumn($condition, $params=null){
    $result = $this->getTargetList($condition, $params);
    return empty($result);
  }

  public function getMax($sql){
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

}

?>