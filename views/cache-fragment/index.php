<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 测试片段缓存的视图
 */



?>
<p>片段缓存测试中..</p>

<?php 
   
    //它依赖于 population 字段是否被更改过的。
    $dependency=[
        'class'=>'yii\caching\DbDependency',
        'sql' => 'SELECT MAX(population) FROM country',
    ];
    
    //参数2数组指定:缓存持续时间,依赖,变化,开关(在get请求下打开)
    //根据yii\widgets\FragmentCache的属性确定参数2数组的内容
    var_dump(Yii::$app->request->isGet);
    echo "\n\n<br/><br/>\n\n";
    if($this->beginCache($id ,['duration'=>180,'dependency'=>$dependency,'variations'=>[Yii::$app->language],'enabled'=> Yii::$app->request->isGet])){
                                ////如果缓存中存在该内容，yii\base\View::beginCache() 方法将渲染内容并返回 false,因此将跳过内容生成逻辑。
                                //否则，内容生成逻辑被执行，一直执行到 yii\base\View::endCache() 时，生成的内容将被捕获并存储在缓存中。
        // ... 在此生成内容 ...
        echo "... 在此生成内容 ...";
        $a=1;
        echo  "$a";
        $a++;
        
        //动态内容:
        //yii\base\View::renderDynamic() 方法接受一段 PHP 代码作为参数。代码的返回值被看作是动态内容。这段代码将在每次请求时都执行，无论其外层的片段缓存是否被存储。
        echo $this->renderDynamic('echo "生成的动态内容aaaaaannnn"."\n\n<br/>\n\n";');
       
        $this->endCache();
}

?>

<?php 
//外层的失效时间应该短于内层，外层的依赖条件应该低于内层，以确保最小的片段，返回的是最新的数据。
//缓存嵌套:
    //if ($this->beginCache($id1)) {

    // ...在此生成内容...

    //if ($this->beginCache($id2, $options2)) {

        // ...在此生成内容...

        //$this->endCache();
    //}

    // ...在此生成内容...

    //$this->endCache();
//}
?>