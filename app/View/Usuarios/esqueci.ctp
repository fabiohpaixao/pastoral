<?php echo $this->Form->create('Usuario', array( 'controller' => 'usuarios', 'action' => 'esqueci', 'class' => 'form-signin validate')) ?>

<h2 class="form-signin-heading">
    Esqueci minha senha
</h2>

<div class="login-wrap">
    
    <?php echo $this->Session->flash() ?>

    <?php echo $this->Form->input('email', array('autofocus' => 'autofocus', 'placeholder' => 'Email', 'div' => null,
        'label' => false,
        'between' => null,
        'after' => null,
        'class' => 'form-control')) ?>

    <br>

    <?php echo $this->Form->button('Enviar <i class="icon-chevron-right"></i>', array('type' => 'submit', 'class' => 'btn  btn-shadow btn-lg btn-login btn-block', 'escape' => false)); ?>
 </div>

<?php echo $this->Form->end() ?>
