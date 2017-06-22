<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * Html助手的测试界面
 * 
 */

use yii\helpers\Html;
?>

<!--静态页面部分:-->
<html>
    <div>
        <h1>静态页面的标题:</h1>
    </div>
    <table>

        <td>
        <tr>1.1</tr>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<tr>1.2</tr>
    </td>
</table>
<!--html里嵌入php代码-->
<?= Html::tag('h1', Html::encode($name), ['class' => 'username']) ?>

</html>

<!--生成标签-->
<!--
    参数一：标签名；参数二：开始标签和结束标签间内容；参数三：设置标签属性
    1.标签属性的值为NULL，对应的属性不会被渲染
    2.如果是布尔类型的值的属性，将会被当做 布尔属性 来处理。
    3.属性的值将会用 yii\helpers\Html::encode() 方法进行 HTML 转码处理。

-->
<?= Html::tag('h1', Html::encode($name), ['class' => NULL]) ?>

<!--如果属性的值是一个数组-->
<?= Html::tag('h1', Html::encode($name), ['class' => ['id' => 1, 'name' => 'yii']]) ?>


<!--生成CSS类和样式-->
<!--CSS类-->
<?php
$option = ['class' => 'btn btn-default'];
if ($type === 'success') {
    Html::removeCssClass($option, 'btn-default');
    Html::addCssClass($option, 'btn-success');
}

echo Html::tag('div', 'Pwede na', $option);
?>

<!--Style-->
<?php
$options = ['style' => ['width' => '100px', 'height' => '100px']];

// gives style="width: 100px; height: 200px; position: absolute;"
Html::addCssStyle($options, 'height: 200px; position: absolute;background:green');

// gives style="position: absolute;"
//Html::removeCssStyle($options, ['width', 'height']);
//echo Html::tag('div','style修改',$options);
?>

<!--标签内容的转码和解码-->
<?php
echo Html::encode($name);
echo Html::decode($name);
?>

<!--表单-->
<?= Html::beginForm("", 'post', ['enctype' => 'multipart/form-data']) ?>
<!--第一个参数为按钮的标题,第二个参数为标签属性-->
<?= Html::button('Press me', ['class' => 'teaser']) ?>
<?= Html::submitButton('Submit', ['class' => 'submit']) ?>
<?= Html::resetButton(Html::encode('Reset'), ['class' => 'reset']) ?>
<?= Html::endForm() ?>

<!--输入栏-->
<?= Html::beginForm("", 'post', ['enctype' => 'multipart/form-data']) ?>
<!--active inputs 依据指定的模型和属性获取数据，而普通 input 则是直接指定数据。-->
<!--type, input name, input value, options-->
<?= Html::input('text', 'name', '请输入内容', ['class' => 'btn']) ?>
<!--type, model, model attribute name, options-->
<?php //echo Html::activeInput('text', $user, 'name', []) ?>
<?= Html::endForm() ?>


<!--Radios 和 checkboxes--> 
<?= Html::radio('agree', true, ['label' => 'I agree']); ?>
<?php //echo Html::activeRadio($model, 'agree', ['class' => 'agreement'])  ?>

<?= Html::checkbox('agree', FALSE, ['label' => 'I agree']); ?>
<?php //echo Html::activeCheckbox($model, 'agree', ['class' => 'agreement'])  ?>

<!--Dropdown list 和 list box 将会如下渲染：-->
<!--第一个参数是 input 的名称，第二个是当前选中的值，第三个则是一个下标为列表值， 值为列表标签的名值对数组。-->
<?php //echo Html::dropDownList('list', $currentUserId, ArrayHelper::map($userModels, 'id', 'name'))  ?>
<?php //echo Html::activeDropDownList($users, 'id', ArrayHelper::map($userModels, 'id', 'name'))  ?>

<?php //echo Html::listBox('list', $currentUserId, ArrayHelper::map($userModels, 'id', 'name')) ?>
<?php //echo Html::activeListBox($users, 'id', ArrayHelper::map($userModels, 'id', 'name'))  ?>

<!--如果你需要使用多项选择， checkbox list 应该能够符合你的需求：-->
<?php //echo Html::checkboxList('roles', [16, 42], ArrayHelper::map($roleModels, 'id', 'name'))  ?>
<?php //echo Html::activeCheckboxList($user, 'role', ArrayHelper::map($roleModels, 'id', 'name'))  ?>
<!--否则，用 radio list ：-->

<?php //echo Html::radioList('roles', [16, 42], ArrayHelper::map($roleModels, 'id', 'name'))  ?>
<?php //echo Html::activeRadioList($user, 'role', ArrayHelper::map($roleModels, 'id', 'name'))  ?>

<!--Labels 和 Errors-->
<!--Yii 也提供了两个方法用于生成表单 label 。 带 ative 方法用于从 model 中取数据，另外一个则是直接接收数据。-->
<?php //echo Html::label('User name', 'username', ['class' => 'label username'])  ?>
<?php //echo Html::activeLabel($user, 'username', ['class' => 'label username'])  ?>

<!--为了从一个或者一组 model 中显示表单的概要错误，你可以使用如下方法：-->
<?php //echo  Html::errorSummary($posts, ['class' => 'errors'])  ?>
<!--为了显示单个错误：-->
<?php //echo  Html::error($post, 'title', ['class' => 'error']) ?>

<!--Input 的名和值-->

<!--样式表和脚本-->
<?= Html::style('.danger { color: red; }') ?>

Gives you

<!--<style>.danger { color: red; }</style>-->


<?php //echo Html::script('alert("Hello!");', ['defer' => true]); ?>

Gives you

<!--<script defer > alert("Hello!");</script>-->



<!--如果你想要外联 css 样式文件，可以如下做：-->
<?= Html::cssFile('@web/css/site.css', ['condition' => 'IE 5']) ?>

generates

<!--[if IE 5]>
    <link href="http://example.com/css/ie5.css" />
<![endif]-->


<!--为了外联 JavaScript 文件：-->
<?= Html::jsFile('@web/js/main.js') ?>


<!--超链接-->
<!--参数一:超链接的标题,参数二:href属性的值,参数三:标签的属性数组-->
<?= Html::a("超链接的标题", 'http://www.baidu.com', ['class' => 'profile-link', 'id' => 'abc']) ?>
<!--在需要的时候，你可以用如下代码生成 mailto 链接：-->
<?= Html::mailto('Contact us', '392771334@qq.com') ?>

<!--图片-->
<?= Html::img('http://b.hiphotos.baidu.com/baike/w%3D268%3Bg%3D0/sign=92e00c9b8f5494ee8722081f15ce87c3/29381f30e924b899c83ff41c6d061d950a7bf697.jpg', ['alt' => '我的图片']) ?>

<image src="https://ss3.bdstatic.com/70cFv8Sh_Q1YnxGkpoWK1HF6hhy/it/u=3771287340,4264471813&fm=117&gp=0.jpg" alt="图片无法显示"></image>
<img src="https://ss3.bdstatic.com/70cFv8Sh_Q1YnxGkpoWK1HF6hhy/it/u=3771287340,4264471813&fm=117&gp=0.jpg" alt="图片无法显示"/>

<!--列表-->
<!--无序列表可以如下生成：-->
<?php
$post=['a','b','c','d'];
Html::ul($post, ['item' => function($item, $index) {
        return Html::tag(
                        'li', $this->render('post', ['item' => $item]), ['class' => 'post']
        );
    }])
?>
<!--有序列表请使用 Html::ol() 方法。-->
