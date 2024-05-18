<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;

class HomeController extends Controller{

    //action index
    public function index(){

        $title = 'Học laravel cơ bản';
        $homeContent = 'Chào mừng bạn đến với laravel';

        $componentData = [
            'name' => 'Laravel',
            'description' => 'Dữ liệu được truyền từ controller sang view'
        ];

        $data = compact('title', 'homeContent', 'componentData');


        //2 cách để truyền dữ liệu từ controller sang view
        // cách 2 cần thêm use Illuminate\Support\Facades\View; ở đầu file
        return view('home', $data);

    }


    public function getCategory($category){
        return 'Danh mục: '.$category;
    }
}
