<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=db_test1',//MySQL，MariaDB
    //'dsn' => 'pgsql:host=localhost;port=5432;dbname=mydatabase', // PostgreSQL
    //'dsn' => 'cubrid:dbname=demodb;host=localhost;port=33000', // CUBRID
    //'dsn' => 'sqlsrv:Server=localhost;Database=mydatabase', // MS SQL Server, sqlsrv driver
    //'dsn' => 'dblib:host=localhost;dbname=mydatabase', // MS SQL Server, dblib driver
    //'dsn' => 'mssql:host=localhost;dbname=mydatabase', // MS SQL Server, mssql driver
    //'dsn' => 'oci:dbname=//localhost:1521/mydatabase', // Oracle
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
    //...参考yii\db\Connection获取可配置的属性列表
    //如果在创建了连接后需要执行额外的 SQL 查询,添加如下配置
    //'on afterOpen'=> function($event){
        //$event->sender->createCommand("SET time_zone = 'UTC'")->execute();
   // }
    
    
    //使用ODBC连接数据库:
    //'class' => 'yii\db\Connection',
    //'driverName' => 'mysql',
    //'dsn' => 'odbc:Driver={MySQL};Server=localhost;Database=test',
    //'username' => 'root',
    //'password' => '',
    
    
    //如果不想定义数据库连接为全局应用组件，可以在代码中直接初始化使用：
//    $connection = new \yii\db\Connection([
//        'dsn' => $dsn,
//        'username' => $username,
//        'password' => $password,
//    ]);
//    $connection->open();
    
    // 配置从服务器
//    'slaveConfig' => [
//        'username' => 'slave',
//        'password' => '',
//        'attributes' => [
//            // use a smaller connection timeout
//            PDO::ATTR_TIMEOUT => 10,
//        ],
//    ],
    // 配置从服务器组
//    'slaves' => [
//        ['dsn' => 'dsn for slave server 1'],
//        ['dsn' => 'dsn for slave server 2'],
//        ['dsn' => 'dsn for slave server 3'],
//        ['dsn' => 'dsn for slave server 4'],
//    ],
];
