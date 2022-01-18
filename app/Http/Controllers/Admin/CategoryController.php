<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Helper\Exceptions;
use App\Helper\CryptoCode;
use App\Models\Category;
use Auth;
use Session;

class CategoryController extends Controller
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
            $data['datarecords'] = Category::orderBy('cat_id','DESC')->get();
            return view('admin.product.category-mgmt.index',$data);
        } catch (\Exception $e) {
            Exceptions::exception($e);
        }
    }

    public function store(Request $request)
    {
        $this->validateStore($request);
        try
        {  
            if(Category::where('cat_name',$request->cat_name)->exists())
            {
                return back()->withError("Category is already exists!!")->withInput();
            }

            if($request->category_id){
                $categoryId = CryptoCode::decrypt($request->category_id);
                $updateData['cat_name'] = $request->cat_name;
                $update = Category::where('cat_id',$categoryId)->update($updateData);
                $message = "Category is updated!";
            }else{
                $insertData = new Category;
                $insertData['cat_name'] = $request->cat_name;
                $insertData->save();
                $message = "Category is added!";
            }

            if($message)
            {
                Session::flash('success', $message);
                return redirect('category');
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
        'cat_name' => 'required|max:150',
        ]);   
    }

    // To delete record..
    public function destroy(Request $request)
    { 
        if(Category::where('cat_id',$request->cat_id)->exists())
        {
            Category::where('cat_id',$request->cat_id)->delete();
            return $request->cat_id;
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
                $checkStatus = Category::where('cat_id',$request->cat_id)->update(array('cat_status' => 0));
                $data['status'] = "true"; 
            }
            else{
                $checkStatus = Category::where('cat_id',$request->cat_id)->update(array('cat_status' => 1));
                 $data['status'] = "false";
            }
            return $data;
        }catch (\Exception $e) {
             Exceptions::exception($e);
        }
    }
}
