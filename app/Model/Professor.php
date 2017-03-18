<?php
App::uses('AppModel', 'Model');
/**
 * Professor Model
 *
 * @property Professor $Professor
 */
class Professor extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'professores';

/**
 * Name class
 *
 * @var mixed False or class name
 */
    public $name = 'Professor';

    public function beforeDelete($cascade = true) {
        
        $this->clearDisciplina($this->id);
    }

    function clearDisciplina($id){
        $this->Disciplina->updateAll(array("professor_id"=>NULL),array("professor_id"=>$id));
    }

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Usuario' => array(
			'className' => 'Usuario',
			'foreignKey' => 'usuario_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public $hasMany = array(
        'Disciplina'=>array(
           'className'=>'Disciplina',
           'foreignKey'=>'professor_id',
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

}
