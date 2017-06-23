<?php

/*
 * 此文件指定了整个应用如何初始化
 */

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

$config = [
    'id' => 'basic', //用来区分其他应用的唯一标识ID,推荐使用数字
    'basePath' => dirname(__DIR__), //应用的根目录,系统预定义 @app 代表这个路径
    
    //定义多个别名,代替 Yii::setAlias() 方法；数组的key为别名名称，值为对应的路径
//    'aliases'=>[
//         '@name1' => 'path/to/path1',
//        '@name2' => 'path/to/path2',
//    ],
    
    //用数组指定启动阶段yii\base\Application::bootstrap()需要运行的组件,可以指定一下的某一项
    //引导启动组件,将组件加入引导,让它始终载入
    'bootstrap' => [
         // 应用组件ID或模块ID
        'log',
        
        // 类名
        //'app\components\Profiler',
        
        // 配置数组
//        [
//            'class' => 'app\components\Profiler',
//            'level' => 3,
//        ],
        
        // 无名称函数
//        function () {
//            return new app\components\Profiler();
//        }
        
        //如果模块ID和应用组件ID同名，优先使用应用组件ID，如果你想用模块ID，可以使用如下无名称函数返回模块ID
//        function () {
//            return Yii::$app->getModule('user');
//        },
    ],
    
    // catchAll属性,仅 yii\web\Application 网页应用支持,它指定一个要处理所有用户请求的 控制器方法，通常在维护模式下使用，同一个方法处理所有用户请求。
    // 'catchAll' =>[],
    
    //注册在其他地方使用的应用组件,每一个应用组件指定一个key-value对的数组，key代表组件ID，value代表组件类名或 配置
    //请谨慎注册太多应用组件，应用组件就像全局变量，使用太多可能加大测试和维护的难度。 一般情况下可以在需要时再创建本地组件。
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '9iyR7_vhHpf9WYi9Vf8_P0G0htacC9Ta',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
    /*
      'urlManager' => [
      'enablePrettyUrl' => true,
      'showScriptName' => false,
      'rules' => [
      ],
      ],
     */
    ],
    
    //指定可全局访问的参数,具体参数在config\params.php文件中定义
    'params' => $params,
    
    //允许指定一个控制器ID到任意控制器类,数组的键代表控制器ID，数组的值代表对应的类名。
//    'controllerMap' => [
//        [
//            'account' => 'app\controllers\UserController',
//            'article' => [
//                'class' => 'app\controllers\PostController',
//                'enableCsrfValidation' => false,
//            ],
//        ],
//    ],
    
    //指定控制器默认的命名空间,默认为app\controllers
    //'controllerNamespace' =>'',
    
    
    //指定应用展示给终端用户的语言
    //'language' =>'',
    
    //指定应用代码的语言
    //'sourceLanguage' =>'',
    
    //指定应用所包含的模块
    //'modules'=>[
         // "booking" 模块以及对应的类
        //'booking' => 'app\modules\booking\BookingModule',
        // "comment" 模块以及对应的配置数组
//        'comment' => [
//            'class' => 'app\modules\comment\CommentModule',
//            'db' => 'db',
//        ],
    //],
    
    //指定展示给终端用户的应用名称,如果其他地方的代码没有用到，可以不配置该属性。
    //'name'=>'My Application!!!!',
    
    
    //修改PHP运行环境的默认时区,配置该属性本质上就是调用PHP函数 date_default_timezone_set()
    //'timeZone'=>'America/Los_Angeles',
    
    //指定应用的版本,默认1.0
    //'version'=>'1.2',
    
    //指定应用使用的字符集,默认utf-8
    //'charset'=>'utf-8',
    
    //指定未配置的请求的响应路由规则(设置默认控制器)
    //'defaultRoute'=>'',
    
    //用数组列表指定应用安装和使用的扩展,默认使用@vendor/yiisoft/extensions.php文件返回的数组
//     'extensions' => [
//        [
//            'name' => 'extension name',
//            'version' => 'version number',
//            'bootstrap' => 'BootstrapClassName', // 可选配，可为配置数组
//            'alias' => [// 可选配
//                '@alias1' => 'to/path1',
//                '@alias2' => 'to/path2',
//            ],
//        ],
//    // ... 更多像上面的扩展 ...
//    ],
    
    //该属性指定渲染 视图 默认使用的布局名字，默认值为 'main' 对应布局路径下的 main.php 文件,如果不想设置默认布局文件，可以设置该属性为 false，这种做法比较罕见
    //'layout' => 'main',
    
    //指定查找布局文件的路径，默认值为 视图路径 下的 layouts 子目录
    //'layoutPath'=>'',
    
    //指定临时文件如日志文件、缓存文件等保存路径，默认值为带别名的 @app/runtime
    //'runtimePath'=>'',
    
    //指定视图文件的根目录，默认值为带别名的 @app/views
    //'viewPath'=>'',
    
    //指定 Composer 管理的供应商路径，该路径包含应用使用的包括Yii框架在内的所有第三方库。 默认值为带别名的 @app/vendor
    //'vendor'=>'',
    
    //仅 yii\console\Application 控制台应用支持， 用来指定是否启用Yii中的核心命令，默认值为 true
    //'enableCoreCommands'=>'',
    
    /**
     * 应用主体生命周期

    当运行 入口脚本 处理请求时，应用主体会经历以下生命周期:

    入口脚本加载应用主体配置数组。
    入口脚本创建一个应用主体实例：
    调用 yii\base\Application::preInit() 配置几个高级别应用主体属性，比如yii\base\Application::basePath。
    注册 yii\base\Application::errorHandler 错误处理方法.
    配置应用主体属性.
    调用 yii\base\Application::init() 初始化，该函数会调用 yii\base\Application::bootstrap() 运行引导启动组件.
    入口脚本调用 yii\base\Application::run() 运行应用主体:
    触发 yii\base\Application::EVENT_BEFORE_REQUEST 事件。
    处理请求：解析请求 路由 和相关参数；创建路由指定的模块、控制器和动作对应的类，并运行动作。
    触发 yii\base\Application::EVENT_AFTER_REQUEST 事件。
    发送响应到终端用户.
    入口脚本接收应用主体传来的退出状态并完成请求的处理。
     */
    
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
            // uncomment the following to add your IP if you are not connecting from localhost.
            // 如果没有从本地主机连接，请取消下面的注释添加您的IP
            //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    //如果当前是开发环境，应用会包含gii模块
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
            // uncomment the following to add your IP if you are not connecting from localhost.
            // 如果没有从本地主机连接，请取消下面的注释添加您的IP
            //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
