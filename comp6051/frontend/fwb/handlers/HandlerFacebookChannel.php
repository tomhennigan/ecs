<?php
// Created in 2012 for "Friends With Benefits"

class HandlerFacebookChannel extends af\web\HTTPRequestHandler
{
    public static function get() {
        $cache_expire = 60*60*24*365;
        header('Pragma: public');
        header('Cache-Control: max-age='.$cache_expire);
        header('Expires: ' . gmdate('D, d M Y H:i:s', time()+$cache_expire) . ' GMT');
        
        return '<script src="https://connect.facebook.net/en_US/all.js"></script>';
    }
}
