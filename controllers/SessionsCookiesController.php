<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 测试sessions和cookies的控制器
 * 在纯PHP中，可以分别使用全局变量$_SESSION 和$_COOKIE 来访问
 * 和 请求 和 响应类似， 默认可通过为yii\web\Session 实例的session 应用组件 来访问sessions
 */

namespace app\controllers;

use Yii;
use yii\web\Controller;
/**
 * Description of SessionsCookiesController
 *
 * @author Administrator
 */
class SessionsCookiesController extends Controller{
    
    public function actionSessionsIndex(){
        $session=Yii::$app->session;
        
        //开启session
        $session->open();
        
        //关闭session
        //$session->close();
        
        //销毁session中所有已经注册的数据
        $session->destroy();
        
        //检查session 是否开启
        if($session->isActive){
            echo "session已经开启","\n\n<br/>";
        } else {
            echo "session未开启", "\n\n<br/>";
        }
    }
    
    /**
     * 访问session
     * 当使用session组件访问session数据时候，如果session没有开启会自动开启， 这和通过$_SESSION不同，$_SESSION要求先执行session_start()。
     */
    public function actionSessionsAccess(){
        $session=Yii::$app->session;
        
        //设置一个session，以下用法相同：
        $session->set('language', 'en-US');
        $session['language']='en-US';
        $_SESSION['language']='en-US';
        
        // 检查session变量是否已存在，以下用法是相同的：
        if($session->has('language')) echo "language的session存在","\n<br/>";
        if(isset($session['language'])) echo "language的session存在", "\n<br/>";
        if(isset($_SESSION['language'])) echo "language的session存在", "\n<br/>";

        // 删除一个session变量，以下用法是相同的：
        $session->remove('language');
        unset($session['language']);
        unset($_SESSION['language']);


        // 获取session中的变量值，以下用法是相同的：
        $language=$session->get('language');
        var_dump($language);
        echo "\n<br/>";
        $language=$session['language'];
         var_dump($language);
        echo "\n<br/>";
        $language= isset($_SESSION['language'])?$_SESSION['language']:NULL;
         var_dump($language);
        echo "\n<br/>";
        
        //遍历所有session，以下用法想同
        foreach ($session as $key => $value) {
            var_dump( "$key");
            echo "\n<br/>";
            var_dump($value);
            echo "\n\n<br/><br/>";
        }
         
        echo "\n<br/>";
        
        foreach ($_SESSION as $key => $value) {
            var_dump("$key");
            echo "\n<br/>";
            var_dump($value);
            echo "\n\n<br/><br/>";
        }
    }
    
    /**
     * session修改
     * 当session数据为数组时，session组件会限制直接修改数据中的单元项
     */
    public function actionSessionsModified(){
        $session=Yii::$app->session;
        
        //先设置session用于测试
        $session->set('captcha', ['number'=>5,'lifetime'=>3600]);
        var_dump($session->get('captcha'));
        echo "\n<br/>";
        
        // 如下代码不会生效，还会报Indirect modification of overloaded element of yii\web\Session has no effect的错误
        //$session['captcha']['number'] = 5;
        //$session['captcha']['lifetime'] = 3600;
        // var_dump($session->get('captcha'));
        //echo "\n<br/>";
        
        //如下代码生效
        $session['captcha']=[
            'number'=>10,
            'lifetime'=>7200,
        ];
        var_dump($session->get('captcha'));
        echo "\n<br/>";
        
        //如下代码也会生效
        echo $session['captcha']['number'],"\n<br/>";
        echo $session['captcha']['lifetime'],"\n<br/>";
        
        //可使用以下任意一个变通方法来解决这个问题
        // 直接使用$_SESSION (确保Yii::$app->session->open() 已经调用)
        $_SESSION['captcha']['number'] = 5;
        $_SESSION['captcha']['lifetime'] = 3600;

        // 先获取session数据到一个数组，修改数组的值，然后保存数组到session中
        $captcha = $session['captcha'];
        $captcha['number'] = 5;
        $captcha['lifetime'] = 3600;
        $session['captcha'] = $captcha;

        // 使用ArrayObject 数组对象代替数组
        $session['captcha'] = new \ArrayObject;
        //...
        $session['captcha']['number'] = 5;
        $session['captcha']['lifetime'] = 3600;

        // 使用带通用前缀的键来存储数组
        $session['captcha.number'] = 5;
        $session['captcha.lifetime'] = 3600;
        
        //为更好的性能和可读性，推荐最后一种方案，也就是不用存储session变量为数组， 而是将每个数组项变成有相同键前缀的session变量。
    }
    
