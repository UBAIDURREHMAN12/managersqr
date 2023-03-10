<?php

namespace App\Http\Controllers;

use App\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class categoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // resouce function to show list of categories page (http://managersqr.managershq.com.au/categories)
    public function index()
    {
       $data=Category::where('user_id',Auth::user()->id)->get();
       return view('Categories.index',compact('data'));
    }


    //following function returns category data for fillable form from where we can update category
    public function EditCat($id){

        $data = Category::findOrFail($id);
        return response()->json(['data' => $data]);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // followign function loads category creation page ()
    public function create()
    {
          return view('Categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // this is resource function to save category with user_id as logged in user (system purchaser or owner)
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:200',

        ]);

        db::table('categories')->insert(['name'=>$request->name,'user_id'=>Auth::user()->id]);

        return redirect()->route('categories.index')->with(['success'=>'Category added successfully !']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // this is resource function to get data for fillable form from where we can udpate category
    public function edit($id)
    {
          $category = Category::where('id',$id)->first();

          return view('Categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // following function is use to update category name
    public function update(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|max:200',
        ]);

       db::table('categories')->where('id',$request->id)->update(['name'=>$request->name]);
        return redirect()->route('categories.index')->with(['success'=>'Category updated successfully !']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // following function deletes category
    public function destroy(request $request)
    {
         db::table('categories')->where('id',$request->id)->delete();
        return response()->json(
            ['success'=>false,'message'=>'Category Deleted Successfully','status'=> 200]);

    }
}
