<?php

	/**
	* Debug class to handle exceptions and log messages
	*/
	class Debug
	{	
		public static $errors = [];
		public static $logs = [];

		public static function newError($e) {
			array_push(Debug::$errors, $e);
		}

		public static function newLog($message) {
			array_push(Debug::$logs, $message);
		}

		public static function getErrors() {
			return Debug::$errors;
		}

		public static function getLogs() {
			return Debug::$logs;
		}
	}

?>