<?php
/**
 * This class is a HTTPRequestHandler in every sense, except the output from the
 * function takes different formats dependant on GET parameters.
 */
class RESTAPIHTTPRequestHandler extends af\web\HTTPRequestHandler
{
	private static $outputFormat = 'json';

	/**
	 * Returns the valid output formats that this class can support.
	  * @return array the output formats available.
	 */
	public static function getValidOutputFormats() {
		return array('json', 'print_r', 'var_export');
	}

	/**
	 * Returns a boolean value for whether the given output format  is valid
	 * or not.
	 * @param string $outputFormat the output format to test.
	 * @return true if the output format is valid, false if not.
	 */
	public static function isValidOutputFormat($outputFormat) {
		return in_array($outputFormat, self::getValidOutputFormats());
	}

	/**
	 * Sets the output format for requests to the given output format.
	 * @param string $outputFormat the output format to set.
	 */
	public static function setOutputFormat($outputFormat) {
		assert(self::isValidOutputFormat($outputFormat));
		self::$outputFormat = $outputFormat;
	}

	/**
	 * This method handles the request by calling the parent class 
	 * (HTTPRequestHandler) in order to get the return value from the underlying
	 * controller and then formats the output from that controller according
	 * to the outputFormat set for the class.
	 * @param af\Request $request the request object.
	 * @return mixed the formatted output of the module.
	 */
	public function handle(af\Request $request) {
		$ret = call_user_func_array('parent::handle', func_get_args());

		switch (self::$outputFormat) {
			case 'json':
				header('Content-type: text/plain');
				return json_encode($ret);

			case 'print_r';
				header('Content-type: text/plain');
				return print_r($ret, true);

			case 'var_export':
				header('Content-type: application/json');
				return var_export($ret, true);
		}
		
		throw new RuntimeException('Output format was unknown.');
	}
}

if (!isset($_SERVER['REUQEST_METHOD']) && defined('STDERR')) {
	// Guessing we're running on the command line here...
	RESTAPIHTTPRequestHandler::setOutputFormat('var_export');
}

if (isset($_GET['fmt']) && RESTAPIHTTPRequestHandler::isValidOutputFormat($_GET['fmt'])) {
	RESTAPIHTTPRequestHandler::setOutputFormat($_GET['fmt']);
}
