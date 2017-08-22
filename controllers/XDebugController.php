<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2017/8/22
 * Time: 21:17
 */

namespace app\controllers;
use yii\web\Controller;

class XDebugController extends Controller
{
    public function actionIndex(){
        phpinfo();
        $a = array();
        $a = "1";
        $a=3;
        print_r($a);

    }
}