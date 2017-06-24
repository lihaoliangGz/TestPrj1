<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 应用结构-->视图测试的控制器
 * 
 */
namespace app\controllers;
use yii\base\Controller;
/**
 * Description of ViewController
 *
 * @author Administrator
 */
class ViewTestController extends Controller{
    
    //安全
    public function actionSafe(){
        $safe="对数据进行转码和过滤，防止跨站脚本攻击";
        
        $user=new User();
        
        //渲染名为"safe"的视图文件并使用一个布局返回到渲染结果
        return $this->render('safe',['safe'=>$safe,'user'=>$user]); 
       
        
      
     
    }
    
    //控制器渲染视图、视图中渲染:
    public function actionViewRender(){
        
         return $this->renderPartial('view-render');
         
        //控制器中渲染
        //控制器中渲染视图的方法:
        //yii\base\Controller::render(): 渲染一个 视图名 并使用一个 布局 返回到渲染结果。
        //yii\base\Controller::renderPartial(): 渲染一个 视图名 并且不使用布局。
        //yii\web\Controller::renderAjax(): 渲染一个 视图名 并且不使用布局， 并注入所有注册的JS/CSS脚本和文件，通常使用在响应AJAX网页请求的情况下。
        //yii\base\Controller::renderFile(): 渲染一个视图文件目录或别名下的视图文件。
    }
}
