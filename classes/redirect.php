<?php
/**
 * класс редиректа
 */
class Redirect{
    public static function to($location = null){
        if(is_numeric($location)){
            switch ($location) {
                case 404:
                    header('HTTP/1.0 404 not found');
                    include '../includes/errors/404.php';
                    exit();
                break;
            
            }
        }
        if($location){
            header('Location: ' . $location);
            exit();
        }
    }
}
