<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 测试自定义助手，代替框架的ArrayHelper，还需在应用的入口文件中添加代码
 * 
 */

namespace app\components;
use yii\helpers\BaseArrayHelper;
/**
 * Description of ArrayHelper
 *
 * @author Administrator
 */
class ArrayHelper extends BaseArrayHelper{
    
    //覆盖父类的merge()方法,定义自己的实现
    public static function merge($a, $b) {
        parent::merge($a, $b);
        echo "测试自定义助手类";
    }
}
