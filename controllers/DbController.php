<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 测试数据库访问和查询生成器的控制器
 * 
 */

namespace app\controllers;

use Yii;
use yii\web\Controller;

/**
 * Description of DbController
 *
 * @author Administrator
 */
class DbController extends Controller {
    //SQL基础查询，通过yii\db\Command执行 SQL 查询

    /**
     * SELECT查询
     */
    public function actionSelect() {
        $connection = Yii::$app->db;
        $command = $connection->createCommand('SELECT * FROM country'); //
        $country = $command->queryAll(); //查询返回多行
        var_dump($country);
        echo "\n\n<br/><br/>";

        $command = $connection->createCommand('SELECT * FROM country WHERE code="AU"');
        $countryOne = $command->queryOne(); //查询返回单行(满足条件的第一行)
        var_dump($countryOne);
        echo "\n\n<br/><br/>";

        $command = $connection->createCommand('SELECT name FROM country');
        $countryColumn = $command->queryColumn(); //查询多行单列
        var_dump($countryColumn);
        echo "\n\n<br/><br/>";

        $command = $connection->createCommand('SELECT COUNT(*) FROM country');
        $countryScalar = $command->queryScalar(); //查询标量值/计算值：
        var_dump($countryScalar);
        echo "\n\n<br/><br/>";
    }

    /**
     * UPDATE, INSERT, DELETE 更新、插入和删除等
     * 如果执行 SQL 不返回任何数据可使用命令中的 execute 方法：
     */
    public function actionIndex() {
        $connection=Yii::$app->db;
        $command = $connection->createCommand('UPDATE country SET population=99 WHERE code="AU"');//sql语句:更新country数据表,字段code为AU的行的字段population的值为99
        $command->execute();
        
    }
    
    /**
     * 使用API
     */
    public function actionApi(){
        $connection = Yii::$app->db;
        
        //insert
//        $connection->createCommand()->insert('country', [
//            'code'=>'BB',
//            'name'=>'CHINA',
//            'population'=>440183,
//        ])->execute();
        
        // INSERT 一次插入多行
//        $connection->createCommand()->batchInsert('country', ['code', 'name','population'], [
//            ['Tom', 30,456],
//            ['Jane', 20,123],
//            ['Linda', 25,789],
//        ])->execute();
        
         // update
        $connection->createCommand()->update('country', ['name'=>'Tom'],'code="To"')->execute();
        
        //delete
         $connection->createCommand()->delete('country', 'code="Li"')->execute();
    }
    
    /**
     * 
     */
    public function actionA(){
        
    }

}
