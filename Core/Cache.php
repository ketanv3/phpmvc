<?php

	class Cache {

		private static $data;

		// Cache Modes
		// 1 : File Caching
		// 2 : Database Caching
		private static $mode = 2;

		private static function loadDataFromFile() {

		}

		private static function loadDataFromDatabase($requestURL, $expiry) {
			list($dbHost, $dbUser, $dbPass, $dbDb) = Database::$credentials;

			//Create a new MySQLi Connection
			$sql = new MySQLi($dbHost, $dbUser, $dbPass, $dbDb);

			$query = $sql->query("SELECT * FROM `cache` WHERE `url` = '$requestURL' ORDER BY `validfrom` DESC LIMIT 1");

			//Check if query returned any result, if not : make an HTTP call to that URL and cache it
			if ($query->num_rows) {

				$result = $query->fetch_assoc();

				//Check if the cache has expired
				if (time() <= $result['validthrough']) {
					//Return the cached response
					return $result['response'];
				} else {
					//Cache again!
					//Make an HTTP call
					$response = file_get_contents($requestURL);

					//Save this response
					$validfrom = time();
					$validthrough = $validfrom + $expiry;

					//Clean the string
					$cleanResponse = $sql->real_escape_string($response);
					$query = $sql->query("INSERT INTO `cache` VALUES (NULL, '$requestURL', '$validfrom', '$validthrough', '$cleanResponse')");

					return $response;
				}

			} else {
				//Make an HTTP call
				$response = file_get_contents($requestURL);

				//Save this response
				$validfrom = time();
				$validthrough = $validfrom + $expiry;

				//Clean the string
				$cleanResponse = $sql->real_escape_string($response);
				$query = $sql->query("INSERT INTO `cache` VALUES (NULL, '$requestURL', '$validfrom', '$validthrough', '$cleanResponse')");

				return $response;
			}
		}

		//Chnage the default cache expiry time, default 1 day (24*60*6 = 864000)
		public static function request($requestURL, $expiry = 86400) {
			switch (Cache::$mode) {
				case 1:
					$response = Cache::loadDataFromFile($requestURL, $expiry);
					break;
				
				case 2:
					$response = Cache::loadDataFromDatabase($requestURL, $expiry);
					break;
			}

			return $response;
		}

	}

?>