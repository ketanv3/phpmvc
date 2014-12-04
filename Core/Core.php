<?php

	function setHeader($action) {
		switch ($action) {
			case 'plain':
				header("Content-Type: text/plain");
				break;
			
			case 'json':
				header("Content-Type: text/javascript");
				break;

			default:
				header("Content-Type: text/html");
				break;
		}
	}

?>