<?php
App::uses('AppModel', 'Model');
/**
 * Area Model
 *
 * @property Titulo $Titulo
 * @property Acesso $Acesso
 */
class Atividade extends AppModel {
    
    /**
     * Use table
     *
     * @var mixed False or table name
     */
        public $useTable = 'atividades';

    /**
     * Name class
     *
     * @var mixed False or class name
     */
        public $name = 'Atividade'; 

    /**
     * Display field
     *
     * @var string
     */
        public $displayField = 'desricao';


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
        $disciplina = $this->Disciplina->findById($data['Atividade']['disciplina_id']);
        
        App::import('model','Aluno');
        $model_aluno = new Aluno();
        $alunos = $model_aluno->find('all', array('conditions' => array('turma_id' =>  $disciplina['Disciplina']['turma_id'])));

        foreach ($alunos as $aluno) {
            $notas[] = array('Nota' => array('atividade_id' => $data['Atividade']['id'], 'aluno_id' => $aluno['Aluno']['id'], 'valor' => 0));
        }

        $this->Nota->saveMany($notas);
    }

    /**
     * Before Delete Callback
     * @param booleam $cascade
     * @return boolean
     */
    public function beforeDelete($cascade = true) {
        
        $this->Nota->deleteAll(array("atividade_id"=>$this->id));
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
        )
	);

    public $hasMany = array(
        'Nota'=>array(
           'className'=>'Nota',
           'foreignKey'=>'atividade_id',
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
