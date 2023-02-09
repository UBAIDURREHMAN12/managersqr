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
    public function index()
    {
       $data=category::where('user_id',Auth::user()->id)->get();
       return view('Categories.index',compact('data'));
    }


    public function EditCat($id){

        $data = category::findOrFail($id);
        return response()->json(['data' => $data]);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
    public function edit($id)
    {
          $category = category::where('id',$id)->first();

          return view('Categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
    public function destroy(request $request)
    {
         db::table('categories')->where('id',$request->id)->delete();
        return response()->json(
            ['success'=>false,'message'=>'Category Deleted Successfully','status'=> 200]);

    }
}
