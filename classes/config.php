<?php
/**
 * файл, работающий с $GLOBALS в core/init.php
 */

class Config{
    /**
     * Возвращает конкретное значение из $GLOBALS
     * @param  $path string
     * @return string
     */
    public static function get($path = NULL){
       $path = explode('/', $path);
       $config = $GLOBALS['config'];
       
          if(isset($config)){
       
           foreach($path as $bit){
          
           if($config[$bit]){
            
            $config = $config[$bit];
          }
        }
       return $config;
       }
    }
}
