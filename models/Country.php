<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 创建一个继承活动记录(ActiveRecord)的类,代表和处理country表
 * 
 */

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/*
 * 不用写任何代码，yii根据类名猜测对应的数据表名
 * 如果类名和数据表名不能直接对应，可以覆写 yii\db\ActiveRecord::tableName() 方法去显式指定相关表名
 */
class Country extends ActiveRecord{
    //public $code_test;
    //public $name_test;
    //public $population_test;
    
    //显式指定表名
    public static function tableName() {
        return 'country_2';
    }
    
    /**
     * 覆盖fields()方法
     * 作用:增加、删除、重命名和重定义字段
     * 返回字段定义列表
     */
    public function fields() {
       
         return[
            //'code' => 'code_test',
            //'name' => 'name_test',
            //'population' => 'population_test',
            'code',
            'name',
             //'population',
        ];
         
        // 过滤掉一些字段，特别用于你想继承父类实现并不想用一些敏感字段
        //$fields = parent::fields();
        // 去掉一些包含敏感信息的字段
        //unset($fields['auth_key'], $fields['password_hash'], $fields['password_reset_token']);
        //return $fields;
    }
    
    /**
     * 覆盖extraFields()方法
     * 作用:
     */
//    public function extraFields() {
//        //parent::extraFields();
//        return[
//          
//        ];
//    }
    
    /**
     * 设置该AR类使用不同的数据库
     */
    //public static function getDb() {
        //return Yii::$app->db2; //使用名为db2的应用组件
    //}
    
    

}
