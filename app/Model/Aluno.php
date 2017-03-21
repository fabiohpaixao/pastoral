<?php
App::uses('AppModel', 'Model');
/**
 * Area Model
 *
 * @property Titulo $Titulo
 * @property Acesso $Acesso
 */
class Aluno extends AppModel {
    
   public $displayField = 'ra';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'ra' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'aluno_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * After Save Callback
     * @param booleam $created
     * @param array $options
     * @return boolean
     */
    public function afterSave($created, $options = array()){
        if($created)
            $this->createNotas($this->data);
    }

    function createNotas($data){
        //$disciplina = $this->Disciplina->findById($data['Atividade']['disciplina_id']);
        
        App::import('model','Disciplina');
        App::import('model','Atividade');
        $model_disciplina = new Disciplina();
        $model_atividade = new Atividade();

        $disciplinas = $model_disciplina->find('all', array('conditions' => array('turma_id' =>  $data['Aluno']['turma_id'])));

        foreach ($disciplinas as $disciplina) {
           
            $atividades = $model_atividade->find('all', array('conditions' => array('disciplina_id' =>  $disciplina['Disciplina']['id'])));

            foreach ($atividades as $atividade) {
                $notas[] = array('Nota' => array('atividade_id' => $atividade['Atividade']['id'], 'aluno_id' => $data['Aluno']['id'], 'valor' => 0));
            }
        }

        $this->Nota->saveMany($notas);
    }

    /**
     * Before Delete Callback
     * @param booleam $cascade
     * @return boolean
     */
    public function beforeDelete($cascade = true) {
        
        $this->Nota->deleteAll(array("aluno_id"=>$this->id));
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
        ),
        'Turma' => array(
            'className' => 'Turma',
            'foreignKey' => 'turma_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
	);

    public $hasMany = array(
        'Nota'=>array(
           'className'=>'Nota',
           'foreignKey'=>'aluno_id',
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
        'Frequencia' => array(
            'className' => 'Frequencia',
            'foreignKey' => 'aluno_id',
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
