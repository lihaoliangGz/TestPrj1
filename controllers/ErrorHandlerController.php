<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 测试错误处理的控制器
 * yii\web\ErrorHandler 注册成一个名称为errorHandler应用组件
 * 
 *  Yii错误处理器做以下工作来提升错误处理效果：
所有非致命PHP错误（如，警告，提示）会转换成可获取异常,也就是说可以通过try/catch来捕获；
异常和致命的PHP错误会被显示，在调试模式会显示详细的函数调用栈和源代码行数。
支持使用专用的 控制器操作 来显示错误；
支持不同的错误响应格式；
yii\web\ErrorHandler 错误处理器默认启用， 可通过在应用的入口脚本中定义常量YII_ENABLE_ERROR_HANDLER来禁用。
 * 
 * yii\web\ErrorHandler 错误处理器默认使用两个视图显示错误:
@yii/views/errorHandler/error.php: 显示不包含函数调用栈信息的错误信息是使用， 当YII_DEBUG 为 false时，所有错误都使用该视图。
@yii/views/errorHandler/exception.php: 显示包含函数调用栈信息的错误信息时使用。
可以配置错误处理器的 yii\web\ErrorHandler::errorView 和 yii\web\ErrorHandler::exceptionView 属性 使用自定义的错误显示视图
 * 
 */

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\base\ErrorException;
/**
 * Description of ErrorHandlerController
 *
 * @author Administrator
 */
class ErrorHandlerController extends Controller{
    
    public function actionIndex(){
//        try {
//            10 / 0;
//        } catch (yii\base\ErrorException $exc) {
//            echo $exc->getTraceAsString();
//        }
        
        //throw new \yii\web\HttpException(102);//使用的视图错误界面不一样
        //throw new \yii\web\NotFoundHttpException;//使用的视图错误界面不一样
    }
    
    /**
     * 自定义异常
     */
    public function actionCustom(){
        
    }
}
