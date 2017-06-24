<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 用于测试app\views\widgets\index.php视图中的表单小部件的model
 * 
 */

namespace app\models;
use yii\base\Model;
/**
 * Description of UserForm
 * 
 * @author Administrator
 */
class UserForm extends Model{
   public  $username;
   public $password;
   
   /**
    * 
    */
   public function rules() {
       return[
           [['username','password'],'required'],
       ];
   }
           
           
}
