<?php

App::uses('AppHelper', 'View/Helper');
class CustomInputsHelper extends AppHelper {

    public $inputs_default = array(
        'monetary' => array(
            'type' => 'text',
            'onKeyPress' => "return(MascaraMoeda(this,'','.',event))",
            'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
            'div' => 'form-group',
            'label' => array('class' => 'col-sm-3 control-label'),
            'between' => '<div class="col-sm-9"><div class="input-group m-bot15"><span class="input-group-addon">R$</span>',
            'after' => '</div></div>',
            'class' => 'form-control',
            'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline'))
        ),
        'decimal' => array(
            'type' => 'text',
            'onKeyPress' => "return(MascaraMoeda(this,'','.',event))",
            'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
            'div' => 'form-group',
            'label' => array('class' => 'col-sm-3 control-label'),
            'between' => '<div class="col-sm-9"><div class="input-group m-bot15">',
            'after' => '<span class="input-group-addon">%</span></div></div>',
            'class' => 'form-control',
            'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline'))
        ),
        'date' => array(
            'type' => 'text',
            'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
            'div' => 'form-group',
            'label' => array('class' => 'col-sm-3 control-label'),
            'between' => '<div class="col-md-3 col-xs-11"><div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date=""  class="input-append date dpYears">',
            'after' => ' <span class="input-group-btn add-on"><button class="btn btn-danger" type="button"><i class="icon-calendar"></i></button></span></div></div>',
            'class' => 'form-control',
            'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline'))
        ),
        'checkbox' => array(
            'checked' => 'checked',
            'between' => '<div class="col-sm-9"><div class="switch switch-square">', 
            'after' => '</div></div>'
        ),
        'multiple' => array(
            'type' => 'select',
            'multiple' => true,
            'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
            'div' => 'form-group last',
            'label' => "",
            'between' => '<div class="col-md-12">',
            'after' => '</div>',
            'class' => 'form-control multi-select',
            'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline'))
        )
        //  <div class="form-group last">
        //     <label class="control-label col-md-3">Searchable</label>
        //     <div class="col-md-9">
        //         <select name="country" class="multi-select" multiple="" id="my_multi_select3" >
        //           <option value="AF">Afghanistan</option>
        //         </select>
        //     </div>
        // </div>

    );

    /**
     * getInput
     *
     * @param $type string
     * @return array
     */
    public function getInput($type, $options=null){
        if(array_key_exists($type,$this->inputs_default)){
            if(is_array($options) && !is_null($options))
                return $options+$this->inputs_default[$type];
            else
                return $this->inputs_default[$type];
        }
        else
            return (is_null($options))?array():$options;
    }

}