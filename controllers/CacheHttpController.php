<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * Http缓存测试的控制器
 * 
 * Http缓存由yii\filters\HttpCache 过滤器提供支持
 * 
 * 通过配置 yii\filters\HttpCache 过滤器，控制器操作渲染的内容就能缓存在客户端。
    yii\filters\HttpCache 过滤器仅对 GET 和 HEAD 请求生效，它能为这些请求设置三种与缓存有关的 HTTP 头。
    yii\filters\HttpCache::lastModified  使用时间戳标明页面自上次客户端缓存后是否被修改过
    yii\filters\HttpCache::etagSeed  “Entity Tag”（实体标签，简称 ETag）使用一个哈希值表示页面内容。如果页面被修改过，哈希值也会随之改变。通过对比客户端的哈希值和服务器端生成的哈希值，浏览器就能判断页面是否被修改过，进而决定是否应该重新传输内容。
    yii\filters\HttpCache::cacheControlHeader  Cache-Control 头指定了页面的常规缓存策略。可以通过配置 yii\filters\HttpCache::cacheControlHeader 属性发送相应的头信息
 * 
 */
namespace app\controllers;

use yii\web\Controller;
/**
 * Description of CacheHttpController
 *
 * @author Administrator
 */
class CacheHttpController extends Controller{
    
    /**
     * 
     */
    public function behaviors() {
        return[
            [
                'class'=>'yii\filters\HttpCache',
                'only'=>['index'],
                
                /**
                    * @param Action $action 当前处理的操作对象
                    * @param array $params “params” 属性的值
                    * @return integer 页面修改时的 Unix 时间戳
                    * 
                    * function ($action, $params)
                    *  
                */
                'lastModified' => function ($action, $params) {
                            $q = new \yii\db\Query();
                            return $q->from('country')->max('population');
                        },

                        //        
            ],
                                
             [
                'class' => 'yii\filters\HttpCache',
                'only' => ['view'],
                'etagSeed' => function ($action, $params) {
                    $post = $this->findModel(\Yii::$app->request->get('id'));
                    return serialize([$post->title, $post->content]);
                },
            ],
                        
        ];
    }
    
    /**
     * 
     */
    public function actionIndex(){
        
    }
    
    /**
     * 
     */
    public function actionView(){
        
    }
    
    //会话缓存限制器
    //...
    
    
    //SEO影响
    //...
}
