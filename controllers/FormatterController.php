<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 显示数据->格式化输出数据测试的控制器
 * 
 * 利用yii\i18n\Formatter组件提供支持
 * 
 * 四种不同的快捷格式：
en_GB区域的 short 会打印日期为 06/10/2014，时间为 15:58
medium 会分别打印 6 Oct 2014 和 15:58:42,
long 会分别打印 6 October 2014 和 15:58:42 GMT,
full 会分别打印 Monday, 6 October 2014 和 15:58:42 GMT.
 用于Formatter的属性的某些值,
 * 
 */

namespace app\controllers;

use Yii;
use yii\web\Controller;

/**
 * Description of FormatterController
 *
 * @author Administrator
 */
class FormatterController extends Controller{
    
    //数据格式器
    /**
     * 直接使用格式化方法(所有的格式器方法以 as做前缀):
     */
    public function actionAs(){
        echo Yii::$app->formatter->asDate('2014-01-01','long'),"\n<br/>\n";// // 输出: January 1, 2014
        echo Yii::$app->formatter->asPercent(0.125,1),"\n<br/>\n";//参数二指定百分数的小数位,// 输出: 12.50%
        echo Yii::$app->formatter->asEmail('392771334@qq.com'),"\n<br/>\n";//输出: <a href="mailto:cebe@example.com">cebe@example.com</a>
        echo Yii::$app->formatter->asBoolean(TRUE),"\n<br/>\n";//输出: Yes
        echo Yii::$app->formatter->asDate(NULL),"\n<br/>\n";//输出: (not set) 
    }
    
    /**
     * 使用 yii\i18n\Formatter::format() 方法和格式化名
     */
    public function actionFormat(){
        echo Yii::$app->formatter->format('2014-01-01', 'date'),"\n<br/>\n"; //
        echo Yii::$app->formatter->format('2014-01-01', ['date']),"\n<br/>\n"; //
        echo Yii::$app->formatter->format('0.125', ['percent',3]),"\n<br/>\n"; //
        
    }
    
    /**
     * 格式化输出的区域性,测试失败,结果一样
     */
    public function actionLanguage(){
        Yii::$app->formatter->locale='en-US';
        echo Yii::$app->formatter->asDate('207-07-07','long'),"\n<br/>\n";
        
        Yii::$app->formatter->locale = 'de-DE';
        echo Yii::$app->formatter->asDate('2017-07-07', 'long'), "\n<br/>\n";
        
        Yii::$app->formatter->locale = 'ru-RU';
        echo Yii::$app->formatter->asDate('2017-07-07', 'long'), "\n<br/>\n";
        
        Yii::$app->formatter->locale = 'zh-CN';
        echo Yii::$app->formatter->asDate('2017-07-07', 'long'), "\n<br/>\n";
    }
    
    /**
     * 格式化日期和时间
     */    
    public function actionDate_time(){
        echo Yii::$app->formatter->asDate('2017-07-07'), "\n<br/>\n"; // 2017---07---07 
        echo Yii::$app->formatter->asTime('2017-07-07'), "\n<br/>\n"; //9:12:42 AM 
        echo Yii::$app->formatter->asTime('1412599260'), "\n<br/>\n"; //9:12:42 AM 
        echo Yii::$app->formatter->asDatetime('2017-07-07'), "\n<br/>\n"; //Jul 7, 2017 9:12:42 AM 
        echo Yii::$app->formatter->asTimestamp('2017-07-07'), "\n<br/>\n"; //1499411639 值被格式化成 unix 时间戳 
        echo Yii::$app->formatter->asRelativeTime('2017-07-07 14:16:12'), "\n<br/>\n"; //in 6 hours 值被格式化成和当前时间比较的时间间隔并用人们易读的格式
        
        //设置时区
        echo Yii::$app->timeZone= 'Europe/Berlin';
        
    }
    
    /**
     * 数字化格式
     */
    public function actionNum(){
        echo Yii::$app->formatter->asInteger('123'), "\n<br/>\n"; // 格式成整形 如 42.
        echo Yii::$app->formatter->asDecimal('123'), "\n<br/>\n"; // 格式化成十进制数字并带有小数位和千分位  如 42.123.
        echo Yii::$app->formatter->asPercent('123'), "\n<br/>\n"; // 格式化成百分率 如 42%.
        echo Yii::$app->formatter->asScientific('123'), "\n<br/>\n"; // 格式化成科学计数型  如4.2E4.
        echo Yii::$app->formatter->asCurrency('123'), "\n<br/>\n"; // 格式化成货币格式  如 £420.00.
        echo Yii::$app->formatter->asSize('123'), "\n<br/>\n"; // 格式化成易读的值，如 410 kibibytes.
    }
    
    /**
     * 其他格式器
     */
    public function actionOther(){
        echo Yii::$app->formatter->asRaw(123), "\n<br/>\n"; // 输出值和原始值一样
        echo Yii::$app->formatter->asText('<br/>'), "\n<br/>\n"; //  值会经过HTML编码
        echo Yii::$app->formatter->asNtext('<br/>'), "\n<br/>\n"; // 值会格式化成HTML编码的纯文本，新行会转换成换行符
        echo Yii::$app->formatter->asParagraphs('p标题'), "\n<br/>\n"; // - 值会转换成HTML编码的文本段落，用<p>标签包裹；
        echo Yii::$app->formatter->asHtml('<br/>'), "\n<br/>\n"; // 会被HtmlPurifier过滤来避免XSS跨域攻击，可传递附加选项如`['html', ['Attr.AllowedFrameTargets' => ['_blank']]]；
        echo Yii::$app->formatter->asEmail('329771334@qq.com'), "\n<br/>\n"; // 值会格式化成 mailto-链接
        echo Yii::$app->formatter->asImage('http://www.quanjing.com/image/2016index/road4.jpg'), "\n<br/>\n"; // 值会格式化成图片标签；输入图片地址,会显示图片
        echo Yii::$app->formatter->asUrl('http://www.baidu.com'), "\n<br/>\n"; // 值会格式化成超链接
        echo Yii::$app->formatter->asBoolean(TRUE), "\n<br/>\n"; // 值会格式化成布尔型值，默认情况下 true 对应 Yes，false 对应 No
    }
}
