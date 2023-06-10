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
    //one to one relation with query builder
    // $categories=DB::table('categories')
    //                 ->join('users','categories.user_id','users.id')
    //                 ->select('categories.*','users.name')->latest()->paginate(10);

    // $categories=Category::all(); //เรียกทั้งหมดมา
    // $categories=Category::latest()->get();

    //loquent ORM
    $categories=Category::latest()->paginate(5);

    // $categories=Category::latest()->paginate(5);
    //เรียงจากล่าสุดไป


       //Query Builder
    // $categories=DB::table('categories')->latest()->paginate(5);



    return \view('admin.category.index',compact('categories'));

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
    Category::insert([
        'category_name'=>$request->category_name,
        'user_id'=>Auth::user()->id,
        'created_at'=>Carbon::now()
    ]);


    // $category = new Category;
    // $category->category_name=$request->category_name;
    // $category->user_id=Auth::user()->id;
    // $category->created_at=Carbon::now();
    // $category->save();// แบบนี้มันจะใส่วันที่ update ให้ด้วยครับ 19. Eloquent ORM Insert Data


    // $data = array();
    // $data['category_name'] = $request->category_name;
    // $data['user_id'] = Auth::user()->id;
    // $data['created_at']=Carbon::now();
    // DB::table('categories')->insert($data);
    //Query Builder

    return Redirect()->back()->with('success','Category Insertes Successfull');


   }
   //End AddCat method

public function Edit($id){
    //Eloquent ORM Edit data
    // $categories = Category::find($id);

    //User Query Builder for edit
    $categories =DB::table('categories')->where('id',$id)->first();

    return \view('admin.category.edit',compact('categories'));

}
//End Edit method

public function Update(Request $request,$id){
    //Eloquent ORM Update data
    // $update = Category::find($id)->update([
    //     'category_name'=> $request->category_name,
    //     'update_user_id'=>Auth::user()->id,
    //     'updated_at'=>Carbon::now()

    // ]);

    //User Query Builder for update
    $data=array();
    $data['category_name'] = $request->category_name;
    $data['update_user_id'] = Auth::user()->id;
    $data['updated_at'] = Carbon::now();
    DB::table('categories')->where('id',$id)->update($data);


    return Redirect()->route('all.category')->with('success','Category Updated Successfull');
}
//End Update method






}
