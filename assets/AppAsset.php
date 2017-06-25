<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 * 
 * 资源包:
 * Yii在资源包中管理资源，资源包简单的说就是放在一个目录下的资源集合， 当在视图中注册一个资源包，在渲染Web页面时会包含包中的CSS和JavaScript文件。
 * 
 * 定义资源包
 * 
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';//指定资源文件放在@webroot目录下 
    public $baseUrl = '@web'; //对应的URL为@web
    public $css = [
        'css/site.css', //代表资源包中包含一个CSS文件
    ];
    
    //每个js文件可指定为两种格式之一:
    //一:相对路径表示为本地js文件(如js/main.js)，文件实际的路径在该相对路径前加上 yii\web\AssetManager::basePath，文件实际的URL在该路径前加上yii\web\AssetManager::baseUrl。
    //二:绝对的URL地址表示为外部js文件,如http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js
    public $js = [
    ];
    
    //列出该资源包依赖的其他资源包
    //资源包依赖其他两个资源包： yii\web\YiiAsset 和 yii\bootstrap\BootstrapAsset 也就是该资源包的CSS和JavaScript文件要在这两个依赖包的文件包含 之后 才包含
    //资源依赖关系是可传递，也就是人说A依赖B，B依赖C，那么A也依赖C
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
    
    //yii\web\AssetBundle::jsOptions: 当调用yii\web\View::registerJsFile()注册该包 每个 JavaScript文件时， 指定传递到该方法的选项。
    //yii\web\AssetBundle::cssOptions: 当调用yii\web\View::registerCssFile()注册该包 每个 css文件时， 指定传递到该方法的选项。
    //yii\web\AssetBundle::publishOptions: 当调用yii\web\AssetManager::publish()发布该包资源文件到Web目录时 指定传递到该方法的选项，仅在指定了yii\web\AssetBundle::sourcePath属性时使用。
    
    //资源位置
    //资源选项
    //资源发布
    
    //常用资源包
    //Yii框架定义许多资源包，如下资源包是最常用，可在你的应用或扩展代码中引用它们。
    //yii\web\YiiAsset: 主要包含yii.js 文件，该文件完成模块JavaScript代码组织功能， 也为 data-method 和 data-confirm属性提供特别支持和其他有用的功能。
    //yii\web\JqueryAsset: 包含从jQuery bower 包的jquery.js文件。
    //yii\bootstrap\BootstrapAsset: 包含从Twitter Bootstrap 框架的CSS文件。
    //yii\bootstrap\BootstrapPluginAsset: 包含从Twitter Bootstrap 框架的JavaScript 文件来支持Bootstrap JavaScript插件。
    //yii\jui\JuiAsset: 包含从jQuery UI库的CSS 和 JavaScript 文件。
    
    //资源转换:
    //除了直接编写CSS 和/或 JavaScript代码，开发人员经常使用扩展语法来编写，再使用特殊的工具将它们转换成CSS/Javascript。
    // 例如，对于CSS代码可使用LESS 或 SCSS， 对于JavaScript 可使用 TypeScript。
    //  css/site.less，js/site.ts
    //当在视图中注册一个这样的资源包，yii\web\AssetManager资源管理器会自动运行预处理工具将使用扩展语法 的资源转换成CSS/JavaScript
    //Yii默认可以识别如下语法和文件扩展名:
    /*
     * LESS: .less
     *SCSS: .scss
     *Stylus: .styl
     *CoffeeScript: .coffee
     *TypeScript: .ts
     */
    
    
    //合并压缩资源
    
}
