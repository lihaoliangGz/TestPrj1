<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/22 0022
 * Time: 下午 2:21
 */

namespace app\controllers;
use yii\web\Controller;


class XDebugController extends Controller
{
    public function actionIndex(){
        phpinfo();
        $a = array();
        $a = '1';
        $a = 2;
        print_r($a);


    }
}