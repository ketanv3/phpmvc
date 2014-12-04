<?php
	
	//Autoload all the dependencies
	require_once "autoload.php";

	$application = new Application;
	// Application can be called using the execute() function, or call by the URL
	// $application->execute('ketan/verma', ['This', 'is', 'cool!']);

	// -------------------------------

	// Set the headers
	setHeader("plain");

	// Dump the Errors
	// var_dump(Debug::getErrors());

	// Dump the Log messages
	// var_dump(Debug::getLogs());