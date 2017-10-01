<?php
session_start();
session_write_close();

error_reporting(E_ALL);

set_include_path(__DIR__);

define("DB_HOST"    , "DBのホスト");
define("DB_NAME"    , "DBの名前");
define("DB_USER"    , "ユーザー");
define("DB_PASSWORD", "パスワード");
define("PW_SALT", "パスワード");


function h($str){
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function connectDB($host, $name, $user, $password){
  return new PDO(
    "mysql:host={$host};dbname={$name}",
    $user,
    $password
  );
}

function writeSession($key, $value){
  session_start();
  $_SESSION[$key] = $value;
  session_write_close();
}
