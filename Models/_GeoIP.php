<?php

	class _GeoIP {

		public function ipdata($arg) {
			if (isset($arg[0])) {
				$ip = $arg[0];
			} else {
				$ip = "";
			}

			//Place a request to "http://telize.com" to get the IP data
			$data = @file_get_contents("http://www.telize.com/geoip/" . $ip);

			//Decode the JSON string into an associative array
			$data = json_decode($data, true);

			return $data;
		}

	}

?>