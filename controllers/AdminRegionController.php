<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 创建行政区划关联的控制器
 * 
 */
namespace app\controllers;

use Yii;
use yii\db\Query;
use yii\web\Controller;
/**
 * Description of AdminRegionController
 *
 * @author Administrator
 */
class AdminRegionController extends Controller{
    
    public function actionIndex(){
//        $db2=Yii::$app->secondDb;
//        //var_dump($db2);
//        //11500;
//        $command = $db2->createCommand('SELECT id,code FROM c2_region_new ORDER BY id LIMIT 500 OFFSET 3000');
//        $code= $command->queryAll(); //查询返回多行
//        foreach ($code as $key => $value) {
//            $code=$value['code'];
//            $id=$value['id'];
//            $update = $db2->createCommand("UPDATE c2_region_rs_new SET parent_id=$id WHERE parent_code=$code"); 
//            $update->execute();
//            var_dump($value);
//        }
        
//        $query=(new Query())->select('code,id')
//                ->from('c2_region_new');
//        foreach ($query->batch() as $values) {
//            var_dump($values);
////            $code = $value['code'];
////            $id=$value['id'];
////            $update = $db2->createCommand("UPDATE c2_region_rs_new SET parent_id=$id WHERE parent_code=$code"); 
////            $update->execute();
//        }
        echo "完成";
    }
}
