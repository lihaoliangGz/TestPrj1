<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 入门-->使用表单模型的测试模型
 * 
 */

namespace app\models;

use yii\base\Model;

/**
 * Description of EntryForm
 *
 * @author Administrator
 */
//yii\base\Model 被用于普通模型类的父类并与数据表无关。yii\db\ActiveRecord 通常是普通模型类的父类但与数据表有关
//yii\db\ActiveRecord 类其实也是继承自 yii\base\Model，增加了数据库处理
class EntryForm extends Model {

    public $name;
    public $email;

    //重写父类的rules()方法,返回数据验证规则的集合
    public function rules() {
        return [
            [['name', 'email'], 'required'],//name和email都是必须的
            ['email', 'email'],//emial必须满足email验证规则
        ];
    }
    
    

}
