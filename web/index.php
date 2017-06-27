<?php

// comment out the following two lines when deployed to production(在部署到生产环境时，注释以下两行)
//定义全局常量,常量定义应该在入口脚本的开头，这样包含其他 PHP 文件时，常量就能生效。
defined('YII_DEBUG') or define('YII_DEBUG', true); //标识应用是否运行在调试模式
//等同于:
//if (!defined('YII_DEBUG')) {//检查某常量是否存在
//    define('YII_DEBUG', true);
//}
defined('YII_ENV') or define('YII_ENV', 'dev'); //标识应用运行的环境

//注册各个类库的类文件加载器(Class AutoLoader)
// 注册 通过autoload.php文件加载的Composer 自动加载器
require(__DIR__ . '/../vendor/autoload.php');
// 注册通过 Yii 类加载的 Yii 自动加载器； 扩展类由 Yii class autoloader 自动加载
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');
// 加载应用配置
$config = require(__DIR__ . '/../config/web.php');

//类映射表（Class Map）:
//Yii::$classMap['yii\helpers\ArrayHelper']='@app/components/ArrayHelper.php';//用 Yii 自动加载器 来加载自定义类 代替框架的原始助手类
//
// 创建、配置、运行一个应用
(new yii\web\Application($config))->run();
/*
 * 路由:
 * 当入口脚本在调用 yii\web\Application::run() 方法时，它进行的第一个操作就是解析输入的请求，然后实例化对应的控制器操作处理这个请求。
 * 该过程就被称为引导路由（routing）（译注：中文里既是动词也是名词）
*/
