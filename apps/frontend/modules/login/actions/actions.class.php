<?php
class loginActions extends sfActions{ 

    // Establece el entorno de desarrollo para el formulario

    public function executeIndex(sfWebRequest $request)
    {
        $form = new UserLoginForm();

        if ($request->isMethod('post'))
        {
            //print_r($request->getParameter('userlogin'));
            //$form->bind($request->getParameter('userlogin'));

            $form->bind($request->getParameter('userlogin'));

            //echo $request->getParameter('userlogin')['username'];
            $username = $request->getParameter('userlogin')['username'];
            $password = $request->getParameter('userlogin')['password'];
            
            if ($username != '' && $password != '')
            {

                $user = Doctrine_Core::getTable('User')->findOneByUsername($username);
                
                if ($user && password_verify($password, $user->getPassword())) // Suponiendo que hay un método checkPassword en tu modelo User
                {
                    // Autentica al usuario
                    $_SESSION['user_id'] = $user->getId();
                    $_SESSION['user_name'] = $user->getUserName();
                    $_SESSION['role'] = $user->getRole();

                    $this->getUser()->setAuthenticated(true);
                    // Redirige al usuario a una página segura después del inicio de sesión
                    //$this->redirect('@secure_route'); // Cambia '@secure_route' por la ruta que deseas
                }
                else
                {
                    $this->getUser()->setFlash('error', 'Nombre de usuario o contraseña incorrectos');
                }
            } else {
                echo "no valido";
            }
        }

        $this->form = $form;
    }

    public function executeNew(sfWebRequest $request) {
        echo 'pepe';
    }
}