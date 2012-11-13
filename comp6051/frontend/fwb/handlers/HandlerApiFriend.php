<?php
// Created in 2012 for "Friends With Benefits"

class HandlerApiFriend extends RESTAPIHTTPRequestHandler
{
    public function get($friendid) {
        DatabaseHelper::connect();
        $user = User::getCurrentUser();
        
        if (!$user) {
            return null;
        }
        
        $query = 'SELECT DISTINCT p.`name` 
            FROM `fb_page` p, 
                 `fb_user_page` up 
            WHERE 
                up.`userid` = :userid
            AND up.`facebookid` = :friendid
            AND p.`facebookid` = up.`pageid`';
        $pdo = orm\Storage::getDefaultInstance()->getPDO();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':userid', $user['id'], PDO::PARAM_INT);
        $stmt->bindParam(':friendid', $friendid, PDO::PARAM_INT);
        $stmt->execute();
        
        $ret = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $ret[] = $row['name'];
        }
        $stmt->closeCursor();
        
        return $ret;
    }
}
