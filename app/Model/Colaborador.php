<?php
App::uses('AppModel', 'Model');
/**
 * Post Model
 *
 */
class Colaborador extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'colaboradores';

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
        'valor_hora' => array(
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

     public $hasMany = array(
        'Especialidade' => array(
            'className' => 'Especialidade',
            'foreignKey' => 'colaborador_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

}
