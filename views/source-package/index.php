<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 使用资源包测试
 * 
 */

echo "使用资源包测试";
//先调用yii\web\AssetBundle::register()方法注册资源包
use yii\web\AssetBundle;

AssetBundle::register($this);//$this代表视图对象
//如果在其他地方注册资源包，应提供视图对象，如在 小部件 类中注册资源包， 可以通过 $this->view 获取视图对象。
?>

