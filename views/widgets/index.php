<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 小部件测试的视图
 */

use app\components\ListWidget;

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

<h2>使用小部件</h2>

<?php //echo ListWidget::widget([

//])?>

<?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

<?= $form->field($model, 'username') ?>

<?= $form->field($model, 'password')->passwordInput() ?>

<div class="form-group">
    <?= Html::submitButton('Login') ?>
</div>

<?php ActiveForm::end(); ?>

