<?php
App::uses('AppModel', 'Model');
/**
 * Grupo Model
 *
 * @property Permisso $Permisso
 * @property Usuario $Usuario
 */
class Turma extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'turmas';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'nome';

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
                'foreignKey' => 'turma_id',
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
	*/
	//public $transporte = array(0 => 'SIM', 1 => 'NÃO' 2 => 'V');
	//public $jp_nf = array(0 => 'SIM', 1 => 'NÃO' 2 => 'V');
	//public $jp_boleto = array(0 => 'SIM', 1 => 'NÃO' 2 => 'V');
	

    public function beforeSave($options = array()) {
        if (!empty($this->data['Turma']['data_inicio'])) {

            $this->data['Turma']['data_inicio'] = $this->dateFormatBeforeSave(
                $this->data['Turma']['data_inicio']
            );
        }
        if (!empty($this->data['Turma']['data_fim'])) {

            $this->data['Turma']['data_fim'] = $this->dateFormatBeforeSave(
                $this->data['Turma']['data_fim']
            );
        }
        return true;
    }

    public function dateFormatBeforeSave($dateString) {
        return date('Y-m-d', strtotime($dateString));
    }

}
