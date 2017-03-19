<?php
App::uses('AppModel', 'Model');
/**
 * Post Model
 *
 */
class Nota extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'notas';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'valor';

    public $belongsTo = array(
        'Atividade' => array(
            'className' => 'Atividade',
            'foreignKey' => 'atividade_id',
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
