<?php
/**
 * файл отвечающий за профиль пользователя
 */
require_once '../core/init.php';

if(!$username = Input::getItem('user')){
    Redirect::to('index.php');
}
 else {
  
     $user = new User($username);
     if(!$user->exists()){
         Redirect::to(404);
     }
     else{
         $data = $user->data();
         echo $data->username,'<br />';
          echo $data->name,'<br />';
     }
      
  
}