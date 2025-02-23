<?php
    class Registration extends Controller {
        function action_index() : void {	
		    $this->view->generate('auth_view.php');
	    }
    }