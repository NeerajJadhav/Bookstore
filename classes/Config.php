<?php

require_once 'core/init.php';

class Config{
    public static function get($path = null){
        if($path){
            $config = $GLOBALS['config'];
            $path = explode('/',$path);

            foreach($path as $bit){
               if(isset($config[$bit])){
                   $config = $config[$bit];
               }
            }
            return $config;
        }
        return false;
    }

    public static function debug($string){
        echo '<pre>'.print_r($string,1).'</pre>';
    }
}