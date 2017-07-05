<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 测试数据库访问和查询生成器的控制器
 * 
 */

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\db\Query;

/**
 * Description of DbController
 *
 * @author Administrator
 */
class DbController extends Controller {
    //SQL基础查询，通过yii\db\Command执行 SQL 查询

    /**
     * SELECT查询
     */
    public function actionSelect() {
        $connection = Yii::$app->db;
        $command = $connection->createCommand('SELECT * FROM country'); //
        $country = $command->queryAll(); //查询返回多行
        var_dump($country);
        echo "\n\n<br/><br/>";

        $command = $connection->createCommand('SELECT * FROM country WHERE code="AU"');
        $countryOne = $command->queryOne(); //查询返回单行(满足条件的第一行)
        var_dump($countryOne);
        echo "\n\n<br/><br/>";

        $command = $connection->createCommand('SELECT name FROM country');
        $countryColumn = $command->queryColumn(); //查询多行单列
        var_dump($countryColumn);
        echo "\n\n<br/><br/>";

        $command = $connection->createCommand('SELECT COUNT(*) FROM country');
        $countryScalar = $command->queryScalar(); //查询标量值/计算值：
        var_dump($countryScalar);
        echo "\n\n<br/><br/>";
    }

    /**
     * UPDATE, INSERT, DELETE 更新、插入和删除等
     * 如果执行 SQL 不需返回任何数据，可使用命令中的 execute 方法：
     */
    public function actionIndex() {
        $connection=Yii::$app->db;
        $command = $connection->createCommand('UPDATE country SET population=999 WHERE code="AU"');//sql语句:更新country数据表,字段code为AU的行的字段population的值为99
        $command->execute();
        
    }
    
    /**
     * 使用API
     */
    public function actionApi(){
        $connection = Yii::$app->db;
        
        //insert
//        $connection->createCommand()->insert('country', [
//            'code'=>'BB',
//            'name'=>'CHINA',
//            'population'=>440183,
//        ])->execute();
        
        // INSERT 一次插入多行
//        $connection->createCommand()->batchInsert('country', ['code', 'name','population'], [
//            ['Tom', 30,456],
//            ['Jane', 20,123],
//            ['Linda', 25,789],
//        ])->execute();
        
         // update 
        //第一个参数:数据表名
        //第二个参数:更新的值
        //第三个参数:条件语句
        $connection->createCommand()->update('country', ['name'=>'OOM'],'code="To"')->execute();
        
        //delete
         //$connection->createCommand()->delete('country', 'code="Li"')->execute();
    }
    
    /**
     * 引用的表名和列名
     */
    public function actionA(){
//        $sql='SELECT count($column) from {{$table}}';
//        $connection=Yii::$app->db;
//        $count = $connection->createCommand($sql)->queryScalar();
//        echo "$count";
    }
    
    /**
     * 预处理语句
     * 为安全传递查询参数可以使用预处理语句,首先应当使用:placeholder占位，再将变量绑定到对应占位符：
     */
    public function actionPreproccess(){
        $connection=Yii::$app->db;
        $command = $connection->createCommand('select * from country where population=:num');
        $command->bindValue(':num', $_GET['id']);
        echo $_GET['id'],"\n\n<br/>";
        $query = $command->queryOne();
        var_dump( $query);
        
        
        
    }
    
    /**
     * 预处理语句
     * 准备一次预处理语句而执行多次查询,在执行前绑定变量，然后在每个执行中改变变量的值（一般用在循环中）比较高效.
     */
    public function actionPreproccess2(){
        $connection = Yii::$app->db;
        $command = $connection->createCommand('select * from country where population=:num');
        $command->bindParam(':num', $num);
        
        $num=999;
        $query_1 = $command->queryOne();
        var_dump($query_1);
        echo "\n<br/>";
        
        $num=440183;
        $query_2 = $command->queryOne();
        var_dump($query_2);
        echo "\n<br/>";
    }
    
