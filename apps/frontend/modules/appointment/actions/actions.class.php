<?php
class appointmentActions extends sfActions{
    public function  executeDelete(sfWebRequest $request) {
        $id = $request->getParameter('id');

        $appointment = Doctrine_Core::getTable('CitaMedica')->find($id);
        // Crear una respuesta JSON
        $response = $this->getResponse();

        if(!$appointment) {
            echo "No existe";
            $data = array(
                'mensaje' => 'formulario invalido',
                );
            $response->setStatusCode(404);
        } else {
            $appointment->delete();
            $data = array(
                'mensaje' => 'Okay',
                );
            $response->setStatusCode(200);
        }
        
        $response->setHttpHeader('Content-Type', 'application/json');
        $response->setContent(json_encode($data));
    
        return sfView::NONE;
    }

    public function executeIndex(sfWebRequest $request) {
        $form = new AppointmentForm();

        $this->pacientes = Doctrine_Core::getTable('Paciente')
            ->findAll();

        $this->doctors = Doctrine_Core::getTable('Doctor')
            ->findAll();

        $this->appointments = Doctrine_Query::create()
            ->from('CitaMedica a')
            ->leftJoin('a.Paciente p')
            ->leftJoin('p.User pu')
            ->leftJoin('a.Medico d')
            ->leftJoin('d.User du')
            ->execute();

        
        $this->form = $form;
    }

    public function executeStore(sfWebRequest $request) {
        $form = new AppointmentForm();
        // Crear una respuesta JSON
        $response = $this->getResponse();

        $form->bind($request->getParameter('appointment'));

        $paciente_id = $request->getParameter('appointment')['paciente_id'];
        $doctor_id = $request->getParameter('appointment')['doctor_id'];
        $fecha = $request->getParameter('appointment')['fecha'];

        print_r($request->getParameter('appointment'));

        if(!$form->isValid() && $paciente_id && $paciente_id != ""
            && $doctor_id && $doctor_id != "" && $fecha && $fecha != "") {

                //Guardamos appointment
                $paciente_user = Doctrine_Query::create()
                                    ->from('Paciente p')
                                    ->leftJoin('p.User u')
                                    ->where('p.user_id = ?', $paciente_id)->fetchOne();
                $doctor_user = Doctrine_Query::create()
                                    ->select('d.id')
                                    ->from('Doctor d')
                                    ->leftJoin('d.User u')
                                    ->where('d.user_id = ?', $doctor_id)->fetchOne();

                /* echo $paciente_id;

                print_r($paciente_user->getId());
 */
                $appointment = new CitaMedica();
                $appointment->setPacienteId($paciente_user->getId());
                $appointment->setDoctorId($doctor_user->getId());
                $appointment->setFecha($fecha['year'].'-'.($fecha['month'] < 10 ? '0'.$fecha['month'] : $fecha['month']).'-'.($fecha['day'] < 10 ? '0'.$fecha['day'] : $fecha['day']));

                $appointment->save();
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