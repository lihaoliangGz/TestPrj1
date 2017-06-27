<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 依赖注入容器测试的控制器
 * 
 */
namespace app\controllers;

use yii\web\Controller;
use yii\di\Container;
use app\models\Foo;
use app\models\Bar;
/**
 * Description of DependencyInjectionController
 *
 * @author Administrator
 */
class DependencyInjectionController extends Controller{
    
    /**
     * 构造方法注入
     */
    public function actionConstruct(){
        $container=new Container();
        $foo = $container->get('app\models\Foo');//get() 创建新的对象        
        // 上面的代码等价于：
        $bar=new Bar();
        $foo1=new Foo($bar);
    }
    
    /**
     * Setter和属性注入，不理解！！
     */
    public function actionSetter(){
        $container=new Container();
        $foo_2 = $container->get('app\models\Foo_2', [], [
           'bar'=>$container->get('app\models\Bar'),
           'qux'=>$container->get('app\models\Qux'),
        ]);
        
        var_dump( $foo_2->bar);
        echo "\n\n<br/>";
        var_dump($foo_2->getQux());
    }
    
    /**
     * PHP回调注入，不理解！！
     */
    public function actionPHP(){
        $container=new Container();
        $set = $container->set('app\models\Foo', function (){
            return new Foo(new Bar);
        });
        $foo = $container->get('app\models\Foo');
        var_dump($foo);
        
         $container= \Yii::$container;
        $foo = $container->get('app\models\Foo');
        var_dump($foo);
    }
    
    /**
     * 注册依赖关系
     */
    public function actionSet(){
        
    }
    
    /**
     * 解决依赖关系
     */
    public function actionSettle(){
        
    }
    
    /**
     * 实践中的运用
     */
    public function actionTest(){
        
    }
            
}
