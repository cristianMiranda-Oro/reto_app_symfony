<?php

class AppointmentForm extends BaseForm {

    public function configure()
    {
        $this->setWidgets(array(
            'paciente_id' => new sfWidgetFormDoctrineChoice(array(
                'model' => 'User', // Modelo al que se hace referencia
                'method' => 'getNombre',
                'add_empty' => 'Selecciona un paciente', // Opcional, mensaje de opción vacía
                'query' => Doctrine_Query::create()
                    ->from('User u')
                    ->where('u.role = ?', 'paciente') // Desde la tabla User
            )),
            'doctor_id' => new sfWidgetFormDoctrineChoice(array(
                'model' => 'User', // Modelo al que se hace referencia
                'method' => 'getNombre',
                'add_empty' => 'Selecciona un medico', // Opcional, mensaje de opción vacía
                'query' => Doctrine_Query::create()
                    ->from('User u')
                    ->where('u.role = ?', 'medico') // Desde la tabla User
            )),
            'fecha' => new sfWidgetFormDate(),
        ));

        $this->setValidators(array(
            'paciente_id' => new sfValidatorDoctrineChoice(array(
                'model' => 'User', // Modelo al que se hace referencia
                'required' => true, // Opcional, indica si el campo es obligatorio
              )),
            'doctor_id' => new sfValidatorDoctrineChoice(array(
                'model' => 'User', // Modelo al que se hace referencia
                'required' => true, // Opcional, indica si el campo es obligatorio
            )),
            'fecha' => new sfValidatorDate(array('required' => true)),
        ));

        $this->widgetSchema->setNameFormat('appointment[%s]');

        $this->widgetSchema->setLabels(array(
            'paciente_id' => 'Elegir Paciente',
            'doctor_id' => 'Eligir Doctor',
            'fecha' => 'Fecha Cita',
        ));

        $this->widgetSchema->setFormFormatterName('table');
    }
}