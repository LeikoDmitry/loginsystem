<?php
/**
 * файл отвечающий за уничтожение сессии
 * 
 */

require_once '../core/init.php';


$user = new User();
$user->logout();
Redirect::to('index.php');