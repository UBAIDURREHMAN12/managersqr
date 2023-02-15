<?php

namespace App\Http\Controllers;




use App\Mail\vendorPassword;
use App\Vendor;
use App\vendors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class VendorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {

        //check if user is logged in
        $this->middleware('auth');
    }

    //this function loads vendors list
    // page url is (http://managersqr.managershq.com.au/vendors)
    public function index()
    {
        //load vendor index page
        $data = Vendor::where('user_id',Auth::user()->id)->orderBy('id','DESC')->get();
        return view('vendors.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // following function returns a view form where we can create a vendor
    public function create(Request $request)
    {

        //load create vendor form

//        $categories = DB::table('vendor_categories')->where([['user_id',Auth::user()->id]])
//            ->orWhere([['user_id',0]])->get();
        $categories = DB::table('vendor_categories')->get();

        return view('vendors.create',compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // following function is use to create a vendor
    // also insert data in vendor_category table with required
    // data like user_id is the id of owner (person who purshse this system) logged in person id
    public function store(Request $request)
    {

        //insert vendors according for a particular organisation


        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:vendors,email',
            'address'=>'required',

        ]);


        $input = $request->all();


        $digits = 8;
        $password = rand(pow(10, $digits-1), pow(10, $digits)-1);
        $hashed_random_password = Hash::make($password);
        $input['user_id']=Auth::user()->id;
        $input['password']=$hashed_random_password;
        if($request->category=='other'){
            $input['category']=$request->other;
        }

        $vendor = Vendor::create($input);


        $data = array('email'=>$vendor->email,'password'=>$password);
        $vendors = Vendor::findOrFail($vendor->id);

        if(!empty($request->other)) {
            $count = DB::table('vendor_categories')->where('name', $request->other)->count();
            if ($count == 0) {
                $d = array(
                    'name' => ucfirst($request->other),
                    'user_id' => Auth::user()->id
                );
                DB::table('vendor_categories')->insert($d);

            }
        }

        //send  account information through email
//        Mail::to($data['email'])->send(new vendorPassword($vendors,$password));
        if($vendor){
            return redirect('/vendors')
                ->with('success','Vendor created successfully');
        }else{
            return view('vendors')->withErrors();

        }

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
        $categories = DB::table('vendor_categories')->get();

        //load vendor edit form
        $vendor = DB::table('vendors')->where('id', $id)->first();

        return view('vendors.edit',compact('vendor','categories'));



//        if($vendor){
//            return view('v',compact('user'));
//        }

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // this is resource function use to update vendor data
    public function update(Request $request)
    {


        //update the vendor information

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'address'=>'required',
            'category'=>'required'
        ]);

        $data=array(
            'name'=>$request->name,
            'email'=>$request->email,
            'address'=>$request->address,
            'category'=>$request->category,
        );

        $vendor=Vendor::where('id', $request->id)->update($data);

        return redirect()->route('vendors.index')
            ->with('success','Vendor updated successfully');




    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //delete vendor

        if(DB::table('vendors')->where('id', $request->id)->delete()){
            return response()->json(
                ['success'=>false,'message'=>'Vendor Deleted Successfully','status'=> 200]);
        }else{
            return response()->json(
                ['success'=>false,'message'=>'Oops,Something went wrong','status'=> 500]);
        }


    }

    // following function generates random password for a vendor and send him/her
    // on mail which is used at vendor creation time
    function generatePassword(Request $request){

        //this is the generate password function which is now move to on creation
        $vendor = Vendor::findOrFail($request->id);

        $digits = 8;
        $password = rand(pow(10, $digits-1), pow(10, $digits)-1);
        $hashed_random_password = Hash::make($password);

        Vendor::where('id', $request->id)->update(['password'=>$hashed_random_password]);
        $data = array('email'=>$vendor->email,'password'=>$password);
        Mail::to($data['email'])->send(new vendorPassword($vendor,$password));
        return response()->json(
            ['success'=>false,'message'=>'Password generated and sent to vendor','status'=> 200]);

    }
}




