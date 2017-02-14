<?php
$dashcur = $this->name === 'Pages' ? 'active' : '';
?>
<li class="<?php echo $dashcur; ?>">
    <?php echo $this->Html->link(" <i class='icon-home'></i> <span>Dashboard</span>", array('controller' => '', 'action' => 'index'), array('escape' => false)); ?>
</li>
<?php //var_dump($menus); ?>

<?php foreach($menus as $key => $menu) { ?>  

    <?php if(count($menu['Submenu']) > 0){ ?>   
      <li class="sub-menu">
          <a href="javascript:;" class="">
              <i class="icon-<?php echo $menu['Area']['chave'] ?>"></i>
              <span><?php echo $menu['Area']['nome'] ?></span>
              <span class="arrow"></span>
          </a>
        <ul class="sub">
            <?php foreach($menu['Submenu'] as $subkey => $submenu) { ?>

                <?php 
                    $cur   = ($this->params['controller'] == $submenu['Area']['chave']) ? 'active' : '';
                ?>

                <li class="<?php echo $cur ?>"><?php echo $this->Html->link($submenu['Area']['nome'], array('controller' =>$submenu['Area']['chave'], 'action' => 'index')); ?></li>

            <?php } ?>
        </ul>
      </li>

    <?php } ?>

<?php } ?>
