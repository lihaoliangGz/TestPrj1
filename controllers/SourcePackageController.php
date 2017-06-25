<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 测试资源包的控制器
 * 
 */
namespace app\controllers;

use yii\web\Controller;
/**
 * Description of SourcePackage
 *
 * @author Administrator
 */
class SourcePackageController extends Controller {
    
    public function actionIndex(){
        return $this->renderPartial('index');
    }
    
}
