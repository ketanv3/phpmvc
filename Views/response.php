<?php
	
	// This is a polyfill, We can't return values back to the Application Object, so we're using a Global Class to save our return values and not render any view.
	// Patchy, but works!
	ResponseHandler::$response = $data;

?>