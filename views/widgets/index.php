<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 小部件测试的视图
 */

use app\components\ListWidget;
use app\components\Hello_2Widget;
use app\components\HelloWidget;

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

<h2>使用小部件</h2>
<!--调用 yii\base\Widget::widget() 方法使用小部件。 该方法使用 配置 数组初始化小部件并返回小部件渲染后的结果。-->

<?php echo ListWidget::widget([
    'item'=>'items',
])?>

<?= HelloWidget::widget(['message'=>'Good morning'])?>

<!--在begin() 和 end()调用中使用的Widget-->
<?php Hello_2Widget::begin();?>
    content that may contain  <tag>'s
<?php Hello_2Widget::end();?>



<?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

<?= $form->field($model, 'username') ?>

<?= $form->field($model, 'password')->passwordInput() ?>

<div class="form-group">
    <?= Html::submitButton('Login') ?>
</div>

<?php ActiveForm::end(); ?>

