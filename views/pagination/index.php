<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 显示数据->分页测试的视图
 * 
 * 测试失败
 * 
 */

foreach ($models as $model) {
    var_dump($model);
}

echo "\n\n<br/><br/>\n\n";

//显示分页
echo yii\widgets\LinkPager::widget([
    'pagination' =>$pages,
]);
