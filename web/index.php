<?php

// comment out the following two lines when deployed to production(在部署到生产环境时，注释以下两行)
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

// 注册 Composer 自动加载器
require(__DIR__ . '/../vendor/autoload.php');
// 包含 Yii 类文件(自动加载器)
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');
// 加载应用配置
$config = require(__DIR__ . '/../config/web.php');

//用 Yii 自动加载器 来加载自定义类 代替框架的原始助手类
//Yii::$classMap['yii\helpers\ArrayHelper']='@app/components/ArrayHelper.php';

// 创建、配置、运行一个应用
(new yii\web\Application($config))->run();
