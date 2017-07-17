<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 显示数据->数据小部件->detailview测试
 * 
 * 测试失败
 * 
 */

use yii\widgets\DetailView;

echo 'detailview';

echo DetailView::widget([
    'model'=>$model,
    'attributes'=>[
        'code',
        //'name',
    ]
]);
