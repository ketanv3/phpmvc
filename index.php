<?php
	
	//Autoload all the dependencies
	require_once "autoload.php";

	$application = new Application;
	// Application can be called using the execute() function, or call by the URL
	$application->execute('currency/convert', ['USD', 'INR', 1]);

	// -------------------------------

	// Set the headers
	// No need to set the headers from here, let the JSON view do it automatically!
	// setHeader("plain");

	// Dump the Errors
	// var_dump(Debug::getErrors());

	// Dump the Log messages
	// var_dump(Debug::getLogs());