<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 关键概念->别名测试的控制器
 * 
 * 别名用来表示文件路径和 URL，这样就避免了在代码中硬编码一些绝对路径和 URL。
 * 一个别名必须以 @ 字符开头，以区别于传统的文件路径和 URL
 * 
 * 别名通常在引导阶段定义，可在入口脚本调用Yii::setAlias(),推荐在应用配置中设置
 * 
 */

namespace app\controllers;

use Yii;
use yii\web\Controller;

/**
 * Description of AliasesController
 *
 * @author Administrator
 */
class AliasesController extends Controller {

    /**
     * 定义别名
     * 注意：别名所指向的文件路径或 URL 不一定是真实存在的文件或资源
     * Yii::setAlias() 定义的别名称为根别名，例如：@foo 就是根别名，而 @foo/bar/file.php 是一个衍生别名
     */
    public function actionIndex() {
        //文件路径的别名;
        Yii::setAlias('@foo', 'app/models/Foo');

        //URL的别名
        Yii::setAlias('@baidu,', 'http://www.baidu.com');


        //用别名定义新别名
        Yii::setAlias('$foobar', '@foo/bar');
    }

    /**
     * 解析别名
     */
    public function actionGet() {
        Yii::setAlias('@foo', 'app/models/Foo');
        echo Yii::getAlias('@foo'), "\n\n<br/>";
        echo Yii::getAlias('@yii'), "\n\n<br/>";
        echo Yii::getAlias('@foo/bar/file.php'), "\n\n<br/>";
        var_dump(Yii::getAlias('@web'));
    }

    /**
     * Yii的预定义别名
     */
    public function actionPredefine() {
        echo Yii::getAlias('@yii'), "\n\n<br/>"; //框架安装目录
        echo Yii::getAlias('@app'), "\n\n<br/>"; //当前运行的应用 yii\base\Application::basePath
        echo Yii::getAlias('@runtime'), "\n\n<br/>"; //当前运行的应用的 yii\base\Application::runtimePath
        echo Yii::getAlias('@vendor'), "\n\n<br/>"; //yii\base\Application::vendorPath
        echo Yii::getAlias('@webroot'), "\n\n<br/>"; //当前运行应用的 Web 入口目录
        echo Yii::getAlias('@web'), "\n\n<br/>"; //当前运行应用的根 URL
    }

}
