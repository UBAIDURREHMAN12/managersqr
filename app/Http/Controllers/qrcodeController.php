<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TempLogo;
use App\Category;
use App\User;
use App\CustomQrCode;
use App\property;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Imagick;
use Intervention\Image\Facades\Image;
use SimpleSoftwareIO\QrCode\Generator;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\LabelAlignment;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Response\QrCodeResponse;
use ZipArchive;

class qrcodeController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');

    }


    public function testRelations(Request $request){

        $data = CustomQrCode::with('properties')->get();
        dd($data);

    }


    // following function takes property id in url parameter
    // and generate qr code against it
    public function index($id){
        $property = DB::table('properties')->where('id',$id)->first();
        $qrcodeData = DB::table('qrocde_info')->where('property_id', $property->id)->count();

        if(Session::has('logo')){

            $image=explode("/",Session::get('logo'));

            if(file_exists(public_path('/img/'.$image[4]))){

                unlink(public_path('/img/'.$image[4]));

            }
            Session::forget('logo');
            Session::forget('logoNew');
            Session::forget('qrCodesize');
            Session::forget('qrformat');


        }

        $qrCode = new QrCode('qrCodegenerator');
        $qrCode->setSize(250);
        $qrCode->setMargin(3);
        $qrCode->setEncoding('UTF-8');
        $qrCode->setWriterByName('png');
        $qrCode->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0));
        $qrCode->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0.4));
        $qrCode->setLogoSize(100, 100);
        $qrCode->setValidateResult(false);
        $qrCode->setRoundBlockSize(true);
        if(isset($property->image)){
            $qrCode->setLogoPath($property->image);
        }
        $qrCode->setLogoSize(70, 70);
        $qrCode->setErrorCorrectionLevel(ErrorCorrectionLevel::HIGH());
        $qrCode->setWriterOptions(['exclude_xml_declaration' => true]);
        header('Content-Type: '.$qrCode->getContentType());
        $qrCode->writeFile(public_path('/qrcode.png'));


        return view('properties.qrCode',compact('id','qrcodeData'));
    }


    function generateQr(Request $request){

//        $input = $request->all();
//dd($input['form4'][0]);
//
////        if($input['form4'][0]->hasFile()){
////echo "file found";
////        }else{
////            echo "file not found";
////        }
//        dd();

        if(file_exists(public_path('/qrcode123.png'))){

            unlink(public_path('/qrcode123.png'));

        }

        $input=$request->all();

        $this->sessionValues($input);
        $qrCode = new QrCode('test qrcode');
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




        $templogo = TempLogo::where('userId', Auth::user()->id)->pluck('image')->first();

        if($templogo){
            $logoUrl = 'http://managersqr.managershq.com.au/public/companyLogos/'.$templogo;
            $qrCode->setLogoPath($logoUrl);
        }else{
            $logoUrl = 'test';
        }

        $qrCode->setLogoSize(70, 70);
        $qrCode->setValidateResult(false);

        if($request->session()->has('logo')){

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



              if($request->eye==1){
//                  $image=public_path('/img/new.png');
                  $image=public_path('/companyLogos/'.$templogo);
                  $request->session()->put('logoNew',$image);

              }else{
                  $image=$request->session()->get('logo');

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
              'showlink'=>$request->link
          );
        $html=view('properties.qrCodeTemplate',compact('qrCode','data', 'logoUrl'))->render();

        return response()->json($html);

    }


    function  sessionValues($qrcode){

        session()->put('qrCode',$qrcode);

    }








    function setupContent(Request $request){




    }



    function downloadQrcode(request $request){

//        dd($request->all());

           session()->put('qrCodesize',$request->size);
           session()->put('qrformat',$request->qrformat);


           return redirect('/properties/create');

    }
    function createProperty(request $request){

        $property = DB::table('properties')->where('id',$request->property)->first();

        if($property->floors>0) {


            $nameofdirectory =str_replace(' ', '', $property->title);


            File::deleteDirectory(public_path() . '/qrCodeProperties/' . $nameofdirectory);
            if(file_exists(public_path('/qrCodeProperties/' . $nameofdirectory.'.zip'))){
                unlink(public_path('/qrCodeProperties/' . $nameofdirectory.'.zip'));
            }
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
                                'property_id' => $request->property

                            );

                            $infoid = db::table('qrocde_info')->insertGetId($data);


                            $url = 'http://managersqr.managershq.com.au/form/' . $infoid;
                            $file_name = 'roomNo' . str_pad($i, 2, '0', STR_PAD_LEFT) . str_pad($j, 2, '0', STR_PAD_LEFT) . '.pdf';
                            $path=public_path('/qrCodeProperties/' . $nameofdirectory . '/' . $file_name);

                            $qrcode = $this->generateQrcode(session()->get('qrCode'), $url,$path);



                        }
                    }else{
                        return redirect('/properties')->with(['error'=>'Oops something went wrong (Room was not added)']);

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

            return response()->download(public_path($fileName));





        }else{

            $nameofdirectory =str_replace(' ', '', $property->title);
            File::makeDirectory(public_path() . '/qrCodeProperties/' . $nameofdirectory, $mode = 0777, true, true);

            $qrcodeData = DB::table('qrocde_info')->where('property_id', $property->id)->get();




                foreach($qrcodeData as $q){
                    if(!empty($q->area)){
                        $data = array(
                            'property_id' => $q->property_id,
                            'area' => $q->area
                        );
                        $infoid = DB::table('qrocde_info')->insertGetId($data);
                        $url = 'http://managersqr.managershq.com.au/form/' . $infoid;

                        $file_name = $q->area . '.pdf'; //generating unique file name;
                        $path=public_path('/qrCodeProperties/' . $nameofdirectory . '/' . $file_name);
                        $qrcode = $this->generateQrcode(session()->get('qrCode'), $url,$path);

                        DB::table('qrocde_info')->where('id', $q->id)->delete();

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

            return response()->download(public_path($fileName));
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



//    $qrCode->setLogoPath('http://managersqr.managershq.com.au/public/img/1603091070.png');
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
            $link='  <h5 style="font-weight: bold;color:'.$data['linkColor'].'">   '.$data['title'].'</h5>
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



    function fileuploader(request $request){


   try{
       if($request->session()->has('logo')){

           $image=explode("/",$request->session()->get('logo'));

           if(file_exists(public_path('/img/'.$image[4]))){

               unlink(public_path('/img/'.$image[4]));

           }
       }
       $request->session()->forget('logo');
       $file=  $request->file('files');
       $extension=$file->getClientOriginalExtension();
       $imageName = time().'.'.$extension;
       $file->move(public_path('/img'), $imageName);
       $logo=url('/public/img/'. $imageName);
       $request->session()->put('logo', $logo);
   }catch (Exception $e) {
       return $e;
   }

        return response()->json(['success' => $logo]);

//        return  json_encode(['success'=>true]);
    }
    function fileuploaderlogo(request $request){


        if($request->session()->has('companylogo')){

            $image=explode("/",$request->session()->get('companylogo'));

            if(file_exists(public_path('/img/'.$image[4]))){

                unlink(public_path('/img/'.$image[4]));

            }
        }
        $request->session()->forget('companylogo');
        $file=  $request->file('files');
        $extension=$file->getClientOriginalExtension();
        $imageName = time().'.'.$extension;
        $file->move(public_path('/img'), $imageName);
        $logo=url('/public/img/'. $imageName);
        $request->session()->put('companylogo', $logo);

        return  json_encode(['success'=>true]);
    }


    function createQrcode(){


        if(Session::has('logo')){

            $image=explode("/",Session::get('logo'));

            if(file_exists(public_path('/img/'.$image[4]))){

                unlink(public_path('/img/'.$image[4]));

            }
            Session::forget('logo');
            Session::forget('logoNew');
            Session::forget('qrCodesize');
            Session::forget('qrformat');


        }
        session()->forget('companylogo');

        $qrCode = new QrCode('qrCodegenerator');
        $qrCode->setSize(250);
        $qrCode->setMargin(-4);
        $qrCode->setEncoding('UTF-8');
        $qrCode->setWriterByName('png');
        $qrCode->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0));
        $qrCode->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0.4));
        $qrCode->setLogoSize(100, 100);
        $qrCode->setValidateResult(false);
        $qrCode->setRoundBlockSize(true);
        $qrCode->setLogoSize(70, 70);
        $qrCode->setWriterOptions(['exclude_xml_declaration' => true]);
        header('Content-Type: '.$qrCode->getContentType());
        $qrCode->writeFile(public_path('/qrcodeimage6.png'));

        return view('properties.qrCode');

    }



    function updateTemplate($id){

        $property = DB::table('properties')->where('id',$id)->first();
        $qrcodeData = DB::table('qrocde_info')->where('property_id', $property->id)->count();

        if(Session::has('logo')){

            $image=explode("/",Session::get('logo'));

            if(file_exists(public_path('/img/'.$image[4]))){

                unlink(public_path('/img/'.$image[4]));

            }
            Session::forget('logo');
            Session::forget('logoNew');
            Session::forget('qrCodesize');
            Session::forget('qrformat');


        }

        $qrCode = new QrCode('qrCodegenerator');
        $qrCode->setSize(250);
        $qrCode->setMargin(3);
        $qrCode->setEncoding('UTF-8');
        $qrCode->setWriterByName('png');
        $qrCode->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0));
        $qrCode->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0.4));
        $qrCode->setLogoSize(100, 100);
        $qrCode->setValidateResult(false);
        $qrCode->setRoundBlockSize(true);
        if(isset($property->image)){
            $qrCode->setLogoPath($property->image);
        }
        $qrCode->setLogoSize(70, 70);
        $qrCode->setErrorCorrectionLevel(ErrorCorrectionLevel::HIGH());
        $qrCode->setWriterOptions(['exclude_xml_declaration' => true]);
        header('Content-Type: '.$qrCode->getContentType());
        $qrCode->writeFile(public_path('/qrcode.png'));


        return view('properties.updateTemplate',compact('id','qrcodeData'));
    }

    function editTemplate(request $request){


        $property = DB::table('properties')->where('id',$request->property)->first();




            $nameofdirectory =str_replace(' ', '', $property->title);


            File::deleteDirectory(public_path() . '/qrCodeProperties/' . $nameofdirectory);
            if(file_exists(public_path('/qrCodeProperties/' . $nameofdirectory.'.zip'))){
                unlink(public_path('/qrCodeProperties/' . $nameofdirectory.'.zip'));
            }
            File::makeDirectory(public_path() . '/qrCodeProperties/' . $nameofdirectory, $mode = 0777, true, true);


            $qrcodeData = DB::table('qrocde_info')->where('property_id', $property->id)->get();


            foreach($qrcodeData as $q){

                if($property->des=='Apartments'){

                    $url = 'http://managersqr.managershq.com.au/form/' . $q->id;
                    $file_name = 'Apartment' . str_pad($q->floor_no, 2, '0', STR_PAD_LEFT) . str_pad($q->room_no, 2, '0', STR_PAD_LEFT) . '.pdf';
                    $path=public_path('/qrCodeProperties/' . $nameofdirectory . '/' . $file_name);

                    $qrcode = $this->generateQrcode(session()->get('qrCode'), $url,$path);
                }elseif($property->des=='units'){
                    $url = 'http://managersqr.managershq.com.au/form/' . $q->id;
                    $file_name = 'Unit' . str_pad($q->floor_no, 2, '0', STR_PAD_LEFT) . str_pad($q->room_no, 2, '0', STR_PAD_LEFT) . '.pdf';
                    $path=public_path('/qrCodeProperties/' . $nameofdirectory . '/' . $file_name);

                    $qrcode = $this->generateQrcode(session()->get('qrCode'), $url,$path);
                }
                elseif($property->des=='other'){
                    $url = 'http://managersqr.managershq.com.au/form/' . $q->id;
                    $file_name = $q->area . '.pdf';
                    $path=public_path('/qrCodeProperties/' . $nameofdirectory . '/' . $file_name);

                    $qrcode = $this->generateQrcode(session()->get('qrCode'), $url,$path);

                }else{

                    $url = 'http://managersqr.managershq.com.au/form/' . $q->id;
                    $file_name = $property->des . '.pdf';
                    $path=public_path('/qrCodeProperties/' . $nameofdirectory . '/' . $file_name);

                    $qrcode = $this->generateQrcode(session()->get('qrCode'), $url,$path);

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
        return response()->download(public_path($fileName));

    }


}
