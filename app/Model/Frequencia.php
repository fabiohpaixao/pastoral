<?php
App::uses('AppModel', 'Model');
/**
 * Area Model
 *
 * @property Titulo $Titulo
 * @property Acesso $Acesso
 */
class Frequencia extends AppModel {
    
    /**
     * Use table
     *
     * @var mixed False or table name
     */
        public $useTable = 'frequencias';

    /**
     * Name class
     *
     * @var mixed False or class name
     */
        public $name = 'Frequencia'; 

    /**
     * Display field
     *
     * @var string
     */
        public $displayField = 'presenca';
    
    /**
     * custom fields
     *
     * @var string
     */
        //public $virtualFields = array('nome' => 'usuarios.nome');


    /**
 * Validation rules
 *
 * @var array
 */
    public $validate = array(
        'ativo' => array(
            'boolean' => array(
                'rule' => array('boolean'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'aula_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'disciplina_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'aluno_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        )
    );

    public function beforeSave($options = array()) {
        if (!empty($this->data['Frequencia']['data'])) {

            $this->data['Frequencia']['data'] = $this->dateFormatBeforeSave(
                $this->data['Frequencia']['data']
            );
        }
        return true;
    }

    public function dateFormatBeforeSave($dateString) {
        return date('Y-m-d', strtotime($dateString));
    }


/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Disciplina' => array(
            'className' => 'Disciplina',
            'foreignKey' => 'disciplina_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
		'Aluno' => array(
            'className' => 'Aluno',
            'foreignKey' => 'aluno_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
	);
}
