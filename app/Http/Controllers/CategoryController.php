<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(){
        return view("admin.categories.index");
    }
    public function create(){
        return view("admin.categories.create");
    }
    public function edit($id){
        $category = Category::findOrFail($id);
        return view("admin.categories.create", ["category"=> $category]);
    }
}
