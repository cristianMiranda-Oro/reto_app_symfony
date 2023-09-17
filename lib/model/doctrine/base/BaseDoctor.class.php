<?php

/**
 * BaseDoctor
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $tarjeta
 * @property string $especialidad
 * @property integer $user_id
 * @property User $User
 * @property Doctrine_Collection $CitaMedica
 * 
 * @method integer             getId()           Returns the current record's "id" value
 * @method string              getTarjeta()      Returns the current record's "tarjeta" value
 * @method string              getEspecialidad() Returns the current record's "especialidad" value
 * @method integer             getUserId()       Returns the current record's "user_id" value
 * @method User                getUser()         Returns the current record's "User" value
 * @method Doctrine_Collection getCitaMedica()   Returns the current record's "CitaMedica" collection
 * @method Doctor              setId()           Sets the current record's "id" value
 * @method Doctor              setTarjeta()      Sets the current record's "tarjeta" value
 * @method Doctor              setEspecialidad() Sets the current record's "especialidad" value
 * @method Doctor              setUserId()       Sets the current record's "user_id" value
 * @method Doctor              setUser()         Sets the current record's "User" value
 * @method Doctor              setCitaMedica()   Sets the current record's "CitaMedica" collection
 * 
 * @package    medicalagenda
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseDoctor extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('doctor');
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('tarjeta', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('especialidad', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('user_id', 'integer', null, array(
             'type' => 'integer',
             ));


        $this->index('unique_name', array(
             'fields' => 
             array(
              0 => 'tarjeta',
             ),
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
             'foreign' => 'doctor_id'));
    }
}