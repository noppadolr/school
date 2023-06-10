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
}
