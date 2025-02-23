<?php 
namespace Core;
class View
{
	
	function generate($content, $data = null)
	{
		include 'views/layout.php';
	}
}