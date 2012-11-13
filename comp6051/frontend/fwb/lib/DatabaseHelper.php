<?php
// Created in 2012 for "Friends With Benefits"

class DatabaseHelper
{
    public static function connect() {
        static $db = false;
    
        if ($db !== false) {
            return $db;
        }
    
        $db = mysql_connect('127.0.0.1', 'social', file_get_contents(__DIR__.'/DatabaseHelperPassword.txt'), false);
        
        if (!$db) {
            user_error('error connecting to mysql server: ' . mysql_error());
            return false;
        }
        
        mysql_select_db('social');
        
        // Setup the orm layer.
        require_once FWB_DIR . '/ext/php-orm/src/orm/orm.php';

        $storage = new orm\mysql\MySQLStorage('social', file_get_contents(__DIR__.'/DatabaseHelperPassword.txt'), 'social');
        orm\Storage::setDefaultInstance($storage);

        return $db;
    }
}
