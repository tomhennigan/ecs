<?php
// Created in 2012 for "Friends With Benefits"

class Answer
{
    private $question = null;

    public function __construct(Question $question) {
        $this->question = $question;
    }
    
    public function getQuestion() {
        return $this->question;
    }
    
    public function getAnswer() {
        DatabaseHelper::connect();
        
        $user = User::getCurrentUser();
        $question = $this->getQuestion();
        $tokens = $question->getTokens();
        
        // Search on each token to find matches.
        // TODO(tomhennigan): This needs tidying up a bit and made non-facebook,
        // but for now we'll make do with this method growing as we add more than
        // just fb_page..
        
        $matches = array();
        
        foreach ($tokens as $token) {
            $res = mysql_query(
                'SELECT u.`facebookid` as userid,p.`name`,p.`facebookid` as pageid
                FROM `fb_page` p
                JOIN `fb_user_page` u ON p.`facebookid` = u.`pageid`
                WHERE
                    p.`name` LIKE "%'.mysql_real_escape_string($token).'%"
                    AND u.`userid` = '.(int)$user['id']
            );
            
            while ($row = mysql_fetch_assoc($res)) {
                $userkey = 'fb_user['.$row['userid'].']';
                $matchkey = 'fb_page['.$row['pageid'].']';
                
                // TODO(tomhennigan): make this actually vary between 0 and 1 depending
                // on how much matches etc etc.
                $score = TokenNameRanker::score($row['name'], $token);
                
                assert($score >= 0 && $score <= 1);
                
                $match = array(
                    'type' => 'fb_page',
                    'fbid' => $row['pageid'],
                    'desc' => $row['name'],
                    'score' => $score
                );
                
                if (!isset($matches[$userkey])) {
                    $matches[$userkey] = array(
                        'type' => 'fb_user',
                        'fbid' => $row['userid'],
                        'matches' => array()
                    );
                }
                
                $matches[$userkey]['matches'][$matchkey] = $match;
            }
        }
        
        shuffle($matches);

        $best = null;
        
        if (!empty($matches)) {
            $bestScore = 0;
            
            foreach ($matches as $cand) {
                $score = 0;
                $count = 0;
                
                foreach ($cand['matches'] as $match) {
                    $score += $match['score'];
                    $count++;
                }
                
                $score /= $count;
                
                // We add a small amount to the score for > 1 match.
                $score += (0.01 * ($count - 1));
                
                if ($score > $bestScore) {
                    $bestScore = $score;
                    $best = $cand;
                }
            }
        }
        
        $answer = array(
            'best' => $best,
            'matches' => $matches
        );
        
        return $answer;
    }
}
