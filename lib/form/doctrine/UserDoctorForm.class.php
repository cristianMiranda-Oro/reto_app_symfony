<?php
// lib/form/doctrine/UserLoginForm.class.php
class UserDoctorForm extends BaseForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'username' => new sfWidgetFormInputText(),
      'password' => new sfWidgetFormInputPassword(),
      'name' => new sfWidgetFormInputText(),
      'lastname' => new sfWidgetFormInputText(),
      'cedula' => new sfWidgetFormInputText(),
      'tarjeta' => new sfWidgetFormInputText(),
      'especialidad' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'username' => new sfValidatorString(array('required' => true)),
      'password' => new sfValidatorString(array('required' => true)),
      'name' => new sfValidatorString(array('required' => true)),
      'lastname' => new sfValidatorString(array('required' => true)),
      'cedula' => new sfValidatorString(array('required' => true)),
      'tarjeta' => new sfValidatorString(array('required' => true)),
      'especialidad' => new sfValidatorString(array('required' => true)),
    ));

    $this->widgetSchema->setNameFormat('userdoctor[%s]');

    $this->widgetSchema->setLabels(array(
      'username' => 'Nombre de usuario',
      'password' => 'Contraseña',
      'name' => 'Nombre',
      'lastname' => 'Apellido',
      'cedula' => 'Cedula',
      'tarjeta' => 'Tarjeta',
      'especialidad' => 'Especialidad',
    ));

    $this->widgetSchema->setFormFormatterName('table');
  }
}
