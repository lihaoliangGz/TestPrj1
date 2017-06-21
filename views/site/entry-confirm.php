<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\helpers\Html;
?>
<p>你刚才输入的信息如下:</p>

<ul>
    <li><label>name</label>:<?=Html::encode($model->name)?></li>
    <li><label>email</label>:<?=Html::encode($model->email)?></li>
    
</ul>

