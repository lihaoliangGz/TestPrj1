<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 显示数据->排序测试的控制器
 * 
 *  yii\data\Sort 提供支持
 * 
 */
namespace app\controllers;

use yii\web\Controller;
use yii\data\Sort;
use app\models\Country_2;

/**
 * Description of SortController
 *
 * @author Administrator
 */
class SortController extends Controller{
    
    /**
     * 测试失败
     */
    public function actionIndex(){
         $sort =new Sort([
             'attributes'=>[
                 'code',
                 'name'=>[
                     'asc'=>['name'=>SORT_DESC],
                     'default' =>SORT_DESC,
                     'label'=>'NAME_abc',
                 ],
             ]
        ]);
         
         $models= Country_2::find()
                 ->orderBy($sort->orders)
                 ->all();
         
         return $this->renderPartial('index',[
             'models'=>$models,
             'sort'=>$sort,
         ]);
    }
}
