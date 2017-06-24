<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * 基类yii\base\Model支持许多实用的特性：
 * 属性: 代表可像普通类属性或数组一样被访问的业务数据;
 * 属性标签: 指定属性显示出来的标签;
 * 块赋值: 支持一步给许多属性赋值;
 * 验证规则: 确保输入数据符合所申明的验证规则;
 * 数据导出: 允许模型数据导出为自定义格式的数组。
 */
/**
 * 最佳实践

 * 模型是代表业务数据、规则和逻辑的中心地方，通常在很多地方重用， 在一个设计良好的应用中，模型通常比控制器代码多。

 * 归纳起来，模型

 * 可包含属性来展示业务数据;
 * 可包含验证规则确保数据有效和完整;
 * 可包含方法实现业务逻辑;
 * 不应直接访问请求，session和其他环境数据，这些数据应该由控制器传入到模型;
 * 应避免嵌入HTML或其他展示代码，这些代码最好在 视图中处理;
 * 单个模型中避免太多的 场景.
 * 在开发大型复杂系统时应经常考虑最后一条建议， 在这些系统中，模型会很大并在很多地方使用，因此会包含需要规则集和业务逻辑， 
 * 最后维护这些模型代码成为一个噩梦，因为一个简单修改会影响好多地方， 为确保模型好维护，最好使用以下策略：

 * 定义可被多个 应用主体 或 模块 共享的模型基类集合。 这些模型类应包含通用的最小规则集合和逻辑。
 * 在每个使用模型的 应用主体 或 模块中， 通过继承对应的模型基类来定义具体的模型类，具体模型类包含应用主体或模块指定的规则和逻辑。
 * 例如，在高级应用模板，你可以定义一个模型基类common\models\Post， 然后在前台应用中，定义并使用一个继承common\models\Post的具体模型类frontend\models\Post， 
 * 在后台应用中可以类似地定义backend\models\Post。 通过这种策略，你清楚frontend\models\Post只对应前台应用，如果你修改它，就无需担忧修改会影响后台应用。
 */

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model {

    public $name;
    public $email;
    public $subject;
    public $body;
    public $verifyCode;

    /**
     * @return array the validation rules.
     * 覆盖rules() 方法指定模型属性应该满足的规则来申明模型相关验证规则
     * 一条规则可用来验证一个或多个属性，一个属性可对应一条或多条规则
     * 
     * validate()方法利用rules()声明的验证规则来验证每个相关属性
     */
    public function rules() {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'subject', 'body'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
                //利用safe验证器声明哪些属性是安全的不需要被验证
                //['verifyCode', 'captcha','safe'],
                //通过on属性,指定一条规则在某个场景下应用；如果没有指定on属性,规则在所有场景下应用
                // 在"register" 场景下 username, email 和 password 必须有值
                //[['username', 'email', 'password'], 'required', 'on' => 'register'],
                // 在 "login" 场景下 username 和 password 必须有值
                //[['username', 'password'], 'required', 'on' => 'login'],
        ];
    }

    /**
     * @return array customized attribute labels
     * 覆盖 attributeLabels(),明确指定属性标签
     */
    public function attributeLabels() {
        return [
            'verifyCode' => 'Verification Code',
                //应用支持多语言的情况下,可翻译属性标签
                // 'name' => \Yii::t('app', 'Your name'),
                //'email' => \Yii::t('app', 'Your email address'),
                //'subject' => \Yii::t('app', 'Subject'),
                //'body' => \Yii::t('app', 'Content'),
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function contact($email) {
        if ($this->validate()) {
            Yii::$app->mailer->compose()
                    ->setTo($email)
                    ->setFrom([$this->email => $this->name])
                    ->setSubject($this->subject)
                    ->setTextBody($this->body)
                    ->send();

            return true;
        }
        return false;
    }

    /**
     * 场景
     * 模型可能在多个场景下使用，例如 User 模块可能会在收集用户登录输入，也可能会在用户注册时使用。
     * 在不同的场景下，模型可能会使用不同的业务规则和逻辑，例如 email 属性在注册时强制要求有，但在登陆时不需要。
     * 
     * 默认情况下，模型支持的场景由模型中申明的 验证规则 来决定， 可以通过覆盖yii\base\Model::scenarios()方法来自定义行为
     * 
     * 场景特性主要在验证 和 属性块赋值 中使用。 也可以用于其他目的，例如可基于不同的场景定义不同的 属性标签。
     */
    public function scenarios() {

        return[
                //'login'=>['name','verifyCode'],
                //'register'=>['name', 'verifyCode','email'],
                //使用!号定义哪些属性是非安全的,不会被块赋值，但也会被验证
                //'register'=>['name', 'verifyCode','!email'],
        ];

        //scenarios() 方法默认实现会返回所有yii\base\Model::rules()方法申明的验证规则中的场景
        //默认场景外使用新场景:
        //$scenarios = parent::scenarios();
        //$scenarios['login'] = ['name', 'verifyCode'];
        //$scenarios['register'] = ['name', 'verifyCode', 'email'];
        //return $scenarios;
    }

    //块赋值
    //安全属性
}
