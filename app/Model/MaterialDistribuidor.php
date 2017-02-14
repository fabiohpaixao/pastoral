<?php
App::uses('AppModel', 'Model');
/**
 * Post Model
 *
 */
class MaterialDistribuidor extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'materiais_distribuidores';

        /**
 * Name class
 *
 * @var mixed False or class name
 */
    public $name = 'MaterialDistribuidor'; 

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
	// public $displayField = 'nome';


    public $belongsTo = array(
        'Material' => array(
            'className' => 'Material',
            'foreignKey' => 'material_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Distribuidor' => array(
            'className' => 'Distribuidor',
            'foreignKey' => 'distribuidor_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    public $hasAndBelongsToMany = array (
        'Orcamento' => array (
            'className'             => 'Orcamento',
            'joinTable'             => 'orcamentos_materiais_distribuidores',
            'foreignKey'            => 'material_distribuidor_id',
            'associationForeignKey' => 'orcamento_id',
            'unique'                => false
        )
    );

}
