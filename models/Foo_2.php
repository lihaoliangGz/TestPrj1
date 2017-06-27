<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 用于依赖注入中setter和属性注入的测试
 * 
 */

namespace app\models;

use yii\base\Object;
/**
 * Description of Foo_2
 *
 * @author Administrator
 */
class Foo_2 extends Object{
    public $bar;
    private $_qux;
    
    public function getQux(){
        return $this->_qux;
    }
    
    public function setQux(Qux $qux){
        $this->_qux=$qux;
    }
}
