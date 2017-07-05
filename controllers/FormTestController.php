<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 接收用户数据->创建表单测试的控制器
 */

namespace app\controllers;

use yii\web\Controller;
use app\models\LoginFormTest;

/**
 * Description of FormController
 *
 * @author Administrator
 */
class FormTestController extends Controller{
    
    /**
     * 
     */
    public function actionIndex(){
        
        $model=new LoginFormTest();
        $this->render('index',['model'=>$model]);
    }
}
