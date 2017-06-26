<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 组件测试的控制器
 */
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\components\MyClass;
/**
 * Description of ComponentController
 *
 * @author Administrator
 */
class ComponentController extends Controller {
    
    public function actionIndex(){
        //创建组件实例方式一:
        $component=new MyClass(13,['prop1'=>3,'prop2'=>4]);
        
        //方式二:
        $component1=Yii::createObject([
            'class'=> MyClass::className(),
            'prop1'=>335,
            'prop2'=>1234,
        ], [56]);
        
       var_dump($component);
       echo "\n\n<br/>";
       var_dump($component1);
       
    }
}
