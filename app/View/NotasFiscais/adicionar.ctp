<?php

    $this->Html->addCrumb('Notas Fiscais', '/notasfiscais');
    $this->Html->addCrumb('Adicionar');

?>
<div class="row">
    <?php echo $this->Form->create('NotasFiscais'); ?>
    <div class="col-lg-9">
        <section class="panel">
			<header class="panel-heading clearfix">
              <span class="pull-left"><i class="icon-plus"></i> <?php echo __('Adicionar Notas Fiscais'); ?></span>

              <?php echo $this->Html->link(__('<i class="icon-chevron-left"></i> Voltar'), array('action' => 'index'), array('class' => 'btn btn-default btn-shadow pull-right', 'escape' => false)); ?>

            </header>
        	<div class="panel-body">
            <?php
                echo $this->Form->input('numero', array('type' => 'number'));
                echo $this->Form->input('fornecedor');
                echo $this->Form->input('data',$this->CustomInputs->getInput('date'));
                echo $this->Form->input('valor',$this->CustomInputs->getInput('monetary'));
                // echo $this->Form->input('comprovante_pgto');
                // echo $this->Form->input('nota_transporte');
                // echo $this->Form->input('comprovante_transportadora');
                // echo $this->Form->input('jp_nf');
                // echo $this->Form->input('jp_boleto');
                // echo $this->Form->input('jp_comprovante');
                // echo $this->Form->input('jp_comprovante');
            ?>    
          </div>
		</section>

		<div class="row">
			<div class="col-lg-4">
				<section class="panel" >
					<header class="panel-heading"><i class="icon-check-square"></i> Comprovante de Pgto</header>
                    <div class="panel-body">
                    <?php echo $this->Form->input('comprovante_pgto', array('type' => 'text', 'label' => '')); ?>
                    </div>
                </section>
            </div>
            <div class="col-lg-4">
                <section class="panel" >
                    <header class="panel-heading"><i class="icon-check-square"></i> Nota de Transporte</header>
                    <div class="panel-body">
                        <?php echo $this->Form->input('nota_transporte', array('type' => 'text', 'label' => '')); ?>
                    </div>
                </section>
            </div>
            <div class="col-lg-4">
                <section class="panel" >
                    <header class="panel-heading"><i class="icon-check-square"></i> Comprovante da Tansp.</header>
                    <div class="panel-body">
                    <?php echo $this->Form->input('comprovante_transportadora', array('type' => 'text', 'label' => '')); ?>
                    </div>
                </section>
            </div>

            <div class="clearfix"></div>

			<div class="col-lg-4">
				<section class="panel" >
					<header class="panel-heading"><i class="icon-check-square"></i> JP Nota Fiscal</header>
                    <div class="panel-body">
                    <?php echo $this->Form->input('jp_nf', array('type' => 'text', 'label' => '')); ?>
                    </div>
                </section>
            </div>
            <div class="col-lg-4">
                <section class="panel" >
                    <header class="panel-heading"><i class="icon-check-square"></i> JP Boleto</header>
                    <div class="panel-body">
                        <?php echo $this->Form->input('jp_boleto', array('type' => 'text', 'label' => '')); ?>
                    </div>
                </section>
            </div>
            <div class="col-lg-4">
                <section class="panel" >
                    <header class="panel-heading"><i class="icon-check-square"></i> JP Comprovante</header>
                    <div class="panel-body">
                    <?php echo $this->Form->input('jp_comprovante', array('type' => 'text', 'label' => '')); ?>
                    </div>
                </section>
            </div>
		</div>
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
                <span class="pull-left"><i class="icon-th-large"></i> Status</span>
            </header>
            <div class="panel-body">
            <?php //echo $this->Form->input('status', array('label' => '')); ?>
            <?php echo $this->Form->input('statu', array('label' => '', 'name' => 'data[NotaFiscal][status]', 'class' => 'poststatus form-control')); ?>
            <?php 
               /* echo $this->Form->input('ativo', array(
                    'checked' => 'checked',
                    'between' => '<div class="col-sm-9"><div class="switch switch-square">', 
                    'after' => '</div></div>'));
                    */
            ?>
            </div>
        </section>

    </div>
     <?php echo $this->Form->end(); ?>
</div>