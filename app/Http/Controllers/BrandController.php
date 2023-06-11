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


   }
   //End StoreBrand Method






}
