<?php

	class _Currency {

		/**
		*	Function : _Currency->convert()
		*	
		*	Converts currency from one code to another, for a list of countries and currencies, see the listCountries and listCurrencies methods below.
		*/
		public function convert($arg) {
			try {
				if (isset($arg[0]) && isset($arg[1])) {

					//Get the <from> and <to> currency IDs
					list ($from, $to) = $arg;

					$from = strtoupper($from);
					$to = strtoupper($to);

					//Get the amount to convert
					if (isset($arg[2]) && !empty($arg[2])) {
						$amount = $arg[2];
					} else {
						$amount = 1;
					}

					//Send a request to "http://freecurrencyconverterapi.com" and get the data
					$data = file_get_contents("http://www.freecurrencyconverterapi.com/api/v2/convert?q=" . $from . "_" . $to ."&compact=y");

					//Convert the JSON response to an associative array
					$data = json_decode($data, true);

					//Check if NO data is returned
					if ( !isset ( $data[$from . "_" . $to]) ) {
						return ["from" => $from, "to" => $to, "result" => "Error Processing Request"];
					}

					//Get the conversion rate
					$rate = $data[ $from . "_" . $to ]["val"];
					
					//Finally, return the converted value
					return ["from" => $from, "to" => $to, "amount" => $amount, "rate" => $rate, "result" => ($amount * $rate)];
				} else {
					throw new Exception("Please pass two arguments, (from) and (to).");					
				}
			} catch (Exception $e) {
				Debug::newError($e);
			}
		}


		public function listCountries() {
			// Place a request to "http://www.freecurrencyconverterapi.com/api/v2/countries" and get the JSON data
			$data = file_get_contents("http://www.freecurrencyconverterapi.com/api/v2/countries");

			//Convert this data into an associative array
			$data = json_decode($data, true);

			return $data;
		}

		public function listCurrencies() {
			// Place a request to "http://www.freecurrencyconverterapi.com/api/v2/currencies" and get the JSON data
			$data = file_get_contents("http://www.freecurrencyconverterapi.com/api/v2/currencies");

			//Convert this data into an associative array
			$data = json_decode($data, true);

			return $data;
		}

	}

?>