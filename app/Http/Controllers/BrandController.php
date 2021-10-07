<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    //
    public function AllBrand()
    {
        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index',compact('brands'));
    }

    public function StoreBrand(Request $request)
    {

        $validated = $request->validate([
            'brand_name' => 'required|unique:brands|min:4',
            'brand_image' => 'required|mimes:jpg,jpeg,png',
        ],

        [
            'brand_name.required' => 'Please input brand name',
            'brand_image.min' => 'Brand Longer than 4 characters'
        ]
    
        );

        $brand_image = $request->file('brand_image');
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($brand_image->getClientOriginalExtension());
        $img_name = $name_gen.'.'.$img_ext;
        $up_location = 'image/brand/';
        $last_img = $up_location.$img_name;
        $brand_image->move($up_location,$img_name);

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image'=> $last_img,
            'created_at' => Carbon::now(),
        ]);



      /*  $data = array();
        $data['brand_name'] = $request->brand->name;
        $data['brand_image'] = $last_img;
        $data['created_at'] = Carbon::now();
        DB::table('brands')->insert($data);*/

        return Redirect()->back()->with('success', 'Brand created successfully');
    }

    public function Edit($id)
    {
        $brands = Brand::find($id);
        return view('admin.brand.edit',compact('brands'));
    }

    public function Update(Request $request, $id)
    {
        $validated = $request->validate([
            'brand_name' => 'required|min:4',
        ],

        [
            'brand_name.required' => 'Please input brand name',
            'brand_image.min' => 'Brand Longer than 4 characters'
        ]
    
        );
        $old_image = $request->old_image;

        $brand_image = $request->file('brand_image');
        if($brand_image)
        {
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($brand_image->getClientOriginalExtension());
            $img_name = $name_gen.'.'.$img_ext;
            $up_location = 'image/brand/';
            $last_img = $up_location.$img_name;
            $brand_image->move($up_location,$img_name);

            unlink($old_image);

            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'brand_image'=> $last_img,
                'created_at' => Carbon::now(),
            ]);



        /*  $data = array();
            $data['brand_name'] = $request->brand->name;
            $data['brand_image'] = $last_img;
            $data['created_at'] = Carbon::now();
            DB::table('brands')->insert($data);*/

            return Redirect()->route('all.brand')->with('success', 'Brand Updated successfully');
        }
        else
        {
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'created_at' => Carbon::now(),
            ]);



        /*  $data = array();
            $data['brand_name'] = $request->brand->name;
            $data['brand_image'] = $last_img;
            $data['created_at'] = Carbon::now();
            DB::table('brands')->insert($data);*/

            return Redirect()->route('all.brand')->with('success', 'Brand Updated successfully');
        }
        
    }

    public function Delete($id)
    {
        $image = Brand::find($id);
        $old_image = $image->brand_image;
        unlink($old_image);
        
        Brand::find($id)->delete();
        return Redirect()->back()->with('success','Brand deleted successfully');
    }
}
