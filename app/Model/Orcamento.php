<?php
App::uses('AppModel', 'Model');
/**
 * Post Model
 *
 */
class Orcamento extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'orcamentos';

 /**
 * Name class
 *
 * @var mixed False or class name
 */
    public $name = 'Orcamento'; 


/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'codigo';


    public function beforeSave($options = array()) {
        
        // if (!empty($this->data['Orcamento']['fator_retrabalho']))
        //     $this->data['Orcamento']['fator_retrabalho'] = $this->decimalFormatBeforeSave(
        //         $this->data['Orcamento']['fator_retrabalho']
        //     );

        // if (!empty($this->data['Orcamento']['imposto']))
        //     $this->data['Orcamento']['imposto'] = $this->decimalFormatBeforeSave(
        //         $this->data['Orcamento']['imposto']
        //     );

            

        return true;
    }
    
    //Converter formatação de numeros
    public function decimalFormatBeforeSave($num) {
        return  str_replace(',', '.', str_replace('.', '', $num));
    }


    // public $belongsTo = array(
    //     'Especialidade' => array(
    //         'className' => 'Especialidade',
    //         'foreignKey' => 'especialidade_id',
    //         'conditions' => '',
    //         'fields' => '',
    //         'order' => ''
    //     ),
    //     'Cliente' => array(
    //         'className' => 'Cliente',
    //         'foreignKey' => 'cliente_id',
    //         'conditions' => '',
    //         'fields' => '',
    //         'order' => ''
    //     ),
    //     'Despesa' => array(
    //         'className' => 'Despesa',
    //         'foreignKey' => 'despesa_id',
    //         'conditions' => '',
    //         'fields' => '',
    //         'order' => ''
    //     ),
    //     'MaterialDistribuidor' => array(
    //         'className' => 'MaterialDistribuidor',
    //         'foreignKey' => 'material_distribuidor_id',
    //         'conditions' => '',
    //         'fields' => '',
    //         'order' => ''
    //     )
    // );

    public $hasAndBelongsToMany = array (
        'Especialidade' => array (
            'className'             => 'Especialidade',
            'joinTable'             => 'orcamentos_especialidades',
            'foreignKey'            => 'orcamento_id',
            'associationForeignKey' => 'especialidade_id',
            'unique'                => false
        ),
        'Despesa' => array (
            'className'             => 'Despesa',
            'joinTable'             => 'orcamentos_despesas',
            'foreignKey'            => 'orcamento_id',
            'associationForeignKey' => 'despesa_id',
            'unique'                => false
        ),
        'MaterialDistribuidor' => array (
            'className'             => 'MaterialDistribuidor',
            'joinTable'             => 'orcamentos_materiais_distribuidores',
            'foreignKey'            => 'orcamento_id',
            'associationForeignKey' => 'material_distribuidor_id',
            'unique'                => false
        ),
        'Cliente' => array (
            'className'             => 'Cliente',
            'joinTable'             => 'orcamentos_clientes',
            'foreignKey'            => 'orcamento_id',
            'associationForeignKey' => 'cliente_id',
            'unique'                => false
        )
    );



    //  public $hasMany = array(
    //     'Orca' => array(
    //         'className' => 'Categoria',
    //         'foreignKey' => 'categoria_id',
    //         'conditions' => '',
    //         'fields' => '',
    //         'order' => ''
    //     )
    // );

}
