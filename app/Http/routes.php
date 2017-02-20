<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('jomlz',function(){
  return 'hello world';  
});

Route::get('member/info','MemberController@info');

Route::get('member/info',[
    'uses' => 'MemberController@info',
    'as'   => 'memberinfo'
]);

Route::get('member/info/{id}',['uses' => 'MemberController@info'])->where('id','[0-9]+');
Route::get('member/query1',['uses' => 'MemberController@query1']);
Route::get('member/query2',['uses' => 'MemberController@query2']);
Route::get('member/query3',['uses' => 'MemberController@query3']);
Route::get('member/query4',['uses' => 'MemberController@query4']);
Route::get('member/orm1',['uses' => 'MemberController@orm1']);
Route::get('member/backAjax',['uses' => 'MemberController@backAjax']);
Route::get('Member/uploads',['uses' => 'MemberController@uploads']);







//Route::match(['get','post'],'multy',function(){
//  return '我是响应get和post的';  
//});
//
//Route::any('nulty1',function(){
//   return '我是请求任何http类型的'; 
//});

//Route::get('user/{id}',function($id){
//    return 'user-id-' . $id;
//})->where('id','[0-9]+');

//Route::get('user/{name?}',function($name = 'jomlz'){
//    return 'user-name-' . $name;
//});

//Route::get('user/{id}/{name?}',function($id,$name = 'jomlz'){
//    return 'user-id-' . $id .'-name-' . $name;
//})->where(['id' => '[0-9]+','name' => '[A-Za-z]+']);

//路由别名
//Route::get('user/center',['as' => 'center', function(){
//    return route('center');
//}]);

//路由群组
//Route::group(['prefix'  => 'menber'], function(){
// 
//    Route::get('user/center',['as' => 'center', function(){
//       return route('center');
//    }]);
//    
//    Route::get('user/{id}',function($id){
//    return 'user-id-' . $id;  
//    })->where('id','[0-9]+');
//});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
    Route::get('student/index', ['uses' => 'StudentController@index']);
    Route::any('student/create', ['uses' => 'StudentController@create']);
    Route::any('student/save', ['uses' => 'StudentController@save']);
    Route::any('student/update/{id}', ['uses' => 'StudentController@update']);
    Route::any('student/detail/{id}', ['uses' => 'StudentController@detail']);
    Route::any('student/delete/{id}', ['uses' => 'StudentController@delete']);
    Route::any('member/uploads',['uses' => 'MemberController@uploads']);
    Route::any('member/backAjax',['uses' => 'MemberController@backAjax']);
    Route::any('member/mail',['uses' => 'MemberController@mail']);

});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
});
