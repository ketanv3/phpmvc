<?php
	
	class home extends Controller
	{
		
		function index($args)
		{
			$model = $this->model("DataStore");
			$model->data = $args;
			$this->view("home", $model->data);
		}
	}

?>