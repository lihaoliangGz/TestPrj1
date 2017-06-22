<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 助手类测试的控制器
 * 
 */

namespace app\controllers;

use yii\web\Controller;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * Description of HelpersController
 *
 * @author Administrator
 */
class HelpersController extends Controller {

    //Array助手
    public function actionArrayHelper() {

        //获取值
        $array = [
            'foo' => [
                'bar' => new User(),
            ]
        ];
        //方法参数一:我们从哪里获取值
        //方法参数二:数组键名或者欲从中取值的对象的属性名称；
        //以点号分割的数组键名或者对象属性名称组成的字符串
        //返回一个值的回调函数。
        $value = ArrayHelper::getValue($array, 'foo.bar.name', '默认值');
        echo "$value", "\n";

        //测试未通过
//        $user=new User;
//        $value2= ArrayHelper::getValue($array, function($user){
//            return "用户名是:".$user->name."\n";
//        });
        //获取值后立即从数组中删除:
        //注意：和 getValue 方法不同的是，remove 方法只支持简单键名。
        $array = array('type' => 'A', 'options' => [1, 2]);
        $type = ArrayHelper::remove($array, 'type');
        echo "type的值:", "$type", "\n";
        var_dump($array);

        //检查键名的存在:
        $date = [
            'username' => 'Alex',
        ];

        $date2 = [
            'username' => 'Lix',
        ];
        //参数三是忽略大小写
        var_dump(ArrayHelper::keyExists('Username', $date, FALSE));

        //检所列:
        $date3 = [
            ['id' => '123', 'date' => 'abc'],
            ['id' => '456', 'date' => 'def'],
        ];
        $column = ArrayHelper::getColumn($date3, 'id');
        var_dump($column);

        //重建数组索引
        $array = [
            ['id' => '123', 'data' => 'abc'],
            ['id' => '345', 'data' => 'def'],
        ];
        $result = ArrayHelper::index($array, 'id');
// the result is:
// [
//     '123' => ['id' => '123', 'data' => 'abc'],
//     '345' => ['id' => '345', 'data' => 'def'],
// ]
// using anonymous function
        $result = ArrayHelper::index($array, function ($element) {
                    return $element['id'];
                });

        var_dump($result);

        //建立哈希表
        $array5 = [
            ['id' => '123', 'name' => 'aaa', 'class' => 'x'],
            ['id' => '124', 'name' => 'bbb', 'class' => 'x'],
            ['id' => '345', 'name' => 'ccc', 'class' => 'y'],
        ];
        $map = ArrayHelper::map($array5, 'id', 'name');

        var_dump($map);

        var_dump(ArrayHelper::map($array5, 'id', 'name', 'class'));

        //多维排序:
        $data3 = [
            ['age' => 30, 'name' => 'Alexander'],
            ['age' => 30, 'name' => 'Brian'],
            ['age' => 19, 'name' => 'Barney'],
        ];
        $multisort = ArrayHelper::multisort($data3, ['age', 'name'], [SORT_ASC, SORT_DESC]);
        var_dump($multisort);


        $multisort0 = ArrayHelper::multisort($data3, function($item) {
                    return isset($item['age']) ? ['age', 'name'] : 'name';
                });
        var_dump($multisort0);

        //检查数组类型
        $indexed = ['Qiang', 'Wang'];
        var_dump(ArrayHelper::isIndexed($indexed)); //是索引数组,返回true
        $indexed = [
            'framework' => 'Yii',
            'version' => '1.0',
        ];
        var_dump(ArrayHelper::isIndexed($indexed)); //是关联数组,返回false
        //HTML编码和解码值
        $date = "abaldgj";
        $date2 = "dajgl;j";
        //$htmlEncode = ArrayHelper::htmlEncode($date);
        //$htmlDecode = ArrayHelper::htmlDecode($date2);
        //echo "$htmlEncode","\n","$htmlDecode";
        //合并数组
        //对象转换为数组:
        //ArrayHelper::toArray($indexed);
    }

