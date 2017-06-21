<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 助手类测试的控制器
 * 
 */

namespace app\controllers;
use yii\web\Controller;
use yii\helpers\ArrayHelper;

/**
 * Description of HelpersController
 *
 * @author Administrator
 */
class HelpersController extends Controller{
    
    //Array助手
    public function actionArrayHelper(){
        
        //获取值
        $array=[
            'foo'=>[
                'bar'=>new User(),
            ]  
        ];
        //方法参数一:我们从哪里获取值
        //方法参数二:数组键名或者欲从中取值的对象的属性名称；
                    //以点号分割的数组键名或者对象属性名称组成的字符串
                    //返回一个值的回调函数。
        $value=ArrayHelper::getValue($array, 'foo.bar.name','默认值');
        echo "$value","\n";
        
        //测试未通过
//        $user=new User;
//        $value2= ArrayHelper::getValue($array, function($user){
//            return "用户名是:".$user->name."\n";
//        });
        
        //获取值后立即从数组中删除:
        //注意：和 getValue 方法不同的是，remove 方法只支持简单键名。
        $array=array('type'=>'A','options'=>[1,2]);
        $type= ArrayHelper::remove($array, 'type');
        echo "type的值:","$type","\n";
        var_dump($array);
        
        //检查键名的存在:
        
        
    }
}


