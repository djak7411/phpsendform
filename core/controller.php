<?php
namespace Core;
class Controller {
	
	public $model;
	public $view;
	
	function __construct()
	{
		$this->view = new View();
	}
	
	function action_index()
	{
	}

	function action_post($data)
	{
	}
}