<?php
// Created in 2012 for "Friends With Benefits"

DatabaseHelper::connect();

class User extends orm\Storable
{
	private static $user = null;

    public function __construct($id=null) {
        $this->setTable('user');
        $this->setPrimaryKey('id');

        if ($id !== null) {
            $this['id'] = $id;
            $this->retrieve();
        }
    }

    public function hasFacebook() {
        return !empty($this['facebookid']);
    }

	public static function getCurrentUser() {
		if (self::$user === null) {
			$fb = FacebookHelper::getFacebook();
			
			$fbid = $fb->getUser();
			
			if ($fbid === false) {
                return false;
			}
			
            DatabaseHelper::connect();
            
            $res = mysql_query('SELECT `id` FROM `user` WHERE `facebookid` = "' . mysql_real_escape_string($fbid) . '"');
            
            if ($res === false) {
                throw new RuntimeError(mysql_error());
                return false;
            }
            
            $row = mysql_fetch_assoc($res);
            
            if ($row === false) {
                $u = new User;
                $u['facebookid'] = $fbid;
                $u->store();
            } else {
                $u = new User($row['id']);
            }
            
            self::$user = $u;
		}
		
		return self::$user;
	}
}
