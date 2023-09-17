<?php
class doctorActions extends sfActions{
    
    public function executeIndex(sfWebRequest $request) {

        $form = new UserDoctorForm();

        /* $this->doctor_data = Doctrine_Core::getTable('Doctor')->findAll(); */
        $q = Doctrine_Query::create()
            ->from('Doctor d')
            ->leftJoin('d.User u'); // Realiza un LEFT JOIN entre Doctor y User
        $this->doctor_data = $q->execute();

        $this->form = $form;
    }

    public function executeDelete(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $doctor = Doctrine_Core::getTable('Doctor')->find($id);
        // Crear una respuesta JSON
        $response = $this->getResponse();
        if(!$doctor) {
            echo "No existe";
            $data = array(
                'mensaje' => 'formulario invalido',
                );
            $response->setStatusCode(404);
        } else {
            $user = Doctrine_Core::getTable('User')->find($doctor->getUser_id());
            if(!is_null($user)) {
                $user->delete();
            }
            $doctor->delete();
            $data = array(
                'mensaje' => 'Okay',
                );
            $response->setStatusCode(200);
        }
        
        $response->setHttpHeader('Content-Type', 'application/json');
        $response->setContent(json_encode($data));
    
        return sfView::NONE; // Indica a Symfony que no se debe renderizar ninguna vista

    }

    public function executeUpdate(sfWebRequest $request) {
        $form = new UserDoctorForm();
        // Crear una respuesta JSON
        $response = $this->getResponse();

        $form->bind($request->getParameter('userdoctor'));
        $id = $request->getParameter('id');
        $username = $request->getParameter('userdoctor')['username'];
        $password = $request->getParameter('userdoctor')['password'];
        $nombre = $request->getParameter('userdoctor')['name'];
        $apellido = $request->getParameter('userdoctor')['lastname'];
        $cedula = $request->getParameter('userdoctor')['cedula'];
        $tarjeta = $request->getParameter('userdoctor')['tarjeta'];
        $especialidad = $request->getParameter('userdoctor')['especialidad'];
        if(!$form->isValid() && $id && $id != "" && $username && $username != null
            && $password && $password != "" && $nombre && $nombre != ""
            && $apellido && $apellido != "" && $cedula && $cedula != ""
            && $tarjeta && $tarjeta != "" && $especialidad && $especialidad != "") {
        
            $doctor = Doctrine_Core::getTable('Doctor')->find($id);
            if(!$doctor) {
                $response->setStatusCode(400);

                $data = array(
                    'mensaje' => 'Error validacion',
                );
            } else {
                $doctor->setTarjeta($tarjeta);
                $doctor->setEspecialidad($especialidad);
                $doctor->save();
                
                $user = Doctrine_Core::getTable('User')->find($doctor->getUser_id());
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

    public function executeStore(sfWebRequest $request) {

        $form = new UserDoctorForm();
        // Crear una respuesta JSON
        $response = $this->getResponse();

        $form->bind($request->getParameter('userdoctor'));

        $username = $request->getParameter('userdoctor')['username'];
        $password = $request->getParameter('userdoctor')['password'];
        $nombre = $request->getParameter('userdoctor')['name'];
        $apellido = $request->getParameter('userdoctor')['lastname'];
        $cedula = $request->getParameter('userdoctor')['cedula'];
        $tarjeta = $request->getParameter('userdoctor')['tarjeta'];
        $especialidad = $request->getParameter('userdoctor')['especialidad'];
        
        if(!$form->isValid() && $username && $username != null
        && $password && $password != "" && $nombre && $nombre != ""
        && $apellido && $apellido != "" && $cedula && $cedula != ""
        && $tarjeta && $tarjeta != "" && $especialidad && $especialidad != "") {

            //Guardamos el usuario
            $user = new User();
            $user->setUsername($username);
            $user->setPassword(password_hash($password, PASSWORD_BCRYPT));
            $user->setNombre($nombre);
            $user->setApellido($apellido);
            $user->setCedula($cedula);
            $user->setRole("medico");

            $user->save();

            //Guardamos el medico
            $doctor = new Doctor();
            $doctor->setTarjeta($tarjeta);
            $doctor->setEspecialidad($especialidad);
            $doctor->setUser_id($user->getId());
            $doctor->save();
            $response->setStatusCode(200);
            $data = array(
                'mensaje' => 'Okay',
                );
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