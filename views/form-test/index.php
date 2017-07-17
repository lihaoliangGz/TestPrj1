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
<?= $form->field($model, 'username')->textInput()->hint("请输入名字")->label('Name') //增加一个提示标签 ?>
<?= $form->field($model, 'password')->passwordInput()->label('密码') ?>
<?= $form->field($model, 'email')->input('email')->label('邮箱'); //创建一个HTML5邮箱输入框?>
<?= $form->field($model, 'uploadFile[]')->fileInput(['multiple'=>'multiple']) //允许多个文件被上传?>
<?= $form->field($model, 'items[]')->checkboxList(['a' => 'Item A', 'b' => 'Item B', 'c' => 'Item C']); //允许进行选择多个项目?>
<?= $form->field($model, 'product_category')->dropDownList(
         ProductCategory::find()->select(['category_name', 'id'])->indexBy('id')->column(), 
        ['prompt' => 'Select Category']
);//创建下拉列表?>


    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
<?= Html::submitButton('Login', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>
