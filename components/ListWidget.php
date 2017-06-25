<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 应用结构-->视图,测试小部件渲染
 * 
 * 对于 小部件 渲染的视图文件默认放在 WidgetPath/views 目录， 其中 WidgetPath 代表小部件类文件所在的目录
 * 
 * 如何使用这个小部件?
 * 
 */

namespace app\components;
use yii\base\Widget;
/**
 * Description of ListWidget
 *
 * @author Administrator
 */
class ListWidget extends Widget{
    public $item='item';
    
    public function run() {
        return $this->render('list', ['item'=> $this->item]);
        
        //调用小部件方法渲染视图
        //yii\base\Widget::render(): 渲染一个 视图名.
        //yii\base\Widget::renderFile(): 渲染一个视图文件目录或别名下的视图文件。
    }
}
