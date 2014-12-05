<?php

	class System extends Controller {

		public function index() {
			echo "System Information Controller<br>You sure you're looking for this?";
			//$this->view("home.php");
		}

		private function phpinfo() {
			phpinfo();
		}

	}

?>