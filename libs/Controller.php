<?php

class Controller
{
	
	function __construct()
	{
		//echo 'Main controller';
		$this->view = new View();
	}

	public function loadModel($name)
	{
		$path = 'models/'.$name.'_model.php';

		if(file_exists($path))
		{
			require $path;

			$modelName = $name.'_Model';
			$this->model = new $modelName();
		}
	}
}

?>