    /**
     * 事务
     */
    public function actionTransaction(){
        $connection=Yii::$app->db;
        $transaction = $connection->beginTransaction();
        try {
            $sql1='delete from country where population=999';
            $sql2='select * from country where population=999';
            $connection->createCommand($sql1)->execute();
            $query = $connection->createCommand($sql2)->queryOne();
            var_dump($query);
            echo "\n\n<br/>";
            //...
            $transaction->commit();//事务提交并结束
            echo "事务提交完毕","\n\n<br/>";
        } catch (Exception $exc) {
            echo "catch中方法执行","\n\n<br/>";
            $transaction->rollBack();//事务回滚
            echo $exc->getTraceAsString();
        }

    }
    
    /**
     * 事务嵌套
     * 涉及到数据库隔离级别
     * \yii\db\Transaction::READ_UNCOMMITTED - 允许读取改变了的还未提交的数据,可能导致脏读、不可重复读和幻读
     * \yii\db\Transaction::READ_COMMITTED - 允许并发事务提交之后读取，可以避免脏读，可能导致重复读和幻读。
     * \yii\db\Transaction::REPEATABLE_READ - 对相同字段的多次读取结果一致，可导致幻读。
     * \yii\db\Transaction::SERIALIZABLE - 完全服从ACID的原则，确保不发生脏读、不可重复读和幻读。
     */
    public function actionTransaction2(){
        $connection = Yii::$app->db;
        // 外部事务
        $transaction1 = $connection->beginTransaction();
        try {            
            $sql1='select * from country';
            $connection->createCommand($sql1)->execute();

            // 内部事务
            $transaction2 = $connection->beginTransaction();
            try {
                $sql2='select name from country';
                $connection->createCommand($sql2)->execute();
                $transaction2->commit();
            } catch (Exception $e) {
                $transaction2->rollBack();
            }

            $transaction1->commit();
        } catch (Exception $e) {
            $transaction1->rollBack();
        }
    }
    
    /**
     * 数据库复制和读写分离
     * 首先在应用的数据库配置中配置主从服务器
     */
    public function actionSeparation(){
        
    }
    
    /**
     * 操作数据库模式
     * 通过 yii\db\Schema实例来获取Schema信息
     */
    public function actionSchema(){
        $connection=Yii::$app->db;
        $schema = $connection->getSchema();
        $tables = $schema->getTableNames();
        var_dump($tables);
        echo "\n<br/>";
    }
    
    /**
     * 修改模式
     * 除了基础的 SQL 查询，yii\db\Command还包括一系列方法来修改数据库模式：
     *   创建/重命名/删除/清空表
      *  增加/重命名/删除/修改字段
     *   增加/删除主键
     *   增加/删除外键
     *   创建/删除索引
     * 
     * 测试失败
     */
    public function actionAlter(){
        $connection=Yii::$app->db;
        $connection->createCommand()->createTable('alter', [
            'id'=>'pk',
            'title'=>'string',
            'text'=>'text',
        ]);
    }
    
    
    //==================================================================================================
    
    /**
     * 查询构建器
     */
    public function actionBuilder(){
        $query0 = new Query;
        $all = $query0->select(['name as Hello','code'])
                ->from('country')
                //->where(['population'=>456])
                ->limit(6)
                ->all();
        var_dump($all);
        echo "\n\n<br/>";
    }
    
    /**
     * yii\db\Query::select()
     */
    public function actionSelect1(){
        
    }
    
    /**
     * yii\db\Query::from()
     */
    public function actionFrom(){
        $query0 = new Query;
        $from = $query0->from('country')
                ->all();
        var_dump($from);
        echo "\n\n<br/>";
    }
    
