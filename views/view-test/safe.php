<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 对应ViewTestController控制器的safe操作的视图
 * 
 * $this 指向 yii\web\View ,可访问来管理和渲染这个视图文件
 * 
 * ViewTestController控制器类对应的目录为@app/views/view-test
 * 
 */

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
$this->title='视图测试';
?>

<div class="username">
    <?= Html::encode($safe) ?>
    <br/>
    <?= Html::encode($user->name)?>
    <br/>
    <?= HtmlPurifier::process($user->text)?>
</div>


