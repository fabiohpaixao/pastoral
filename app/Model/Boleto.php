<?php
App::uses('AppModel', 'Model');
/**
 * Post Model
 *
 */
class Boleto extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'boletos';

/**
 * Name class
 *
 * @var mixed False or class name
 */
    public $name = 'Boleto'; 

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'numero';

/**
 * Validation rules
 *
 * @var array
 */
    public $validate = array(
        'data_pgto' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            )
        ),
    );


/**
 * belongsTo associations
 *
 * @var array
 */
    public $belongsTo = array(
        'NotaFiscal' => array(
            'className' => 'NotaFiscal',
            'foreignKey' => 'nota_fiscal_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

}
