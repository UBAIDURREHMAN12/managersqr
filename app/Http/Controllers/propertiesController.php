<?php

namespace App\Http\Controllers;
use Bitly;
use Imagick;
use App\TempLogo;
use App\Order;
use ZipArchive;
use App\property;
use App\Helper\Helper;
use Endroid\QrCode\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Endroid\QrCode\ErrorCorrectionLevel;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use ShortURL;
use AshAllenDesign\ShortURL\Classes\Builder;
use CodeOfDigital\LaravelUrlShortener\Facades\UrlShortener;


class propertiesController extends Controller
{
    public function __construct()
    {

        //check if user is login or not
        $this->middleware('auth');
    }

    public function SaveLogo(Request $request){

        $image = $request->file('image');

        $new_name = rand() . '.' . $image->getClientOriginalExtension();

        $image->move(public_path('companyLogos'), $new_name);

        $ifAlreadyExists = TempLogo::where('userId', Auth::user()->id)->first();

        if($ifAlreadyExists){

            $form_data = array(
                'image'    =>  $new_name,
            );

            $ifAlreadyExists->update($form_data);

        }else{
            $form_data = array(
                'userId'        =>  Auth::user()->id,
                'image'    =>  $new_name,
            );

            TempLogo::create($form_data);
        }


    }


    function vgdShorten($url,$shorturl = null)
    {

        $url = urlencode('[URL_YOU_WANT_SHORTEN]');
        $json = file_get_contents("https://cutt.ly/team/API/index.php?key=[API_KEY]&action=[shorten]&url=$url&name=[CUSTOM_URL_ALIAS]&domain=[domain name (cutt.ly)]");
        $data = json_decode ($json, true);
        var_dump($data);

        //$url - The original URL you want shortened
        //$shorturl - Your desired short URL (optional)

        //This function returns an array giving the results of your shortening
        //If successful $result["shortURL"] will give your new shortened URL
        //If unsuccessful $result["errorMessage"] will give an explanation of why
        //and $result["errorCode"] will give a code indicating the type of error

        //See https://v.gd/apishorteningreference.php#errcodes for an explanation of what the
        //error codes mean. In addition to that list this function can return an
        //error code of -1 meaning there was an internal error e.g. if it failed
        //to fetch the API page.

        $url = urlencode($url);
        $basepath = "https://v.gd/create.php?format=simple";
        //if you want to use is.gd instead, just swap the above line for the commented out one below
        //$basepath = "https://is.gd/create.php?format=simple";
        $result = array();
        $result["errorCode"] = -1;
        $result["shortURL"] = null;
        $result["errorMessage"] = null;

        //We need to set a context with ignore_errors on otherwise PHP doesn't fetch
        //page content for failure HTTP status codes (v.gd needs this to return error
        //messages when using simple format)
        $opts = array("http" => array("ignore_errors" => true));
        $context = stream_context_create($opts);

        if($shorturl)
            $path = $basepath."&shorturl=$shorturl&url=$url";
        else
            $path = $basepath."&url=$url";

        $response = @file_get_contents($path,false,$context);

        if(!isset($http_response_header))
        {
            $result["errorMessage"] = "Local error: Failed to fetch API page";
            return($result);
        }

        //Hacky way of getting the HTTP status code from the response headers
        if (!preg_match("{[0-9]{3}}",$http_response_header[0],$httpStatus))
        {
            $result["errorMessage"] = "Local error: Failed to extract HTTP status from result request";
            return($result);
        }

        $errorCode = -1;
        switch($httpStatus[0])
        {
            case 200:
                $errorCode = 0;
                break;
            case 400:
                $errorCode = 1;
                break;
            case 406:
                $errorCode = 2;
                break;
            case 502:
                $errorCode = 3;
                break;
            case 503:
                $errorCode = 4;
                break;
        }

        if($errorCode==-1)
        {
            $result["errorMessage"] = "Local error: Unexpected response code received from server";
            return($result);
        }

        $result["errorCode"] = $errorCode;
        if($errorCode==0)
            $result["shortURL"] = $response;
        else
            $result["errorMessage"] = $response;

        return($result);
    }

    public function testencryption(Request $request){


        $shortUrl = UrlShortener::shorten('https://www.facebook.com/');
        echo $shortUrl;
        dd();
//        $builder = new Builder();
//
//        $shortURLObject = $builder
//            ->destinationUrl('https://destination.com')
//            ->singleUse()
//            ->make();


        $result = $this->vgdShorten("https://codegrippers.com/");
//below line would be how to request a custom URL instead of an automatically generated one
//in this case asking for https://v.gd/mytesturl
//$result = vgdShorten("https://www.reddit.com/","mytesturl");

        if($result["shortURL"])
            print("Success, your new shortened URL is ".$result["shortURL"]."\n");
        else
        {
            print("There was an error, code: ".$result["errorCode"]."\n");
            print($result["errorMessage"]."\n");
        }

        if($result["errorCode"]==3)
        {
            //Error code 3 means your app has exceeded our rate limit.
            //In a real app you'd take some action here to prevent it
            //from using v.gd again for 1 minute or so.
        }

    }

