<?php

	/**
	* Core Controller Class
	*/
	class Controller
	{

		protected $responseType;

		public function __construct($responseType) {
			$this->responseType = $responseType;
		}

		public function model($model) {
			require_once "Models/" . $model . ".php";
			return new $model;
		}

		public function view($view, $data = []) {
			require_once "Views/" . $view . ".php";
		}

		public function index($args)
		{
			$model = $this->model("data");
			$model->data = $args;
			$this->view("home", $model->data);
		}
	}

?>