<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 入门-->操作数据库
 * 显示国家列表的视图
 * 
 */

use yii\helpers\Html;
use yii\widgets\LinkPager;
?>

<h1>Countries</h1>
<ul>
   
    <?php foreach ($countries as $country):?>
    <li>
        <?=Html::encode("{$country->name} ({$country->code})")?>
        <?=Html::encode($country->population)?>
    </li>
    <?php endforeach;?>
</ul>

<!--显示分页按钮的列表的小部件-->
<?=LinkPager::widget(['pagination'=>$pagination])?>