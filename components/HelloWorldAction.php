<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 独立操作类
 * 
 */
namespace app\components;
use yii\base\Action;
/**
 * Description of HelloWorldAction
 *
 * @author Administrator
 */
class HelloWorldAction extends Action{
    
    //实现run方法,和操作方法的角色类似
    public function run(){
        return 'Hello World';
    }
    
}
