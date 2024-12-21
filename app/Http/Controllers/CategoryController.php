<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function create(){
        return view("categories.create");
    }
    public function edit($id){
        $category = Category::findOrFail($id);
        return view("categories.create", ["category"=> $category]);
    }
}
