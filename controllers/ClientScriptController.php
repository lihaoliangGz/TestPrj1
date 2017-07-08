<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 显示数据->使用客户端脚本测试的控制器
 * 
 */
namespace app\controllers;
use yii\web\Controller;
/**
 * Description of ClientScriptController
 *
 * @author Administrator
 */
class ClientScriptController extends Controller{
    
    /**
     * 
     */
    public function actionIndex(){
        return $this->renderPartial('index');
    }
    
}
