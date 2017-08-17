<?php

class Bootstrap
{
	public $url;
	
	function __construct()
	{
		if (!(isset($_GET['url'])))
		{
			$url[0] = 'index';
		}
		else
		{
			$url = $_GET['url'];
			$url = rtrim($url, '/');
			$url = explode('/', $url);
		}
	

		$file =  'controllers/'.$url[0].'.php';
		if (!file_exists($file))
		{
			$this->error();
		}
		else
		{
			require_once $file;
			$controller = new $url[0];
			$controller->loadModel($url[0]);

			// calling methods
			if (isset($url[2])) {
				if (method_exists($controller, $url[1])) {
					$controller->{$url[1]}($url[2]);
				} else {
					$this->error();
				}
			}
			else 
			{
				if (isset($url[1])) 
				{
					if (method_exists($controller, $url[1])) 
					{
						$controller->{$url[1]}();
					}
					else 
					{
					$this->error();
					}
				}
				else 
				{
				$controller->index();
				}
			}
		}
	}

	function error()
	{
		require_once 'controllers/error.php';
		$controller = new Error();
		$controller->index();
		return false;
	}
}

?>