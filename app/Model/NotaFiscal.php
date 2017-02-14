<?php
App::uses('AppModel', 'Model');
/**
 * Grupo Model
 *
 * @property Permisso $Permisso
 * @property Usuario $Usuario
 */
class NotaFiscal extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'notas_fiscais';

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
		'numero' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Boleto' => array(
			'className' => 'Boleto',
			'foreignKey' => 'nota_fiscal_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	/**
	* Valiaveis
	public $transporte = array(0 => 'SIM', 1 => 'NÃO' 2 => 'V');
	public $jp_nf = array(0 => 'SIM', 1 => 'NÃO' 2 => 'V');
	public $jp_boleto = array(0 => 'SIM', 1 => 'NÃO' 2 => 'V');
	
	*/



}
