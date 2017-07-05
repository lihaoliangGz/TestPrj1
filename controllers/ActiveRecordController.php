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
}
