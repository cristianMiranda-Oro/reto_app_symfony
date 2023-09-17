<?php

/**
 * CitaMedica form base class.
 *
 * @method CitaMedica getObject() Returns the current form's model object
 *
 * @package    medicalagenda
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCitaMedicaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'paciente_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Paciente'), 'add_empty' => true)),
      'doctor_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Medico'), 'add_empty' => true)),
      'fecha'       => new sfWidgetFormDate(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'paciente_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Paciente'), 'required' => false)),
      'doctor_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Medico'), 'required' => false)),
      'fecha'       => new sfValidatorDate(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cita_medica[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CitaMedica';
  }

}
