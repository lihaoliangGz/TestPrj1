<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 缓存->片段缓存测试的控制器
 * 
 * yii\widget\FragmentCache 小部件用以实现片段缓存功能
 */
namespace app\controllers;

use Yii;
use yii\web\Controller;
/**
 * Description of CacheFragmentController
 *
 * @author Administrator
 */
class CacheFragmentController extends Controller{
    
    /**
     * 
     */
    public function actionIndex(){
        
        return $this->renderPartial('index',['index'=>'index','id'=>1]);
    }
    
}
