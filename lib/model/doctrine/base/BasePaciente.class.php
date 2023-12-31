<?php

/**
 * BasePaciente
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $numhistoria
 * @property integer $user_id
 * @property User $User
 * @property Doctrine_Collection $CitaMedica
 * 
 * @method integer             getId()          Returns the current record's "id" value
 * @method string              getNumhistoria() Returns the current record's "numhistoria" value
 * @method integer             getUserId()      Returns the current record's "user_id" value
 * @method User                getUser()        Returns the current record's "User" value
 * @method Doctrine_Collection getCitaMedica()  Returns the current record's "CitaMedica" collection
 * @method Paciente            setId()          Sets the current record's "id" value
 * @method Paciente            setNumhistoria() Sets the current record's "numhistoria" value
 * @method Paciente            setUserId()      Sets the current record's "user_id" value
 * @method Paciente            setUser()        Sets the current record's "User" value
 * @method Paciente            setCitaMedica()  Sets the current record's "CitaMedica" collection
 * 
 * @package    medicalagenda
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePaciente extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('paciente');
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('numhistoria', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('user_id', 'integer', null, array(
             'type' => 'integer',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('User', array(
             'local' => 'user_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasMany('CitaMedica', array(
             'local' => 'id',
             'foreign' => 'paciente_id'));
    }
}