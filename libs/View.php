<?php

class View
{
	
	function __construct()
	{
		//echo 'This is the view';
	}
	public function render($name, $noInclude = false)
	{
		if($noInclude == true)
		{
			require_once 'views/'.$name.'.php';
		}
		else
		{
			require_once 'views/header.php';
			require_once 'views/'.$name.'.php';
			require_once 'views/footer.php';
		}
	}				
}

?>