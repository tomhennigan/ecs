<?php
// Created in 2012 for "Friends With Benefits"

class TokenNameRanker
{
    public static function score($match, $token) {
        $match = strtolower($match);
        $token = strtolower($token);
        
        $simplifiedMatch = preg_replace('/[^a-z0-9\s]*/', '', $match);
        $simplifiedToken = preg_replace('/[^a-z0-9\s]*/', '', $token);
        
        $scores = array();
        
        foreach (preg_split('/\s+/', $simplifiedMatch) as $part) {
            if ($part === $token) {
                $scores[] = 1;
                continue;
            }
            
            if (!preg_match('/^(.*)'.$token.'(.*)$/', $part, $m)) {
                $scores[] = 0.8;
                continue;
            }
            
            $preMatch = $m[1];
            $postMatch = $m[2];
            
            $preMatchLen = strlen($preMatch);
            $postMatchLen = strlen($postMatch);
            $excessLen = $preMatchLen + $postMatchLen;
            
            if ($excessLen > strlen($token)) {
                $scores[] = 0.2;
            }
        }
        
        // Avoid divide by 0.
        if ($scores === array()) {
            return 0;
        }
        
        return self::sum($scores) / count($scores);
    }
    
    private static function sum(array $values) {
        $ret = 0;
        foreach ($values as $val) {
            $ret += $val;
        }
        return $ret;
    }
}
