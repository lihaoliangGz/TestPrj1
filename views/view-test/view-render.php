<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 对应ViewTestController控制器的view-render操作的视图
 * 
 */
use yii\helpers\Html;
?>

<h1>视图中渲染</h1>

<?=$this->render('_overview')?>
<!--
yii\base\View::render(): 渲染一个 视图名.
yii\web\View::renderAjax(): 渲染一个 视图名 并注入所有注册的JS/CSS脚本和文件，通常使用在响应AJAX网页请求的情况下。
yii\base\View::renderFile(): 渲染一个视图文件目录或别名下的视图文件。
-->