<?php

    $this->Html->addCrumb('Orçamentos', '/orcamentos');
    $this->Html->addCrumb('Editar');

?>
<div class="row">
    <?php echo $this->Form->create('Orcamento', array('action' => 'editar')); ?>
    <div class="col-lg-9">
        <section class="panel">
            <header class="panel-heading clearfix">
                <span class="pull-left"><i class="icon-plus"></i> <?php echo __('Editar Orçamento'); ?></span>

                <?php echo $this->Html->link(__('<i class="icon-chevron-left"></i> Voltar'), array('action' => 'index'), array('class' => 'btn btn-default btn-shadow pull-right', 'escape' => false)); ?>

            </header>
            <div class="panel-body">
            <?php
                echo $this->Form->input('codigo');
                echo $this->Form->input('Cliente', array('multiple' => false));
            ?>
            </div>
        </section>

        <section class="panel">
            <header class="panel-heading clearfix"><i class="icon-wrench"></i> Fatores</header>
            <div class="panel-body">
                <div class="col-lg-6">
                <?php
                    echo $this->Form->input('fator_retrabalho', $this->CustomInputs->getInput('decimal', array('label'=>'Retrabalho')));
                ?>    
                </div>
                <div class="col-lg-6">
                <?php
                    echo $this->Form->input('imposto', $this->CustomInputs->getInput('decimal'));
                ?>
                </div>
            </div>
        </section>

        <div class="row">
            <div class="col-lg-4">
                <section class="panel" >
                    <header class="panel-heading"><i class="icon-clock-o"></i> Horas Normais</header>
                    <div class="panel-body">
                    <?php echo $this->Form->input('qtd_horas_normais', array('type' => 'number', 'label' => '')); ?>
                    </div>
                </section>
            </div>
            <div class="col-lg-4">
                <section class="panel" >
                    <header class="panel-heading"><i class="icon-clock-o"></i> Horas Extra</header>
                    <div class="panel-body">
                        <?php echo $this->Form->input('qtd_horas_extra', array('type' => 'number', 'label' => '')); ?>
                    </div>
                </section>
            </div>
            <div class="col-lg-4">
                <section class="panel" >
                    <header class="panel-heading"><i class="icon-clock-o"></i> Horas Noturnas</header>
                    <div class="panel-body">
                    <?php echo $this->Form->input('qtd_horas_noturna', array('type' => 'number', 'label' => '')); ?>
                    </div>
                </section>
            </div>

            <div class="clearfix"></div>
           
            <div class="col-lg-6">
                <section class="panel" >
                    <header class="panel-heading"><i class="icon-calculator"></i> Despesas</header>
                    <div class="panel-body">
                        <?php echo $this->Form->input('Despesa', $this->CustomInputs->getInput('multiple')); ?>
                    </div>
                </section>
            </div>
            <div class="col-lg-6">
                <section class="panel" >
                    <header class="panel-heading"><i class="icon-user-plus"></i> Especialidades</header>
                    <div class="panel-body">
                        <?php echo $this->Form->input('Especialidade', $this->CustomInputs->getInput('multiple')); ?>
                    </div>
                </section>
            </div>

            <div class="clearfix"></div>

            <div class="col-lg-12">
                <section class="panel" >
                    <header class="panel-heading"><i class="icon-cart-arrow-down"></i> Materiais</header>
                    <div class="panel-body">
                        <?php echo $this->Form->input('MaterialDistribuidor', $this->CustomInputs->getInput('multiple', array('options' => $materiais))); ?>
                    </div>
                </section>
            </div>

            <div class="clearfix"></div>

            <div class="col-lg-12">
                <section class="panel" >
                    <header class="panel-heading"><i class="icon-money"></i> Valor</header>
                    <div class="panel-body">
                        <?php echo $this->Form->input('valor', $this->CustomInputs->getInput('monetary')); ?>
                    </div>
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
                <?php echo $this->Form->button('<i class="icon-save"></i> Salvar', array('type' => 'submit', 'class' => 'btn btn-success btn-shadow', 'escape' => false)); ?>

                <?php echo $this->Form->button('<i class="icon-refresh"></i> Limpar', array('type' => 'reset', 'class' => 'btn btn-default btn-shadow', 'escape' => false)); ?>
            </div>
        </section>


        <section class="panel">
            <header class="panel-heading clearfix">
                <span class="pull-left"><i class="icon-th-large"></i> Opçoes</span>
            </header>
            <div class="panel-body">
            <?php 
                echo $this->Form->input('ativo', array(
                    'between' => '<div class="col-sm-9"><div class="switch switch-square">', 
                    'after' => '</div></div>'));
            ?>
            </div>
        </section>
    </div>

    <?php echo $this->Form->end(); ?>
</div>
