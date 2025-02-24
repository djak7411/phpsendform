<?php
    namespace Controllers;
    use \Models\User as User;
    class Registration extends \Core\Controller {

        function  __construct(){
            $this->view = new \Core\View();
        }
        function action_index(): void 
        {	
		    $this->view->generate('layout.php');
	    }

        function action_post($data):void
        {
            if($data['email'] && $data['pass'] && $data['confirm']){
                $email = $data['email'];
                $password = $data['pass'];
                $confirm = $data['confirm'];
                $existUsers = [];
                if($password === $confirm){
                    $existUsers = User::get_all();
                    foreach($existUsers as $user){
                        if($email === $user['email']){
                            header("HTTP/1.1 409");
                            break;
                        }
                    }
                    $new_user = new User($email, $password, $confirm);
                    if($new_user->validate()){
                        $new_user->save();
                    }else{
                        header("HTTP/1.1 502");
                    }
                }
            }
        }
    }