<?php
App::uses('AppModel', 'Model');
/**
 * Post Model
 *
 */
class Material extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'materiais';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'titulo';

    public function beforeDelete($cascade = true) {
        
        // $this->MaterialDistribuidor->deleteAll(array('Material.id' => $this->id), false);
        $this->deleteDistriuidores($this->id);
        // if ($count == 0) {
        //     return true;
        // }
        // return false;
    }

    function deleteDistriuidores($id){
        $this->MaterialDistribuidor->deleteAll(array('Material.id' => $id), false);
    }

    // public $belongsTo = array(
    //     'Especialidade' => array(
    //         'className' => 'Usuario',
    //         'foreignKey' => 'usuario_id',
    //         'conditions' => '',
    //         'fields' => '',
    //         'order' => ''
    //     )
    // );

    public $hasMany = array(
        'MaterialDistribuidor' =>
            array(
                'className' => 'MaterialDistribuidor',
                'foreignKey' => 'material_id',
                'dependent' => 'false',
                'conditions' => '',
                'fields' => '',
                'order' => '',
                'limit' => '',
                'offset' => '',
                'finderQuery' => '',
                'with' => ''
            )
    );

}
