<?php

    $this->Html->addCrumb('Posts', '/kadmin/posts');
    $this->Html->addCrumb('Adicionar');

?>
<div class="row">
    <?php echo $this->Form->create('Post'); ?>
    <div class="col-lg-9">
        <section class="panel">
            <header class="panel-heading clearfix">
              <span class="pull-left"><i class="icon-plus"></i> <?php echo __('Adicionar Post'); ?></span>

              <?php echo $this->Html->link(__('<i class="icon-chevron-left"></i> Voltar'), array('action' => 'index'), array('class' => 'btn btn-default btn-shadow pull-right', 'escape' => false)); ?>

            </header>
              <div class="panel-body">
                <?php

                    echo $this->Form->input('titulo');
                    echo $this->Form->input('texto', array('class' => 'ckeditor'));

                ?>
              </div>
        </section>
        
        <div class="row">
            <div class="col-lg-6">
                <section class="panel">
                    <header class="panel-heading clearfix">
                      <span class="pull-left"><i class="icon-picture"></i> Imagem</span>
                    </header>
                    <div class="panel-body">
                        <?php echo $this->Form->input('capa', array('type' => 'file')); ?>
                    </div>
                </section>
            </div>
            <div class="col-lg-6">
                 <section class="panel">
                    <header class="panel-heading clearfix">
                      <span class="pull-left"><i class="icon-comment"></i> Comentários</span>
                    </header>
                    <div class="panel-body">
                        <?php 
                            echo $this->Form->input('comentarios', array(
                                'label' => 'Permitir',
                                'between' => '<div class="col-sm-9"><div class="switch switch-square">', 
                                'after' => '</div></div>'));
                        ?>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <section class="panel">
            <header class="panel-heading clearfix">
              <span class="pull-left"><i class="icon-th-large"></i> Opções</span>
            </header>
            <div class="panel-body">
                <?php echo $this->Form->input('statu', array('label' => 'Status', 'name' => 'data[Post][status]', 'class' => 'poststatus form-control')); ?>
                <div class="postagenda" style="display: none"> 
                <?php
                    echo $this->Form->input('publicar',
                     array(
                        'between' => '<div class="input-append col-sm-7 datetimepicker">',
                        'after' => '<span class="add-on">
                          <i data-time-icon="icon-time" data-date-icon="icon-calendar">
                          </i>
                        </span>
                      </div>',
                        'class' => ' form-control',
                        'type' => 'text',
                        'data-format' => 'dd/MM/yyyy hh:mm:ss'));

                    echo $this->Form->input('finalizar',
                     array(
                        'between' => '<div class="input-append col-sm-7 datetimepicker">',
                        'after' => '<span class="add-on">
                          <i data-time-icon="icon-time" data-date-icon="icon-calendar">
                          </i>
                        </span>
                      </div>',
                        'class' => ' form-control',
                        'type' => 'text',
                        'data-format' => 'dd/MM/yyyy hh:mm:ss'));

                ?>

                </div>
            </div>
        </section>

        <section class="panel">
            <header class="panel-heading clearfix">
              <span class="pull-left"><i class="icon-tag"></i> Grupo</span>
            </header>
            <div class="panel-body">
                <?php 
                    echo $this->Form->input('categoriasDisponiveis', array('value' => $categoriasDisponiveis, 'id' => 'categoriasDisponiveis', 'type' => 'hidden'));
                    echo $this->Form->input('categorias', array( 'class' => 'tagsinput categorias'));
                ?>
            </div>
        </section>

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