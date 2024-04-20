<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SchoolsController extends Controller{

    public function __construct(Request $request){

    }

    //lấy ra danh sách trường học(GET)
    public function index(Request $request){

        $path = $request->path();
        echo $path;
        echo '<br>';

//        $name = $request->query();
//
//        dd($name);

        return 'Danh sách trường học';
    }

    //lấy ra 1 trường học theo id(GET)
    public function getSchool($id){
        return 'Lấy ra trường học có id là '.$id;
    }

    //show form cập nhật thông tin trường học(GET)
    public function showFormUpdateSchool($id){
        $data = [
            'id' =>$id,
        ];

        return view('school.edit-form', $data);
    }

    //xử lý cập nhật thông tin trường học(PUT)
    public function handleUpdateSchool($id){

    }

    //show form thêm mới trường học(GET)
    public function showFormAddSchool(Request $request){

        echo '<br>';

        //
        $schoolName = $request->old('school_name');
        $data = [
            'title' => 'Thêm mới trường học',
            'schoolName' => $schoolName,
        ];

        echo '<br>';


        return view('school.add-form', $data);
    }

    //xử lý thêm mới trường học(POST)
    public function handleAddSchool(Request $request){

//        $schoolsUrl = route('schools.index');
//        return redirect($schoolsUrl);

        //các cách lấy dữ liệu từ request
//        $schoolName = request()->school_name;

//        $schoolName = $request->input('school_name');

//        $schoolName = $request->school_name;
//
//        echo $schoolName;

        //query chỉ lấy ra các tham số trên url không lấy ra các tham số post
//        $name = $request->query();


        //kiểm tra xem có trường school_name trong request không
//        if($request->has('school_name')){
//            $schoolName = $request->school_name;
//            dd($schoolName);
//        }
//        else{
//            echo 'Không có trường school_name trong request';
//        }



        //cái này dùng trong trường hợp muốn lưu lại dữ liệu cũ khi validate form
//        if($request->has('school_name')){
//            $schoolName = $request->school_name;
//
//            // lưu lại dữ liệu cũ(vào session) nếu validate không thành công
//            $request->flash();
//
////            return redirect()->route('schools.add');
//        }
//        else{
//            echo 'Không có trường school_name trong request';
//        }


        //xử lý file upload
//        if($request->hasFile('logo')){
//            $file = $request->file('logo');
//            $filePath = $file->path();
//            $fileName = $file->getClientOriginalName();
//            $fileExtension = $file->getClientOriginalExtension();
//            echo 'Đã upload file '.$fileName.' có đuôi '.$fileExtension.' lên đường dẫn '.$filePath;
//        }
//        else{
//            return 'Vui lòng chọn file';
//        }



        echo '<br>';

        $name = $request->all()['school_name'];

        $data = [
            'message' => 'Thêm mới trường học có tên là '.$name.' thành công',
        ];

        return view('school.add-success', $data);


    }


    //xóa trường học(DELETE)
    public function deleteSchool($id){
        return 'Xóa trường học có id là '.$id;
    }
}
