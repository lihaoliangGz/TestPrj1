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
/**
 * Description of FormBuilder
 *
 * @author Administrator
 */
class FormBuilder extends Model{
    public $username;
    public $password;
    
    public function rules() {
        return[
            [['username','password'],'required'],
        ];
    }
}
