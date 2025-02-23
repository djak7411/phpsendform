<?php
    namespace Controllers;
    class nf extends \Core\Controller {

        function  __construct(){
            $this->view = new \Core\View();
        }
        function action_index(): void 
        {	
		    $this->view->generate('Не найдено');
	    }

        function action_post($data): void
        {
    
        }
    }