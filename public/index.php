<?php 
/**
 * Файл точки входа
 */

/*Подключаем init.php*/

require_once '../core/init.php';

$user = Db::getInstance()->update('users',3,array(
    'username'=>'Vasilion',
    'password'=>'password',
  ));

