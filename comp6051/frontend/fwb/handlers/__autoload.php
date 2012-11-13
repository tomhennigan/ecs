<?php
// Created in 2012 for "Friends With Benefits"

spl_autoload_register(function ($class_name) {
	// A quick sanity test.
	if (stripos($class_name, '/') !== false) {
		return class_exists($class_name, false);
	}

	// Now check for the file.
	$f = __DIR__ . '/' . $class_name . '.php';
	if (file_exists($f)) {
		if (!is_readable($f)) {
			throw new RuntimeException($f.' is not readable');
		}
		
		require_once $f;
	}
	
	return class_exists($class_name, false);
});
