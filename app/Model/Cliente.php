<?php
App::uses('AppModel', 'Model');
/**
 * Post Model
 *
 */
class Cliente extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'clientes';

/**
 * Name class
 *
 * @var mixed False or class name
 */
    public $name = 'Cliente'; 

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'nome';

/**
 * Validation rules
 *
 * @var array
 */
    public $validate = array(
        'nome' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'fator' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            ),
        ),
    );

    // public $belongsTo = array(
    //     'Especialidade' => array(
    //         'className' => 'Usuario',
    //         'foreignKey' => 'usuario_id',
    //         'conditions' => '',
    //         'fields' => '',
    //         'order' => ''
    //     )
    // );

    //  public $hasMany = array(
    //     'Orcamento' => array(
    //         'className' => 'Orcamento',
    //         'foreignKey' => 'especialidade_id',
    //         'conditions' => '',
    //         'fields' => '',
    //         'order' => ''
    //     )
    // );
    public $hasAndBelongsToMany = array (
        'Orcamento' => array (
            'className'             => 'Orcamento',
            'joinTable'             => 'orcamentos_clientes',
            'foreignKey'            => 'cliente_id',
            'associationForeignKey' => 'orcamento_id',
            'unique'                => false
        )
    );

}
