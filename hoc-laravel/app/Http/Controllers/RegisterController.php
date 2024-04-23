<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Rules\RegisterUniqueRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller{


    //xử lý đăng ký
    public function register(Request $request){

        if($request->session()->has('loggedInUser')){
            return redirect()->route('users.dashboard');
        }

        $validator = Validator::make($request->all(), [
            'user_name' => [
                'required',
                new RegisterUniqueRule('users', 'user_name'),
                'regex:/^[a-zA-Z0-9]{6,20}$/',
                //chỉ chứa chữ cái, số, không chứa ký tự đặc biệt, tối thiểu 6 ký tự và tối đa 20 ký tự
            ],
            'email' => [
                'required',
                new RegisterUniqueRule('users', 'email'),
                'regex:/^\b[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Z|a-z]{2,}\b$/',
                //định dạng email theo cấu trúc rất cơ bản
            ],
            'password' => [
                'required',
                'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[@#$%^&*]).{8,}$/',
                //tối thiểu 8 ký tự, ít nhất 1 chữ cái viết hoa, 1 số và 1 ký tự đặc biệt trong danh sách(@#$%^&*)
            ],
            'confirm_password' => 'required|same:password',
        ], [
            'user_name.required' => 'Tên người dùng không được để trống',
            'user_name.regex' => 'Tên người dùng không chứa ký tự đặc biệt, không khoảng trắng, tối thiểu 6 ký tự và tối đa 20 ký tự',
            'email.required' => 'Email không được để trống',
            'email.regex' => 'Email không hợp lệ',
            'password.required' => 'Mật khẩu không được để trống',
            'password.regex' => 'Mật khẩu phải có ít nhất 1 chữ cái viết hoa, 1 số và 1 ký tự đặc biệt(@#$%^&*), tối thiểu 8 ký tự',
            'confirm_password.required' => 'Vui lòng nhập lại mật khẩu',
            'confirm_password.same' => 'Nhập lại mật khẩu không khớp',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validator->getMessageBag(),
            ]);
        }
        else{

            $user = new Users();

            $data = [
                'user_name' => $request->user_name,
                'email' => $request->email,
                'password' => $request->password,
                'created_date' => date('Y-m-d H:i:s'),
                'active' => 1,
                'channel_name' => $request->user_name,
                'role' => 1,
            ];

            //cái này là để lưu user, comment lại để làm giao diện trước
//            $user->createUser($data);


            //lấy ra id của user vừa tạo
//            $userId = Users::
            //lưu id user vào session
//            $request->session()->put('loggedInUser', $user->user_id);

            return response()->json([
                'status' => 200,
                'message' => 'Đăng ký thành công',
            ]);
        }

    }

}