    /**
     * yii\db\Query::where()
     * 三种格式
     * 字符串格式，例如：'status=1'
     * 哈希格式，例如： ['status' => 1, 'type' => 2]
     * 操作符格式，例如：['like', 'name', 'test']
     * 
     * 可以使用 yii\db\Query::andWhere() 或者 yii\db\Query::orWhere() 在原有条件的基础上 附加额外的条件
     * 
     * 使用使用 yii\db\Query::filterWhere() 方法实现数据的过滤
     * 可以使用 yii\db\Query::andFilterWhere() 和 yii\db\Query::orFilterWhere() 方法 来追加额外的过滤条件
     * yii\db\Query::filterWhere() 和 yii\db\Query::where() 唯一的不同就在于，前者 将忽略在条件当中的hash format的空值。所以如果 $email 为空而 $username 不为空，那么上面的代码最终将生产如下 SQL ...WHERE username=:username。
     */
    public function actionWhere(){
        $query=new Query;
        $pop=456;
        $result=$query->select('*')
                ->from('country')
                //->where('population=456')v //字符串形式
                //->where('population=:pop',[':pop'=>$pop]) //使用参数绑定
                ->where('population=:pop')//调用 yii\db\Query::params() 或者 yii\db\Query::addParams() 方法 来分别绑定不同的参数
                ->addParams([':pop'=>$pop])
                ->all();
        var_dump($result);
        echo "\n\n<br/>";
    }
    
    /**
     * yii\db\Query::orderBy()
     * PHP 的常量 SORT_ASC 指的是升序排列，SORT_DESC 指的则是降序排列。
     * 以调用 [yii\db\Query::addOrderBy()|addOrderBy()]] 来为 ORDER BY 片断添加额外的子句
     */
    public function actionOrderBy(){
        //$query->orderBy('id ASC')
        //        ->addOrderBy('name DESC');
    }
    
    //.....还有其他的API查询手册
    
    /**
     * 查询方法
        yii\db\Query 提供了一整套的用于不同查询目的的方法。
        yii\db\Query::all(): 将返回一个由行组成的数组，每一行是一个由名称和值构成的关联数组（译者注：省略键的数组称为索引数组）。
        yii\db\Query::one(): 返回结果集的第一行。
        yii\db\Query::column(): 返回结果集的第一列。
        yii\db\Query::scalar(): 返回结果集的第一行第一列的标量值。
        yii\db\Query::exists(): 返回一个表示该查询是否包结果集的值。
        yii\db\Query::count(): 返回 COUNT 查询的结果。
     * 
     * 
     * 当你调用 yii\db\Query 当中的一个查询方法的时候，实际上内在的运作机制如下：
        在当前 yii\db\Query 的构造基础之上，调用 yii\db\QueryBuilder 来生成一条 SQL 语句；
        利用生成的 SQL 语句创建一个 yii\db\Command 对象；
        调用 yii\db\Command 的查询方法（例如，queryAll()）来执行这条 SQL 语句，并检索数据。
     */
    public function actionMethod(){
        $command=(new Query())->select('name')
                ->from('country')
                ->limit(5)
                ->createCommand()
                ->sql;
                ;
        var_dump($command);
    }
    
    /**
     * 索引查询结果
     * 当你在调用 yii\db\Query::all() 方法时，它将返回一个以连续的整型数值为索引的数组。 而有时候你可能希望使用一个特定的字段或者表达式的值来作为索引结果集数组
     */
    public function actionIndex2(){
        $query = (new \yii\db\Query())
                ->from('country')
                ->limit(10)
                //->indexBy('code')
                ->indexBy(function($row){
                    return $row['code'] . $row['name'];
                })
                ->all();
        
        var_dump($query);
    }
    
    /**
     * 批量处理查询  降低内存使用
     * 当需要处理大数据的时候，像 yii\db\Query::all() 这样的方法就不太合适了， 因为它们会把所有数据都读取到内存上。
     * 为了保持较低的内存需求， Yii 提供了一个 所谓的批处理查询的支持。批处理查询会利用数据游标将数据以批为单位取出来
     */
    public function actionBatch(){
        $query=(new Query())->select('*')
                ->from('country')
                ->orderBy('code');
        
        foreach ($query->batch(10) as $values) {
             // $values 是一个包含100条或小于100条用户表数据的数组
             var_dump($values);
        }
        
        echo "\n\n<br/><br/>\n\n";
        
        foreach($query->each() as $value){
            //$value 指代的是用户表当中的其中一行数据
            var_dump($value);
            echo "\n\n<br/><br/>";
        }
    }
    
}
