<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 显示数据->分页测试的控制器
 * 
 *  \yii\data\Pagination提供支持
 * 需要创建 \yii\data\Pagination 对象为其填充数据，例如 \yii\data\Pagination::$totalCount， \yii\data\Pagination::$pageSize 和 \yii\data\Pagination::$page，在 查询中使用它并且填充到 \yii\widgets\LinkPager。
 * 
 * 如果你使用 数据提供者 和 数据小部件 中之一， 分页已经自动为你整理
 * 
 */
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Country_2;
use yii\data\Pagination;
/**
 * Description of PaginationController
 *
 * @author Administrator
 */
class PaginationController extends Controller{
    
    /**
     * 
     */
    public function actionIndex(){
        $query = Country_2::find()->where([]);
        $countQuery = clone $query;        
        $pages = new Pagination(['totalCount' => $countQuery->count()]);//数据的条数
        $models = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();

        return $this->renderPartial('index', [
                    'models' => $models,
                    'pages' => $pages,
        ]);
    }
}
