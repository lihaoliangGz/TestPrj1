<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 显示数据->数据提供者测试的控制器
 * 
 * 数据提供者是一个实现了 yii\data\DataProviderInterface 接口的类。 它主要用于获取分页和数据排序。
 * 数据提供者类包含
  yii\data\ActiveDataProvider：使用 yii\db\Query 或者 yii\db\ActiveQuery 从数据库查询数据并且以数组项的方式或者 Active Record 实例的方式返回。
  yii\data\SqlDataProvider：执行一段SQL语句并且将数据库数据作为数组返回。
  yii\data\ArrayDataProvider：将一个大的数组依据分页和排序规格返回一部分数据。
 * 
 */

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use yii\data\ArrayDataProvider;
use yii\db\Query;

/**
 * Description of DataProviderController
 *
 * @author Administrator
 */
class DataProviderController extends Controller {

    /**
     * 活动数据提供者  ,就只返回5条数据,没有下一页了.....
     */
    public function actionActive() {
        $provider = new ActiveDataProvider([
            'query' => (new Query())->from('country'),
            'pagination' => [
                'pageSize' => 5,
            ],
            'sort' => [
                'defaultOrder' => [
                //'code'=>SORT_DESC, //出错
                //'name'=>SORT_ASC,
                ],
            ],
        ]);

        //返回查询结果
        $models = $provider->getModels();
        // 在当前页获取数据项的数目
        $count = $provider->getCount();
        echo "$count", "\n\n<br/>\n\n";
        // 获取所有页面的数据项的总数
        $totalCount = $provider->getTotalCount();
        echo "$totalCount", "\n\n<br/>\n\n";
        foreach ($models as $model) {
            var_dump($model);
        }
    }

    /**
     * sql数据提供者
     */
    public function actionSql() {
        $count = Yii::$app->db->createCommand('SELECT COUNT(*) FROM country ')->queryScalar();

        $provider = new SqlDataProvider([
            //'sql' => 'SELECT * FROM post WHERE status=:status',
            //'params' => [':status' => 1],
            'sql' => 'SELECT * FROM country',
            'totalCount' => $count,
            'pagination' => [
                'pageSize' => 5,
            ],
            'sort' => [
                'attributes' => [
                    'code',
                    'name',
                    'population',
                ],
            ],
        ]);

        // 返回包含每一行的数组
        $models = $provider->getModels();
        var_dump($models);
    }
    
    /**
     * 数组数据提供者
     */
    public function actionArray(){
        
        
    }
    
    //创建自定义数据提供者....
    
    
}
