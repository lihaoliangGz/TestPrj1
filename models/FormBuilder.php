<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 表单测试的model类,对应FormBuilderController.php
 * 
 */

namespace app\models;

use yii\base\Model;
use yii\helpers\Html;
use kartik\builder\Form;
/**
 * Description of FormBuilder
 *
 * @author Administrator
 */
class FormBuilder extends Model{
    public $username;
    public $password;
    public $rememberMe;
    public $actions;
    //private $formAttribs;
    
    public function rules() {
        return[
            [['username','password'],'required'],
        ];
    }
    
    /**
     * 为表单构建器设置属性数组
     */
    public function getFormAttribs(){
        return[
        'username' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => '请输入账号']],
        'password' => ['type' => Form::INPUT_PASSWORD, 'options' => ['placeholder' => '请输入密码']],
        'rememberMe' => ['type' => Form::INPUT_CHECKBOX],
        'actions' => ['type' => Form::INPUT_RAW, 'value' => Html::submitButton('Submit', ['class' => 'btn btn-primary']) ]
        ];
    }
}
