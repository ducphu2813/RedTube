<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductsController extends Controller
{

    public function __construct(){

        echo 'Khởi động ProductsController';
        echo '<br>';
    }


    //lấy ra danh sách sản phẩm(GET)
    public function index(){
        return 'Danh sách sản phẩm';
    }

    //show form thêm mới sản phẩm(GET)
    public function create(){
        return 'Form thêm mới sản phẩm';
    }

    //xử lý thêm mới sản phẩm(POST)
    public function store(Request $request){
        return 'Xử lý thêm mới sản phẩm';
    }

    //lấy ra 1 sản phẩm theo id(GET)
    public function show($id){
        return 'Lấy ra sản phẩm có id là '.$id;
    }

    //show form cập nhật thông tin sản phẩm(GET)
    public function edit($id){
        return 'Form cập nhật thông tin sản phẩm có id là '.$id;
    }

    //xử lý cập nhật thông tin sản phẩm(PUT)
    public function update(Request $request, $id){
        return 'Xử lý cập nhật thông tin sản phẩm có id là '.$id;
    }


    //xóa sản phẩm(DELETE)
    public function destroy($id){
        return 'Xóa sản phẩm có id là '.$id;
    }
}
