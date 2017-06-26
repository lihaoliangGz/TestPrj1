<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 响应测试的控制器
 * 
 * 在大多是情况下主要处理继承自 yii\web\Response 的 response 应用组件
 * 
 * Yii预定义的HTTP异常：
yii\web\BadRequestHttpException: status code 400.
yii\web\ConflictHttpException: status code 409.
yii\web\ForbiddenHttpException: status code 403.
yii\web\GoneHttpException: status code 410.
yii\web\MethodNotAllowedHttpException: status code 405.
yii\web\NotAcceptableHttpException: status code 406.
yii\web\NotFoundHttpException: status code 404.
yii\web\ServerErrorHttpException: status code 500.
yii\web\TooManyRequestsHttpException: status code 429.
yii\web\UnauthorizedHttpException: status code 401.
yii\web\UnsupportedMediaTypeHttpException: status code 415.
 * 
 */
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
/**
 * Description of ResponseController
 *
 * @author Administrator
 */
class ResponseController extends Controller{
    
    public function actionIndex(){
        $response=\Yii::$app->response;
        //var_dump($response);
        echo "\n\n<br/><br/>";
        //throw new NotFoundHttpException;//如果需要指定请求失败，可抛出对应的HTTP异常
        //throw new HttpException(123);//抛出指定的状态码
        var_dump($response->statusCode);//状态码
    }
    
    /**
     * HTTP头部
     * 可在 response 组件中操控yii\web\Response::headers来发送HTTP头部信息
     * 头名称是大小写敏感的，在yii\web\Response::send()方法调用前新注册的头信息并不会发送给用户
     */
    public function actionHeader(){
        $headers = Yii::$app->response->headers;

        // 增加一个 Pragma 头，已存在的Pragma 头不会被覆盖。
        $headers->add('Pragma', 'no-cache');

        // 设置一个Pragma 头. 任何已存在的Pragma 头都会被丢弃
        $headers->set('Pragma', 'no-cache');

        // 删除Pragma 头并返回删除的Pragma 头的值到数组
        $values = $headers->remove('Pragma');
        var_dump($values);
    
    }
    
    /*
     * 响应主体
     * 大多是响应应有一个主体存放你想要显示给终端用户的内容。
     * yii\web\Response::FORMAT_HTML: 通过 yii\web\HtmlResponseFormatter 来实现.
     * yii\web\Response::FORMAT_XML: 通过 yii\web\XmlResponseFormatter来实现.
     * yii\web\Response::FORMAT_JSON: 通过 yii\web\JsonResponseFormatter来实现.
     * yii\web\Response::FORMAT_JSONP: 通过 yii\web\JsonResponseFormatter来实现.
     */
    public function actionBody(){
        $response=Yii::$app->response;
        //方式一:
        //已有格式化好的主体字符串,赋值到yii\web\Response::content属性
        $response->content="Hello World";
        
        //方式二:
        //隐式设置返回主体:
        //return $this->render('index');
        
        //方式三:
        //格式化发送数据
        //设置 yii\web\Response::format 和 yii\web\Response::data 属性,yii\web\Response::format 属性指定yii\web\Response::data中数据格式化后的样式
        $response->format= Response::FORMAT_JSON;
        $response->data=['message'=>'Hello World!','code'=>200];
        //$response->send();
        
        //方式四:
        //格式化发送数据
        //因为响应格式默认为yii\web\Response::FORMAT_HTML, 只需要在操作方法中返回一个字符串；如需发送其他响应格式在返回字符串前先设置格式
        //$response->format= yii\web\Response::FORMAT_JSON;
        //返回json格式的数据
//        return [
//            'message'=>'Hello World',
//            'code'=>100
//        ];
        
        //方式五:
        //创建自己的响应对象并发送到客户端
//        return Yii::createObject([
//            'class'=>'yii\web\Response',
//            'format'=> Response::FORMAT_JSON,
//            'data' =>[
//                'message'=>'Hello World!!',
//                'code'=>100,
//            ],
//        ]);
        
    }
    
    //浏览器跳转
    public function actionLocation(){
        //方式一;
        //return $this->redirect("http://www.baidu.com");//操作的方法返回的响应对象会被当总响应发送给终端用户
        //方式二:
        Yii::$app->response->redirect('http://www.baidu.com',301)->send();//默认设置状态码为302
    }
    
    /*
     * 发送文件
     * yii\web\Response::sendFile(): 发送一个已存在的文件到客户端
     * yii\web\Response::sendContentAsFile(): 发送一个文本字符串作为文件到客户端
     * yii\web\Response::sendStreamAsFile(): 发送一个已存在的文件流作为文件到客户端
     * 
     * 未测试成功，文件路径不会写
     */
    public function actionDownload(){
        return Yii::$app->response->sendFile('send_file_test.txt');
    }
    
    /**
     * 在yii\web\Response::send() 方法调用前响应中的内容不会发送给用户，该方法默认在yii\base\Application::run() 结尾自动调用，尽管如此，可以明确调用该方法强制立即发送响应。
yii\web\Response::send() 方法使用以下步骤来发送响应：
触发 yii\web\Response::EVENT_BEFORE_SEND 事件.
调用 yii\web\Response::prepare() 来格式化 yii\web\Response::data 为 yii\web\Response::content.
触发 yii\web\Response::EVENT_AFTER_PREPARE 事件.
调用 yii\web\Response::sendHeaders() 来发送注册的HTTP头
调用 yii\web\Response::sendContent() 来发送响应主体内容
触发 yii\web\Response::EVENT_AFTER_SEND 事件.
一旦yii\web\Response::send() 方法被执行后，其他地方调用该方法会被忽略， 这意味着一旦响应发出后，就不能再追加其他内容。

如你所见yii\web\Response::send() 触发了几个实用的事件，通过响应这些事件可调整或包装响应。
     */
    public function actionSend(){
        
    }
}
