<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 过滤器测试的控制器
 * 
 */
namespace app\controllers;
use yii\web\Controller;
use app\components\ActionTimeFilter;
/**
 * Description of FilterController
 *
 * @author Administrator
 */
class FilterController extends Controller{
    
    /**
     * 
     * 在控制器中覆盖behaviors() 方法申明使用过滤器
     * 过滤器本质上是一类特殊的 行为
     * 控制器类的过滤器默认应用到该类的 所有 动作
     * 
     * 除了控制器外，可在 模块或应用主体 中申明过滤器。 申明之后，过滤器会应用到所属该模块或应用主体的 所有 控制器动作，
     * 除非像上述一样配置过滤器的 yii\base\ActionFilter::only 和 yii\base\ActionFilter::except 属性。
     * 
     */
    public function behaviors() {
         echo "执行behaviors()方法", "\n\n<br/><br/>";
         return[
              [
                //'class' => 'app\components\ActionTimeFilter',
                //等同于
                'class'=> ActionTimeFilter::className(),
                //'only' => ['a'],//yii\base\ActionFilter::only属性明确指定控制器应用到哪些动作
                'except' =>['d'],//yii\base\ActionFilter::except属性使一些动作不执行过滤器
//                'rules' => [
//                    [
//                        'actions' => ['logout'],
//                        'allow' => true,
//                        'roles' => ['@'],
//                    ],
//                ],
            ],
            
        ];
         
         //return [];
    }
    
    
    public function actionA(){
        echo "执行A()动作", "\n\n<br/><br/>";
    }
    
    public function actionB() {
        echo "执行B()动作", "\n\n<br/><br/>";
    }


    public function actionC() {
        echo "执行C()动作", "\n\n<br/><br/>";
    }

    public function actionD() {
        echo "执行D()动作", "\n\n<br/><br/>";
    }

}
