<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Helper\Exceptions;
use App\Helper\CryptoCode;
use App\Models\Category;
use App\Models\SubCategory;
use Auth;
use Session;

class SubCategoryController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Grid List...
    public function index(Request $request)
    {
        try
        {
            $data['categorys'] = Category::orderBy('cat_name','ASC')->get();
            $data['datarecords'] = SubCategory::join('tbl_categorys','tbl_sub_categorys.sub_cat_id','tbl_categorys.cat_id')->orderBy('sub_id','DESC')->get();
            return view('admin.product.sub-category-mgmt.index',$data);
        } catch (\Exception $e) {
            Exceptions::exception($e);
        }
    }

    public function store(Request $request)
    {
        $this->validateStore($request);
        try
        {  
            if(SubCategory::where('sub_cat_name',$request->sub_cat_name)->exists())
            {
                return back()->withError("Category is already exists!!")->withInput();
            }

            if($request->category_id){
                $categoryId = CryptoCode::decrypt($request->category_id);
                $updateData['cat_name'] = $request->cat_name;
                $update = SubCategory::where('sub_id',$categoryId)->update($updateData);
                $message = "Category is updated!";
            }else{
                $insertData = new SubCategory;
                $insertData['sub_cat_id'] = CryptoCode::decrypt($request->sub_cat_id);
                $insertData['sub_cat_name'] = $request->sub_cat_name;
                $insertData->save();
                $message = "Sub category is added!";
            }

            if($message)
            {
                Session::flash('success', $message);
                return redirect('/sub-category');
            }else{
                return back()->withError("Category isn't created!")->withInput();
            }
            
        }catch (\Exception $e) {
            Exceptions::exception($e);
            return back()->withError(substr($e->getMessage(),1,200))->withInput();
        }
    }

    // Validation to check here..
    private function validateStore($request)
    {
        $this->validate($request, [
        'sub_cat_id' => 'required',
        'sub_cat_name' => 'required|max:150',
        ]);   
    }

    // To delete record..
    public function destroy(Request $request)
    { 
        if(SubCategory::where('sub_id',$request->sub_id)->exists())
        {
            SubCategory::where('sub_id',$request->sub_id)->delete();
            return $request->sub_id;
        }else{
          Session::flash('error', "Record isn't deleted!");
          return redirect()->intended('/category');
        }
    }

    // To check active / inactive status...
    public function changeStatus(Request $request)
    {
        try
        {  
            if($request->mode == "true"){
                $checkStatus = SubCategory::where('sub_id',$request->sub_id)->update(array('cat_status' => 0));
                $data['status'] = "true"; 
            }
            else{
                $checkStatus = SubCategory::where('sub_id',$request->sub_id)->update(array('cat_status' => 1));
                 $data['status'] = "false";
            }
            return $data;
        }catch (\Exception $e) {
             Exceptions::exception($e);
        }
    }
}
