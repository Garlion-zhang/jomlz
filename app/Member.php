<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model{
    
   public static  function getMember(){
       
       return '模型实例';
   }
   
   //指定表
   protected $table = 'test';
   
   //指定id
   protected $primaryKey = 'id';
   
   //指定允许批量赋值的字段
   protected $fillable = ['name','age'];
   //不允许....
   protected $guarded = [];


   //自动维护时间戳
   public $timestamps = true;
   
   protected function getDateFormat() {  //时间转为Linux保存
       return time();
   }
   
   protected function asDateTime($value) {
       return $value;               //用Linux时间来显示
   }
    
}

