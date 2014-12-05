<?php

	class Currency extends Controller {

		public function convert($arg) {
			$model = $this->model('_Currency');
			$data = $model->convert($arg);
			$this->view('json', $data);
		}

		public function listCountries() {
			$model = $this->model('_Currency');
			$data = $model->listCountries();
			$this->view('json', $data);
		}

		public function listCurrencies() {
			$model = $this->model('_Currency');
			$data = $model->listCurrencies();
			$this->view('json', $data);
		}

	}

?>