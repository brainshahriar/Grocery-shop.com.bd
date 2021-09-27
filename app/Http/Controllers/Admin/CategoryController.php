<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Subsubcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::latest()->get();
        return view('admin.category.index',compact('categories'));
    }

    //store category
    public function categoryStore(Request $request){

        $request->validate([
            'category_name_en' => 'required',
            'category_name_bn' => 'required',
            'category_icon' => 'required',
       ]);

       Category::insert([
        'category_name_en' => $request->category_name_en,
        'category_name_bn' => $request->category_name_bn,
        'category_slug_en' => strtolower(str_replace(' ','-',$request->category_name_en)),
        'category_slug_bn' => str_replace(' ','-',$request->category_name_bn),
        'category_icon' => $request->category_icon,
        'created_at' => Carbon::now(),
       ]);

       $notification=array(
        'message'=>'Catetory Added Success',
        'alert-type'=>'success'
    );
    return Redirect()->back()->with($notification);

    }

    //edit category
    public function edit($cat_id){
        $category = Category::findOrFail($cat_id);
        return view('admin.category.edit',compact('category'));
    }

    //update

    public function catUpdate(Request $request){
        $cat_id = $request->id;

        Category::findOrFail($cat_id)->Update([
            'category_name_en' => $request->category_name_en,
            'category_name_bn' => $request->category_name_bn,
            'category_slug_en' => strtolower(str_replace(' ','-',$request->category_name_en)),
            'category_slug_bn' => str_replace(' ','-',$request->category_name_bn),
            'category_icon' => $request->category_icon,
            'created_at' => Carbon::now(),
           ]);

           $notification=array(
            'message'=>'Catetory Update Success',
            'alert-type'=>'success'
        );
        return Redirect()->route('category')->with($notification);
    }



    //delete Category
   public function delete($cat_id){
    Category::findOrFail($cat_id)->delete();
        $notification=array(
        'message'=>'Category Delete Success',
        'alert-type'=>'success'
    );
    return Redirect()->back()->with($notification);
    }
     // ==================================== Subcategory ==============================
     public function subIndex(){
        $subcategories = Subcategory::latest()->get();
        $categories = Category::orderBy('category_name_en','ASC')->get();
        return view('admin.sub-category.index',compact('subcategories','categories'));
    }


    // store data in database
    public function subCategoryStore(Request $request){
        $request->validate([
            'subcategory_name_en' => 'required',
            'subcategory_name_bn' => 'required',
            'category_id' => 'required',
        ],[
            'category_id.required' => 'select any category',
        ]);

        Subcategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name_en' => $request->subcategory_name_en,
            'subcategory_name_bn' => $request->subcategory_name_bn,
            'subcategory_slug_en' => strtolower(str_replace(' ','-',$request->subcategory_name_en)),
            'subcategory_slug_bn' => str_replace(' ','-',$request->subcategory_name_bn),
            'created_at' => Carbon::now(),
           ]);

           $notification=array(
            'message'=>'Sub Catetory Added Success',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    //edit subcategory
    public function subEdit($subcat_id){
        $subcategory = Subcategory::findOrFail($subcat_id);
        $categories = Category::orderBy('category_name_en','ASC')->get();
        return view('admin.sub-category.edit',compact('subcategory','categories'));
    }

    //subcategory update
    public function subCatUpdate(Request $request){
        $subcat_id = $request->id;

        Subcategory::findOrFail($subcat_id)->Update([
            'category_id' => $request->category_id,
            'subcategory_name_en' => $request->subcategory_name_en,
            'subcategory_name_bn' => $request->subcategory_name_bn,
            'subcategory_slug_en' => strtolower(str_replace(' ','-',$request->subcategory_name_en)),
            'subcategory_slug_bn' => str_replace(' ','-',$request->subcategory_name_bn),
            'updated_at' => Carbon::now(),
           ]);

           $notification=array(
            'message'=>'Sub-Catetory Update Success',
            'alert-type'=>'success'
        );
        return Redirect()->route('sub-category')->with($notification);
    }

    //delete subcategory
    public function subDelete($subcat_id){

        Subcategory::findOrFail($subcat_id)->delete();
        $notification=array(
        'message'=>'Sub-Category Delete Success',
        'alert-type'=>'success'
    );
    return Redirect()->back()->with($notification);
    }

 // ================================= Sub Sub-Category =================
 public function subSubIndex(){
    $categories = Category::orderBy('category_name_en','ASC')->get();
    $subsubcategories = SubsubCategory::latest()->get();
    return view('admin.sub-sub-category.index',compact('categories','subsubcategories'));
}

//get subcategory with ajax
public function getSubCat($cat_id){
    $subcat = Subcategory::where('category_id',$cat_id)->orderBy('subcategory_name_en','ASC')->get();
    return json_encode($subcat);
}


///store

public function subSubCategoryStore(Request $request){
    SubsubCategory::insert([
        'category_id' => $request->category_id,
        'subcategory_id' => $request->subcategory_id,
        'subsubcategory_name_en' => $request->subsubcategory_name_en,
        'subsubcategory_name_bn' => $request->subsubcategory_name_bn,
        'subsubcategory_slug_en' => strtolower(str_replace(' ','-',$request->subsubcategory_name_en)),
        'subsubcategory_slug_bn' => str_replace(' ','-',$request->subsubcategory_name_bn),
        'created_at' => Carbon::now(),
       ]);

       $notification=array(
        'message'=>'Sub-SubCatetory Added Success',
        'alert-type'=>'success'
    );
    return Redirect()->back()->with($notification);
}


//edit
public function subSubEdit($subsubcat_id){
    $subsubcat = SubsubCategory::findOrFail($subsubcat_id);
    return view('admin.sub-sub-category.edit',compact('subsubcat'));
}

//update
public function subSubCatUpdate(Request $request){
    $subsubcat_id = $request->id;
    SubsubCategory::findOrFail($subsubcat_id)->Update([
        'subsubcategory_name_en' => $request->subsubcategory_name_en,
        'subsubcategory_name_bn' => $request->subsubcategory_name_bn,
        'subsubcategory_slug_en' => strtolower(str_replace(' ','-',$request->subsubcategory_name_en)),
        'subsubcategory_slug_bn' => str_replace(' ','-',$request->subsubcategory_name_bn),
        'updated_at' => Carbon::now(),
       ]);

       $notification=array(
        'message'=>'Sub-SubCatetory Update Success',
        'alert-type'=>'success'
    );
    return Redirect()->route('sub-sub-category')->with($notification);
}


// delete
public function subSubDelete($subsubcat_id){
    SubsubCategory::findOrFail($subsubcat_id)->delete();
    $notification=array(
    'message'=>'Sub Sub-Category Delete Success',
    'alert-type'=>'success'
);
return Redirect()->back()->with($notification);
}
}
