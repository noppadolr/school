<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
   public function AllCat(){
    return \view('admin.category.index');

   }
   //End AllCat method

   public function AddCat(Request $request):RedirectResponse
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

   }
   //End AddCat method




}
