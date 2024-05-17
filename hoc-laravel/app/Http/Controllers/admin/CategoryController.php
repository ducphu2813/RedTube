<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function createNewCategory(Request $request){
        $data = $request->all();
        $category = new Category();
        $category->createCategory($data);
        return response()->json(['status' => 'success']);
    }
}
