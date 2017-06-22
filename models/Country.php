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
use yii\db\ActiveRecord;

/*
 * 不用写任何代码，yii根据类名猜测对应的数据表名
 * 如果类名和数据表名不能直接对应，可以覆写 yii\db\ActiveRecord::tableName() 方法去显式指定相关表名
 */
class Country extends ActiveRecord{
    
    //显式指定表名
    public static function tableName() {
        return 'country_2';
    }
    
}
