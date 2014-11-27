<?php
/**
 * Файл инициализации проекта
 */
session_start();
/**
 * Различный настройки
 */
$GLOBALS['config']= [
      'mysql' => [
      'host' => 'localhost',
      'username' => 'root',
      'password' => '',
      'charset' => 'UTF8',
      'db' => 'login'    
    ],
    'remember' => [
       'cookie_name' => 'hash',
       'cookie_expiry' => 604800 
    ],
    'session' => [
       'session_name' => 'user',
       'token_name' => 'token' 
    ]
];
/**
 * подключам классы из папки classes
 */
spl_autoload_register(function($class){
    require_once '../classes/'.$class.'.php';
});

//require_once '../functions/sanitize.php';
if(Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists(Config::get('session/session_name'))){
  $hash = Cookie::get(Config::get('remember/cookie_name'));
  
  $hashCheck = Db::getInstance()->get('user',['hash','=', $hash]);
  
  if($hashCheck->count()){
     
      $user = new User($hashCheck->first()->user_id);
      $user->login();
  }
}


