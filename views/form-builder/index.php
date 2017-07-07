<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\builder\Form;
?>


<?php 

//use kartik\widgets\ActiveForm;
//注意和调用 yii\base\Widget::widget() 返回渲染结果不同， 调用 yii\base\Widget::begin() 方法返回一个可组建小部件内容的小部件实例

$form = ActiveForm::begin(['type' => ActiveForm::TYPE_INLINE]);
echo Form::widget([ // widget()方法使用配置数组初始化小部件并返回小部件渲染后的结果
    'model' => $model,
    'form' => $form,
    'attributes' => $model->formAttribs
]);
ActiveForm::end();
?>

<?php

    $form= ActiveForm::begin(['type'=> ActiveForm::TYPE_VERTICAL]);
    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>2,
        'attributes'=>$model->formAttribs,
    ]);
    echo Html::button('Submit', ['type' => 'button', 'class' => 'btn btn-primary']);
    ActiveForm::end();
?>
