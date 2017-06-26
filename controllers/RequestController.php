<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 测试请求(Request)组件的控制器
 * 
 * 一个应用的请求是用 yii\web\Request 对象来表示的，该对象提供了诸如 请求参数（译者注：通常是GET参数或者POST参数）、HTTP头、cookies等信息
 * 
 */

namespace app\controllers;

use Yii;
use yii\web\Controller;

/**
 * Description of RequestController
 *
 * @author Administrator
 */
class RequestController extends Controller{
    
    //请求参数
    public function actionIndex($message="Hello World"){
        $request= Yii::$app->request;
        //$get = $request->get();
        // 等价于: $get = $_GET;
        //echo "$get";
        echo "\n\n<br/>";

        $id = $request->get('id');
        // 等价于: $id = isset($_GET['id']) ? $_GET['id'] : null;
        echo "$id";
        echo "\n\n<br/>";

        $id = $request->get('id', 1);
        // 等价于: $id = isset($_GET['id']) ? $_GET['id'] : 1;
        echo "$id";
        echo "\n\n<br/>";

        $post = $request->post();
        // 等价于: $post = $_POST;
        echo "$post";
        echo "\n\n<br/>";

        $name = $request->post('name');
        // 等价于: $name = isset($_POST['name']) ? $_POST['name'] : null;
        echo "$name";
        echo "\n\n<br/>";

        $name = $request->post('name', '');
        // 等价于: $name = isset($_POST['name']) ? $_POST['name'] : '';
        echo "$name";
        echo "\n\n<br/>";
    }
    
    //请求方法
    public function actionMethod(){
        $request = Yii::$app->request;
        $method=$request->method;
        echo "$method","\n\n<br/>";
        if ($request->isAjax) { 
            echo "该请求是一个 AJAX 请求";
        }
        if ($request->isGet) { 
            echo "请求方法是 GET";
        }
        if ($request->isPost) { 
            echo "请求方法是 POST";
        }
        if ($request->isPut) { 
            echo "请求方法是 PUT";
        }
    }
    
    //请求URL
    public function actionUrl(){
        $request = Yii::$app->request; //此URL不包括host info部分
        $url=$request->url;
        echo "$url","\n\n<br/>";
        
        $absoluteUrl = $request->absoluteUrl; // 包含host infode的整个URL
        echo "$absoluteUrl", "\n\n<br/>";
        
        $hostInfo = $request->hostInfo;// 只有host info部分
        echo "$hostInfo", "\n\n<br/>";
        
        $pathInfo = $request->pathInfo;//这个是入口脚本之后，问号之前（查询字符串）的部分
        echo "$pathInfo", "\n\n<br/>";
        
        $queryString = $request->queryString;//问号之后的部分
        echo "$queryString", "\n\n<br/>";
        
        $baseUrl = $request->baseUrl;//host info之后， 入口脚本之前的部分
        echo "$baseUrl", "\n\n<br/>";
        
        $scriptUrl = $request->scriptUrl;//没有path info和查询字符串部分
        echo "$baseUrl", "\n\n<br/>";
        
        $serverName = $request->serverName;// URL中的host name
        echo "$serverName", "\n\n<br/>";
        
        $serverPort = $request->serverPort;
        echo "$serverPort", "\n\n<br/>";//返回 80, 这是web服务中使用的端口
    }
    
    //HTTP头
    public function actionHeader(){
        $request= Yii::$app->request;
        $header= $request->headers;
        
        var_dump($header);
        echo "\n\n<br/>";
        
        $accept = $header->get('Accept');
        var_dump("$accept");
        echo "\n\n<br/>";
        
        $userAgent= $request->userAgent;//返回user-Agent头
        var_dump($userAgent);
        echo "\n\n<br/>";
        
        $contentType = $request->contentType; //返回contentType头
        var_dump($contentType);
        echo "\n\n<br/>";
        
        $acceptable=$request->acceptableContentTypes;//返回用户可接受的内容MIME类型。 返回的类型是按照他们的质量得分来排序的
        var_dump($acceptable);
        echo "\n\n<br/>";
        
        $languages=$request->acceptableLanguages;//返回用户可接受的语言。 返回的语言是按照他们的偏好层次来排序的。
        var_dump($languages);
        echo  "\n\n<br/>";
        
        $host=$request->userHost;
        var_dump($host);
        echo "\n\n<br/>";
        
        $ip = $request->userIP;
        var_dump($ip);
        echo "\n\n<br/>";
    }
}