    /**
     * 自定义session存储
     * yii\web\Session 类默认存储session数据为文件到服务器上，Yii提供以下session类实现不同的session存储方式：
        yii\web\DbSession: 存储session数据在数据表中
        yii\web\CacheSession: 存储session数据到缓存中，缓存和配置中的缓存组件相关
        yii\redis\Session: 存储session数据到以redis 作为存储媒介中
        yii\mongodb\Session: 存储session数据到MongoDB.
     * 注意: 如果通过$_SESSION访问使用自定义存储介质的session，需要确保session已经用yii\web\Session::open() 开启， 这是因为在该方法中注册自定义session存储处理器。
     * 
     * 步骤一:
     * 在应用配置中配置DbSession将数据表作为session存储介质
     * 
     * 步骤二:
     * 创建对应数据表
     * CREATE TABLE session
       (
            id CHAR(40) NOT NULL PRIMARY KEY,
            expire INTEGER,
            data BLOB
        )
     * 其中'BLOB' 对应你选择的数据库管理系统的BLOB-type类型，以下一些常用数据库管理系统的BLOB类型：
        MySQL: LONGBLOB
        PostgreSQL: BYTEA
        MSSQL: BLOB
        注意: 根据php.ini 设置的 session.hash_function，你需要调整id列的长度， 例如，如果 session.hash_function=sha256 ，应使用长度为64而不是40的char类型。
     */
    public function actionSessionCustom(){
        
    }
    
    /**
     * Flash数据
     * Flash数据是一种特别的session数据，它一旦在某个请求中设置后，只会在下次请求中有效，然后该数据就会自动被删除
     */
    public function actionFlash(){
        $session=Yii::$app->session;
        
        //设置名为'postDeleted'的flash信息
        $session->setFlash('postDeleted','You have successfully deleted your post.');
        
        //显示名为'postDeleted'的flash信息
        echo $session->getFlash('postDeleted'),"\n\n<br/>";
        
        $result=$session->hasFlash('postDeleted');
        var_dump($result);
        echo"\n\n<br/><br/>";
   
        // 在名称为"alerts"的flash信息增加数据
        $session->addFlash('alerts', 'You have successfully deleted your post.');
        $session->addFlash('alerts', 'You have successfully added a new friend.');
        $session->addFlash('alerts', 'You are promoted.');

        // $alerts 为名为'alerts'的flash信息，为数组格式
        $alerts = $session->getFlash('alerts');
        var_dump($alerts);

    }
    
    /**
     * 读取cookies
     */
    public function actionCookies(){
        // 从 "request"组件中获取cookie集合(yii\web\CookieCollection)
        $cookies=Yii::$app->request->cookies;
        
        // 获取名为 "language" cookie 的值，如果不存在，返回默认值"en"
        $language=$cookies->getValue('language','en');
        var_dump($language);
        echo "\n\n<br/>";
        
        if(($cookie=$cookies->get('language'))!==null){
            $language=$cookie->value;
            var_dump($language);
            echo "\n\n<br/>";
        }
        
        // 可将 $cookies当作数组使用
        if (isset($cookies['language'])) {
            $language = $cookies['language']->value;
            var_dump($language);
            echo "\n\n<br/>";
        }

        // 判断是否存在名为"language" 的 cookie
        if ($cookies->has('language')) echo "language的值存在","\n\n<br/>";
        if (isset($cookies['language'])) echo "language的值存在", "\n\n<br/>";
    }
    
    /**
     * 发送cookies
     */
    public function actionSendCookies(){
        
        // 从"response"组件中获取cookie 集合(yii\web\CookieCollection)
        $cookies=Yii::$app->response->cookies;
        
        // 在要发送的响应中添加一个新的cookie
        $cookies->add(new \yii\web\Cookie([
            'name'=>'language',
            'value'=>'zh-CN',
        ]));
        //除了定义的 yii\web\Cookie::name 和 yii\web\Cookie::value 属性 yii\web\Cookie 类也定义了其他属性来实现cookie的各种信息，
        //如 yii\web\Cookie::domain, yii\web\Cookie::expire 可配置这些属性到cookie中并添加到响应的cookie集合中。


        //删除一个value
        $cookies->remove('language');
        // 等同于以下删除代码
        unset($cookies['language']);
    }
    
    /**
     * cookie验证
     * 该功能通过给每个cookie签发一个哈希字符串来告知服务端cookie是否在客户端被修改， 如果被修改，通过request组件的yii\web\Request::cookiescookie集合访问不到该cookie
     * Cookie验证默认启用，可以设置yii\web\Request::enableCookieValidation属性为false来禁用它
     * 当使用cookie验证，必须指定yii\web\Request::cookieValidationKey，它是用来生成s上述的哈希值， 可通过在应用配置中配置request 组件。
     * 
     */
    public function actionCookiesAuth(){
        
    }
    

    
}
