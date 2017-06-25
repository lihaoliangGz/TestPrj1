<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 创建小部件
 * 
 */

namespace app\components;
use yii\base\Widget;
use yii\helpers\Html;
/**
 * Description of HelloWidget
 * 
 * @author Administrator
 */
class HelloWidget extends Widget{
    public $message;
    
    /**
     * init()
     * init()方法处理小部件属性
     */
    public function init() {
        parent::init();
        if($this->message===NULL){
            $this->message='Hello World';
        }
    }

    /**
     * 覆盖run()
     * run()方法包含小部件生成渲染结果的代码
     */
    public function run() {
        return Html::encode($this->message);
    }
    
    
    
}
