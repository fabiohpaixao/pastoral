<?php $this->Html->addCrumb($pluralHumanName, Router::url(array('controller' => $pluralVar, 'action' => 'index'), true)); ?>
<?php $this->Html->addCrumb('Visualizar'); ?>

<div class="row">
    <div class="col-lg-9">
        <section class="panel">
            <header class="panel-heading clearfix">
              <span class="pull-left">
                <i class="icon-eye-open"></i> Visualizar <?php echo $singularHumanName ?>
              </span>

            <?php echo $this->Html->link('<i class="icon-chevron-left"></i> Voltar', array('action' => 'index'),array('class' => 'btn btn-default btn-shadow pull-right', 'escape' => false)); ?> </header>
            <table class="table table-hover personal-task">
                <tbody>
<?php
$i = 0;
foreach ($scaffoldFields as $_field) {
	$isKey = false;
	if (!empty($associations['belongsTo'])) {
		foreach ($associations['belongsTo'] as $_alias => $_details) {
			if ($_field === $_details['foreignKey']) {
				$isKey = true;
				echo "\t\t\t\t<tr><td>" . Inflector::humanize($_alias) . "</td>\n";
				echo "\t\t\t\t<td>\n\t\t\t\t\t" . $this->Html->link(${$singularVar}[$_alias][$_details['displayField']], array('controller' => $_details['controller'], 'action' => 'view', ${$singularVar}[$_alias][$_details['primaryKey']])) . "\n\t\t\t\t&nbsp;</td></tr>\n";
				break;
			}
		}
	}
	if ($isKey !== true) {
		echo "\t\t\t\t<tr><td>" . Inflector::humanize($_field) . "</td>\n";
		echo "\t\t\t\t<td>" . h(${$singularVar}[$modelClass][$_field]) . "&nbsp;</td></tr>\n";
	}
}
?>
              </tbody>
          </table>
      </section>
    </div>

    <div class="col-lg-3">

      <!--   <section class="panel">
            <header class="panel-heading clearfix">
              <span class="pull-left"><i class="icon-reorder"></i> Detalhes</span>
            </header>
              <table class="table table-hover personal-task">
                  <tbody>
                 
                  </tbody>
              </table>
        </section> -->

        <section class="panel">
            <header class="panel-heading clearfix">
              <span class="pull-left"><i class="icon-cog"></i> Açoes</span>
            </header>
            <div class="panel-body">

            <?php   

                echo $this->Html->link('<i class="icon-pencil"></i> Editar', array('action' => 'editar', ${$singularVar}[$modelClass][$primaryKey]), array('class' => 'btn btn-info btn-shadow', 'escape' => false)) . ' ';

                echo $this->Form->postLink(
                '<i class="icon-trash"></i> Excluir',
                array('action' => 'excluir', ${$singularVar}[$modelClass][$primaryKey]),
                array('class' => 'btn btn-danger btn-shadow', 'escape' => false ),
                __d('cake', 'Tem certeza que deseja excluir o registro ') . ${$singularVar}[$modelClass][$primaryKey] . '?');
            ?>

            </div>
        </section>

    </div>
</div>
