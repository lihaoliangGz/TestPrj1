<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

/**
 * 控制器生命周期
 * 处理一个请求时，应用主体 会根据请求路由创建一个控制器，控制器经过以下生命周期来完成请求：
 * 在控制器创建和配置后，yii\base\Controller::init() 方法会被调用。
 * 控制器根据请求操作ID创建一个操作对象:
 * 如果操作ID没有指定，会使用yii\base\Controller::defaultAction默认操作ID；
 * 如果在yii\base\Controller::actions()找到操作ID，会创建一个独立操作；
 * 如果操作ID对应操作方法，会创建一个内联操作；
 * 否则会抛出yii\base\InvalidRouteException异常。
 * 控制器按顺序调用应用主体、模块（如果控制器属于模块）、控制器的 beforeAction() 方法；
 * 如果任意一个调用返回false，后面未调用的beforeAction()会跳过并且操作执行会被取消； action execution will be cancelled.
 * 默认情况下每个 beforeAction() 方法会触发一个 beforeAction 事件，在事件中你可以追加事件处理操作；
 * 控制器执行操作:
 * 请求数据解析和填入到操作参数；
 * 控制器按顺序调用控制器、模块（如果控制器属于模块）、应用主体的 afterAction() 方法；
 * 默认情况下每个 afterAction() 方法会触发一个 afterAction 事件，在事件中你可以追加事件处理操作；
 * 应用主体获取操作结果并赋值给响应.
 * 
 * 
 * 最佳实践
 * 在设计良好的应用中，控制器很精练，包含的操作代码简短； 如果你的控制器很复杂，通常意味着需要重构，转移一些代码到其他类中。
 * 归纳起来，控制器
 * 可访问 请求 数据;
 * 可根据请求数据调用 模型 的方法和其他服务组件;
 * 可使用 视图 构造响应;
 * 不应处理应被模型处理的请求数据;
 * 应避免嵌入HTML或其他展示代码，这些代码最好在 视图中处理.
 */
/*
 * 
 * 控制器类命名:
 * 控制器ID遵循以下规则衍生控制器类名：
 * 将用中横杠区分的每个单词第一个字母转为大写。注意如果控制器ID包含正斜杠，只将最后的正斜杠后的部分第一个字母转为大写；
 * 去掉中横杠，将正斜杠替换为反斜杠;
 * 增加Controller后缀;
 * 在前面增加yii\base\Application::controllerNamespace控制器命名空间.
 */

//控制器ID应仅包含英文小写字母、数字、下划线、中横杠和正斜杠， 例如 article 和 post-comment 是真是的控制器ID，article?, PostComment, admin\post不是控制器ID。
class SiteController extends Controller {

    //修改默认操作为default操作
    //public $defaultAction = 'default';

    /**
     * @inheritdoc
     *
     */
    public function behaviors() {
       
        return [
            'access' => [
                //AccessControl提供基于yii\filters\AccessControl::rules规则的访问控制。
                // 特别是在动作执行之前，访问控制会检测所有规则并找到第一个符合上下文的变量（比如用户IP地址、登录状态等等）的规则，
                //  来决定允许还是拒绝请求动作的执行，如果没有规则符合，访问就会被拒绝。
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    //允许认证用户
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),//VerbFilter检查请求动作的HTTP请求方式是否允许执行，如果不允许，会抛出HTTP 405异常
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     * 
     * 要使用独立操作，控制器中需要覆盖actions（）方法
     * 
     * 访问独立操作和访问内联操作基本一样
     * http://yiibase.local.com/index.php?r=site/helloworld
     */
    public function actions() {
        return [
            // 用类来申明"error" 操作
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'helloworld' => [
                'class' => 'app\components\HelloWorldAction',
            ],
        ];
    }
    
    //public function beforeAction($action) {
        //echo "beforeAction()方法执行";
        //echo "\n\n<br/>";
        //return TRUE;
    //}
    
    //public function afterAction($action, $result) {
        //echo "afterAction()方法执行";
        //echo "\n\n<br/>";
        //return TRUE;
    //}
    
    

    /**
     * Displays homepage.
     * 
     * 创建操作:
     * 操作方法必须是以action开头的公有方法
     * 操作方法的返回值会作为响应数据发送给终端用户
     * 
     * 内联操作:
     * 
     * 操作方法的名字是根据操作ID遵循如下规则衍生：
     * 将每个单词的第一个字母转为大写;
     * 去掉中横杠;
     * 增加action前缀.
     * 例如index 转成 actionIndex, hello-world 转成 actionHelloWorld。
     * 
     * @return string
     * 
     * defaultAction = 'index'; index是默认操作
     */
    //操作ID应仅包含英文小写字母、数字、下划线和中横杠，操作ID中的中横杠用来分隔单词。 例如view, update2, comment-post是真实的操作ID，view?, Update不是操作ID.
    public function actionIndex() {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
                    'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
                    'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout() {
        return $this->render('about');
    }

    //
    public function actionHelloWorld() {
        $request = Yii::$app->request;
        $get = $request->get();
        var_dump($get);
        echo "YII框架安装目录:", Yii::getAlias("@yii"), "\n";
        echo "当前运行的应用:", Yii::getAlias("@app"), "\n";
        echo "当前运行的应用的:", Yii::getAlias("@runtime"), "\n";
        echo "webroot:", Yii::getAlias("@webroot"), "\n";
        echo "web:", Yii::getAlias("@web"), "\n";
        echo "vendor:", Yii::getAlias("@vendor"), "\n";
        echo "bower:", Yii::getAlias("@bower"), "\n";
        echo "npm:", Yii::getAlias("@npm"), "\n";
        return "\nHello World";
//        return FALSE;
//        echo "Hello World";
    }

    public function actionTest() {
        $formatter = Yii::$app->formatter;
        echo $formatter->asDate('2016-6-16', 'long');
        echo $formatter->asPercent(0.125, 3);
    }

    //返回相应对象测试
    public function actionReturn() {
        //redirect()方法返回一个响应对象,可将用户浏览器跳转到新的URL
        return $this->redirect("http://www.baidu.com"); //
    }

    //操作参数
    //操作参数接收数组值,请求URL改为:http://yiibase.local.com/index.php?r=site/view&id[]=1
    //如果接收的参数值是字符串,url中的参数必须是字符串;若参数值是array,url中的参数可以是字符串,因为无类型的参数会自动转成数组
    public function actionView(array $id, $version = null) {
        //echo "id=$id,version=$version";
        var_dump($id);
        echo "\n\n\n<br/>";
        echo "version=$version";
    }

    //将默认操作修改为这个操作
    public function actionDefault() {
        echo "将默认操作修改为这个操作";
        echo "\n\n<br/>";
    }
    
    public function actionOffline(){
        echo '系统维护中...';
    }

}
