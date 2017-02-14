<?php

    $this->Html->addCrumb($pluralHumanName, Router::url(array('controller' => $pluralVar, 'action' => 'index'), true));
    $this->Html->addCrumb(ucfirst($this->action));

?>
<div class="row">
    <?php echo $this->Form->create(); ?>
    <div class="col-lg-9">
        <section class="panel">
            <header class="panel-heading clearfix">
              <span class="pull-left"><i class="icon-pencil"></i> <?php echo __(ucfirst($this->action) . ' ' . $singularHumanName); ?></span>

              <?php echo $this->Html->link(__('<i class="icon-chevron-left"></i> Voltar'), array('action' => 'index'), array('class' => 'btn btn-default btn-shadow pull-right', 'escape' => false)); ?>

            </header>
            <div class="panel-body">

	           <?php echo $this->Form->inputs($scaffoldFields, array('created', 'modified'), array('legend' => false));
?>
            </div>
        </section>
    </div>

    <div class="col-lg-3">
        <!-- <section class="panel">
            <header class="panel-heading clearfix">
              <span class="pull-left"><i class="icon-th-large"></i> Opçoes</span>
            </header>
            <div class="panel-body">
                
            </div>
        </section>
 -->
         <!-- <section class="panel">
            <header class="panel-heading clearfix">
              <span class="pull-left"><i class="icon-reorder"></i> Detalhes</span>
            </header>
              <table class="table table-hover personal-task">
                  <tbody>
                    <tr>
                        <td><?php echo __('Criado'); ?></td>
                        <td><?php echo $this->Time->format('d/m/Y \à\s h:i:s', $usuario['Usuario']['criado']); ?>
                    </tr>
                  </tbody>
              </table>
        </section>
 -->
        <section class="panel">
            <header class="panel-heading clearfix">
              <span class="pull-left"><i class="icon-cog"></i> Açoes</span>
            </header>
            <div class="panel-body">
                <?php echo $this->Form->button('<i class="icon-save"></i> Salvar', array('type' => 'submit', 'class' => 'btn btn-success btn-shadow', 'escape' => false)); ?>

                <?php echo $this->Form->button('<i class="icon-refresh"></i> Cancelar', array('type' => 'reset', 'class' => 'btn btn-default btn-shadow', 'escape' => false)); ?>
            </div>
        </section>
    </div>
     <?php echo $this->Form->end(); ?>
</div>