<?php

    $this->Html->addCrumb('Professores', '/professores');
    $this->Html->addCrumb('Editar');

?>
<div class="row">
    <?php echo $this->Form->create('Professor', array('action' => 'editar', 'type' => 'file')); ?>
    <div class="col-lg-9">
        <section class="panel">
            <header class="panel-heading clearfix">
              <span class="pull-left"><i class="icon-pencil"></i> <?php echo __('Editar Professor'); ?></span>

              <?php echo $this->Html->link(__('<i class="icon-chevron-left"></i> Voltar'), array('action' => 'index'), array('class' => 'btn btn-default btn-shadow pull-right', 'escape' => false)); ?>

            </header>
              <div class="panel-body">
                <?php

                    echo $this->Form->input('id');
                    echo $this->Form->input('Usuario.id');
                    echo $this->Form->input('Usuario.nome');
                    echo $this->Form->input('Usuario.email');
                    echo $this->Form->input('Usuario.telefone', array('class' => 'tel form-control'));
                    //echo $this->Form->input('Usuario.avatar', array('type' => 'file'));
                ?>
                  <div class="form-group">
                    <label class="col-sm-3 control-label">Imagem</label>
                     
                    <div class="col-sm-9">
                      <div class="col-sm-3">
                        <?= str_replace('img/img', 'img', $this->Html->image($this->data['Usuario']['avatar'], array('height' => '50px'))) ?>
                      </div>
                      <div class="col-sm-9">
                        <?= $this->Form->input('Usuario.avatar', array('type' => 'file', 'label' => false)) ?>
                      </div>
                    </div>
                  </div>

                <?php  if($professor['Professor']['rp'] == $usuarioLogado['usuario']){ ?>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Senha</label>
                    <div class="col-sm-10">
                        <?php echo $this->Html->link(__('<i class="icon-lock"></i> Alterar senha'), array('action' => 'senha', $professor['Professor']['id']), array('class' => 'btn btn-warning btn-shadow', 'escape' => false)); ?>

                    </div>
                </div>
                <?php } ?>
              </div>
          </section>

    </div>
    <div class="col-lg-3">

         <section class="panel">
            <header class="panel-heading clearfix">
              <span class="pull-left"><i class="icon-cog"></i> Açoes</span>
            </header>
            <div class="panel-body">
                <?php echo $this->Form->button('<i class="icon-save"></i> Salvar', array('type' => 'submit', 'class' => 'btn btn-success btn-shadow', 'escape' => false)); ?>

                <?php echo $this->Form->button('<i class="icon-refresh"></i> Limpar', array('type' => 'reset', 'class' => 'btn btn-default btn-shadow', 'escape' => false)); ?>
            </div>
        </section>

        <section class="panel">
            <header class="panel-heading clearfix">
              <span class="pull-left"><i class="icon-th-large"></i> Opçoes</span>
            </header>
            <div class="panel-body">
                <?php echo $this->Form->input('Usuario.ativo', array(
                        'between' => '<div class="col-sm-9"><div class="switch switch-square">', 
                        'after' => '</div></div>'));
                ?>
            </div>
        </section>

         <section class="panel">
            <header class="panel-heading clearfix">
              <span class="pull-left"><i class="icon-reorder"></i> Detalhes</span>
            </header>
              <table class="table table-hover personal-task">
                  <tbody>
                    <tr>
                        <td><?php echo __('Criado'); ?></td>
                        <td><?php echo $this->Time->format('d/m/Y \à\s h:i:s', $professor['Usuario']['criado']); ?>
                    </tr>

                    <tr>
                        <td><?php echo __('Modificado'); ?></td>
                        <td><?php echo $this->Time->format('d/m/Y \à\s h:i:s', $professor['Usuario']['modificado']); ?></td>
                    </tr>

                      <tr>
                        <td><?php echo __('Último login'); ?></td>
                        <td><?php echo $this->Time->format('d/m/Y \à\s h:i:s', $professor['Usuario']['acesso']); ?></td>
                    </tr>
                  </tbody>
              </table>
        </section>
    </div>
     <?php echo $this->Form->end(); ?>
</div>