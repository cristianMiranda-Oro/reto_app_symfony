<?php
// lib/form/doctrine/UserLoginForm.class.php
class UserLoginForm extends BaseForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'username' => new sfWidgetFormInputText(),
      'password' => new sfWidgetFormInputPassword(),
    ));

    $this->setValidators(array(
      'username' => new sfValidatorString(array('required' => true)),
      'password' => new sfValidatorString(array('required' => true)),
    ));

    $this->widgetSchema->setNameFormat('userlogin[%s]');

    $this->widgetSchema->setLabels(array(
      'username' => 'Nombre de usuario',
      'password' => 'Contraseña',
    ));

    $this->widgetSchema->setFormFormatterName('table');
  }
}
