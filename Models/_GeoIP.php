<?php

	class _GeoIP {

		/*
			Response Data from this API (telize.com/geoip/<optional:ip>)

			ip (Visitor IP address, or IP address specified as parameter)
			country_code (Two-letter ISO 3166-1 alpha-2 country code)
			country_code3 (Three-letter ISO 3166-1 alpha-3 country code)
			country (Name of the country)
			region_code (Two-letter ISO-3166-2 state / region code)
			region (Name of the region)
			city (Name of the city)
			postal_code (Postal code / Zip code)
			continent_code (Two-letter continent code)
			latitude (Latitude)
			longitude (Longitude)
			dma_code (DMA Code)
			area_code (Area Code)
			asn (Autonomous System Number)
			isp (Internet service provider)
			timezone (Time Zone)
		*/

		public function ipdata($arg) {
			if (isset($arg[0])) {
				$ip = $arg[0];
			} else {
				$ip = "";
			}

			//Place a request to "http://telize.com" to get the IP data
			$data = @Cache::request("http://www.telize.com/geoip/" . $ip, (1 * 30 * 24 * 60 * 60));

			//Decode the JSON string into an associative array
			$data = json_decode($data, true);

			return $data;
		}

	}

?>