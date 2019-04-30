<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /**
     * 处理登录认证
     *
     * @return Response
     * @translator laravelacademy.org
     */
    public function login(Request $request,Response $response)
    {
        $this->validateLogin($request);
        if (Auth::attempt(['name' => $request['name'], 'password' => $request['password']])) {
            // 认证通过...
            return \Response::make([
                'status'=>200,
                'message'=>'登录成功！',
                'data'=>Auth::user()
            ]);
        }else{
            return \Response::make([
                'status'=>404,
                'message'=>'用户名或密码错误'
            ]);
        }
    }
    public function validateLogin(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'password' => 'required|string'
        ]);
    }
    /**
     * 注册用户
     */
    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            // 'api_token' => hash('sha256', Str::random(60)),
            'api_token' => Str::random(60),
        ]);
        return $this->sendResponse(200,'注册成功！',$user);
    }
    public function logout(){
        Auth::logout();
    }
    public function userInfo(Request $request){
        $user = $request->user();
        // $user = Auth::user();
        return $this->sendResponse(200,'获取成功！',$user);
    }


    protected function sendResponse($a, $b, $data)
    {
        return \Response::make([
            'status' => $a,
            'message' => $b,
            'data' => $data
        ]);
    }







    //
    public function userList(Request $request)
    {
        $keyword = $request->keyword;
        if (!empty($keyword)) {
            $lists = User::orderBy('id','desc')
            ->where(function($query) use ($request){
                // 获取关键字
                $keyword = $request->keyword;
                // 检测参数
                if(!empty($keyword)){
                    $query->where('name','like','%'.$keyword.'%');
                };
            })
            ->paginate($request->size);
        }else{
            $lists = User::orderBy('id','desc')->paginate($request->size);
        }
        return $this->sendResponse(200,'获取成功！',$lists);
    }
}
