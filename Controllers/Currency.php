<?php

	class Currency extends Controller {

		public function convert($arg) {
			$model = $this->model('_Currency');
			$data = $model->convert($arg);
			$this->view($this->responseType, $data);
		}

		public function listCountries() {
			$model = $this->model('_Currency');
			$data = $model->listCountries();
			$this->view($this->responseType, $data);
		}

		public function listCurrencies() {
			$model = $this->model('_Currency');
			$data = $model->listCurrencies();
			$this->view($this->responseType, $data);
		}

	}

?>