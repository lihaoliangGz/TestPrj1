<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 接收用户数据->文件上传测试的控制器
 * 
 */
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\UploadForm;
use yii\web\UploadedFile;
/**
 * Description of UploadControlleer
 *
 * @author Administrator
 */
class UploadController extends Controller{
    
    public function actionIndex(){
        $model=new UploadForm();
        if(Yii::$app->request->isPost){
            $model->imageFile= UploadedFile::getInstance($model, 'imageFile');
            if($model->upload()){
                echo "<script>alert('上传成功');</script>";
                return;
            }else{
                echo var_dump($model->errors);
                return;
            }
        }
        return $this->renderPartial('index',['model'=>$model]);
    }
}
