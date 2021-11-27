<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(){
        $category = Category::all();
        return response()->json([
            'status'=>200,
            'category'=>$category
        ]);
    }
    public function edit($id){
        $category = Category::find($id);
        if($category)
        {
            return response()->json([
                'status'=>200,
                'category'=>$category
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'Ko tìm thấy id Category'
            ]);
        }
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'meta_title'=>'required|max:191',
            'slug'=>'required|max:191',
            'name'=>'required|max:191'
        ]);
        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>'Errors'
            ]);
        }
        else
        {

            $category = new Category();
            $category->meta_title = $request->input('meta_title');
            $category->meta_keyword = $request->input('meta_keyword');
            $category->meta_descrip = $request->input('meta_descrip');
            $category->slug = $request->input('slug');
            $category->name = $request->input('name');
            $category->description = $request->input('description');
            $category->status = $request->input('status')==true?"1":"0";
            $category->save();
            return response()->json([
                'status'=>200,
                'message'=>'Add category successfully'
            ]);
        }
    }
    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(),[
            'meta_title'=>'required|max:191',
            'slug'=>'required|max:191',
            'name'=>'required|max:191'
        ]);
        if($validator->fails())
        {
            return response()->json([
                'status'=>402,
                'errors'=>$validator->messages(),
            ]);
        }
        else
        {

            $category = Category::find($id);
            if($category){

                $category->meta_title = $request->input('meta_title');
                $category->meta_keyword = $request->input('meta_keyword');
                $category->meta_descrip = $request->input('meta_descrip');
                $category->slug = $request->input('slug');
                $category->name = $request->input('name');
                $category->description = $request->input('description');
                $category->status = $request->input('status')==true?"1":"0";
                $category->save();
                return response()->json([
                    'status'=>200,
                    'message'=>'Add category successfully'
                ]);
            }
            else{
                return response()->json([
                    'status'=>404,
                    'message'=>'Ko tìm thấy id '
                ]);
            }
        }
    }
    public function destroy($id)
    {
        $category = Category::find($id);
        if($category)
        {
            $category->delete();
            return response()->json([
                'status'=>200,
                'message'=>'Delete category successfully'
            ]);
        }
        else{
            return response()->json([
                'status'=>404,
                'message'=>'Ko tìm thấy id để xóa'
            ]);
        }
    }
}
