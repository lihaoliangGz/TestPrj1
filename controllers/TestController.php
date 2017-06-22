<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 入门测试的控制器
 * 
 */

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\EntryForm;
use app\models\Country;
use yii\data\Pagination;

class TestController extends Controller {

    //第一次问候
    //使用action前缀代表操作，没有action前缀代表普通方法
    //Yii如何处理操作ID和控制器ID ?
    //URL中参数r代表路由，格式是：控制器 ID/操作 ID
    public function actionSay($message = 'Hello') {
        //echo "Hello World";
        return $this->render('say', ['message' => $message]); //渲染名为"say"的视图文件并返回渲染结果
    }

    //使用表单模型
    /* 将会学到：
     * 创建一个模型代表用户通过表单输入的数据
     * 声明规则去验证输入的数据
     * 在视图中生成一个 HTML 表单 
     */
    //处理用户提交数据表单的动作
    public function actionEntry() {
        echo "<br/>";
        echo "<br/>";
        echo "<br/>";
        echo "<br/>";
        echo "<br/>";

        $model0 = new EntryForm();
        $model0->name = 'Qing';
        $model0->email = 'adg';
        if ($model0->validate()) {
            echo "验证成功", "<br/>";
        } else {
            //验证失败,获取失败信息
            var_dump($model0->getErrors());
            echo "<br/>";
        }

        var_dump(Yii::$app->request->post());
        echo "<br/>";
        $model = new EntryForm();
        //表达式 Yii::$app 代表应用实例，它是一个全局可访问的单例。同时它也是一个服务定位器，能提供 request，response，db 等等特定功能的组件。
        //在上面的代码里就是使用 request 组件来访问应用实例收到的 $_POST 数据。
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            //验证$model 收到的数据

            return $this->render('entry-confirm', ['model' => $model]);
        } else {
            //无论是初始化显示还是数据验证错误,都显示entry页面
            return $this->render('entry', ['model' => $model]);
        }
    }

    //使用数据库
    /*
     * 将会学到：
      配置一个数据库连接 config\db.php
      定义一个活动记录类 models\Country.php
      使用活动记录从数据库中查询数据
      以分页方式在视图中显示数据 views\test\country.php
     */
    public function actionCountry() {
        //获取country所有行并以name排序
        $all = Country::find()->orderBy('name')->all();
        //var_dump($all);        
        echo "<br/>";

        //获取主键为US的行
        $findOne = Country::findOne('US');
        var_dump($findOne);
        echo "<br/>";
        echo $findOne->name;
        echo "<br/>";
        echo $findOne->code;
        echo "<br/>";
        echo $findOne->population;

        //修改数据表的值:
        //$findOne->name="修改";
        //$findOne->save();

        echo "<br/>";
        echo "<br/>";
        echo "<br/>";
        echo "\n\n\n";

        $query = Country::find();
        //var_dump($query);

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);

        $countries = $query->orderBy('name')
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();

        return $this->render('country', [
                    'countries' => $countries,
                    'pagination' => $pagination,
        ]);
    }

}
