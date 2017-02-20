<?php
namespace App\Http\Controllers;

use App\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Mail;

//use Illuminate\Support\Facades\Request;

class MemberController extends Controller
{
    public function info(){
//        return 'member-info';
//        return route('memberinfo');
//       return Member::getMember();
//        return view('member-info');
        //查询
        $admin = DB::select('select * from admin where id > ?',
                [10]);
        dd($admin);
        //添加
//        $bool = DB::insert('insert into admin(username,password) values(?,?)',
//                ['jomlz',123456]);
        
        //更新
//        $admin = DB::update('update admin set username = ? where id = ?',
//                ['jomlz',7]);
//        var_dump($admin);
//        
//        //删除
//        DB::delete('delete from admin  where id = ?', [206]);
    }
    
    public function query1(){
       $bool =  DB::table('test')->insert([
            ['name' => 'jomlz3','age' => 18],    
            ['name' => 'jomlz4','age' => 18],    
                ]);
                var_dump($bool);
//               $id =  DB::table('test')->insertGetId(
//                   ['name' => 'jomlz1','age' =>18]     
//                        );
//                        var_dump($id);
    }
    //更新数据 update
    public function query2(){
        $num = DB::table('test')->where('id',2)->update(['age' => 30,'name' => 'c']);
        var_dump($num);
//         DB::table('test')->increment('age',3); //age字段值自增
//         DB::table('test')->decrement('age',3); //age字段值自减
//         DB::table('test')->where('id',2)->decrement('age',3,['name' => 'jomlz']); //age字段值自减下其他字段也修改
    }
    
    //删除 delete
    public function query3(){
     $num =  DB::table('test')->where('id',4)->delete();  
//     $num =  DB::table('test')->truncate(); //删除整个表 
     var_dump($num);
     
    }
   //查询数据 get 多个条件whereRaw 只返回某个字段的值pluck lists select
    public function query4(){
//       $test =  DB::table('test')->get(); //所有
//       $test =  DB::table('test')->orderBy('id','desc')->first(); //第一条
        
//       $test =  DB::table('test')->whereRaw('id >=? and age > ?',[2,10])->get(); //多条件查询
       
       echo "<pre>"; //chunk 分组查询 大量数据查询的情况下用
        DB::table('test')->chunk(2,function($test){
           var_dump($test);   
           return FALSE;  //停止查询下去
       }); 
//       var_dump($test);
        
    }
    
    //使用模型操作数据
    public function orm1(){
//      $test = new Member();
//      $test->name = 'a';
//      $test->age = 18;
//      $bool = $test->save();
        
//        $test = Member::find(7);
//        echo $test->created_at;
        
//        $test = Member::create(
//                ['name' => 'b', 'age' => 30]
//                );
//        $test = Member::firstOrCreate(  //查询这条数据，没有则新增这条只有name字段的数据
//                ['name' => 'eee']
//                );
        
//                $test = Member::firstOrNew(  //查询这条数据，没有则新增这条数据
//                ['name' => 'ee']
//                );
//              $bool = $test->save();
        
        //通过主键删除
//        $num = Member::destroy(13);
//        var_dump($num);
    }
    
    public function backAjax(){
        ob_start();
        echo str_repeat(' ', 4096);
        ob_end_flush();
        ob_flush();

        $i= 1;
        while(true){
            echo $i++;
            ob_flush();
            flush();
            sleep(1);
        }
    }
    
    //获取请求的实例
    public function request(Request $request){

        $name = Request::input('name'); //url请求参数和值
         dd($name);
//        if($request::has('name')){  //确定一个输入值是否出现
//       echo $request::input('name');
//    }else{
//        echo '无此参数';
//    }
//        $res = $request::all(); //得到请求里的所有输入的值
//        dd($res);
    //
//        if($request::isMethod('POST')){  //判断请求的类型
//            echo 'Yes';
//        }else{
//            echo 'No';
//        }
       $url = $request::url();  //当前url
    }

    public function uploads(Request $request){
     if($request->isMethod('POST')){
         $file = $request->file('source');
         //文件是否上传成功
         if($file->isValid()){
             //源文件信息
             $originalname = $file->getClientOriginalName();
             //扩展名
             $ext = $file->getClientOriginalExtension();
             //类型
             $type = $file->getClientMimeType();
             //临时绝对路径
             $realPath = $file->getRealPath();

             $filename = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
            $bool  = Storage::disk('uploads')->put($filename,file_get_contents($realPath));
           dd($bool);exit;
         }
     }
        
    return view('uploads.uploads');
    }

    public function mail(){
      Mail::raw('邮件内容',function($message){
          $message->from('json_vip@163.com','jomlz');
          $message->subject('邮件主题 测试');
          $message->to('984239932@qq.com');
      });
    }
    
}

