<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 创建过滤器测试
 * 
 * 创建一个记录动作执行时间日志的过滤器
 */

namespace app\components;
use yii\base\ActionFilter;
/**
 * Description of ActionTimeFilter
 *
 * @author Administrator
 */
class ActionTimeFilter extends ActionFilter{
    private $_startTime;
    
    /**
     * 
     * @param type $action
     * @return type
     * 预过滤（过滤逻辑在动作之前）
     */
    public function beforeAction($action) {
        echo "ActionTimeFilter过滤器的beforeAction()方法执行","\n\n<br/><br/>";
        //$this->_startTime->microtime(true);//microtime()方法未定义,报错
        return parent::beforeAction($action);
    }
    
    /**
     * 
     * @param type $action
     * @param type $result
     * @return type
     * 后过滤（过滤逻辑在动作之后）
     */
    public function afterAction($action, $result) {
        echo "ActionTimeFilter过滤器的afterAction()方法执行", "\n\n<br/><br/>";
        //$time = microtime(true) - $this->_startTime; //microtime()方法未定义,报错
        //Yii::trace("Action '{$action->uniqueId}' spent $time second.");
        return parent::afterAction($action, $result);
    }
}
