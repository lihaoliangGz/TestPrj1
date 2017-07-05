<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 缓存->数据缓存测试的控制器
 * 
 * 数据缓存需要缓存组件提供支持，它代表各种缓存存储器，例如内存，文件，数据库。
 * 
 * Yii 支持的缓存存储器，如下：
    yii\caching\ApcCache：使用 PHP APC 扩展。这个选项可以认为是集中式应用程序环境中（例如：单一服务器，没有独立的负载均衡器等）最快的缓存方案。
    yii\caching\DbCache：使用一个数据库的表存储缓存数据。要使用这个缓存，你必须创建一个与 yii\caching\DbCache::cacheTable 对应的表。
    yii\caching\DummyCache: 仅作为一个缓存占位符，不实现任何真正的缓存功能。这个组件的目的是为了简化那些需要查询缓存有效性的代码。
        例如，在开发中如果服务器没有实际的缓存支持，用它配置一个缓存组件。一个真正的缓存服务启用后，可以再切换为使用相应的缓存组件。
        两种条件下你都可以使用同样的代码 Yii::$app->cache->get($key) 尝试从缓存中取回数据而不用担心 Yii::$app->cache 可能是 null。
    yii\caching\FileCache：使用标准文件存储缓存数据。这个特别适用于缓存大块数据，例如一个整页的内容。
    yii\caching\MemCache：使用 PHP memcache 和 memcached 扩展。这个选项被看作分布式应用环境中（例如：多台服务器，有负载均衡等）最快的缓存方案。
    yii\redis\Cache：实现了一个基于 Redis 键值对存储器的缓存组件（需要 redis 2.6.12 及以上版本的支持 ）。
    yii\caching\WinCache：使用 PHP WinCache（另可参考）扩展.
    yii\caching\XCache：使用 PHP XCache扩展。
    yii\caching\ZendDataCache：使用 Zend Data Cache 作为底层缓存媒介。
 * 
 * 
 * Tip: 你可以在同一个应用程序中使用不同的缓存存储器。一个常见的策略是使用基于内存的缓存存储器存储小而常用的数据（例如：统计数据），
    使用基于文件或数据库的缓存存储器存储大而不太常用的数据（例如：网页内容）。
 */

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\caching\FileDependency;
/**
 * Description of CacheController
 *
 * @author Administrator
 */
class CacheDataController extends Controller{
    
    /**
     * 数据缓存
     * 
     * 
     * 
     *  API：
        yii\caching\Cache::get()：通过一个指定的键（key）从缓存中取回一项数据。如果该项数据不存在于缓存中或者已经过期/失效，则返回值 false。
        yii\caching\Cache::set()：将一项数据指定一个键，存放到缓存中。
        yii\caching\Cache::add()：如果缓存中未找到该键，则将指定数据存放到缓存中。
        yii\caching\Cache::mget()：通过指定的多个键从缓存中取回多项数据。
        yii\caching\Cache::mset()：将多项数据存储到缓存中，每项数据对应一个键。
        yii\caching\Cache::madd()：将多项数据存储到缓存中，每项数据对应一个键。如果某个键已经存在于缓存中，则该项数据会被跳过。
        yii\caching\Cache::exists()：返回一个值，指明某个键是否存在于缓存中。
        yii\caching\Cache::delete()：通过一个键，删除缓存中对应的值。
        yii\caching\Cache::flush()：删除缓存中的所有数据。
        有些缓存存储器如 MemCache，APC 支持以批量模式取回缓存值，这样可以节省取回缓存数据的开支。
        yii\caching\Cache::mget() 和 yii\caching\Cache::madd() API提供对该特性的支持。如果底层缓存存储器不支持该特性，Yii 也会模拟实现。
     */
    public function actionData(){
        $cache=Yii::$app->cache;
        $data=$cache->get('data');
        if(!$data){
            echo "没有缓存","\n<br/>";
            $cache->set('data', "缓存的数据",30);//可以设置缓存时间,保留30秒
        }
        
        echo $data,"\n<br/>\n";
        //$cache->delete('data');
        //var_dump($cache->exists('data'));
        //$cache->flush();
        
        //由于 yii\caching\Cache 实现了 PHP ArrayAccess 接口，缓存组件也可以像数组那样使用
        $cache['var1'] = "数组形式设置缓存";  // 等价于： $cache->set('var1', $value1);
        $value2 = $cache['var1'];  // 等价于： $value2 = $cache->get('var2');
        echo "$value2";
    }
    
    /**
     * 缓存依赖
     * 除了超时设置，缓存数据还可能受到缓存依赖的影响而失效
     * 
     * 可用的缓存依赖的概况：
        yii\caching\ChainedDependency：如果依赖链上任何一个依赖产生变化，则依赖改变。
        yii\caching\DbDependency：如果指定 SQL 语句的查询结果发生了变化，则依赖改变。
        yii\caching\ExpressionDependency：如果指定的 PHP 表达式执行结果发生变化，则依赖改变。
        yii\caching\FileDependency：如果文件的最后修改时间发生变化，则依赖改变。
        yii\caching\GroupDependency：将一项缓存数据标记到一个组名，你可以通过调用 yii\caching\GroupDependency::invalidate() 一次性将相同组名的缓存全部置为失效状态。
     */
    public function actionDependency(){
        // 创建一个对 example.txt 文件修改时间的缓存依赖
        $dependency=new FileDependency(['fileName'=>'example.txt']);
        $key='dependency';
        $cache=Yii::$app->cache;
        
        // 缓存数据将在180秒后超时
        // 如果 example.txt 被修改，它也可能被更早地置为失效状态。
        //$cache->set($key, "测试缓存依赖", 180, $dependency);
        
        // 缓存会检查数据是否已超时。
        // 它还会检查关联的依赖是否已变化。
        // 符合任何一个条件时都会返回 false。
        $data = $cache->get($key);
        var_dump($data);
        
        //测试失败
    }
    
    /**
     * 查询缓存
     */
    public function actionQuery(){
        //$duration = 60;     // 缓存查询结果60秒
       //$dependency = ...;  // 可选的缓存依赖

        //$db->beginCache($duration, $dependency);

        // ...这儿执行数据库查询...

        //$db->endCache();
    }
}
