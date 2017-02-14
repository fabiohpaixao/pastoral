<?php
App::uses('AppModel', 'Model');
/**
 * Post Model
 *
 */
class Especialidade extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'especialidades';

    /**
 * Name class
 *
 * @var mixed False or class name
 */
    public $name = 'Especialidade'; 


/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'titulo';


/**
 * custom fields
 *
 * @var string
 */
    // public $virtualFields = array('valores' => 'SUM(valor)');

/**
 * Validation rules
 *
 * @var array
 */
    public $validate = array(
        'titulo' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'colaborador_id' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'numeric' => array(
                'rule' => array('numeric'),
            ),
        ),
    );

    public $belongsTo = array(
        'Colaborador' => array(
            'className' => 'Colaborador',
            'foreignKey' => 'colaborador_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    //  public $hasMany = array(
    //     'Orcamento' => array(
    //         'className' => 'Orcamento',
    //         'foreignKey' => 'specialty_id',
    //         'conditions' => '',
    //         'fields' => '',
    //         'order' => ''
    //     )
    // );

    public $hasAndBelongsToMany = array (
        'Orcamento' => array (
            'className'             => 'Orcamento',
            'joinTable'             => 'orcamentos_especialidades',
            'foreignKey'            => 'especialidade_id',
            'associationForeignKey' => 'orcamento_id',
            'unique'                => false
        )
    );

}
