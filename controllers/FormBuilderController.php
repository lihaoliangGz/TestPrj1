<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * Yii框架插件:Form Builder  表单
 * 
 */

namespace app\controllers;

use yii\web\Controller;
use app\models\FormBuilder;
/**
 * Description of FormBuilderController
 *
 * @author Administrator
 */
class FormBuilderController extends Controller{
    
    
    public function actionIndex(){
        $model=new FormBuilder();
        
       return $this->renderPartial('index',['model'=>$model]);
    }
}
