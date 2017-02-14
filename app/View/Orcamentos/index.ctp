<?php

	$this->Html->addCrumb('Orçamentos');

?>
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading clearfix">
                <span class="pull-left"><?php echo __('Orçamentos'); ?></span>
                
                <?php echo $this->Html->link(__('<i class="icon-plus"></i> Novo Orçamento'), array('controller' => 'orcamentos', 'action' => 'adicionar'),array('class' => 'btn btn-success btn-shadow pull-right', 'escape' => false)); ?>
            </header>

            <table class="table table-striped border-top table-hover" id="table">
                <thead>
                    <tr>
                        <th>Ativo</th>
                        <th>Código</th>
                        <th>Cliente</th>
                        <th class="hidden-phone">Especialidade</th>
                        <th class="hidden-phone">Valor</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($orcamentos as $key => $orcamento): ?>
                    <tr class="<?php echo ($key % 2 == 0) ? 'odd' : ''; ?> gradeX">
                        <td>
                            <?php $class =  $orcamento['Orcamento']['ativo'] ? 'success' : 'danger'; ?>
                            <?php $txt =  $orcamento['Orcamento']['ativo'] ? 'Sim' : 'Não'; ?>
                            <?php echo $this->Html->tag('span', $txt, array('class' => 'label label-' . $class)); ?>
                        </td>
                        <td><?php echo h($orcamento['Orcamento']['codigo']); ?></td>
                        <td class="hidden-phone"><?php foreach ($orcamento['Cliente'] as $key => $value) echo h($value['nome']);?></td>
                        <td class="hidden-phone"><?php foreach ($orcamento['Especialidade'] as $key => $value) echo $this->Html->tag('span', h($value['titulo']),array('class' => 'btn btn-default')); ?></td>
                        <td><?php echo $this->Number->format($orcamento['Orcamento']['valor'], array('before' => 'R$ ', 'thousands' => '.', 'decimals' => ',')); ?>&nbsp;</td>
                        <td class="actions">
                            <?php echo $this->Html->link(__('<i class="icon-pencil"></i> Editar'), array('action' => 'editar', $orcamento['Orcamento']['id']), array('class' => 'btn btn-info btn-shadow', 'escape' => false)); ?>
                            <?php echo $this->Form->postLink(__('<i class="icon-trash"></i> Excluir'), array('action' => 'excluir', $orcamento['Orcamento']['id']), array('class' => 'btn btn-danger btn-shadow', 'escape' => false), __('Tem certeza que deseja excluir o registro %s?', $orcamento['Orcamento']['codigo'])); ?>
    					</td>
                    </tr>
				<?php endforeach; ?>
                </tbody>
			</table>
	   </section>
	</div>
</div>