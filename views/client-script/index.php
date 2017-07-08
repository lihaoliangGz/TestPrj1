<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 显示数据->使用客户端脚本测试的视图
 * 使用 yii\web\View 对象注册脚本。这里有两个专门的方法：
 * （1）yii\web\View::registerJs() 用于内联脚本。 内联脚本通常用于配置和动态生成代码。 
 * （2）yii\web\View::registerJsFile() 用于注册引入外部脚本文件。 
 * 
 */

/**
 * 使用内联脚本：
 * 
 * 参数一:想插入的实际JS代码
 * 参数二:确定了JS代码插入页面的位置，可用的值如下：
    yii\web\View::POS_HEAD 用在HEAD部分。
    yii\web\View::POS_BEGIN 用在 <body> 标签的右边。
    yii\web\View::POS_END 用在 </body> 标签的左边。
    yii\web\View::POS_READY 为了在 ready 事件中执行代码，这里将自动注册yii\web\JqueryAsset。
    yii\web\View::POS_LOAD 为了在 load 事件中执行代码，这里将自动注册yii\web\JqueryAsset。
 * 参数三：是一个唯一的脚本ID，主要是用于标识一段代码块；若不传这个参数，JS代码本身将会作为ID来使用
 */
//$this->registerJs("var options = " . json_encode($options) . ";", View::POS_END, 'my-options');

/**
 * 使用外部脚本:
 * 
 * 
 */
//$this->registerJsFile('http://example.com/js/main.js', ['depends' => [\yii\web\JqueryAsset::className()]]);


/**
 * 注册资源包
 */
//\frontend\assets\AppAsset::register($this);


/**
 * 注册CSS
 * (1)yii\web\View::registerCss() ;注册一段CSS代码块
 * (2)yii\web\View::registerCssFile() ;注册引入外部的CSS文件
 */
$this->registerCSS("body { background: #f00; }");
//以上代码相当于在页面头部中添加了下面的代码：
//<style>
   //body {
       //background: #f00; 
   //}
//</style>


    