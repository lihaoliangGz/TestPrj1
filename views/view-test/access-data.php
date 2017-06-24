<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 测试视图中访问数据的推送方式。
 * 
 */
use yii\helpers\Html;
?>

推送:
<br/>
<?php 
var_dump(isset($data_1));
if(isset($data_1)) {//判断$data_1是否已经赋值
    echo Html::encode($data_1);
}
echo "\n\n<br/><br/>";
?>

拉取:
<br/>
The Controller ID: <?= $this->context->id?>
