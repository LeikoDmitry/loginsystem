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
       'session_name' => 'user' 
    ]
];
/**
 * подключам классы из папки classes
 */
spl_autoload_register(function($class){
    require_once '../classes/'.$class.'.php';
});

//require_once '../functions/sanitize.php';


