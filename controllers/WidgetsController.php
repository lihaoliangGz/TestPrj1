<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 小部件测试的控制器
 * 
 */
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\UserForm;
/**
 * Description of WidgetsController
 *
 * @author Administrator
 */
class WidgetsController extends Controller {
    
    public function actionIndex(){
        $model=new UserForm();
        $model->username='alex';
        $model->password='******';
        if($model->load(Yii::$app->request->post()&&$model->validate())){
            return  "你输入的用户名是:".$model->username."\n\n<br/>密码是:".$model->password."\n\n<br/>";
        } else {
            return $this->renderPartial('index',['model'=>$model]);
        }
    }
    
   
}
