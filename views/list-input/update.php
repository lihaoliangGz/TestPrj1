<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 接收用户数据->搜集列表输入测试的视图
 * 
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form= ActiveForm::begin();
foreach ($settings as $index => $setting) {
    echo $form->field($setting,  "[$index]value")->label($setting->name);
}
ActiveForm::end();