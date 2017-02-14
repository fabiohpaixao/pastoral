<?php

    $this->Html->addCrumb('Grupos', '/grupos');
    $this->Html->addCrumb('Adicionar');

?>
<div class="row">
    <?php echo $this->Form->create('Grupo'); ?>
    <div class="col-lg-9">
        <section class="panel">
            <header class="panel-heading clearfix">
              <span class="pull-left"><i class="icon-plus"></i> <?php echo __('Adicionar Grupo'); ?></span>

              <?php echo $this->Html->link(__('<i class="icon-chevron-left"></i> Voltar'), array('action' => 'index'), array('class' => 'btn btn-default btn-shadow pull-right', 'escape' => false)); ?>

            </header>
            <div class="panel-body">

                <?php
                    echo $this->Form->input('id');
                    echo $this->Form->input('nome');
                ?>
            </div>
        </section>
        
        <div class="row">
        <?php foreach ($areas as $key => $area) { ?>

            <div class="col-lg-4">
                <section class="panel">
                    <header class="panel-heading clearfix">
                      <span class="pull-left"><i class="icon-<?php echo $area['Area']['chave'] ?>"></i> <?php echo $area['Area']['nome']; ?></span>
                    </header>
                    <div class="panel-body">

                    <?php foreach ($area['Check'] as $ckey => $check) { ?>
                        
                        <?php $checked = (isset($check['Area']['checked'])) ? 'checked' : '' ?>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="switch switch-square">
                                        <?php echo $this->Form->checkbox($check['Area']['chave'], array('name' => 'data[Grupo][Area][' . $check['Area']['chave'] . ']', 'checked' => $checked)); ?>
                                </div>
                            </div>
                             <div class="col-sm-5 check-area">
                                <?php echo  $check['Area']['nome'] ?>
                             </div>
                         </div>
                            
                    <?php } ?>

                    </div>
                </section>
            </div>

        <?php } ?>
        </div>
    </div>

    <div class="col-lg-3">
        <section class="panel">
            <header class="panel-heading clearfix">
              <span class="pull-left"><i class="icon-cog"></i> Açoes</span>
            </header>
            <div class="panel-body">
                <?php echo $this->Form->button('<i class="icon-plus"></i> Adicionar', array('type' => 'submit', 'class' => 'btn btn-success btn-shadow', 'escape' => false)); ?>

                <?php echo $this->Form->button('<i class="icon-refresh"></i> Limpar', array('type' => 'reset', 'class' => 'btn btn-default btn-shadow', 'escape' => false)); ?>
            </div>
        </section>
    </div>
     <?php echo $this->Form->end(); ?>
</div>