<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 安全->认证测试的控制器,对应app\models\User.php
 * 
 */

namespace app\controllers;

use Yii;

use yii\web\Controller;
/**
 * Description of AuthController
 *
 * @author Administrator
 */
class AuthController extends Controller{
    
    public function actionIndex(){
        // 当前用户的身份实例。未认证用户则为 Null 。
        $identity=Yii::$app->user->identity;
        var_dump($identity);
        
        echo "\n\n<br/><br/>\n\n";
        
        // 当前用户的ID。 未认证用户则为 Null 。
        $id=Yii::$app->user->id;
        var_dump($id);
        
         echo "\n\n<br/><br/>\n\n";

         // 判断当前用户是否是游客（未认证的）
        $isGuest = Yii::$app->user->isGuest;
        var_dump($isGuest);
    }
    
    
    public function actionLogin(){
        
    }
}
