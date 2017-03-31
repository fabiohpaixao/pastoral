<?php
App::uses('AppModel', 'Model');
/**
 * Grupo Model
 *
 * @property Permisso $Permisso
 * @property Usuario $Usuario
 */
class Periodo extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'periodos';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'titulo';
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
        'ativo' => array(
            'boolean' => array(
                'rule' => array('boolean'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        )
    );
	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
    public $hasMany = array(
        'Disciplina' =>
            array(
                'className' => 'Disciplina',
                'foreignKey' => 'periodo_id',
                'dependent' => false,
       			'conditions' => '',
				'fields' => '',
				'order' => '',
				'limit' => '',
				'offset' => '',
				'exclusive' => '',
				'finderQuery' => '',
				'counterQuery' => ''
			),
		'Turma' =>
            array(
                'className' => 'Turma',
                'foreignKey' => 'periodo_id',
                'dependent' => false,
       			'conditions' => '',
				'fields' => '',
				'order' => '',
				'limit' => '',
				'offset' => '',
				'exclusive' => '',
				'finderQuery' => '',
				'counterQuery' => ''
			),
    );

	/**
	* Valiaveis
	*/
	//public $transporte = array(0 => 'SIM', 1 => 'NÃO' 2 => 'V');
	//public $jp_nf = array(0 => 'SIM', 1 => 'NÃO' 2 => 'V');
	//public $jp_boleto = array(0 => 'SIM', 1 => 'NÃO' 2 => 'V');
	

    public function beforeSave($options = array()) {
        if (!empty($this->data['Periodo']['data_inicio'])) {

            $this->data['Periodo']['data_inicio'] = $this->dateFormatBeforeSave(
                $this->data['Periodo']['data_inicio']
            );
        }
        if (!empty($this->data['Periodo']['data_fim'])) {

            $this->data['Periodo']['data_fim'] = $this->dateFormatBeforeSave(
                $this->data['Periodo']['data_fim']
            );
        }
        return true;
    }

    public function dateFormatBeforeSave($dateString) {
        return date('Y-m-d', strtotime($dateString));
    }

}
