<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 一个继承Object的类的组件（不需要事件和行为两个功能时），像普通的PHP对象一样高效
 * 
 * 推荐使用getter 和 setter（读取器和设定器）方法来定义属性
 * 
 * 当继承 yii\base\Component 或 yii\base\Object 时，推荐你使用如下的编码风格：
若你需要重写构造方法（Constructor），传入 $config 作为构造器方法最后一个参数，然后把它传递给父类的构造方法。
永远在你重写的构造方法结尾处调用一下父类的构造方法。
如果你重写了 yii\base\Object::init() 方法，请确保你在 init 方法的开头处调用了父类的 init 方法。
 * 
 * yii\base\Object 类执行时的生命周期如下：
构造方法内的预初始化过程。你可以在这儿给各属性设置缺省值。
通过 $config 配置对象。配置的过程可能会覆盖掉先前在构造方法内设置的默认值。
在 yii\base\Object::init() 方法内进行初始化后的收尾工作。你可以通过重写此方法，进行一些良品检验，属性的初始化之类的工作。
对象方法调用。
前三步都是在对象的构造方法内发生的。这意味着一旦你获得了一个对象实例，那么它就已经初始化就绪可供使用。
 */

namespace app\components;

use yii\base\Object;

/**
 * Description of MyClass
 *
 * @author Administrator
 */
class MyClass extends Object{
    public $prop1;
    public $prop2;
    
    public function __construct($paraml,$config = array()) {//查看源码发现，$config参数为属性赋值
        // ... 配置生效前的初始化过程
        echo "$paraml","\n\n<br/>";
        parent::__construct($config);
    }
    
    public function init() {
        parent::init();
        
        //...配置生效后的初始化过程
    }
}
