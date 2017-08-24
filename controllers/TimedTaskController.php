<?php
/**
 *
 * 定时任务测试
 * Created by PhpStorm.
 * User: DELL
 * Date: 2017/8/24
 * Time: 21:01
 */

namespace app\controllers;
use yii\web\Controller;


class TimedTaskController extends Controller
{
    public function actionIndex(){
        echo '执行';
        file_put_contents('D:\Zdtvr\Projects\Test\TestPrj1\timed.txt',"\n项目根目录timed.txt文件,当前时间:".date('Y-m-d H:i:s',time()),FILE_APPEND);
        file_put_contents('timed.txt',"\nweb/timed.txt文件,当前时间:".date('Y-m-d H:i:s',time()),FILE_APPEND);
    }
}