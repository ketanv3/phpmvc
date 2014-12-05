<?php

	//Set the header to output contents as JSON (JavaScript in reality)
	setHeader("json");

	//Spit out the $data in json's encoded form
	echo json_encode( $data );

?>