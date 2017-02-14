<?php

    $this->Html->addCrumb('Grupos', '/kadmin/grupos');
    $this->Html->addCrumb('Visualizar');

?>
<div class="row">
    <div class="col-lg-9">
        <section class="panel">
            <header class="panel-heading clearfix">
              <span class="pull-left"><i class="icon-eye-open"></i> <?php echo __('Visualizar Grupo'); ?></span>

              <?php echo $this->Html->link(__('<i class="icon-chevron-left"></i> Voltar'), array('action' => 'index'), array('class' => 'btn btn-default btn-shadow pull-right', 'escape' => false)); ?>

            </header>
              <table class="table table-hover personal-task">
                  <tbody>
                    <tr>
                        <td><?php echo __('ID'); ?></td>
                        <td><?php echo h($grupo['Grupo']['id']); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo __('Nome'); ?></td>
                        <td><?php echo h($grupo['Grupo']['nome']); ?></td>
                    </tr>
                  </tbody>
              </table>
          </section>
          
          <div class="row">
            <?php foreach ($areas as $key => $area) { ?>
                <?php if (count($area['Check']) == 0) continue; ?>
                <div class="col-lg-4">
                    <section class="panel">
                        <header class="panel-heading clearfix">
                          <span class="pull-left"><i class="icon-<?php echo $area['Area']['chave'] ?>"></i> <?php echo $area['Area']['nome']; ?></span>
                        </header>
                        <div class="panel-body">

                        <?php foreach ($area['Check'] as $ckey => $check) { ?>
                            <?php if($check['Area']['id'] == $area['Area']['id']) continue; ?>
                            <div class="row" style="margin-bottom: 10px">
                                <div class="col-sm-4">
                                    <?php 
                                        $label =  (isset($check['Area']['checked'])) ? 'success' : 'danger';
                                        $text =  (isset($check['Area']['checked'])) ? 'Sim' : 'Não';
                                    ?>
                                    <span class="label label-<?php echo $label ?>"><?php echo $text ?></span>
                                </div>
                                 <div class="col-sm-5">
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
               
               <?php echo $this->Html->link(__('<i class="icon-pencil"></i> Editar'), array('action' => 'editar', $grupo['Grupo']['id']), array('class' => 'btn btn-info btn-shadow', 'escape' => false)); ?>

                <?php echo $this->Form->postLink(__('<i class="icon-trash"></i> Excluir'), array('action' => 'excluir', $grupo['Grupo']['id']), array('class' => 'btn btn-danger btn-shadow', 'escape' => false), __('Tem certeza que deseja excluir o registro %s?', $grupo['Grupo']['nome'])); ?>
            </div>
        </section>
    </div>

     
</div>