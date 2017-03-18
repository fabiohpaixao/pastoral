<?php

    $this->Html->addCrumb('Materiais', '/materiais');
    $this->Html->addCrumb('Adicionar');

?>
<div class="row">
    <?php echo $this->Form->create('Material', array('type' => 'file')); ?>
    <div class="col-lg-9">
        <section class="panel">
            <header class="panel-heading clearfix">
              <span class="pull-left"><i class="icon-plus"></i> <?php echo __('Adicionar Material'); ?></span>

              <?php echo $this->Html->link(__('<i class="icon-chevron-left"></i> Voltar'), array('action' => 'index'), array('class' => 'btn btn-default btn-shadow pull-right', 'escape' => false)); ?>

            </header>
              <div class="panel-body">
                <?php
                    
                    echo $this->Form->input('titulo');
                    echo $this->Form->input('fabricante');
                    echo $this->Form->input('descricao', array('type' => 'textarea'));
                    // echo $this->Form->input('imposto', array('type' => 'text', 'onKeyPress' => "return(MascaraMoeda(this,'.',',',event))"));
                    echo $this->Form->input('imposto',$this->CustomInputs->getInput('decimal'));

                ?>    
              </div>
        </section>

        <div class="row">
            <div class="col-lg-6">
                <section class="panel distribuidores">
                    <header class="panel-heading clearfix">
                      <span class="pull-left"><i class="icon-user-plus"></i> Distribuidores</span>
                    </header>
                    <div class="panel-body">
                    <?php 
                        echo $this->Form->input('distribuidores', array('multiple' => false)); 
                        // echo $this->Form->input('valor', array(
                        //   'type' => 'text',
                        //   'onKeyPress' => "return(MascaraMoeda(this,'.',',',event))",
                        //   'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
                        //   'div' => 'form-group',
                        //   'label' => array('class' => 'col-sm-3 control-label'),
                        //   'between' => '<div class="col-sm-9"><div class="input-group m-bot15"><span class="input-group-addon">R$</span>',
                        //   'after' => '</div></div>',
                        //   'class' => 'form-control',
                        //   'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline'))
                        //   )
                        // );
                        echo $this->Form->input('valor', $this->CustomInputs->getInput('monetary'));
                        echo $this->Form->button('<i class="icon-plus"></i> Adicionar Distribuidor', array('type' => 'button', 'class' => 'btn btn-success btn-shadow', 'id' => 'add-dist', 'escape' => false));
                    ?>
                    </div>
                </section>
            </div>
            <div class="col-lg-6">
                <section class="panel">
                    <header class="panel-heading">Distribuidores Adicionados
                      </header>
                      <table class="table table-striped table-hover table-ditribuidores">
                          <thead>
                          <tr>
                              <th>#</th>
                              <th>Nome</th>
                              <th>Valor</th>
                              <th>Ações</th>
                          </tr>
                          </thead>
                          <tbody>
                         <!--  <tr>
                              <td>1</td>
                              <td>Nome<input name="data[Distribuidor][nome]" class="form-control " type="hidden" id="DistribuidorNome" ></td>
                              <td>Valor<input name="data[Distribuidor][valor]" class="form-control" type="hidden" id="DistribuidorValor"></td>
                          </tr>
                          <tr>
                              <td>2</td>
                               <td>Nome<input name="data[Distribuidor][nome]" class="form-control " type="hidden" id="DistribuidorNome" ></td>
                              <td>Valor<input name="data[Distribuidor][valor]" class="form-control" type="hidden" id="DistribuidorValor"></td>
                          </tr>
                          <tr>
                              <td>3</td>
                               <td>Nome<input name="data[Distribuidor][nome]" class="form-control " type="hidden" id="DistribuidorNome" ></td>
                              <td>Valor<input name="data[Distribuidor][valor]" class="form-control" type="hidden" id="DistribuidorValor"></td>
                          </tr> -->
                          </tbody>
                      </table>
                  </section>
              </div>
        </div>

    </div>
    <div class="col-lg-3">
        <section class="panel">
            <header class="panel-heading clearfix">
              <span class="pull-left"><i class="icon-cog"></i> Ações</span>
            </header>
            <div class="panel-body">
                <?php echo $this->Form->button('<i class="icon-plus"></i> Adicionar', array('type' => 'submit', 'class' => 'btn btn-success btn-shadow', 'escape' => false)); ?>

                <?php echo $this->Form->button('<i class="icon-refresh"></i> Limpar', array('type' => 'reset', 'class' => 'btn btn-default btn-shadow', 'escape' => false)); ?>
            </div>
        </section>

    </div>
     <?php echo $this->Form->end(); ?>
</div>
