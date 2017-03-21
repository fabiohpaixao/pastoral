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
        'disciplina_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'arquivo' => array(
            // http://book.cakephp.org/2.0/en/models/data-validation.html#Validation::uploadError
            'uploadError' => array(
                'rule' => 'uploadError',
                'message' => 'Something went wrong with the file upload',
                'required' => FALSE,
                'allowEmpty' => TRUE,
            ),
            // http://book.cakephp.org/2.0/en/models/data-validation.html#Validation::mimeType
            'mimeType' => array(
                'rule' => array('mimeType', array('image/gif','image/png','image/jpg','image/jpeg', 'application/msword', 'application/pdf', 'application/vnd.ms-excel', 'application/zip')),
                'message' => 'Arquivo inválido',
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

/*    public function beforeDelete($cascade = true) {
        
        $this->deleteDistriuidores($this->id);
    }

    function deleteDistriuidores($id){
        $this->MaterialDistribuidor->deleteAll(array('Material.id' => $id), false);
    }*/
    
    /**
     * Before Save Callback
     * @param array $options
     * @return boolean
     */
    public function beforeSave($options = array()){

        // a file has been uploaded so grab the filepath
        if (!empty($this->data[$this->alias]['filepath']))
            $this->data[$this->alias]['arquivo'] = $this->data[$this->alias]['filepath'];
              
        return parent::beforeSave($options);
    }


    /**
     * Before Validation
     * @param array $options
     * @return boolean
     */
    public function beforeValidate($options = array()) {
        // ignore empty file - causes issues with form validation when file is empty and optional
        if (!empty($this->data[$this->alias]['arquivo']['error']) && $this->data[$this->alias]['arquivo']['error']==4 && $this->data[$this->alias]['arquivo']['size']==0) {
            unset($this->data[$this->alias]['arquivo']);
        }

        parent::beforeValidate($options);
    }

    public $belongsTo = array(
        'Disciplina' => array(
        'className' => 'Disciplina',
        'foreignKey' => 'disciplina_id',
        'conditions' => '',
        'fields' => '',
        'order' => ''
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
        if (!empty($check['arquivo']['tmp_name'])) {

            // check file is uploaded
            if (!is_uploaded_file($check['arquivo']['tmp_name'])) {
                return FALSE;
            }

            // build full arquivo
            //debug($this->data['Material']);
            //die();
            $imageDir =  WWW_ROOT . 'arquivos' . DS .  $this->uploadDir . DS .  'materiais';
            
            if(!is_dir( $imageDir))
                mkdir( $imageDir, 0777, true);

            $arquivo =  $imageDir . DS . Inflector::slug(pathinfo($check['arquivo']['name'], PATHINFO_FILENAME)).'.'.pathinfo($check['arquivo']['name'], PATHINFO_EXTENSION);

            // @todo check for duplicate arquivo

            // try moving file
            if (!move_uploaded_file($check['arquivo']['tmp_name'], $arquivo)) {
                return FALSE;

            // file successfully uploaded
            } else {
                // save the file path relative from WWW_ROOT e.g. uploads/example_arquivo.jpg
                $this->data[$this->alias]['filepath'] = str_replace(DS, "/", str_replace(WWW_ROOT, "", $arquivo) );
            }
        }

        return TRUE;
    }
}
