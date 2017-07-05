<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 安全->处理密码测试的控制器
 */
namespace app\controllers;

use Yii;
use yii\db\Query;
use yii\helpers\Html;
use yii\web\Controller;
/**
 * Description of PasswordController
 *
 * @author Administrator
 */
class PasswordController extends Controller{
    
     //public $enableCsrfValidation = false;//禁用 CSRF 验证

    /**
     * 第一次提供密码时(注册),将密码哈希化
     */
    public function actionIndex(){
        $password= $_GET['password'];
        echo "$password","\n\n<br/><br/>";
        
        $hash = Yii::$app->getSecurity()->generatePasswordHash($password);
        echo $hash;
        
        $hash= Html::decode($hash);
        
        //$connection=Yii::$app->db;
        //$sql="insert into password_test (password_explicit,password_hash) values($password,$hash)";//哈希化后的密码存不进数据库...未能解决
        //$connection->createCommand($sql)->execute();
        
        //模拟登陆时验证
        if(Yii::$app->getSecurity()->validatePassword($password, $hash)){
            echo "\n\n<br/><br/>\n\n","加密后的密码验证成功";
        }
               
    }
    
    /**
     * 生成伪随机数
     * 可用于通过邮箱重置密码时
     */
    public function actionRandom(){
        $string = Yii::$app->getSecurity()->generateRandomString();
        echo $string;
    }
    
    /**
     * 加密解密
     */
    public function actionKey(){
        $data="加密后的传输数据";
        $secretkey=123;
        //加密数据
        $encryptByKey = Yii::$app->getSecurity()->encryptByPassword($data, $secretkey);
        echo ($encryptByKey);
        
        echo  "\n<br/><br/>\n";
        
        //读取数据
        $deData = Yii::$app->getSecurity()->decryptByPassword($encryptByKey, $secretkey);
        echo ($deData);
                
    }
    
    /**
     * 校验数据完整性
     */
    public function actionCheckout(){
        $data="校验数据的完整性";
        $key=456;
        $hashData = Yii::$app->getSecurity()->hashData($data, $key);
        echo $hashData;;
            
        echo "\n<br/><br/>\n";
        
        $validateData = Yii::$app->getSecurity()->validateData($hashData, $key);
        echo $validateData;
    }
}
