<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\PremiumRegistration;
use App\Models\SharePremium;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class UsersController extends Controller{


    public function index(){
        return view('users.list-user');
    }

    //show form login register
    public function loginRegister(){
        return view('authenticate.login-register-page');
    }

    //show forgot password form
    public function forgotPassword(){
        return view('authenticate.forgot');
    }

    //handle forgot password
    public function handleForgotPassword(){

    }

    //show reset password form
    public function resetPassword(){
        return view('authenticate.reset');
    }

    //handle reset password
    public function handleResetPassword(){

    }

    public function listUser(){

        $listUser = Cache::remember('list_user', 60, function () {
            return Users::getAllUsers();
        });

        return view('users.user-com', ['listUser' => $listUser]);
    }

    public function findById($id){
        $user = Cache::remember('user_' . $id, 60, function () use ($id) {
            return Users::getUserById($id);
        });

        if($user == null){
            return view('users.user-notfound');
        }

        return view('users.user-com', ['listUser' => [$user] ]);
    }

    public function findByName($name){
        $listUser = Users::getUsersByName($name);

        if($listUser->isEmpty()){

            return view('users.user-notfound');
        }

        return view('users.user-com', ['listUser' => $listUser]);
    }

    public function userDetail($id){
        $user = Users::getUserById($id);

        if($user == null){
            return view('users.user-notfound');
        }

        return view('users.user-detail', ['user' => $user]);
    }

    //form edit user, cần check login trước
    public function showUserDashboard(){

        $data = [
            'user' => Users::getUserById(session('loggedInUser')),
        ];

        $data['current_premium'] = PremiumRegistration::getCurrentPremiumRegistrationByUser(session('loggedInUser'));

        $data['expired_premium'] = PremiumRegistration::getExpiredPremiumRegistrationsByUser(session('loggedInUser'));

        $data['all_premium'] = PremiumRegistration::getAllPremiumRegistrationsByUser(session('loggedInUser'));

        $data['current_shared_premium'] = SharePremium::getCurrentSharedPremiumByUser(session('loggedInUser'));

        $data['all_shared_premium'] = SharePremium::getAllSharedPremiumsByUser(session('loggedInUser'));

        return view('users.user-dashboard', $data);
    }

    //xử lý update ảnh đại diện ajax request
    public function updatePicture(Request $request){

        if(!session('loggedInUser')){
            return response()->json([
                'status' => 401,
                'message' => 'Bạn cần đăng nhập để thực hiện hành động này',
            ]);
        }

        $data = $request->all();

        $user_id = $data['user_id'];

        $user = Users::getUserById($user_id);

        if($request->hasFile('picture_url')){
            $file = $request->file('picture_url');
            $fileName = time() . $file->getClientOriginalName();
            $file->storeAs('public/img/', $fileName);

            if($user->picture_url){
                Storage::delete('public/img/' . $user->picture_url);
            }
        }

        $user->updateUser($user_id, ['picture_url' => $fileName]);

        return response()->json([
            'status' => 200,
            'message' => 'Cập nhật ảnh đại diện thành công',
        ]);

    }



    public function showFormAddUser(){

        return view('users.add-form');
    }

    //xử lý thêm user
    public function addUser(){
        $data = request()->all();

//        echo '<pre>';
//        print_r($data);
//        echo '</pre>';

        unset($data['_token'], $data['_method']);

        $user = new Users();
        $user->createUser($data);

        return redirect()->route('users.all');
    }
}
