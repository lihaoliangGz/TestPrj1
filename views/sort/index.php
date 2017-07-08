<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 显示数据->排序测试的视图
 */

echo $sort->link('code').'  |  '.$sort->link('name'),"\n\n<br/>\n\n";

//foreach ($models as $model){
//    var_dump($model);
//    echo "\n<br/>\n";
//}
var_dump($models);