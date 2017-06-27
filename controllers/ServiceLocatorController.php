<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 服务定位器测试的控制器
 * 
 * 服务定位器是一个了解如何提供各种应用所需的服务（或组件）的对象
 * 服务定位器中，每个组件都只有一个单独的实例，并通过ID 唯一地标识
 * 
 * 最常用的服务定位器是application（应用）对象，可以通过 \Yii::$app 访问
 */

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\di\ServiceLocator;
use yii\caching\FileCache;

/**
 * Description of ServiceLocatorController
 *
 * @author Administrator
 */
class ServiceLocatorController extends Controller {

    /**
     * 
     */
    public function actionIndex() {
        $serviceLocator = new ServiceLocator();
        var_dump($serviceLocator->has('db')); //检查某组件ID是否被注册
        echo "\n\n<br/>";
        var_dump($serviceLocator->has('cache'));
        echo "\n\n<br/><br/>";

        $app = Yii::$app;
        //var_dump($app);
        //var_dump(Yii::$classMap);
        echo "\n\n<br/><br/>";
        var_dump(Yii::$aliases);
        echo "\n\n<br/><br/>";
    }

    /**
     * 注册组件
     */
    public function actionSet() {
        $locator = new ServiceLocator;

        // 通过一个可用于创建该组件的类名，注册 "cache" （缓存）组件。
        $locator->set('cache', 'yii\caching\ApcCache');

        // 通过一个可用于创建该组件的配置数组，注册 "db" （数据库）组件。
        $locator->set('db', [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=demo',
            'username' => 'root',
            'password' => '',
        ]);

        // 通过一个能返回该组件的匿名函数，注册 "search" 组件。
        $locator->set('search', function () {
            return new app\components\SolrService;
        });

        // 用组件注册 "pageCache" 组件
        $locator->set('pageCache', new FileCache);
        
        //通过ID访问组件
        //$cache = $locator->get('cache');
        // 或者
        //$cache = $locator->cache;
    }

}
