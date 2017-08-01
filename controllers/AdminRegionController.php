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
    
    //操作全国地址数据库
    public function actionIndex(){
        $db3=Yii::$app->threeDb;
        //var_dump($db2);
        //11500;
        $command = $db3->createCommand('SELECT id,code FROM c2_region_three ORDER BY id LIMIT 500 OFFSET 0');
        $code= $command->queryAll(); //查询返回多行
        foreach ($code as $key => $value) {
            $code=$value['code'];
            $id=$value['id'];
            //$update = $db3->createCommand("UPDATE c2_region_rs_three SET parent_id=$id WHERE parent_code=$code"); 
            //$update->execute();
            var_dump($value);
        }
        
//        $query=(new Query())->select('code,id')
//                ->from('c2_region_new');
//        foreach ($query->batch() as $values) {
//              var_dump($values);
////            $code = $value['code'];
////            $id=$value['id'];
////            $update = $db3->createCommand("UPDATE c2_region_rs_three SET parent_id=$id WHERE parent_code=$code"); 
////            $update->execute();
//        }
        echo "完成";
    }
    
    //查询全国地址
    public function actionSelect(){
        $db3=Yii::$app->threeDb;
        //查父级
        $type=1;
        $commandParent = $db3->createCommand("SELECT label,id FROM c2_region_three WHERE type=$type ORDER BY id ");
        $codeParent= $commandParent->queryAll(); //查询返回多行
        var_dump($codeParent);
        
        //查子级
        $parent_id=1;
        $commandSub = $db3->createCommand("SELECT child_id FROM c2_region_rs_three WHERE parent_id=$parent_id ORDER BY child_id ");
        $codeSub = $commandSub->queryAll(); //查询返回多行
        var_dump($codeSub);
    }
}
