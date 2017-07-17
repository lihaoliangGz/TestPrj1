<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 接收用户数据->搜集列表输入测试的控制器
 * 
 */

namespace app\controllers;
use Yii;
use yii\web\Controller;
use yii\base\Model;
use app\models\Setting;

/**
 * Description of ListInputController
 *
 * @author Administrator
 */
class ListInputController extends Controller {

    /**
     * yii\base\Model::loadMultiple() 将数据加载到一个数组中。
     * yii\base\Model::validateMultiple() 验证一系列模型。
     */
    public function actionUpdate() {
        $settings = Setting::find()->indexBy('id')->all();
        if (Model::loadMultiple($settings, Yii::$app->request->post()) && Model::validateMultiple($settings)) {
            foreach ($settings as $setting) {
                $setting->save(false);
            }
            return $this->redirect('index');
        }

        return $this->render('update', ['settings' => $settings]);
    }

}
