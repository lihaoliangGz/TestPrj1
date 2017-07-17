<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 接收用户数据->文件上传测试的model
 * 
 */

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

/**
 * Description of UploadForm
 *
 * @author Administrator
 */
class UploadForm extends Model{
    
    /**
     *
     * @var 上传的文件
     */
    public $imageFile;
    
    public function rules() {
        return [
            ['imageFile','file','skipOnEmpty'=>false,'extensions'=>'png,jpg'],            
        ];
    }
    
    /**
     * 执行该验证并且把上传的文件保存在服务器上
     * @return boolean
     */
    public function upload(){
        if ($this->validate()) {
            $this->imageFile->saveAs(dirname(__DIR__).'/uploads/' . $this->imageFile->baseName ."_". time(). '.' . $this->imageFile->extension);
            return TRUE;
        } else {
            //$this->errors;
            return FALSE;
        }
    }
    
}
