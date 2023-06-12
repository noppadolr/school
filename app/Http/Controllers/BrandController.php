<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Image;
use App\Models\MultiPic;

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

    // แบบปกติ
    // $name_gen= hexdec(uniqid());
    // $img_ext = strtolower($brand_image->getClientOriginalExtension());
    // $img_name = $name_gen.'.'.$img_ext;
    // $up_location = 'upload/images/brand/';
    // $last_img = $up_location.$img_name;
    // $brand_image->move($up_location,$img_name);

    //ใช้ Image Intervention
    $name_gen= hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
    Image::make($brand_image)->resize(300,200)->save('upload/images/brand/'.$name_gen);
    $last_img ='upload/images/brand/'.$name_gen;


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

   public function Update(Request $request,$id){
            $validatedData = $request->validate
            (
                [
                'brand_name' => 'required|min:5',

                ],
                [
                    'brand_name.required' => 'Please enter a brand name',
                    'brand_name.min' => 'Brand Longer than 5 characters',


                ]

            );

            $old_image =$request->old_image;



            $brand_image = $request->file('brand_image');
            if($brand_image){
                $name_gen= hexdec(uniqid());
                $img_ext = strtolower($brand_image->getClientOriginalExtension());
                $img_name = $name_gen.'.'.$img_ext;
                $up_location = 'upload/images/brand/';
                $last_img = $up_location.$img_name;
                $brand_image->move($up_location,$img_name);
                unlink($old_image);

                Brand::find($id)->update([
                'brand_name'=> $request->brand_name,
                'brand_image'=> $last_img,
                'updated_at'=>Carbon::now()

            ]);

            return redirect()->back()->with('success', 'Brand Updated Successfully');

            }else{
                Brand::find($id)->update([
                    'brand_name'=> $request->brand_name,

                    'updated_at'=>Carbon::now()]);
                    return redirect()->back()->with('success', 'Brand Updated Successfully');

            }
   }
   //End Update Method

   public function Delete($id){


    //ลบรูปก่อน
    $image = Brand::find($id);
    $old_image = $image->brand_image;
    unlink($old_image);

    //ลบในฐานข้อมูล

    Brand::find($id)->delete();
    return redirect()->back()->with('success', 'Brand Deleted Successfully');


   }
   //End BrandDelete method

   /// This for All MutiImage methods
   public function MultiPic() {

    $images = Multipic::all();
    return \view('admin.multipic.index',compact('images'));
    }
    //End MultiPic method

    public function StoreImg(Request $request){


        $validatedData = $request->validate
        (

           [ 'image.*' => ['nullable','mimes:jpg,png,jpeg']],


        );

        $image = $request->file('image');

        foreach($image as $multi_img){
        $name_gen= hexdec(uniqid()).'.'.$multi_img->getClientOriginalExtension();
        Image::make($multi_img)->resize(300,200)->save('upload/images/multi/'.$name_gen);
        $last_img ='upload/images/multi/'.$name_gen;


        MultiPic::insert([

        'image'=> $last_img,
        'created_at'=>Carbon::now()

       ]);
        }
        //end foreach
       return redirect()->back();








    }
    //End StoreImg method



}
