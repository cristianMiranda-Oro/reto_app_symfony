<h1>Mi Formulario</h1>
<?php echo $sf_user->getFlash('error'); ?>
<?php if ($sf_user->hasFlash('error')): ?>
    <div class="error_message">
        <?php echo $sf_user->getFlash('error'); ?>
    </div>
<?php endif;
?>

<form action="<?php echo url_for('login/index') ?>" method="post" >

  <div>
      <?php echo $form['username']->renderRow(array('class' => 'form-group')) ?>
  </div>
  <div>
      <?php echo $form['password']->renderRow(array('class' => 'form-group')) ?>
  </div>

  <div class="form-actions">
    <input type="submit" value="Enviar" class="btn btn-primary">
  </div>
</form>