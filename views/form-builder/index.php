<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php $form=ActiveForm::begin();?>

    <?= $form->field($model, 'username') ?>
    <?= $form->field($model, 'password')?>
<div class="form-group">
    <?=Html::submitButton('提交',['class'=>'btn btn-primary'])?> 
</div>
<?php ActiveForm::end();?>