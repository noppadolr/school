<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Category;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
   public function AllCat(){
    return \view('admin.category.index');

   }
   //End AllCat method

   public function AddCat(Request $request)
   {
    $validated = $request->validate
    (
        [
        'category_name' => 'required|unique:categories|max:50',
        ],
        [
            'category_name.required' => 'Please enter a category name',
            'category_name.max' => 'Categories must not exceed 50 characters',
        ],
    );
    // Category::insert([
    //     'category_name'=>$request->category_name,
    //     'user_id'=>Auth::user()->id,
    //     'created_at'=>Carbon::now()
    // ]);


    // $category = new Category;
    // $category->category_name=$request->category_name;
    // $category->user_id=Auth::user()->id;
    // $category->created_at=Carbon::now();
    // $category->save();// แบบนี้มันจะใส่วันที่ update ให้ด้วยครับ 19. Eloquent ORM Insert Data


    $data = array();
    $data['category_name'] = $request->category_name;
    $data['user_id'] = Auth::user()->id;
    $data['created_at']=Carbon::now();
    DB::table('categories')->insert($data);
    //Query Builder

    return Redirect()->back()->with('success','Category Insertes Successfull');


   }
   //End AddCat method




}
