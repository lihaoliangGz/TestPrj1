<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 安全->安全领域最佳实践测试的控制器
 * 
 * 基本准则:
 *   过滤输入
 *   转义输出
 * 
 */
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Html;
/**
 * Description of SecurePracticeController
 *
 * @author Administrator
 */
class SecurePracticeController extends Controller{
    
    /**
     * 过滤输入
     */
    public function actionIndex(){
        $sortBy=$_GET['sort'];
        if(!in_array($sortBy, ['title','name','code'])){
            //throw new Exception("无效的排序值");
            echo "无效的排序值";
        }
    }
    
    //转义输出
    /**
     * 避免SQL注入
     */
    public function actionSql(){
        $username=$_GET['username'];
        $sql="select * from delete where name= '$username'";
        $connection=Yii::$app->db;
        $queryAll = $connection->createCommand($sql)->queryAll();
        var_dump($queryAll);
    }
    
    /**
     * 防止XSS攻击
     * 避免 XSS 攻击在 Yii 中非常简单，有如下两种一般情况：
        数据以纯文本输出。
        数据以 HTML 形式输出。
     */
    public function actionXss(){
        //$result=$_GET['result'];
        $result="<script>alert('Hello!');</script>";
        echo Html::encode($result);
    }
    
    /**
     * 
     * CSRF 是跨站请求伪造的缩写。这个攻击思想源自许多应用程序假设来自用户的浏览器请求是由用户自己产生的，而事实并非如此。
     * 比如说：an.example.com 站点有一个 /logout URL，当以 GET 请求访问时，登出用户。
     * 如果它是由用户自己操作的，那么一切都没有问题。但是，有一天坏人在一个用户经常访问的论坛发了一个 <img src="/docs/guide/2.0/http://an.example.com/logout"> 内容的帖子。
     * 浏览器无法辨别请求一个图片还是一个页面，所以，当用户打开含有上述标签的页面时，他将会从 an.example.com 登出。
     */
    public function actionCsrf(){
        
    }
    
    
    /**
     * 防止文件暴露
     * 
     * 默认的服务器 webroot 目录指向包含有 index.php 的 web 目录。在共享托管环境下，这样是不可能的，这样导致了所有的代码，配置，日志都在webroot目录。
     * 如果是这样，别忘了拒绝除了 web 目录以外的目录的访问权限。如果没法这样做，考虑将你的应用程序托管在其他地方。
     * 
     */



/**
 * 在生产环境关闭调试信息和工具
 * 在调试模式下， Yii 展示了大量的错误信息，这样是对开发有用的。同样，这些调试信息对于攻击者而言也是方便其用于破解数据结构，配置值，以及你的部分代码。
 * 永远不要在生产模式下将你的 index.php 中的 YII_DEBUG 设置为 true。
 * 你同样也不应该在生产模式下开启 Gii。它可以被用于获取数据结构信息，代码，以及简单的用 Gii 生成的代码覆盖你的代码。
 * 调试工具栏同样也应该避免在生产环境出现，除非非常有必要。它将会暴露所有的应用和配置的详情信息。如果你确定需要，反复确认其访问权限限定在你自己的 IP。
 */





}
