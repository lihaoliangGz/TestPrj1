<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php

$form = ActiveForm::begin([
            'id' => 'login-form',
            'options' => ['class' => 'form-horizontal'],
        ])
?>
<?= $form->field($model, 'username')->textInput()->hint("请输入名字")->label('Name') ?>
<?= $form->field($model, 'password')->passwordInput()->label('密码') ?>
<?= $form->field($model, 'email')->input('email')->label('邮箱');?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
<?= Html::submitButton('Login', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>
