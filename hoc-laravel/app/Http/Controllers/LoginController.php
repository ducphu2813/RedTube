<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Rules\LoginUniqueRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller{

    //xử lý đăng nhập
    public function login(Request $request){

        if($request->session()->has('loggedInUser')){
            return redirect()->route('users.dashboard');
        }

        $validator = Validator::make($request->all(), [
            'user_name' => [
                'required',
                new LoginUniqueRule('users', 'user_name'),
            ],
            'password' => 'required',
        ], [
            'user_name.required' => 'Tài khoản không được để trống',
            'password.required' => 'Mật khẩu không được để trống',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'message' => $validator->getMessageBag(),
            ]);
        }
        else{

            //khi tài khoản tồn tại, kiểm tra mật khẩu
            //sử dụng whereRaw và BINARY để đưa chuỗi về dạng binary để so sánh, tránh trường hợp không phân biệt chữ hoa chữ thường
            $user = Users::query()->whereRaw("BINARY `user_name` = ?", [$request->user_name])->first();

            if($user->password == $request->password){

                $request->session()->put('loggedInUser', $user->user_id);
                $request->session()->put('userPermission', $user->role);

                return response()->json([
                    'status' => 200,
                    'message' => 'Đăng nhập thành công',
                ]);
            }
            else{
                return response()->json([
                    'status' => 400,
                    'message' => 'Mật khẩu không chính xác',
                ]);
            }
        }

    }

    //xử lý đăng xuất
    public function logout(Request $request){
        if(session()->has('loggedInUser')){

            //lấy ra giá trị của loggedInUser và quên nó đi
            session()->pull('loggedInUser');
            session()->pull('userPermission');
        }

        return redirect()->route('login-register')
            ->header(
                'Cache-Control',
                'no-cache, no-store, max-age=0, must-revalidate')
            ->header('Pragma','no-cache')
            ->header('Expires', '0');
    }
}
