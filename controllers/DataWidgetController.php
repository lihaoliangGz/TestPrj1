<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 显示数据->数据小部件
 * 
 */

namespace app\controllers;
use yii\web\Controller;
use app\models\Country;
/**
 * Description of DataWidgetController
 *
 * @author Administrator
 */
class DataWidgetController extends Controller{
    
    
    /**
     * DetailView小部件
     */
    public function actionDetailView(){
        $model=new Country();
        return $this->renderPartial('detail-view', $model);
    }
}
