<?php

	class GeoIP extends Controller {

		public function ipdata($arg) {
			$model = $this->model('_GeoIP');
			$data = $model->ipdata($arg);
			$this->view('json', $data);
		}

	}

?>