<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
   public function AllBrand(){
    $brands = Brand::latest()->paginate(5);

    return view('admin.brand.index',compact('brands'));
   }
   //End AllBrand Method

   public function StoreBrand(Request $request){
    $validatedData = $request->validate
    (
        [
        'brand_name' => 'required|unique:brands|min:5',

        'brand_image' => 'required|mimes:jpg,jpeg,png',
        ],
        [
            'brand_name.required' => 'Please enter a brand name',
            'brand_name.min' => 'Brand Longer than 5 characters',
            'brand_image.required'=>'Please Choose a brand Image',

        ]

    );
    $brand_image = $request->file('brand_image');

    $name_gen= hexdec(uniqid());
    $img_ext = strtolower($brand_image->getClientOriginalExtension());
    $img_name = $name_gen.'.'.$img_ext;
    $up_location = 'upload/images/brand/';
    $last_img = $up_location.$img_name;
    $brand_image->move($up_location,$img_name);

   Brand::insert([
    'brand_name'=> $request->brand_name,
    'brand_image'=> $last_img,
    'created_at'=>Carbon::now()

   ]);
   return redirect()->back()->with('success', 'Brand Inserted Successfully');


   }
   //End StoreBrand Method

   public function Edit($id){
    $brands = Brand::find($id);
    return view('admin.brands.brand_edit',compact('brands'));

   }
   //End Edit Method



}
