<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function Allcat()
    {
        //query builder with join query
       // $categories = DB::table('categories')->join('users','categories.user_id','users.id')->select('categories.*','users.name')->latest()->paginate(5);
       // $categories = Category::all(); // To get all data and latest data will be in the last row
        //$categories = Category::latest()->get(); //To get all data and latest will be first row

       // $categories = DB::table('categories')->latest()->get(); // Query builder method

         $categories = Category::latest()->paginate(5); // To get all data and latest data with pagination

         $trachCat = Category::onlyTrashed()->latest()->paginate(3);

        //$categories = DB::table('categories')->latest()->paginate(5); // Query builder method with pagination
        return view('admin.category.index',compact('categories','trachCat'));
    }

    public function Addcat(Request $request)
    {
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ]);

        //Elequent method

       /* Category::insert([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now()
        ]);*/

       /* $category = new Category();
        $category->category_name = $request->category_name;
        $category->user_id = Auth::user()->id;
        $category->save();*/

// Query builder method
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['user_id'] = Auth::user()->id;
        $data['created_at'] = Carbon::now();
        DB::table('categories')->insert($data);

        return Redirect()->back()->with('success','Category successfully inserted');



    }


    public function Edit($id)
    {
        //$categories = Category::find($id);
        $categories = DB::table('categories')->where('id',$id)->first();
        return view('admin.category.edit',compact('categories'));

    }

    public function Update(Request $request, $id)
    {
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['user_id'] = Auth::user()->id;
        DB::table('categories')->where('id',$id)->update($data);
        /*$update = Category::find($id)->update([
            'category_name'=>$request->category_name,
            'user_id' => Auth::user()->id
        ]);*/

        return Redirect()->route('all.category')->with('success','Category successfully updated');
    }

    public function SoftDelete($id)
    {
        $delete = Category::find($id)->delete();
        return Redirect()->back()->with('success', 'Category deleted successfully');
    }

    public function Restore($id)
    {
        $delete = Category::withTrashed()->find($id)->restore();
        return Redirect()->back()->with('success', 'Category Restored successfully'); 
    }

    public function PDelete($id)
    {
        $delete = Category::onlyTrashed()->find($id)->forceDelete();
        return Redirect()->back()->with('success', 'Category permanently deleted');
    }
}
