<?php
    class Registration extends Controller {
        function action_index(): void 
        {	
		    $this->view->generate('auth_view.php');
	    }

        function action_post($request): void
        {
            echo var_dump($request);
        }
    }