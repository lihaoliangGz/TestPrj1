<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 入门测试的控制器
 * 
 */

namespace app\controllers;
use yii\web\Controller;

class TestController extends Controller{
    
    //第一次问候
    //使用action前缀代表操作，没有action前缀代表普通方法
    //Yii如何处理操作ID和控制器ID ?
    //URL中参数r代表路由，格式是：控制器 ID/操作 ID
    public function actionSay($message='Hello'){
        //echo "Hello World";
        return $this->render('say',['message'=>$message]);//渲染名为"say"的视图文件并返回渲染结果
    }
}
