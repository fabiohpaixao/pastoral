<?php
App::uses('AppModel', 'Model');
/**
 * Post Model
 *
 */
class Disciplina extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'disciplinas';

    /**
 * Name class
 *
 * @var mixed False or class name
 */
    public $name = 'Disciplina'; 

/**
 * custom fields
 *
 * @var string
 */
    // public $virtualFields = array('valores' => 'SUM(valor)');

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'nome';

    public $belongsTo = array (
        'Turma' => array (
            'className' => 'Turma',
            'foreignKey' => 'turma_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),

        'Professor' => array (
            'className' => 'Professor',
            'foreignKey' => 'professor_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    public $hasMany = array(
        'Atividade'=>array(
           'className'=>'Atividade',
           'foreignKey'=>'disciplina_id',
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
