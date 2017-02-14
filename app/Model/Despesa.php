<?php
App::uses('AppModel', 'Model');
/**
 * Post Model
 *
 */
class Despesa extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'despesas';

    /**
 * Name class
 *
 * @var mixed False or class name
 */
    public $name = 'Despesa'; 

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
	public $displayField = 'titulo';


    public $hasAndBelongsToMany = array (
        'Orcamento' => array (
            'className'             => 'Orcamento',
            'joinTable'             => 'orcamentos_despesas',
            'foreignKey'            => 'despesa_id',
            'associationForeignKey' => 'orcamento_id',
            'unique'                => false
        )
    );

}
