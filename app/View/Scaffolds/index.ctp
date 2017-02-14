    <?php $this->Html->addCrumb($pluralHumanName ); ?>
<div class="row">
  <div class="col-lg-12">
     <section class="panel">
          <header class="panel-heading clearfix">
              <span class="pull-left"><?php echo $pluralHumanName ?></span>


			 <?php echo $this->Html->link('<i class="icon-plus"></i> Adicionar '. $singularHumanName, array('action' => 'adicionar'),array('class' => 'btn btn-success btn-shadow pull-right', 'escape' => false)); ?>

            </header>
			 <table class="table table-striped border-top table-hover" id="table">
             <thead>
				<tr>
                <?php
                	foreach ($scaffoldFields as $key => $_field):
                		if ($_field === 'id' || $_field === 'criado' || $_field === 'modificado')  {
                			unset($scaffoldFields[$key]);
                		} else { ?>
                    		<th><?php echo $this->Paginator->sort($_field); ?></th>
                    <?php }

                    endforeach;
                ?>
					<th><?php echo __d('cake', 'Ações'); ?></th>
				</tr>
                </thead>
                <tbody>

                <?php
                	$i = 0;

                	foreach (${$pluralVar} as ${$singularVar}):
                		echo "\t\t\t\t<tr>";
                			foreach ($scaffoldFields as $_field) {
                				$isKey = false;
                				if (!empty($associations['belongsTo'])) {
                					foreach ($associations['belongsTo'] as $_alias => $_details) {
                						if ($_field === $_details['foreignKey']) {
                							$isKey = true;
                                            if(${$singularVar}[$_alias][$_details['displayField']])
                							     echo "\t\t\t\t\t<td>". $this->Html->link(${$singularVar}[$_alias][$_details['displayField']], array('controller' => $_details['controller'], 'action' => 'visualizar', ${$singularVar}[$_alias][$_details['primaryKey']]), array('class' => 'btn btn-primary', 'style' => 'border:none; background: #' . substr(dechex(crc32(${$singularVar}[$_alias][$_details['displayField']])), 0, 6))) . "</td>\n";
                                            else
                                                echo "\t\t\t\t\t<td></td>\n";
                							break;
                						}
                					}
                				}
                				if ($isKey !== true) {
                					if ($this->viewVars['displayField'] === $_field) {

                						echo "\t\t\t\t\t<td>" . $this->Html->link(h(${$singularVar}[$modelClass][$_field]), array('action' => 'visualizar', ${$singularVar}[$modelClass][$primaryKey])) . "</td>\n";
                					} else {
                						echo "\t\t\t\t\t<td>" . h(${$singularVar}[$modelClass][$_field]) . "</td>\n";
                					}
                				}
                			}

                			echo "\t\t\t\t\t<td class=\"actions\">\n";

                			echo $this->Html->link('<i class="icon-pencil"></i> Editar', array('action' => 'editar', ${$singularVar}[$modelClass][$primaryKey]), array('class' => 'btn btn-info btn-shadow', 'escape' => false)) . ' ';
                			 echo $this->Form->postLink(
                                '<i class="icon-trash"></i> Excluir',
                                array('action' => 'excluir', ${$singularVar}[$modelClass][$primaryKey]),
                                array('class' => 'btn btn-danger btn-shadow', 'escape' => false ),
                                __d('cake', 'Tem certeza que deseja excluir o registro ') . ${$singularVar}[$modelClass][$primaryKey] . '?');
                			echo "\t\t\t\t\t\t</td>\n";
                		echo "\t\t\t\t</tr>\n";
                	endforeach;
                ?>
                </tbody>
			</table>
        </section>
    </div>
</div>