    public function index()
    {
        //load properties index page


//        $data = property::where('user_id',Auth::user()->id)->get();
        $data = property::where('user_id',Auth::user()->id)->orderBy('id', 'DESC')->get();

        return view('properties.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        //load user create properties view
        $user = DB::table('users')->where('id', Auth::user()->id)->first();
        return view('properties.create',compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */



    public function store(Request $request)
    {
        $request->validate([
            'title'    =>  'required|regex:/^[a-zA-Z0-9 ]+$/|max:255',
            'location' =>  'required|regex:/^[a-zA-Z0-9 ]+$/|max:255'
        ]);

        $counter=property::where('title',$request->title)->count();

        if($counter>0){
            return redirect()->back()->withErrors(['Property with same name already exist !']);
        }


    try{
        if($request->des=='units' || $request->des=='Apartments') {
            $this->validate($request, [
                'title' => 'required',
                // 'des' => 'required',
                'location' => 'required',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'floors' => 'required',

            ]);
        }

        if($request->des=='other'){
            $this->validate($request, [
                'title' => 'required',
                // 'des' => 'required',
                'location' => 'required',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'area' => 'required',

            ]);
        }




        $input=$request->all();

        if(empty($input['user_id'])){
            $input['user_id']=Auth::user()->id;

        }

        if(isset($request->defaultProperty)){
            $defaultProperty=$request->defaultProperty;

            $count= DB::table('properties')->where([['defaultProperty',1],['user_id',Auth::user()->id]])->count();

            if($count>0){
                $updatedProperty=DB::table('properties')->where([['defaultProperty',1],['user_id',Auth::user()->id]])->first();

                $update=array(
                    'defaultProperty'=>0
                );

                DB::table('properties')->where('id',$updatedProperty->id)->update($update);
            }

            $input['defaultProperty']=1;

        }else{


            $input['defaultProperty']=0;
        }

        if($request->hasfile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('/img'), $imageName);

            $input['image'] = url('/public/img/' . $imageName);
        }

        $user = property::create($input);

        $i=1;
        if(isset($request->rooms)){
            foreach($request->rooms as $r){

                if(!empty($r)){
                    $data=array(
                        'rooms'=>$r,
                        'prefix'=>str_pad($i, 2, '0', STR_PAD_LEFT),
                        'floorNo'=>$i,
                        'property_id'=>$user->id
                    );
                    DB::table('property_room_info')->insert($data);

                }else{

                    $data=array(
                        'rooms'=>0,
                        'prefix'=>str_pad($i, 2, '0', STR_PAD_LEFT),
                        'floorNo'=>$i,
                        'property_id'=>$user->id
                    );
                    DB::table('property_room_info')->insert($data);

                }



                $i++;
            }
        }

        $property = DB::table('properties')->where('id',$user->id)->first();


        if(!empty($property->floors) && $property->floors>0) {

            $nameofdirectory =str_replace(' ', '', $property->title);

            File::makeDirectory(public_path() . '/qrCodeProperties/' . $nameofdirectory, $mode = 0777, true, true);

            $qrcodeData = DB::table('qrocde_info')->where('property_id', $property->id)->count();

            if($qrcodeData>0){
                DB::table('qrocde_info')->where('property_id', $property->id)->delete();
            }


            for ($i = 1; $i <= $property->floors; $i++) {
                $roomsData = DB::table('property_room_info')->where([['property_id', $property->id], ['floorNo', $i]])->first();
                if(isset($roomsData->rooms) && !empty($roomsData->rooms)) {

                    for ($j = 1; $j <= $roomsData->rooms; $j++) {

                        $data = array(
                            'floor_no' => $i,
                            'room_no' => $j,
                            'property_id' => $user->id
                        );

                        $infoid = db::table('qrocde_info')->insertGetId($data);
//                        $url_original = URL::to('/form/' . $infoid);

                        $url_original =  UrlShortener::shorten(URL::to('/form/' . $infoid));


//                        $url = Bitly::getUrl($url_original);
                        $file_name = rtrim($request->des,"s") . str_pad($i, 2, '0', STR_PAD_LEFT) . str_pad($j, 2, '0', STR_PAD_LEFT) . '.pdf';
                        $path=public_path('/qrCodeProperties/' . $nameofdirectory . '/' . $file_name);
                        $qrcode = $this->generateQrcode(session()->get('qrCode'), $url_original,$path);

                    }
                }else{



                    $data = array(
                        'floor_no' => $i,
                        'room_no' => 0,
                        'property_id' => $user->id

                    );
                    $j=0;

                    $infoid = db::table('qrocde_info')->insertGetId($data);
//                    $url_original  = URL::to('/form/' . $infoid);
                    $url_original =  UrlShortener::shorten(URL::to('/form/' . $infoid));
//                    $url = Bitly::getUrl($url_original);
                    $file_name = rtrim($request->des,"s") . str_pad($i, 2, '0', STR_PAD_LEFT)  . '.pdf';
                    $path=public_path('/qrCodeProperties/' . $nameofdirectory . '/' . $file_name);
                    $qrcode = $this->generateQrcode(session()->get('qrCode'), $url_original,$path);


                }
            }


            $path = public_path() . '/qrCodeProperties/' . $nameofdirectory;
            $zip = new ZipArchive;

            $fileName = $nameofdirectory . '.zip';

            if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE) {
                $files = File::files($path);

                foreach ($files as $key => $value) {
                    $relativeNameInZipFile = basename($value);
                    $zip->addFile($value, $relativeNameInZipFile);
                }

                $zip->close();
            }

            db::table('properties')->where('id',$property->id)->update(['qrcodeLink'=>'/public/'.$fileName]);


//            session()->put('downloadFile', 'public/' . $fileName);
            return redirect('/properties')->with(['success'=>'Qrcode generated successfully !']);

        }

        if(!empty($request->area) && count($request->area)>0){



            $nameofdirectory = str_replace(' ', '', $property->title);
            File::makeDirectory(public_path() . '/qrCodeProperties/' . $nameofdirectory, $mode = 0777, true, true);

            if(isset($request->area)){
                foreach ($request->area as $a) {
                    if(!empty($a)){
                        $data = array(
                            'area' => $a,
                            'property_id' => $user->id

                        );

                        $infoid = db::table('qrocde_info')->insertGetId($data);


//                        $url_original  = URL::to('/form/' . $infoid);
                        $url_original =  UrlShortener::shorten(URL::to('/form/' . $infoid));
//                        $url = Bitly::getUrl($url_original);
                        $file_name = $a . '.pdf'; //generating unique file name;
                        $path=public_path('/qrCodeProperties/' . $nameofdirectory . '/' . $file_name);
                        $qrcode = $this->generateQrcode(session()->get('qrCode'), $url_original,$path);


                    }
                }
                $path = public_path() . '/qrCodeProperties/' . $nameofdirectory;
                $zip = new ZipArchive;

                $fileName = $nameofdirectory . '.zip';
                if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE) {
                    $files = File::files($path);

                    foreach ($files as $key => $value) {
                        $relativeNameInZipFile = basename($value);
                        $zip->addFile($value, $relativeNameInZipFile);
                    }

                    $zip->close();
                }
//                session()->put('downloadFile', 'public/' . $fileName);
                db::table('properties')->where('id',$property->id)->update(['qrcodeLink'=>'/public/'.$fileName]);

                return redirect('/properties')->with(['success' => 'Qrcode generated successfully']);

            }


        }


        if(empty($property->floors) && empty($request->area)){
            $nameofdirectory =str_replace(' ', '', $property->title);

            File::makeDirectory(public_path() . '/qrCodeProperties/' . $nameofdirectory, $mode = 0777, true, true);

            $qrcodeData = DB::table('qrocde_info')->where('property_id', $property->id)->count();

            if($qrcodeData>0){
                DB::table('qrocde_info')->where('property_id', $property->id)->delete();
            }

            $data = array(
                'floor_no' => 0,
                'room_no' => 0,
                'property_id' => $user->id
            );

            $infoid = db::table('qrocde_info')->insertGetId($data);
//            $url_original  = URL::to('/form/' . $infoid);
            $url_original =  UrlShortener::shorten(URL::to('/form/' . $infoid));
//            $url = Bitly::getUrl($url_original);
            $file_name =  'qrCode.pdf';
            $path=public_path('/qrCodeProperties/' . $nameofdirectory . '/' . $file_name);
            $qrcode = $this->generateQrcode(session()->get('qrCode'), $url_original,$path);

            $path = public_path() . '/qrCodeProperties/' . $nameofdirectory;
            $zip = new ZipArchive;

            $fileName = $nameofdirectory . '.zip';

            if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE) {
                $files = File::files($path);

                foreach ($files as $key => $value) {
                    $relativeNameInZipFile = basename($value);
                    $zip->addFile($value, $relativeNameInZipFile);
                }

                $zip->close();
            }
//            session()->put('downloadFile', 'public/' . $fileName);

            db::table('properties')->where('id',$property->id)->update(['qrcodeLink'=>'/public/'.$fileName]);


            return redirect('/properties')->with(['success'=>'Qrcode generated successfully']);

        }
    }catch (\Exception $e) {

        return $e->getMessage();
    }


    }
    function  generateQrcode($qrcode,$url,$path){



        $mpdf = new \Mpdf\Mpdf();



        if(file_exists(public_path('/qrcode123.png'))){

            unlink(public_path('/qrcode123.png'));

        }

        $input=$qrcode;




        $qrCode = new QrCode($url);
        if(isset($input['form'][0]['value']) && !empty($input['form'][0]['value']) && $input['form'][0]['name']=='foregroundOne'){
            $foregroundcolor=explode(")",$input['form'][0]['value']);
            $forgroundcode=explode("(",$foregroundcolor[0]);
            $forgroundcodes=explode(",",$forgroundcode[1]);
            $qrcode=$qrCode->setForegroundColor(array('r'=>$forgroundcodes[0],'g'=>$forgroundcodes[1],'b'=>$forgroundcodes[2],'a'=>0));
        }

        if(isset($input['form'][1]['value']) && !empty($input['form'][1]['value']) && $input['form'][1]['name']=='background'){
            $backgroundcolor=explode(")",$input['form'][1]['value']);
            $backgroundcode=explode("(",$backgroundcolor[0]);
            $backgroundcodes=explode(",",$backgroundcode[1]);
            $qrCode->setBackgroundColor(array('r'=>$backgroundcodes[0],'g'=>$backgroundcodes[1],'b'=>$backgroundcodes[2],'a'=>0.7));
        }

        $qrCode->setSize(250);
        $qrCode->setMargin(0);
        $qrCode->setEncoding('UTF-8');
        $qrCode->setWriterByName('png');
        $qrCode->setLabelFontSize(10);
        $qrCode->setRoundBlockSize(true, QrCode::ROUND_BLOCK_SIZE_MODE_MARGIN); // The size of the qr code is shrinked, if necessary, but the size of the final image remains unchanged due to additional margin being added (default)
        $qrCode->setRoundBlockSize(true, QrCode::ROUND_BLOCK_SIZE_MODE_ENLARGE); // The size of the qr code and the final image is enlarged, if necessary
        $qrCode->setRoundBlockSize(true, QrCode::ROUND_BLOCK_SIZE_MODE_SHRINK); // The size of the qr code and the final image is shrinked, if necessary


//    $qrCode->setLogoPath('http://managersqr.managershq.com.au/public/img/1599457503897.png');

        $isLogoExists = TempLogo::where('userId', Auth::user()->id)->pluck('image')->first();

        if($isLogoExists){
            $qrCode->setLogoPath('http://managersqr.managershq.com.au/public/companyLogos/'.$isLogoExists);
        }

        $logoData = TempLogo::where('userId', Auth::user()->id)->first();
        if($logoData){
            $file =public_path('companyLogos/'.$logoData->image);
            if($file){
                unlink($file);
            }
            $logoData->delete();
        }


        $qrCode->setLogoSize(70, 70);
        $qrCode->setValidateResult(false);

        if(session()->has('logo')){

//            dd($request->session()->get('logo'));

            $img = imagecreatefrompng(session()->get('logo'));


            $width  = imagesx($img);
            $height = imagesy($img);

// make a plain background with the dimensions
            $background = imagecreatetruecolor($width, $height);
            $color = imagecolorallocate($background, $backgroundcodes[0], $backgroundcodes[1], $backgroundcodes[2]); // grey background
            imagefill($background, 0, 0, $color);

// place image on top of background
            imagecopy($background, $img, 0, 0, 0, 0, $width, $height);

//save as png
            imagepng($background, public_path('/img/new.png'), 0);



            if($input['eye']==1){
                $image=public_path('/img/new.png');
                session()->put('logoNew',$image);

            }else{
                $image=session()->get('logo');

            }



            $qrCode->setLogoPath($image);
        }
        $qrCode->setErrorCorrectionLevel(ErrorCorrectionLevel::HIGH());
        $qrCode->setWriterOptions(['exclude_xml_declaration' => true]);
        header('Content-Type: '.$qrCode->getContentType());
        $qrCode=$qrCode->writeDataUri();

        $data=array(
            'background'=>$input['form3'][3]['value'],
            'textLine1'=>$input['form2'][0]['value'],
            'textLine2'=>$input['form2'][1]['value'],
            'textColor'=>$input['form2'][2]['value'],
            'title'=>$input['form3'][0]['value'],
            'link'=>$input['form3'][1]['value'],
            'linkColor'=>$input['form3'][2]['value'],
            'Adbackground'=>$input['form3'][3]['value'],
            'showlink'=>$input['link']
        );

//    return view('properties.qrCodeTemplate',compact('qrCode','data'));


        if(session()->has('companylogo')){
            $logo='<img src="'.session()->get('companylogo').'" style="margin-left: auto!important;display: block!important;width: 10rem;
        position: relative !important;
        top:60px !important;margin-top:40px"  alt="" >';
        }else{
            $logo='<div style="margin-left: auto!important;display: block!important;width: 7px;
                    position: relative !important;
                    top:10px !important;margin-top:2px;color:'.$data['background'].'">dfgdfgd</div>';
        }

        if(!empty($data['link'])){
            $link='  <h5 style="font-weight: bold;color:'.$data['linkColor'].'"> '.$data['title'].'</h5>
            <small style=" font-weight: 800;color:'.$data['linkColor'].';">'.$data['link'].'</small>';
        }else{
            $link='';
        }

        $mpdf->WriteHTML('<style>

     body{
     font-family: "Roboto", sans-serif;
     }

        .box img{
            width: 7rem;
            position: relative;
            top:80px;
        }

        .text{
            margin: 0 auto;
        }

    </style>
</style>
<body>

<div class="col-md-12" style=" position: absolute;
            z-index: 99999;
            width: 80%;
            text-align: center;
            font-size: 1.5em;
            color: #fff;
            line-height: 1.5;
            background: '.$data['background'].';flex: 0 0 100%;
    max-width: 100%;" >
    <div class="row" style="    display: flex;
    flex-wrap: wrap;
    margin-right: 10px;
    margin-left: 10px;" >
        <div class="box text col-md-6" style="flex: 0 0 50%;
    max-width: 50%;">

            '.$logo.'


        </div>
    </div>

    <div class="row"  style="display: flex;
    flex-wrap: wrap;
    margin-right: 60px;
    margin-left: 60px;">
        <div class="text col-md-12" style="flex: 0 0 100%;
    max-width: 40%;margin: 0 auto">

            <h3 style="text-align:center;font-weight:bold;font-size:42px;color:'.$data['textColor'].' ">'.$data['textLine1'].'</h3>
            <h3 style="text-align:center;font-weight: bold;font-size:42px;position: relative;color:'.$data['textColor'].'}}; ">'.$data['textLine2'].'</h3>

        </div>

    </div>

    <div class="row" style="margin-bottom: 5rem;margin-bottom: 3rem;display: flex;
    flex-wrap: wrap;
    margin-right: 10px;
    margin-left: 10px;">
        <div class=" text col-md-8 " style="margin:0 auto;flex: 0 0 66.666667%;
    max-width: 30%;
}">



            <img class="d-block mx-auto" style="margin-left: auto!important;display: block!important;" height="200" src="'.$qrCode.'"  alt="" >

        </div>

    </div>


    <div class="row" style="padding-bottom:20px;margin-bottom:10rem;display: flex;
    flex-wrap: wrap;
    margin-right: 30px;
    margin-left: 30px;
    max-width: 10%
    ">
        <div class=" text col-md-6 " style="margin-bottom:10rem;display: flex;
    flex-wrap: wrap;
    margin-right: 50px;
    margin-left: 50px; max-width: 10% ">

          '.$link.'



        </div>

    </div>


</div>
</body>

');
        $mpdf->Output($path,'F');

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

        //load edit property view
        $properties = DB::table('properties')->where('id', $id)->first();
        $user = DB::table('users')->where('id', Auth::user()->id)->first();
        $rooms=DB::table('property_room_info')->where('property_id', $id)->get();
        $qrocde_info=DB::table('qrocde_info')->where('property_id', $id)->get();

        return view('properties.edit',compact('properties','user','rooms','qrocde_info'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function propertyUpdate(Request $request)
    {

        if($request->des=='units' || $request->des=='Apartments'){
            $this->validate($request, [
                'title' => 'required',
                'location' => 'required',
            ]);
        }elseif($request->des=='other'){
            $this->validate($request, [
                'title' => 'required',
                'des' => 'required',
            ]);
        }



        if(isset($request->defaultProperty)){
            $defaultProperty=$request->defaultProperty;

            $count= DB::table('properties')->where([['defaultProperty',1],['user_id',Auth::user()->id]])->count();

            if($count>0){
                $updatedProperty=DB::table('properties')->where([['defaultProperty',1],['user_id',Auth::user()->id]])->first();

                $update=array(
                    'defaultProperty'=>0
                );

                DB::table('properties')->where('id',$updatedProperty->id)->update($update);
            }

        }else{
            $defaultProperty=0;
        }


        $data=array(
            'title'=>$request->title,
            'location'=>$request->location,
        );





        if($request->hasfile('image')) {
            $property=property::where('id', $request->id)->first();

            if(!empty($property->image)){
                $image=explode('/',$property->image);

                if(file_exists(public_path('/img/'.$image[5]))){

                    unlink(public_path('/img/'.$image[5]));

                }
            }



            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('/img'), $imageName);

            $data['image'] = url('/public/img/' . $imageName);
        }
        $vendor=property::where('id', $request->id)->update($data);

        $i=1;
        DB::table('property_room_info')->where('property_id',$request->id)->delete();

        if(isset($request->rooms)){
            foreach($request->rooms as $r){

                $data=array(
                    'rooms'=>$r,
                );

              if(!empty($r)){
                  $data=array(
                      'rooms'=>$r,
                      'prefix'=>str_pad($i, 2, '0', STR_PAD_LEFT),
                      'floorNo'=>$i,
                      'property_id'=>$request->id

                  );
                  DB::table('property_room_info')->insert($data);
              }




                $i++;
            }
        }


        if(isset($request->area)){
            $qrArea = db::table('qrocde_info')->where('property_id',$request->id)->get();
            foreach($request->area as $a){
                $flag=0;

                foreach($qrArea as $q){
                    if(!empty($q->area)){
                        if($q->area==$a){
                            $flag=1;
                            break;
                        }
                    }else{
                        db::table('qrocde_info')->where('id',$q->id)->delete();

                    }



                }

                if($flag!=1){

                    $data = array(
                        'floor_no' => 0,
                        'room_no' => 0,
                        'area'=>$a,
                        'property_id' => $request->id

                    );

                    $infoid = db::table('qrocde_info')->insert($data);

                }



            }

        }




        return redirect()->route('properties.index')
            ->with('success','Property updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        //delete property and related reports and images

        $property= DB::table('properties')->where('id', $request->id)->first();


        DB::table('properties')->where('id', $request->id)->delete();

        $orders= DB::table('Orders')->where('property_id',$request->id)->get();
        if(isset($orders)){
            foreach( $orders as $o){
                DB::table('Notifications')->where('feedback_id',$o->id)->delete();
                DB::table('feedback_send_history')->where('feedback_id',$o->id)->delete();

            }
        }



        DB::table('Orders')->where('property_id',$request->id)->delete();

        DB::table('qrocde_info')->where('property_id',$request->id)->delete();

        if(file_exists(public_path('/'.str_replace(' ', '', $property->title).'.zip'))){

            unlink(public_path('/'.str_replace(' ', '', $property->title).'.zip'));

        }

        File::deleteDirectory(public_path('/qrCodeProperties/'.str_replace(' ', '', $property->title)));

//        if(!rmdir(public_path('/qrCodeProperties/'.str_replace(' ', '', $property->title)))) {
//
//        }


        return response()->json(
            ['success'=>false,'message'=>'Property Deleted Successfully','status'=> 200]);


    }


    function getEditRooms(Request $request){
        $floor = DB::table('properties')->where('id', '=', $request->id)->first();
        $rooms = DB::table('property_room_info')->where('property_id', '=', $request->id)->get();

        $data=array(
            'floor'=>$floor,
            'rooms'=>$rooms
        );
        return response()->json($data);
    }


    function manageRooms(){
        $property = DB::table('properties')->where('id', '=', session()->get('property'))->first();

        $users=DB::table('users_assign_role')->select('users.id as user_id','users.first_name as first_name','users.last_name')->join('users','users_assign_role.user_id','=','users.id')
            ->where([['users.org_id',Auth::user()->id],['users_assign_role.role_id',10]])->groupBy('users.id')->get();
        $info=db::table('manageRooms')->select('*','manageRooms.id as room_id')
            ->join('users','manageRooms.assign_to','=','users.id')
            ->where([['manageRooms.user_id',Auth::user()->id],['manageRooms.property_id',session()->get('property')]])
            ->get();


        return view('properties.manageRooms',compact('property','users','info'));
    }



    function getRoomsDetail(Request $request){



        $roomInfo = DB::table('property_room_info')->where([['property_id', '=', $request->id],['floorNo',$request->floorNO]])->first();



        $room='';

        for($i=1;$i<=$roomInfo->rooms;$i++){

            $room.='<option value="'.$i.'">'.str_pad($i, 2, '0', STR_PAD_LEFT).'</option>';

        }


        $roomhtml='<div class="form-group mb-5">

                            <select onchange="showUsers()" id="room" class="form-control" name="room">

                                <option value="">Select Room</option>
                                '.$room.'




                        </select>
                        </div>';


        return response()->json(compact('roomhtml'));


    }


    function assignRoom(Request $request){


        $data=array(
            'property_id'=>session()->get('property'),
            'user_id'=>Auth::user()->id,
            'room'=>$request->form[1]['value'],
            'floor'=>$request->form[0]['value'],
            'assign_to'=>$request->form[2]['value'],
            'date'=>$request->date,
            'time'=>$request->time
        );
        $check=db::table('manageRooms')->select('*','manageRooms.id as room_id')
            ->where([['room',$request->form[1]['value']],['floor',$request->form[0]['value']],['property_id',session()->get('property')],['completed',0]])->count();
        if($check>0){
            $returData=array(
                'floor'=>0,

            );
            return response()->json($returData);

        }else{
            $id=db::table('manageRooms')->insertGetId($data);

            foreach($request->form as $f){

                if($f['name']=='task[]'){

                    $taskData=array(
                        'room_data_id'=>$id,
                        'task_id'=>$f['value']
                    );
                    db::table('room_assigned_task')->insert($taskData);

                }
            }
            foreach($request->form as $f){

                if($f['name']=='clean'){

                    $taskDataclean=array(
                        'room_data_id'=>$id,
                        'task_id'=>$f['value']
                    );
                    db::table('room_assigned_task')->insert($taskDataclean);

                }
            }

            $property=db::table('properties')->where('id',session()->get('property'))->first();

            $message='You are assigned to room '.$request->form[1]['value'].' in floor no '.$request->form[0]['value'].' for property '.$property->title;
            $admintokens = db::table('device_Info')->where('user_id',$request->form[2]['value'])->get();

            foreach($admintokens as $t){
                if(isset($t->token) && !empty($t->token)){
                    Helper::sendNotification('Housekeeping Job Assigned',strip_tags($message),$t->token,['property_id'=>session()->get('property'),'activity_id'=>$id,'type'=>'JOBASSIGN']);
                    $not=array(
                        'title'=>'Housekeeping Job Assigned',
                        'body'=>strip_tags($message),
                        'user_id'=>$t->user_id,
                        'timestamp'=>Carbon::now()->timestamp,
                        'data'=>json_encode(['property_id'=>session()->get('property'),'activity_id'=>$id,'type'=>'JOBASSIGN'])


                    );
                    db::table('appNotifications')->insert($not);

                }
            }

            $info=db::table('manageRooms')->select('*','manageRooms.id as room_id')
                ->join('users','manageRooms.assign_to','=','users.id')->where('manageRooms.id',$id)
                ->first();

            $returData=array(
                'floor'=>str_pad($info->floor, 2, '0', STR_PAD_LEFT),
                'room'=>str_pad($info->room, 2, '0', STR_PAD_LEFT),
                'assign_to'=>$info->first_name,
                'date'=>$info->date,
                'room_id'=>$info->room_id,
                'id'=>$info->id,
                'time'=>$info->time

            );

            return response()->json($returData);
        }




    }

    function deleteRoom(Request $request){



        db::table('manageRooms')->where('id',$request->id)->delete();

    }


    function manageCompletedRoom(){
        $property = DB::table('properties')->where('id', '=', session()->get('property'))->first();

        $users=DB::table('users_assign_role')->select('users.id as user_id','users.first_name as first_name','users.last_name')->join('users','users_assign_role.user_id','=','users.id')
            ->where([['users.org_id',Auth::user()->id],['users_assign_role.role_id',10]])->groupBy('users.id')->get();
        $info=db::table('manageRooms')->select('*','manageRooms.id as room_id')
            ->join('users','manageRooms.assign_to','=','users.id')
            ->where([['manageRooms.user_id',Auth::user()->id],['manageRooms.property_id',session()->get('property')],['manageRooms.completed',0]])
            ->get();
        $completed=db::table('manageRooms')->select('*','manageRooms.id as room_id')
            ->join('users','manageRooms.assign_to','=','users.id')
            ->where([['manageRooms.user_id',Auth::user()->id],['manageRooms.property_id',session()->get('property')],['manageRooms.completed',1]])
            ->get();
        $inprogress=db::table('manageRooms')->select('*','manageRooms.id as room_id')
            ->join('users','manageRooms.assign_to','=','users.id')
            ->where([['manageRooms.user_id',Auth::user()->id],['manageRooms.property_id',session()->get('property')],['manageRooms.completed',2]])
            ->get();
        $roomTask = DB::table('roomTasks')->get();


        return view('properties.manageCompletedRooms',compact('info','roomTask','completed','property','users','inprogress'));
    }

    function editRoom(Request $request){
        $manageRoom=db::table('manageRooms')->where('id',$request->id)->first();

        $property=db::table('properties')->select('floors')->where('id',$manageRoom->property_id)->first();

        $roomInfo = DB::table('property_room_info')->where([['property_id', '=', $manageRoom->property_id],['floorNo',$manageRoom->room]])->first();
        $users=DB::table('users_assign_role')->select('users.id as user_id','users.first_name as first_name','users.last_name')->join('users','users_assign_role.user_id','=','users.id')
            ->where([['users.org_id',Auth::user()->id],['users_assign_role.role_id',10]])->groupBy('users.id')->get();
        $roomTask = DB::table('roomTasks')->get();
        $tasks=db::table('room_assigned_task')->select('room_assigned_task.id','roomTasks.id','roomTasks.name')->join('roomTasks','room_assigned_task.task_id','=','roomTasks.id')->where('room_assigned_task.room_data_id',$request->id)->get();

        $html=view('properties.editRoom',compact('manageRoom','roomInfo','users','property','roomTask','tasks'))->render();

        return response()->json($html);

    }


    function updateRoom(Request $request){

        $data=array(
            'floor'=>$request->form[1]['value'],
            'room'=>$request->form[2]['value'],
            'assign_to'=>$request->form[3]['value'],
            'date'=>$request->date,
            'time'=>$request->time
        );

        $check=db::table('manageRooms')->select('*','manageRooms.id as room_id')
            ->where([['room',$request->form[2]['value']],['floor',$request->form[1]['value']],['property_id',session()->get('property')],['completed',0]])->count();
//        echo $request->roomId.'<br>';
//        echo $request->floorId.'<br>';
//        echo $request->floorId.'<br>';
//        echo $request->form[2]['value'].'<br>';
//        echo $request->form[1]['value'].'<br>';
//        echo $check;




        if($check>0){

            if($request->form[2]['value']==$request->roomId && $request->form[1]['value']==$request->floorId){
                db::table('manageRooms')->where('id',$request->form[0]['value'])->update($data);

                $info=db::table('manageRooms')->select('*','manageRooms.id as room_id')
                    ->join('users','manageRooms.assign_to','=','users.id')->where('manageRooms.id',$request->form[0]['value'])
                    ->first();

                db::table('room_assigned_task')->where('room_data_id',$request->form[0]['value'])->delete();


                foreach($request->form as $f){

                    if($f['name']=='task[]'){

                        if($f['value']!=14){
                            $taskData=array(
                                'room_data_id'=>$request->form[0]['value'],
                                'task_id'=>$f['value']
                            );
                            db::table('room_assigned_task')->insert($taskData);
                        }

                    }
                }

                if(isset($request->form[4]['value'])){
                    $taskDataclean=array(
                        'room_data_id'=>$request->form[0]['value'],
                        'task_id'=>$request->form[4]['value']
                    );
                    db::table('room_assigned_task')->insert($taskDataclean);

                }else{
                    db::table('room_assigned_task')->where([['room_data_id',$request->form[0]['value']],['task_id',14]])->delete();

                }



                $returData=array(
                    'floor'=>str_pad($info->floor, 2, '0', STR_PAD_LEFT),
                    'room'=>str_pad($info->room, 2, '0', STR_PAD_LEFT),
                    'assign_to'=>$info->first_name,
                    'date'=>$info->date,
                    'room_id'=>$info->room_id,
                    'time'=>$info->time,
                    'id'=>$info->id,

                );

                return response()->json($returData);

            }else{
                $returData=array(
                    'floor'=>0,
                );

                return response()->json($returData);
            }



        }else{
            db::table('manageRooms')->where('id',$request->form[0]['value'])->update($data);

            $info=db::table('manageRooms')->select('*','manageRooms.id as room_id')
                ->join('users','manageRooms.assign_to','=','users.id')->where('manageRooms.id',$request->form[0]['value'])
                ->first();

            db::table('room_assigned_task')->where('room_data_id',$request->form[0]['value'])->delete();


            foreach($request->form as $f){

                if($f['name']=='task[]'){

                    $taskData=array(
                        'room_data_id'=>$request->form[0]['value'],
                        'task_id'=>$f['value']
                    );
                    db::table('room_assigned_task')->insert($taskData);

                }
            }

            if(isset($request->form[4]['value'])){
                $taskDataclean=array(
                    'room_data_id'=>$request->form[0]['value'],
                    'task_id'=>$request->form[4]['value']
                );
                db::table('room_assigned_task')->insert($taskDataclean);

            }else{
                db::table('room_assigned_task')->where([['room_data_id',$request->form[0]['value']],['task_id',14]])->delete();

            }



            $returData=array(
                'floor'=>str_pad($info->floor, 2, '0', STR_PAD_LEFT),
                'room'=>str_pad($info->room, 2, '0', STR_PAD_LEFT),
                'assign_to'=>$info->first_name,
                'date'=>$info->date,
                'room_id'=>$info->room_id,
                'time'=>$info->time,
                'id'=>$info->id,

            );

            return response()->json($returData);
        }
    }


    function getGraphdata(){
        $manageRoom=db::table('manageRooms')
            ->where([['property_id',session()->get('property')],['completed',1]])->get();



        $rooms=array();

        foreach($manageRoom as $m){


            $data=array(
                'label'=>str_pad($m->floor, 2, '0', STR_PAD_LEFT).str_pad($m->room, 2, '0', STR_PAD_LEFT),
                'y'=>10

            );
            array_push($rooms,$data);

        }


        return response()->json(compact('rooms'));

    }


    function getTask(request $request){

        $tasks=db::table('room_assigned_task')->select('room_assigned_task.id','roomTasks.id','roomTasks.name')->join('roomTasks','room_assigned_task.task_id','=','roomTasks.id')->where('room_assigned_task.room_data_id',$request->id)->get();

        $html=view('properties.taskDetail',compact('tasks'))->render();

        return response()->json($html);


    }


    function getRoomsInfo(Request $request){



        $roomInfo = DB::table('property_room_info')->where([['property_id', '=', session()->get('property')],['floorNo',$request->id]])->first();

        $room='';

        for($i=1;$i<=$roomInfo->rooms;$i++){

            $room.='<option value="'.$i.'">'.str_pad($i, 2, '0', STR_PAD_LEFT).'</option>';

        }




        $roomhtml='  <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12 p-0">
                    <select class="form-control" name="room">

                                <option value="">Select Room</option>
                                '.$room.'

                    </select>
                </div>
            </div>
        </div>
    </div>';





        return response()->json(compact('roomhtml'));


    }

    function feedbacks(){

        $data = db::table('Orders')
            ->select('*','Orders.id as order_id' )
            ->join('categories','Orders.order','=','categories.id')
            ->join('properties','Orders.property_id','=','properties.id')
            ->join('users','properties.user_id','=','users.id')
            ->where([['users.id','=',Auth::user()->id]])
            ->get();
        $categories=db::table('categories')->where('user_id',Auth::user()->id)->get();

        $property=db::table('properties')->get();




        return view('Feedbacks.index',compact('data','property','categories'));

    }

    function getFeedbackInfo(request $request){

        $feedback=db::table('Orders')
            ->select('*','Orders.id as order_id')
            ->join('categories','Orders.order','=','categories.id')
            ->where('Orders.id',$request->id)->first();

        $feedbackImages=db::table('feedbac_images')->where('feedback_id',$request->id)->get();
        $vendors=db::table('vendors')->where('user_id',Auth::user()->id)->get();
        $html = view('Feedbacks.createReport',compact('vendors','feedback','feedbackImages'))->render();
        return response()->json($html);
    }


    function setProperty(request $request){

        session()->put('property',$request->id);




    }


    function searchRecords(request $request){


        if($request->type=='other'){


            $input=$request->all();

            $data = db::table('Orders')
                ->select('*','Orders.id as order_id' )
//            ->select('Orders.id as order_id','properties.title as property_title','categories.name as category_name','Orders.created_at as order_created_at','*')
                ->join('categories','Orders.order','=','categories.id')
                ->join('properties','Orders.property_id','=','properties.id')
                ->join('users','properties.user_id','=','users.id');


            if(isset($input['form'][0]['value']) && !empty($input['form'][0]['value'])){

                $data->where('Orders.area',$input['form'][0]['value']);
            }
            if(isset($input['form'][1]['value']) && !empty($input['form'][1]['value']) &&   $input['form'][1]['value']!='all'){


                $data->where('Orders.order',$input['form'][1]['value']);

            }

            if(isset($input['form'][2]['value']) && !empty($input['form'][2]['value'])){


                $data->Where('Orders.created_at','like','%'.$request->form[2]['value'].'%');

            }

            $data->where('Orders.property_id',session()->get('property'));
            $data->where('Orders.active',0);

            $feedbacks=$data->get();
            return response()->json(['feedbacks'=>$feedbacks]);

        }elseif($request->type=='units' || $request->type=='Apartments'){

            $input=$request->all();



            $data = db::table('Orders')
                ->select('*','Orders.id as order_id' )
//            ->select('Orders.id as order_id','properties.title as property_title','categories.name as category_name','Orders.created_at as order_created_at','*')
                ->join('categories','Orders.order','=','categories.id')
                ->join('properties','Orders.property_id','=','properties.id')
                ->join('users','properties.user_id','=','users.id');


            if(isset($input['form'][0]['value']) && !empty($input['form'][0]['value']) ){
                $roomdata=explode(" ",$input['form'][1]['value']);

//                $floor=$roomdata[0];
//                $room=$roomdata[1];

                $data->where('Orders.floor_id',$input['form'][0]['value']);
//                $data->where('Orders.room_id',$room);
            }
            if(isset($input['form'][1]['value']) && !empty($input['form'][1]['value']) &&   $input['form'][1]['value']!='all'){


                $data->where('Orders.order',$input['form'][1]['value']);

            }

            if(isset($input['form'][2]['value']) && !empty($input['form'][2]['value'])){


                $data->Where('Orders.created_at','like','%'.$request->form[2]['value'].'%');

            }


            $data->where('Orders.active',0);
            $data->where('Orders.property_id',session()->get('property'));


            $feedbacks=$data->get();
            return response()->json(['feedbacks'=>$feedbacks]);

        }else{

            $input=$request->all();



            $data = db::table('Orders')
                ->select('*','Orders.id as order_id' )
//            ->select('Orders.id as order_id','properties.title as property_title','categories.name as category_name','Orders.created_at as order_created_at','*')
                ->join('categories','Orders.order','=','categories.id')
                ->join('properties','Orders.property_id','=','properties.id')
                ->join('users','properties.user_id','=','users.id');



            if(isset($input['form'][0]['value']) && !empty($input['form'][0]['value']) &&   $input['form'][0]['value']!='all'){


                $data->where('Orders.order',$input['form'][0]['value']);

            }

            if(isset($input['form'][1]['value']) && !empty($input['form'][1]['value'])){


                $data->Where('Orders.created_at','like','%'.$request->form[1]['value'].'%');

            }


            $data->where('Orders.active',0);
            $data->where('Orders.property_id',session()->get('property'));


            $feedbacks=$data->get();
            return response()->json(['feedbacks'=>$feedbacks]);
        }




    }
    function searchRecordsinactive(request $request){

        if($request->type=='other'){


            $input=$request->all();

            $data = db::table('Orders')
                ->select('*','Orders.id as order_id' )
//            ->select('Orders.id as order_id','properties.title as property_title','categories.name as category_name','Orders.created_at as order_created_at','*')
                ->join('categories','Orders.order','=','categories.id')
                ->join('properties','Orders.property_id','=','properties.id')
                ->join('users','properties.user_id','=','users.id');


            if(isset($input['form'][0]['value']) && !empty($input['form'][0]['value'])){

                $data->where('Orders.area',$input['form'][0]['value']);
            }
            if(isset($input['form'][1]['value']) && !empty($input['form'][1]['value']) &&   $input['form'][1]['value']!='all'){


                $data->where('Orders.order',$input['form'][1]['value']);

            }

            if(isset($input['form'][2]['value']) && !empty($input['form'][2]['value'])){


                $data->Where('Orders.created_at','like','%'.$request->form[2]['value'].'%');

            }

            $data->where('Orders.property_id',session()->get('property'));
            $data->where('Orders.active',1);

            $feedbacks=$data->get();
            return response()->json(['feedbacks'=>$feedbacks]);

        }elseif($request->type=='units' || $request->type=='Apartments'){

            $input=$request->all();



            $data = db::table('Orders')
                ->select('*','Orders.id as order_id' )
//            ->select('Orders.id as order_id','properties.title as property_title','categories.name as category_name','Orders.created_at as order_created_at','*')
                ->join('categories','Orders.order','=','categories.id')
                ->join('properties','Orders.property_id','=','properties.id')
                ->join('users','properties.user_id','=','users.id');


            if(isset($input['form'][0]['value']) && !empty($input['form'][0]['value']) ){
                $roomdata=explode(" ",$input['form'][1]['value']);

//                $floor=$roomdata[0];
//                $room=$roomdata[1];

                $data->where('Orders.floor_id',$input['form'][0]['value']);
//                $data->where('Orders.room_id',$room);
            }
            if(isset($input['form'][1]['value']) && !empty($input['form'][1]['value']) &&   $input['form'][1]['value']!='all'){


                $data->where('Orders.order',$input['form'][1]['value']);

            }

            if(isset($input['form'][2]['value']) && !empty($input['form'][2]['value'])){


                $data->Where('Orders.created_at','like','%'.$request->form[2]['value'].'%');

            }


            $data->where('Orders.active',1);
            $data->where('Orders.property_id',session()->get('property'));


            $feedbacks=$data->get();
            return response()->json(['feedbacks'=>$feedbacks]);

        }else{

            $input=$request->all();



            $data = db::table('Orders')
                ->select('*','Orders.id as order_id' )
//            ->select('Orders.id as order_id','properties.title as property_title','categories.name as category_name','Orders.created_at as order_created_at','*')
                ->join('categories','Orders.order','=','categories.id')
                ->join('properties','Orders.property_id','=','properties.id')
                ->join('users','properties.user_id','=','users.id');



            if(isset($input['form'][0]['value']) && !empty($input['form'][0]['value']) &&   $input['form'][0]['value']!='all'){


                $data->where('Orders.order',$input['form'][0]['value']);

            }

            if(isset($input['form'][1]['value']) && !empty($input['form'][1]['value'])){


                $data->Where('Orders.created_at','like','%'.$request->form[1]['value'].'%');

            }


            $data->where('Orders.active',1);
            $data->where('Orders.property_id',session()->get('property'));


            $feedbacks=$data->get();
            return response()->json(['feedbacks'=>$feedbacks]);
        }


    }
    function closedFeedback($id){

        $update=db::table('Orders')->where('id',(int)$id)->update(['active'=>1]);

        if($update==1){
            return redirect()->back()->with(['success'=>'Feedback closed successfully!']);
        }else{
            return redirect()->back()->with(['error'=>'Something went wrong!']);

        }

    }


    function deleteFeddback(request $Request){



        $delete= db::table('Orders')->where('id',$Request->id)->delete();

    }


    function showfeedbacks($id){


        session()->put('feedback',$id);

        $data = db::table('Orders')
            ->select('*','Orders.id as order_id' )
            ->join('categories','Orders.order','=','categories.id')
            ->join('properties','Orders.property_id','=','properties.id')
            ->join('users','properties.user_id','=','users.id')
            ->where([['users.id','=',Auth::user()->id]])
            ->get();



        $categories=db::table('categories')->where('user_id',Auth::user()->id)->get();

        $property=db::table('properties')->get();







        return view('Feedbacks.index',compact('data','property','categories'));





    }

    function feedbacksBytype($user){

        if(session()->get('property') == 0)
        {
             $data = db::table('Orders')
                ->select('*','Orders.created_at as create_date','Orders.id as order_id' )
                ->join('categories','Orders.order','=','categories.id')
                ->join('properties','Orders.property_id','=','properties.id')
                ->join('users','properties.user_id','=','users.id')
                ->where([['users.id','=',Auth::user()->id],['Orders.user',$user]])
                ->get();
        } else {

            $data = db::table('Orders')
                ->select('*','Orders.created_at as create_date','Orders.id as order_id' )
                ->join('categories','Orders.order','=','categories.id')
                ->join('properties','Orders.property_id','=','properties.id')
                ->join('users','properties.user_id','=','users.id')
                ->where([['users.id','=',Auth::user()->id],['Orders.user',$user],['Orders.property_id',session()->get('property')]])
                ->get();
        }

        // $data = Order::all();


        $categories=db::table('categories')->where('user_id',Auth::user()->id)->get();
        $property=db::table('properties')->where('id',session()->get('property'))->first();


        $check=db::table('property_room_info')->where('property_id',session()->get('property'))->count();

        if($check>0){
            $propertyInfo=db::table('property_room_info')->where('property_id',session()->get('property'))->get();

        }else{
            $propertyInfo=db::table('qrocde_info')->where('property_id',session()->get('property'))->get();

        }

        $areaInfo=db::table('qrocde_info')->where('property_id',session()->get('property'))->get();



        return view('Feedbacks.index',compact('data','categories','property','propertyInfo','areaInfo'));
    }


    function getpropertyareainfo(Request $request){

        if($request->type=='area'){

            $areas=db::table('qrocde_info')->where('property_id',$request->property)->get();

            $text='<option value="">Select Area</option>';

            foreach ($areas as $a){

                $text.='<option value="'.$a->area.'">'.$a->area.'</option>';
            }

            return response()->json($text);

        }

        if($request->type=='units'){
            $areas=db::table('qrocde_info')->where('property_id',$request->property)->get();





            $text='<option value="">Select Unit</option>';

            foreach ($areas as $a){

                $text.='<option value="'.$a->floor_no.' '.$a->room_no.'">'.str_pad($a->floor_no, 2, '0', STR_PAD_LEFT).str_pad($a->room_no, 2, '0', STR_PAD_LEFT).'</option>';
            }

            return response()->json($text);
        }
        if($request->type=='Apartments'){
            $areas=db::table('qrocde_info')->where('property_id',$request->property)->get();


            $text='<option value="">Select Apartment</option>';

            foreach ($areas as $a){

                $text.='<option value="'.$a->floor_no.' '.$a->room_no.'">'.str_pad($a->floor_no, 2, '0', STR_PAD_LEFT).str_pad($a->room_no, 2, '0', STR_PAD_LEFT).'</option>';
            }

            return response()->json($text);
        }

        if($request->type!='area'&&$request->type!='units'&&$request->type!='Apartments'){
            $text='';
            return response()->json($text);
        }

    }



}
