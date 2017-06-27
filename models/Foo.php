<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 用于依赖注入中，构造方法注入的测试
 * 
 */

namespace app\models;

/**
 * Description of Foo
 *
 * @author Administrator
 */
class Foo {
    
    public function __construct() {
        echo "Foo的构造方法执行","\n\n,<br/>";
    }
    
    public function __destruct() {
        echo "Foo对象被销毁前(即从内存中清除)调用", "\n\n,<br/>";
    }
}
