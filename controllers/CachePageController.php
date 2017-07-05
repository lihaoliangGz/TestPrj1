<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 缓存->分页缓存测试的控制器
 * 
 * 页面缓存由 yii\filters\PageCache 类提供支持，该类是一个过滤器
 * 
 * 页面缓存是由过滤器实现，而片段缓存则是一个小部件。
 * 你可以在使用页面缓存的同时，使用片段缓存和动态内容。
 * 
 * 
 * 
 */
namespace app\controllers;

use yii\web\Controller;
/**
 * Description of CachePageController
 *
 * @author Administrator
 */
class CachePageController extends Controller{
   
    /**
     * 
     * @return type
     * 
     */
    public function behaviors() {
        return[
            [
                'class'=>'yii\filters\PageCache',
                'only'=>['index'],
                'duration' =>60,
                
                'variations' => [
                    \Yii::$app->language,
                ],
                'dependency' => [
                    'class' => 'yii\caching\DbDependency',
                    'sql' => 'SELECT COUNT(*) FROM country',
                ],
            ],  
        ];
    }
    
    /**
     * 
     */
    public function actionIndex(){
        $time= time();
        echo $time;
    }
}
