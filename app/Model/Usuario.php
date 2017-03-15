<?php
App::uses('AppModel', 'Model');
/**
 * Usuario Model
 *
 * @property Grupo $Grupo
 */
class Usuario extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
    public $validate = array(
        'nome' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'email' => array(
            'email' => array(
                'rule' => array('email'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'usuario' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),

                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'senha' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'ativo' => array(
            'boolean' => array(
                'rule' => array('boolean'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'grupo_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'avatar' => array(
            // http://book.cakephp.org/2.0/en/models/data-validation.html#Validation::uploadError
            'uploadError' => array(
                'rule' => 'uploadError',
                'message' => 'Something went wrong with the file upload',
                'required' => FALSE,
                'allowEmpty' => TRUE,
            ),
            // http://book.cakephp.org/2.0/en/models/data-validation.html#Validation::mimeType
            'mimeType' => array(
                'rule' => array('mimeType', array('image/gif','image/png','image/jpg','image/jpeg')),
                'message' => 'Arquivo nválido, use somente imagens',
                'required' => FALSE,
                'allowEmpty' => TRUE,
            ),
            // custom callback to deal with the file upload
            'processUpload' => array(
                'rule' => 'processUpload',
                'message' => 'Algo deu errado ao processar seu arquivo',
                'required' => FALSE,
                'allowEmpty' => TRUE,
                'last' => TRUE,
            )
        )
    );

/**
 * Display field
 *
 * @var string
 */
    public $displayField = 'nome';
        /**
     * Before Save Callback
     * @param array $options
     * @return boolean
     */
    public function beforeSave($options = array()){
        if (!empty($this->data['Usuario']['senha'])) {
            $this->data['Usuario']['senha'] = Security::hash($this->data['Usuario']['senha'], 'sha1', false);
        }

        // a file has been uploaded so grab the filepath
        if (!empty($this->data[$this->alias]['filepath'])) {
            $this->data[$this->alias]['avatar'] = $this->data[$this->alias]['filepath'];
        }
        
        return parent::beforeSave($options);
    }

    /**
     * Before Validation
     * @param array $options
     * @return boolean
     */
    public function beforeValidate($options = array()) {
        // ignore empty file - causes issues with form validation when file is empty and optional
        if (!empty($this->data[$this->alias]['avatar']['error']) && $this->data[$this->alias]['avatar']['error']==4 && $this->data[$this->alias]['avatar']['size']==0) {
            unset($this->data[$this->alias]['avatar']);
        }

        parent::beforeValidate($options);
    }

//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
    public $belongsTo = array(
        'Grupo' => array(
            'className' => 'Grupo',
            'foreignKey' => 'grupo_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );


/**
 * hasMany associations
 *
 * @var array
 */
    public $hasMany = array(
        'Professor' =>
            array(
                'className' => 'Professor',
                'foreignKey' => 'usuario_id',
                'dependent' => 'false',
                'conditions' => '',
                'fields' => '',
                'order' => '',
                'limit' => '',
                'offset' => '',
                'finderQuery' => '',
                'with' => ''
            ),
        'Aluno' =>
            array(
                'className' => 'Aluno',
                'foreignKey' => 'usuario_id',
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

    /**
     * Upload Directory relative to WWW_ROOT
     * @param string
     */
    public $uploadDir = 'uploads';

    /**
     * Process the Upload
     * @param array $check
     * @return boolean
     */
    public function processUpload($check=array()) {
        // deal with uploaded file
        if (!empty($check['avatar']['tmp_name'])) {

            // check file is uploaded
            if (!is_uploaded_file($check['avatar']['tmp_name'])) {
                return FALSE;
            }

            // build full avatar
             // echo $this->data['Usuario']['id'];
             // die();
            $imageDir =  WWW_ROOT . 'img' . DS .  $this->uploadDir . DS .  $this->data['Usuario']['id'];
            
            if(!is_dir( $imageDir))
                mkdir( $imageDir, 0777, true);

            $avatar =  $imageDir . DS . Inflector::slug(pathinfo($check['avatar']['name'], PATHINFO_FILENAME)).'.'.pathinfo($check['avatar']['name'], PATHINFO_EXTENSION);

            // @todo check for duplicate avatar

            // try moving file
            if (!move_uploaded_file($check['avatar']['tmp_name'], $avatar)) {
                return FALSE;

            // file successfully uploaded
            } else {
                // save the file path relative from WWW_ROOT e.g. uploads/example_avatar.jpg
                $this->data[$this->alias]['filepath'] = str_replace(DS, "/", str_replace(WWW_ROOT, "", $avatar) );
            }
        }

        return TRUE;
    }


}
