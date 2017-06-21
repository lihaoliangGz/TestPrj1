<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * say动作的视图
 * 
 */
use yii\helpers\Html;
?>
<?=Html::encode($message)?>
<br/>
<!--获取控制器ID-->
The controller ID is:<?= $this->context->id ?>
<br/>
The controller ID is: <?php echo $this->context->id ?>

<!--设置页面标题-->
<?php $this->title="我的页面设置" ?>


