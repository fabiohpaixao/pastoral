<?php
App::uses('AppModel', 'Model');
/**
 * Post Model
 *
 */
class Feriado extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'feriados';

/**
 * Validation rules
 *
 * @var array
 */
    public $validate = array(
        'titulo' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'data' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
    );


/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'titulo';


    // public $belongsTo = array(
    //     'Especialidade' => array(
    //         'className' => 'Usuario',
    //         'foreignKey' => 'usuario_id',
    //         'conditions' => '',
    //         'fields' => '',
    //         'order' => ''
    //     )
    // );

    public function beforeSave($options = array()) {
        if (!empty($this->data['Feriado']['data'])) {

            $this->data['Feriado']['data'] = $this->dateFormatBeforeSave(
                $this->data['Feriado']['data']
            );
        }
        return true;
    }

    public function dateFormatBeforeSave($dateString) {
        return date('Y-m-d', strtotime($dateString));
    }

}
