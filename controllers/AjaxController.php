<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace app\controllers;

use yii\web\Controller;

/**
 * Description of AjaxController
 *
 * @author Administrator
 */
class AjaxController extends Controller{
    
    public function actionIndex(){
        return "Hello World!!";
    }
}
