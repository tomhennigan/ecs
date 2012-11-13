<?php
// Created in 2012 for "Friends With Benefits"

class HandlerApiFriends extends RESTAPIHTTPRequestHandler
{
    public function get() {
        DatabaseHelper::connect();
        $user = User::getCurrentUser();
        
        if (!$user) {
            return null;
        }
        
        $query = 'SELECT DISTINCT `facebookid` FROM `fb_user_page` WHERE `userid` = :userid ORDER BY `facebookid`';
        $pdo = orm\Storage::getDefaultInstance()->getPDO();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':userid', $user['id']);
        $stmt->execute();
        
        $ret = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $ret[] = $row['facebookid'];
        }
        $stmt->closeCursor();
        
        return $ret;
    }
}
