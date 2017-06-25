<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 创建可在begin()和end()调用中使用的Widget
 * 
 * PHP输出缓冲在init()启动，所有在init() 和 run()方法之间的输出内容都会被获取，并在run()处理和返回。
 * 
 * 当你调用 yii\base\Widget::begin() 时会创建一个新的小部件实例并在构造结束时调用init()方法， 在end()时会调用run()方法并输出返回结果。
 * 
 */

namespace app\components;

use yii\base\Widget;
use yii\helpers\Html;

/**
 * Description of Hello_2Widget
 *
 * @author Administrator
 */
class Hello_2Widget extends Widget{
    
    public function init() {
        parent::init();
        ob_start();
    }
    
    public function run() {
        $content= ob_get_clean();
        return Html::encode($content);
    }
}
