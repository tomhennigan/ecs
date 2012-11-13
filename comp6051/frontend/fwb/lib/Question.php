<?php
// Created in 2012 for "Friends With Benefits"

class Question
{
	private $question;
	private $tokens = array();
	private $intention = Intention::UNKNOWN;
	
	public function __construct($question) {
		$this->setQuestion($question);
	}
	
	public function setQuestion($question) {
		$question = trim($question);
		$this->question = $question;
		$this->tokens = SearchTokenizer::tokenize($question);
		$this->intention = Intention::getIntention($question);
	}
	
	public function __toString() {
		return $this->question;
	}
	
	public function getIntention() {
		return $this->intention;
	}
	
	public function getQuestion() {
		return $this->question;
	}
	
	public function getTokens() {
		return $this->tokens;
	}
	
	public function getAnswer() {
	   return new Answer($this);
    }
}
