<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * test控制器的say动作对应的页面
 * 被yii\web\Controller::render() 执行
 * ii\web\Controller::render() 方法会自动把 say 视图执行的结果嵌入称为布局的文件中，本例中是 views/layouts/main.php。
 * 
 */
//使用Html类
use yii\helpers\Html;
echo Html::encode("使用HTML类");
?>

<?= Html::encode($message);?>
<?php echo $message;?>

