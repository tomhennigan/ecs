<?php
// Created in 2012 for "Friends With Benefits"

class Template extends ArrayObject
{
	private static $templateDir = null;
	private $name, $data = array();

	public static function setTemplateDir($dir) {
		self::$templateDir = $dir;
	}

	public function __construct($template) {
		$this->name = $template;
	}
	
	public function offsetExists($offset) {
		return isset($this->data[$offset]);
	}
	
	public function offsetGet($offset) {
		return $this->data[$offset];
	}
	
	public function offsetSet($offset, $value) {
		return $this->data[$offset] = $value;
	}
	
	public function offsetUnset($offset) {
		unset($this->data[$offset]);
	}
	
	public function __toString() {
		$err = error_reporting();
		
		error_reporting(E_ALL ^ E_NOTICE);
		
		$file = self::$templateDir . DIRECTORY_SEPARATOR . $this->name . '.php';
		
		$content = $this->extractRequire($file);
		
		error_reporting($err);

		return $content;
	}
	
	private function extractRequire($___template_file) {
		ob_start();
		
		// The only collision should be $___template_file
		extract($this->data, EXTR_SKIP);
		
		if(file_exists($___template_file) && is_readable($___template_file)) {
			require $___template_file;
		} else {
			throw new RuntimeException('Unable to find and/or read template file ' . $___template_file);
		}
		
		return ob_get_clean();
	}
}