    //Html助手
    public function actionHtmlHelper() {
        //html助手类的作用:


        $name = 'Alex';
        $type = 'success';
        $user = new User();

        $data = [
            'data' => ''
        ];
        return $this->render('html-helper', ['name' => $name, 'type' => $type, 'user' => $user]);
    }

    //Url助手
    public function actionUrlHelper($id = 2) {
        //获得通用URL，当前请求的 home URL 和 base URL 
        echo Url::home(); //生成相对url
        echo "<br/>";
        echo Url::home(true); //生成绝对url
        echo "<br/>";
        echo Url::home('https'); //指定具体的协议类型，生成绝对的https的url
        echo "<br/>";
        echo \Yii::$app->getHomeUrl();

        echo "<br/>";
        echo "<br/>";

        echo Url::base();
        echo "<br/>";
        echo Url::base(TRUE);
        echo "<br/>";
        echo Url::base('https');

        echo "<br/>";
        echo "<br/>";

        //创建URLs
        echo Url::toRoute('helpers/url-helper');
        echo "<br/>";
        echo Url::toRoute(['helpers/url-helper', 'id' => 42]); //附加查询参数的URL
        echo "<br/>";
        echo Url::toRoute(['helpers/url-helper', 'param1' => 'value1', 'param2' => 'value2']); //附加查询参数的URL
        echo "<br/>";
        echo Url::toRoute(['helpers/url-helper', 'param1' => 'value1', '#' => 'name']); //带有anchor(锚)的URL

        echo "<br/>";
        echo "<br/>";

        //创建的URL ,路由转换规则
        echo Url::toRoute('helpers/url-helper', TRUE);
        echo "<br/>";
        echo Url::toRoute('helpers/url-helper', 'https');

        echo "<br/>";
        echo "<br/>";

        // Url::to()方法
        //方法的第一个参数:
        //数组：将会调用 toRoute() 来生成URL。比如： ['site/index'], ['post/index', 'page' => 2] 。 详细用法请参考 toRoute() 。
        //带前导 @ 的字符串：它将会被当做别名， 对应的别名字符串将会返回。
        //空的字符串：当前请求的 URL 将会被返回；
        //普通的字符串：返回本身。
        echo Url::to(); //返回当前请求
        echo "<br/>";
        echo Url::to("site/index"); //返回字符串本身
        echo "<br/>";
        echo Url::to('@web');
        echo "<br/>";
        echo Url::to('');
        echo "<br/>";
        echo Url::to('@web', TRUE);
        echo "<br/>";
        echo Url::to('@web', 'https');

        echo "<br/>";
        echo "<br/>";

        // assume $_GET = ['id' => 123, 'src' => 'google'], current route is "post/view"
        // /index.php?r=post/view&id=123&src=google
        echo Url::current();
        echo "<br/>";
        // /index.php?r=post/view&id=123
        echo Url::current(['src' => null]);
        echo "<br/>";
        // /index.php?r=post/view&id=100&src=google
        echo Url::current(['id' => 100]);

        echo "<br/>";
        echo "<br/>";

        //记住Url
        Url::remember(['site/index', 'id' => 789], 'site'); //指定name
        
        Url::remember(); //记住当前URL
        echo Url::previous();
        echo "<br/>";
        Url::remember(['site/index', 'id' => 123]); //记住指定路由和参数的URL
        echo Url::previous();
        echo "<br/>";
        //Url::remember(['site/index', 'id' => 789],'site');//指定name
        echo Url::previous('site');
        
        echo "<br/>";
        echo "<br/>";
        
        //检查相对URL
        $relative = Url::isRelative('test/it');
        $relative1 = Url::isRelative('abcds');
        var_dump($relative);
        echo "<br/>";
        var_dump($relative1);
    }

}
