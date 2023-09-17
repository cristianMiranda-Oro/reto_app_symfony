<?php
class pacienteActions extends sfActions{

    public function executeIndex(sfWebRequest $request) {
        $form = new UserPacienteForm();
        $q = Doctrine_Query::create()
            ->from('Paciente p')
            ->leftJoin('p.User u'); // Realiza un LEFT JOIN entre Paciente y User
        $this->pacientes_data = $q->execute();
        $this->form = $form;
    }

    public function executeDelete(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $paciente = Doctrine_Core::getTable('Paciente')->find($id);

        // Crear una respuesta JSON
        $response = $this->getResponse();

        if(!$paciente) {
            echo "No existe";
            $data = array(
                'mensaje' => 'formulario invalido',
                );
            $response->setStatusCode(404);
        } else {
            $user = Doctrine_Core::getTable('User')->find($paciente->getUser_id());
            if(!is_null($user)) {
                $user->delete();
            }
            $paciente->delete();
            $data = array(
                'mensaje' => 'Okay',
                );
            $response->setStatusCode(200);
        }

        $response->setHttpHeader('Content-Type', 'application/json');
        $response->setContent(json_encode($data));
    
        return sfView::NONE; // Indica a Symfony que no se debe renderizar ninguna vista
    }

    public function executeStore(sfWebRequest $request) {
        
        // Crear una respuesta JSON
        $response = $this->getResponse();

        $form = new UserPacienteForm();

        $form->bind($request->getParameter('userpaciente'));

        $username = $request->getParameter('userpaciente')['username'];
        $password = $request->getParameter('userpaciente')['password'];
        $nombre = $request->getParameter('userpaciente')['name'];
        $apellido = $request->getParameter('userpaciente')['lastname'];
        $cedula = $request->getParameter('userpaciente')['cedula'];
        $numhistoria = $request->getParameter('userpaciente')['numhistoria'];

        if(!$form->isValid() && $username && $username != "" && $password && $password != "" && $nombre && $nombre != ""
            && $apellido && $apellido != "" && $cedula && $cedula != "" && $numhistoria && $numhistoria != "" ) {

            //Guardamos el usuario
            $user = new User();
            $user->setUsername($username);
            $user->setPassword(password_hash($password, PASSWORD_BCRYPT));
            $user->setNombre($nombre);
            $user->setApellido($apellido);
            $user->setCedula($cedula);
            $user->setRole("paciente");

            $user->save();

            //Guardamos el paciente
            $paciente = new Paciente();
            $paciente->setNumhistoria($numhistoria);
            $paciente->setUser_id($user->getId());
            $paciente->save();
            $response->setStatusCode(200);

            $data = array(
                'mensaje' => 'Okay',
            );
        } else {
            $response->setStatusCode(400);

            $data = array(
                'mensaje' => 'Datos incorrectos',
            );
        }

        
        $response->setHttpHeader('Content-Type', 'application/json');
        $response->setContent(json_encode($data));
    
        return sfView::NONE; // Indica a Symfony que no se debe renderizar ninguna vista
    }

    public function executeUpdate(sfWebRequest $request) {
        $form = new UserPacienteForm();
        // Crear una respuesta JSON
        $response = $this->getResponse();

        $form->bind($request->getParameter('userpaciente'));

        $id = $request->getParameter('id');
        $username = $request->getParameter('userpaciente')['username'];
        $password = $request->getParameter('userpaciente')['password'];
        $nombre = $request->getParameter('userpaciente')['name'];
        $apellido = $request->getParameter('userpaciente')['lastname'];
        $cedula = $request->getParameter('userpaciente')['cedula'];
        $numhistoria = $request->getParameter('userpaciente')['numhistoria'];

        if(!$form->isValid() && $username && $username != "" && $password && $password != "" && $nombre && $nombre != ""
        && $apellido && $apellido != "" && $cedula && $cedula != "" && $numhistoria && $numhistoria != "") {
            $paciente = Doctrine_Core::getTable('Paciente')->find($id);
            if(!$paciente) {
                $response->setStatusCode(400);

                $data = array(
                    'mensaje' => 'Error validacion',
                );
            } else {
                $paciente->setNumhistoria($numhistoria);
                $paciente->save();

                $user = Doctrine_Core::getTable('User')->find($paciente->getUser_id());
                if($user) {
                    $user->setNombre($nombre);
                    $user->setApellido($apellido);
                    $user->setCedula($cedula);
                    if($username != "" && $username != "****") {
                        $user->setUsername($username);
                    }

                    if($password != "" && $password != "****") {
                        $user->setPassword(password_hash($password, PASSWORD_BCRYPT));
                    }
                    $user->save();
                }
                $response->setStatusCode(200);

                $data = array(
                    'mensaje' => 'Okay',
                );
            }
        } else {
            $response->setStatusCode(400);

            $data = array(
                'mensaje' => 'Error validacion',
            );
        }

        $response->setHttpHeader('Content-Type', 'application/json');
        $response->setContent(json_encode($data));
    
        return sfView::NONE; // Indica a Symfony que no se debe renderizar ninguna vista

    }
}