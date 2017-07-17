<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 接收用户数据->创建表单测试的通用模型类
 * 
 */

namespace app\models;

use yii\base\Model;

/**
 * Description of LoginFormTest
 *
 * @author Administrator
 */
class LoginFormTest extends Model{
    public $username;
    public $password;
    public $email;
    
    public function rules() {
        return[
          //定义验证规则
            [['username','password'],'required'],
        ];
    }
}
