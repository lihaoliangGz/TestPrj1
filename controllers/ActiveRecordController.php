<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 测试Active Record的控制器 ,对应的AR类是:app\models\Country.php
 * 
 * 一个 AR 类关联一张数据表， 每个 AR 对象对应表中的一行，对象的属性（即 AR 的特性Attribute）映射到数据行的对应列。
 * 一条活动记录（AR对象）对应数据表的一行，AR对象的属性则映射该行的相应列。
 * 
 */
namespace app\controllers;

use yii\web\Controller;
use app\models\Country;
/**
 * Description of ActiveRecordController
 *
 * @author Administrator
 */
class ActiveRecordController extends Controller{
    
    /**
     * 访问列数据
     * 
     * 测试不成功
     */
    public function actionAccess(){
        $country=new Country();
        $code=$country->code;
        $name=$country->name;
        echo $code,"\n\n<br/>";
        echo $name,"\n\n<br/>";
        
    }
    
    /**
     * 查询数据
     */
    public function actionQuery(){
        $result=Country::find()
                ->select('*')
                ->asArray() //一数组形式获取数据
                ->all();
        
        var_dump($result);
        
        echo "\n\n<br/><br/>\n\n";
        
        $result1 = Country::find()
                ->select('*')
                ->where(['population'=>'1147000'])
                ->asArray() //一数组形式获取数据
                ->all();

        var_dump($result1);

        echo "\n\n<br/><br/>\n\n";

        $sql='select * from country';//查询的是country表
        $result2=Country::findBySql($sql)
                ->asArray()
                ->all();
        var_dump($result2);
        echo "\n\n<br/><br/>\n\n";

        //findOne 和 findAll() 用来返回一个或者一组ActiveRecord实例
        //...
        
        //批量获取数据
        foreach (Country::find()->batch(5) as $countries) {
             // $countries 是 5 个或更少的客户对象的数组
             var_dump($countries);
            echo "\n\n<br/><br/>\n\n";
        }
        
        foreach (Country::find()->each(6) as $country) {
            // $country 是一个 ”Country_2“ 对象
            var_dump($country);
            echo "\n\n<br/><br/>\n\n";
        }
        
    }
    
    /**
     * 操作数据
     * AR 提供以下方法插入、更新和删除与 AR 对象关联的那张表中的某一行：
        yii\db\ActiveRecord::save()
        yii\db\ActiveRecord::insert()
        yii\db\ActiveRecord::update()
        yii\db\ActiveRecord::delete()
        AR 同时提供了一下静态方法，可以应用在与某 AR 类所关联的整张表上。 用这些方法的时候千万要小心，因为他们作用于整张表！ 比如，deleteAll() 会删除掉表里所有的记录。

        yii\db\ActiveRecord::updateCounters()
        yii\db\ActiveRecord::updateAll()
        yii\db\ActiveRecord::updateAllCounters()
        yii\db\ActiveRecord::deleteAll()
     */
    public function actionOperate(){
        // 插入新客户的记录
        //$country=new Country();
        //$country->code='AB';
        //$country->name='AABBCC';
        //$country->save();// 等同于 $customer->insert();
        
        //更新现有记录
        //$country1 = Country::findOne(['code'=>'AB']);
        //$country1->population=112233;
        //$country1->save();
        
        // 删除已有记录
        $country2 = Country::findOne(['code' => 'AB']);
        $country2->delete();
        
        //示例:
        // 删除多个年龄大于20，性别为男（Male）的客户记录
        //Customer::deleteAll('age > :age AND gender = :gender', [':age' => 20, ':gender' => 'M']);

        // 所有客户的age（年龄）字段加1：
        //Customer::updateAllCounters(['age' => 1]);

        /**
         * 
         * 须知：save() 方法会调用 insert() 和 update() 中的一个， 用哪个取决于当前 AR 对象是不是新对象（在函数内部，他会检查 yii\db\ActiveRecord::isNewRecord 的值）。
         *  若 AR 对象是由 new 操作符 初始化出来的，save() 方法会在表里插入一条数据； 如果一个 AR 是由 find() 方法获取来的， 则 save() 会更新表里的对应行记录
         */
        
        
    }
    
    /**
     * 数据输入与有效性验证
     */
    public function actionAuth(){
        
    }
    
    
    
}
