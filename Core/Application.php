<?php

	class Application {

		protected $controller = "home";
		protected $method = "index";
		protected $args = [];

		public function __construct() {
			if (isset($_REQUEST['q'])) {
				$this->parseURL();
			}
		}

		public function execute($path, $args = []) {
			$path = explode('/', $path);
			$this->controller = $path[0];
			$this->method = $path[1];

			//Check if the controller exists on file, if not: use the default values
			try {
				if (file_exists("Controllers/" . $this->controller . ".php")) {
					//Do nothing
				} else {
					$this->controller = "home";
					throw new Exception("Controller doesn't exist on file, using (home)");
				}
			} catch (Exception $e) {
				Debug::newError($e);
			}
			//Create a new instance of controller
			require_once "Controllers/" . $this->controller . ".php";
			$this->controller = new $this->controller;

			//Check if the method exists, else use the default values
			try {
				if (method_exists($this->controller, $this->method)) {
					//Do nothing
				} else {
					$this->method = "index";
					throw new Exception("Method doesn't exists on the controller, using (index)");
				}
			} catch (Exception $e) {
				Debug::newError($e);
			}
			//Call that method
			//call_user_func_array([$this->controller, $this->method], $args);
			
			//Try and see if the method is public
			try {
				//How to see if the method is visible or not?
				$this->controller->{$this->method}($args);
			} catch (Exception $e) {
				Debug::newError($e);
			}

		}

		public function parseURL() {
			try {
				if (isset($_REQUEST['q'])) {
					$query = $_REQUEST['q'];

					//Explode the string and get the parameters
					$query = explode('/', rtrim($query, '/'));

					//Check if the controller is set or not
					try {
						if (isset($query[0])) {
							$this->controller = $query[0];
							unset($query[0]);
						} else {
							throw new Exception("Controller name not set, using default (home)");
						}
					} catch (Exception $e) {
						Debug::newError($e);
					}

					//Check if the method name is set or not
					try {
						if (isset($query[1])) {
							$this->method = $query[1];
							unset($query[1]);
						} else {
							throw new Exception("Method name is not set, using default (index)");
						}
					} catch (Exception $e) {
						Debug::newError($e);
					}

					//Fix the indexes of input query and assign it to args
					$this->args = ($query) ? array_values($query) : [];

				} else {
					throw new Exception("Input Query not set.");
				}
			} catch (Exception $e) {
				Debug::newError($e);
			}

			//Call the execute function with the above values
			$this->execute($this->controller . "/" . $this->method, $this->args);
		}

	}

?>