<?php
App::uses('AppModel', 'Model');
/**
 * Area Model
 *
 * @property Titulo $Titulo
 * @property Acesso $Acesso
 */
class Atividade extends AppModel {
    
   public $displayField = 'nome';


	//The Associations below have been created with all possible keys, those that are not needed can be removed


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
