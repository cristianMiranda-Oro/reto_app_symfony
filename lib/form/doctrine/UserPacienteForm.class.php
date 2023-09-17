<?php
class UserPacienteForm extends BaseForm {
    public function configure()
    {
        $this->setWidgets(array(
        'username' => new sfWidgetFormInputText(),
        'password' => new sfWidgetFormInputText(),
        'name' => new sfWidgetFormInputText(),
        'lastname' => new sfWidgetFormInputText(),
        'cedula' => new sfWidgetFormInputText(),
        'numhistoria' => new sfWidgetFormInputText(),
        ));

        $this->setValidators(array(
        'username' => new sfValidatorString(array('required' => true)),
        'password' => new sfValidatorString(array('required' => true)),
        'name' => new sfValidatorString(array('required' => true)),
        'lastname' => new sfValidatorString(array('required' => true)),
        'cedula' => new sfValidatorString(array('required' => true)),
        'numhistoria' => new sfValidatorString(array('required' => true))
        ));

        $this->widgetSchema->setNameFormat('userpaciente[%s]');

        $this->widgetSchema->setLabels(array(
        'username' => 'Nombre de usuario',
        'password' => 'Contraseña',
        'name' => 'Nombre',
        'lastname' => 'Apellido',
        'cedula' => 'Cedula',
        'tarjeta' => 'Tarjeta',
        'especialidad' => 'Especialidad',
        'numhistoria' => 'Numero Historia Clinica'
        ));

        $this->widgetSchema->setFormFormatterName('table');
    }
}