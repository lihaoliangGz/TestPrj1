<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 应用结构-->视图测试的控制器
 * 
 * 通过yii\web\View应用组件来管理视图， 该组件主要提供通用方法帮助视图构造和渲染
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
    public $defaultAction='safe';//指定了默认操作
    
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
    
    //其他地方渲染视图
    public function actionRenderOther(){
        echo \Yii::$app->view->render('@app/views/view-test/other-view.php');
    }
    
    //视图名
    public function actionViewName(){
        //1. 视图名省略扩展名
        //return $this->renderPartial('view-render');
        
        //2. 视图名以双斜杠开头,对应的视图文件路径为 @app/views/ViewName， 也就是说视图文件在 yii\base\Application::viewPath 路径下找，
        // 例如 //site/about 对应到 @app/views/site/about.php。
        //return $this->renderPartial('//view-test/view-name');
        
        //3. 视图名以单斜杠/开始,视图文件路径以当前使用模块 的yii\base\Module::viewPath开始， 如果不存在模块，使用@app/views/ViewName开始，
        //例如，如果当前模块为user， /user/create 对应成 @app/modules/user/views/user/create.php, 如果不在模块中，/user/create对应@app/views/user/create.php
        return $this->renderPartial('/view-test/view-name');
        
        //4. 如果 yii\base\View::context 渲染视图 并且上下文实现了 yii\base\ViewContextInterface.....
        
        // 5.如果视图渲染另一个视图，包含另一个视图文件的目录以当前视图的文件路径开始，
        //  例如被视图@app/views/post/index.php 渲染的 item 对应到 @app/views/post/item。
    }
    
    //视图中访问数据,两种方式:：推送和拉取。
    public function actionAccessData(){
        //推送
        //$data_1="data_1";
        //return $this->renderPartial('access-data',['data_1'=>$data_1]);
        
        //拉取
        return $this->renderPartial('access-data');       
    }
    
    //视图间共享数据
    public function actionDataShare(){
        return $this->renderPartial('data-share');
    }
    
    //布局 
    public function actionLayout(){
        
    }
}
