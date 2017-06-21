<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\EntryForm;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
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
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
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
    public function actionAbout()
    {
        return $this->render('about');
    }
    
    //第一次问候Hello World 动作
    public function actionSay($message='Hello'){
        return $this->render('say',['message' =>$message]);
    }
    
    //处理用户提交数据表单的动作
    public function actionEntry(){
        $model=new EntryForm();
        if($model->load(Yii::$app->request->post())&&$model->validate()){
            //验证$model 收到的数据
            
            return $this->render('entry-confirm',['model'=>$model]);
        } else {
            return $this->render('entry',['model' =>$model]);
        }
        
    }
    
    //
    public function actionHelloWorld(){
        $request= Yii::$app->request;
        $get=$request->get();
        var_dump($get);
        echo   "YII框架安装目录:", Yii::getAlias("@yii"),"\n";
        echo   "当前运行的应用:", Yii::getAlias("@app"),"\n";
        echo   "当前运行的应用的:", Yii::getAlias("@runtime"),"\n";
        echo   "webroot:", Yii::getAlias("@webroot"),"\n";
        echo   "web:", Yii::getAlias("@web"),"\n";
        echo   "vendor:", Yii::getAlias("@vendor"),"\n";
        echo   "bower:", Yii::getAlias("@bower"),"\n";
        echo   "npm:", Yii::getAlias("@npm"),"\n";
        return "\nHello World";
//        return FALSE;
//        echo "Hello World";
    }
    
    public function actionTest(){
        $formatter= Yii::$app->formatter;
        echo $formatter->asDate('2016-6-16','long');
        echo $formatter->asPercent(0.125,3);
        
    }
    
    
}
