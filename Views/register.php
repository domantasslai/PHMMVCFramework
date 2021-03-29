<h1>Create an account</h1>
<?php $form = \App\Core\Form\Form::begin('', "post") ?>
<div class="row">
    <div class="col">
        <?=  $form->field($model, 'firstname') ?>
    </div>
    <div class="col">
        <?=  $form->field($model, 'lastname') ?>
    </div>
</div>
<?=  $form->field($model, 'email') ?>
<?=  $form->field($model, 'password')->passwordField() ?>
<?=  $form->field($model, 'passwordConfirm')->passwordField() ?>
<button type="submit" class="btn btn-primary my-3">Submit</button>
<?= \App\Core\Form\Form::end() ?>
