<?php
App::uses('AppModel', 'Model');
/**
 * Post Model
 *
 */
class Distribuidor extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'distribuidores';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'nome';


    // public $belongsTo = array(
    //     'Especialidade' => array(
    //         'className' => 'Usuario',
    //         'foreignKey' => 'usuario_id',
    //         'conditions' => '',
    //         'fields' => '',
    //         'order' => ''
    //     )
    // );

    public $hasMany = array(
        'MaterialDistribuidor' =>
            array(
                'className' => 'MaterialDistribuidor',
                'foreignKey' => 'distribuidor_id',
                'dependent' => 'false',
                'conditions' => '',
                'fields' => '',
                'order' => '',
                'limit' => '',
                'offset' => '',
                'finderQuery' => '',
                'with' => ''
            )
    );

}
