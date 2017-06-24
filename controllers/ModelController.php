<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 应用结构-->模型测试的控制器，对应models\ContactForm类和models\Country类
 * 
 */
namespace app\controllers;
use yii\base\Controller;
use app\models\ContactForm;
use app\models\Country;
/**
 * Description of ModelController
 *
 * @author Administrator
 */
class ModelController extends Controller{
    
    //测试普通模型
    public function actionIndex(){
        $model=new ContactForm();
        //访问模型属性:
        $model->name='example';
        echo $model->name;
        echo "\n\n<br/>";
        
        //像访问数组一样访问模型属性
        $model['name']='example_2';
        echo $model['name'];
        echo "\n\n<br/><br/>";

        //迭代器遍历模型:
        foreach ($model as $name => $value) {
            echo "$name = $value";
            echo "\n<br/>";
        }
        echo "\n\n<br/><br/>";
        
        //属性标签,获取属性标签
        $attrLabel = $model->getAttributeLabel('name');
        echo $attrLabel;
        echo "\n<br/>";
        $attrLabel2 = $model->getAttributeLabel('verifyCode');
        echo $attrLabel2;
        echo "\n<br/>";
        $attrLabel3 = $model->getAttributeLabel('abc');
        echo $attrLabel3;
        echo "\n<br/>";
        
       
    }
    
    //测试数据导出
    public function actionExport(){
        //数据导出成数组格式
        $country=Country::findOne('AU');
        $attributes = $country->attributes;//使用attributes将模型转换为数组
        $toArray = $country->toArray([]);//使用toArray()的行为默认和attributes想同,但是它允许选择哪些称之为字段的数据项放入到结果数组中并同时被格式化。
        //toArray()方法默认会返回fields() 方法定义的字段，可用于过滤掉不想显示的字段，如密码...

        var_dump($attributes);
         echo "\n\n<br/>";
        var_dump($toArray);
        echo "\n\n<br/>";
        
        echo $country->code;
        echo "\n\n<br/>";
        echo $country->name;
        echo "\n\n<br/>";
        echo $country->population;
    }
    
    //测试字段
    public function actionField(){
        $country = Country::findOne('AU');
        $toArray0 = $country->toArray();
        var_dump($toArray0);
        echo "\n\n<br/>";
    }
    
}
