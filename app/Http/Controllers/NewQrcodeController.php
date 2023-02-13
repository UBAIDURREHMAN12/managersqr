<?php

namespace App\Http\Controllers;

//use App\Mail\Request;

use App\Mail\AccountConfirmation;
use Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Imagick;
use Intervention\Image\Facades\Image;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\LabelAlignment;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Response\QrCodeResponse;
use ZipArchive;
use SimpleSoftwareIO\QrCode\Generator;
use App\User;
use App\TempData;
use App\Visitors;
use App\CustomQrCode;
use App\CustomWeb;
use App\Gallery;
use App\SurveyAnswer;
use App\SurveyQuestion;

class NewQrcodeController extends Controller
{


    public function TestView(Request $request)
    {
        return view('testview');
    }


    public function Test444(Request $request)
    {

        if (\Mail::to('ubaidurrehman1001@gmail.com')->send(new AccountConfirmation('test1', 5555))) {
            echo "email send ";

        } else {
            echo "email not send";
        }
    }

    public function CodeConfirmation(Request $request)
    {

        $data = TempData::where('email', $request->email)->where('code', $request->code)->first();

        if ($data) {
            return redirect()->route('stripe');
        } else {
            return redirect()->back()->with('success', 'Invalid Confirmation Code');
        }
    }

    public function ReturnEmailConfirmationScreen(Request $request)
    {
        return view('email_confirmation_code_screent');
    }

    public function policies(Request $request)
    {
        return view('policies');
    }

    function FetchSurvey($id)
    {

        $data = CustomQrCode::find($id);

        return view('display_servey', compact('data'));
    }

    //    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * ListQrcodes.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */

    public function listqrcodes()
    {
        $data = CustomQrCode::get();

        return view('properties.customqr', compact('data'));
    }

    // this route will returns the custom qr code list
    public function LoadView(Request $request)
    {
        //        $data = CustomQrCode::where('user_id', Auth::user()->id)->groupby('web_link')->distinct()->get();
        $data = CustomQrCode::where('user_id', Auth::user()->id)->get();
        return view('properties.loadview', compact('data'));
    }
    // this function retusns the list of custom websites
    public function LoadView2(Request $request)
    {

        $data = CustomWeb::orderBy('created_at', 'desc')->where('user_id', Auth::user()->id)->get();
        return view('properties.loadview2', compact('data'));
    }
    // this function takes question form id and returns answers
    // and compact data to feedaback_report view
    public function GetFeedbacks($form_id)
    {

        $answers = SurveyAnswer::where('question_form_iu_d', $form_id)->get();

        return view('feedback_report', compact('answers'));

    }
    /**
     * Qrcode View.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */

    // this function checks unique company name
    public function FindUniqueName($name)
    {
        $data = CustomQrCode::where('company_name', $name)->get();
        if (count($data) > 0) {
            return response()->json(['found' => 'No name found']);
        } else {
            return response()->json(['not_found' => 'Name found']);
        }
    }

    public function index($id)
    {

        $property = DB::table('properties')->where('id', $id)->first();
        $qrcodeData = DB::table('qrocde_info')->where('property_id', $property->id)->count();

        if (Session::has('logo')) {

            $image = explode("/", Session::get('logo'));

            if (file_exists(public_path('/img/' . $image[4]))) {

                unlink(public_path('/img/' . $image[4]));
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
        if (isset($property->image)) {
            $qrCode->setLogoPath($property->image);
        }
        $qrCode->setLogoSize(70, 70);
        $qrCode->setErrorCorrectionLevel(ErrorCorrectionLevel::HIGH());
        $qrCode->setWriterOptions(['exclude_xml_declaration' => true]);
        header('Content-Type: ' . $qrCode->getContentType());
        $qrCode->writeFile(public_path('/qrcode.png'));

        return view('properties.qrCode2', compact('id', 'qrcodeData'));
    }

    /**
     * Gallery.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */

    public function gallery(Request $request, $id)
    {

        $data = Gallery::where('web_id', $id)->get();
        return view('gallery', compact('data'));
    }

    /**
     * Delete Gallery Images.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */

    public function deletegallery_images($id)
    {

        $data = Gallery::where('id', $id)->delete();
        return back()->with('success', 'Deleted successfully!');
    }

    /**
     * Custom Web View.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */

    public function custom_web(Request $request)
    {
        return view('customweb');
    }

    /**
     * Edit Web View.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */

    public function editweb_content(Request $request, $id)
    {
        $data = CustomWeb::findorfail($id);
        return view('editweb', compact('data'));
    }

    // this function deletes custom website
    public function Deletewebsite($id)
    {
        $data = CustomWeb::find($id);
        if ($data->delete()) {
            return response()->json(['success' => 'Website deleted successfully.']);
        } else {
            return response()->json(['error' => 'Something went wrong']);
        }
    }
    /**
     * Custom Web View 2.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */

    // this function returns custom websit's data (contant) for updating website (fillable form data)
    public function editweb_content2(Request $request, $id)
    {

        $data = CustomWeb::findorfail($id);
        return view('editweb2', compact('data'));
    }

    /**
     * Store Web-Content.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */


    // this function get data from ("http://managersqr.managershq.com.au/web")
    // page and save in database
    public function storeweb_content(Request $request)
    {

        $request->validate([
            'company_name_or_title' => 'required|unique:custom_web,company_name_or_title',
            'fb_link' => 'required',
        ]);


        $CustomWeb = $request->all();
        $CustomWeb['user_id'] = Auth::user()->id;
        $CustomWeb['property_id'] = session()->get('property');
        $CustomWeb['company_name_or_title'] = $request->company_name_or_title;
        if ($request->hasfile('logo')) {

            $logo = $request->logo;

            $file_name = time();
            $file_name .= rand();
            $ext = $logo->getClientOriginalExtension();
            $logo->move(public_path() . "/images/logo", $file_name . "." . $ext);
            $local_url = $file_name . "." . $ext;
            $s3_url = url('/') . '/public/images/logo/' . $local_url;
            $imageUrl = $s3_url;

            $CustomWeb['logo'] = $imageUrl;

        }

        $CustomWeb = CustomWeb::create($CustomWeb);

        if ($request->hasfile('files')) {

            $get_images = $request->files;

            foreach ($request->file('files') as $value) {

                $file_name = time();
                $file_name .= rand();
                $ext = $value->getClientOriginalExtension();
                $value->move(public_path() . "/images/", $file_name . "." . $ext);
                $local_url = $file_name . "." . $ext;
                $s3_url = url('/') . '/public/images/' . $local_url;
                $imageUrl = $s3_url;

                Gallery::create([
                    'web_id' => $CustomWeb->id,
                    'image' => $imageUrl
                ]);
            }
        }

        $link = "http://managersqr.managershq.com.au/website/" . $CustomWeb->id;

        $request->session()->put('new_web_url', $link);


        return redirect('/load/web/view');

    }

    /**
     * Update Web-Content.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */

    // following funciton updates website content
    public function updateweb_content(Request $request, $id)
    {

        $web = CustomWeb::findorfail($id);

        if ($request->has('title')) {
            $web->title = $request->title;
        }

        if ($request->has('home')) {
            $web->home = $request->home;
        }

        if ($request->has('name')) {
            $web->name = $request->name;
        }

        if ($request->has('email')) {
            $web->email = $request->email;
        }

        if ($request->has('phone')) {
            $web->phone = $request->phone;
        }

        if ($request->has('bg_color')) {
            $web->bg_color = $request->bg_color;
        }

        if ($request->has('btn_color')) {
            $web->btn_color = $request->btn_color;
        }

        if ($request->has('btn_txt_color')) {
            $web->btn_txt_color = $request->btn_txt_color;
        }

        if ($request->has('header_color')) {
            $web->header_color = $request->header_color;
        }

        if ($request->has('heading_color')) {
            $web->heading_color = $request->heading_color;
        }

        if ($request->has('footer_bgcolor')) {
            $web->footer_bgcolor = $request->footer_bgcolor;
        }

        if ($request->has('footer_txt_color')) {
            $web->footer_txt_color = $request->footer_txt_color;
        }

        if ($request->has('fb_link')) {
            $web->fb_link = $request->fb_link;
        }

        if ($request->has('insta_link')) {
            $web->insta_link = $request->insta_link;
        }

        if ($request->has('twitter_link')) {
            $web->twitter_link = $request->twitter_link;
        }

        if ($request->has('address')) {
            $web->address = $request->address;
            $web->latitude = $request->latitude;
            $web->longitude = $request->longitude;
        }

        if ($request->hasfile('files')) {

            $get_images = $request->files;

            foreach ($request->file('files') as $value) {

                $file_name = time();
                $file_name .= rand();
                $ext = $value->getClientOriginalExtension();
                $value->move(public_path() . "/images/", $file_name . "." . $ext);
                $local_url = $file_name . "." . $ext;
                $s3_url = url('/') . '/public/images/' . $local_url;
                $imageUrl = $s3_url;

                Gallery::create([
                    'web_id' => $id,
                    'image' => $imageUrl
                ]);
            }
        }

        $web->save();

        return back()->with('success', 'Updated Successfully!');
    }

    /**
     * GenerateQrcode.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */

    // when we press apply button at the time of qrcdoe creation
    // then this function calls and generate qrcode and return back to the same
    // page with qrcode related url and data
    function generateQr(Request $request)
    {

        if (file_exists(public_path('/qrcode123.png'))) {
            unlink(public_path('/qrcode123.png'));
        }

        $input = $request->all();

        //dd($input);
        $this->sessionValues($input);
        $propertyID = session()->get('property');

        if ($input['form4'][0]['value'] !== null) {

            $qrCode = new QrCode($input['form4'][0]['value']);

        } elseif ($input['form5'][0]['value'] !== null) {

            $qrCode = new QrCode('https://maps.google.com/local?q=' . $input['form5'][1]['value'] . "," . $input['form5'][2]['value']);

        } elseif ($input['form6'][0]['value'] !== null) {

            $qrCode = new QrCode($input['form6'][0]['value']);

        }

        //        elseif($input['form7'][0]['value'] !== null){
//
//            $qrCode = new QrCode('www.ioptime.com');
//
//        }
        elseif ($input['form7'] !== null) {

            $qrCode = new QrCode('www.ioptime.com');

        } elseif ($input['form8'][0]['value'] != null) {

            $qrCode = new QrCode('numl.edu.pk');

        } else {

            $qrCode = new QrCode('http://mngrshq.managershq.com.au/qrform/' . $propertyID);

        }

        if (isset($input['form'][0]['value']) && !empty($input['form'][0]['value']) && $input['form'][0]['name'] == 'foregroundOne') {
            $foregroundcolor = explode(")", $input['form'][0]['value']);
            $forgroundcode = explode("(", $foregroundcolor[0]);
            $forgroundcodes = explode(",", $forgroundcode[1]);
            $qrcode = $qrCode->setForegroundColor(array('r' => $forgroundcodes[0], 'g' => $forgroundcodes[1], 'b' => $forgroundcodes[2], 'a' => 0));
        }

        if (isset($input['form'][1]['value']) && !empty($input['form'][1]['value']) && $input['form'][1]['name'] == 'background') {
            $backgroundcolor = explode(")", $input['form'][1]['value']);
            $backgroundcode = explode("(", $backgroundcolor[0]);
            $backgroundcodes = explode(",", $backgroundcode[1]);
            $qrCode->setBackgroundColor(array('r' => $backgroundcodes[0], 'g' => $backgroundcodes[1], 'b' => $backgroundcodes[2], 'a' => 0.7));
        }

        $qrCode->setSize(250);
        $qrCode->setMargin(0);
        $qrCode->setEncoding('UTF-8');
        $qrCode->setWriterByName('png');
        $qrCode->setLabelFontSize(10);
        $qrCode->setRoundBlockSize(true, QrCode::ROUND_BLOCK_SIZE_MODE_MARGIN); // The size of the qr code is shrinked, if necessary, but the size of the final image remains unchanged due to additional margin being added (default)
        $qrCode->setRoundBlockSize(true, QrCode::ROUND_BLOCK_SIZE_MODE_ENLARGE); // The size of the qr code and the final image is enlarged, if necessary
        $qrCode->setRoundBlockSize(true, QrCode::ROUND_BLOCK_SIZE_MODE_SHRINK); // The size of the qr code and the final image is shrinked, if necessary

        //$qrCode->setLogoPath('https://qrcodegenerator.ioptime.com/public/img/1603091070.png');
        $qrCode->setLogoSize(70, 70);
        $qrCode->setValidateResult(false);

        if ($request->session()->has('logo')) {

            //dd($request->session()->get('logo'));

            $img = imagecreatefrompng(session()->get('logo'));

            $width = imagesx($img);
            $height = imagesy($img);

            // make a plain background with the dimensions
            $background = imagecreatetruecolor($width, $height);
            $color = imagecolorallocate($background, $backgroundcodes[0], $backgroundcodes[1], $backgroundcodes[2]); // grey background
            imagefill($background, 0, 0, $color);

            // place image on top of background
            imagecopy($background, $img, 0, 0, 0, 0, $width, $height);

            //save as png
            imagepng($background, public_path('/img/new.png'), 0);

            if ($request->eye == 1) {
                $image = public_path('/img/new.png');
                $request->session()->put('logoNew', $image);
            } else {
                $image = $request->session()->get('logo');
            }
            $qrCode->setLogoPath($image);
        }

        $qrCode->setErrorCorrectionLevel(ErrorCorrectionLevel::HIGH());
        $qrCode->setWriterOptions(['exclude_xml_declaration' => true]);
        header('Content-Type: ' . $qrCode->getContentType());
        $qrCode = $qrCode->writeDataUri();

        $data = array(
            'background' => $input['form3'][3]['value'],
            'textLine1' => $input['form2'][0]['value'],
            'textLine2' => $input['form2'][1]['value'],
            'textColor' => $input['form2'][2]['value'],
            'title' => $input['form3'][0]['value'],
            'link' => $input['form3'][1]['value'],
            'linkColor' => $input['form3'][2]['value'],
            'Adbackground' => $input['form3'][3]['value'],
            'showlink' => $request->link
        );

        $html = view('properties.qrCodeTemplate2', compact('qrCode', 'data'))->render();

        return response()->json($html);
    }

    /**
     * Session qrcode values.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */

    function sessionValues($qrcode)
    {
        session()->put('qrCode', $qrcode);
    }

    /**
     * Setup Content.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */

    function setupContent(Request $request)
    {
    }

    /**
     * Download Qrcode Sample.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */

    function downloadQrcode(request $request)
    {
        session()->put('qrCodesize', $request->size);
        session()->put('qrformat', $request->qrformat);
        return redirect('/properties/create');
    }

    /**
     * Delete Qrcode.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */

    // this function takes qrcode id and delete it
    // this qrcode could be against property or against webstie or it
    // can be against any object.
    public function deleteQr($id)
    {

        //        $data = CustomQrCode::findorFail($id);
//        File::deleteDirectory(public_path($data->title));
//        unlink(public_path('/' . $data->title.'.zip'));
//        CustomQrCode::where('id',$id)->delete();

        $data12 = CustomQrCode::find($id);

        $data13 = CustomQrCode::where('web_link', $data12->web_link)->get();

        if (count($data13) > 0) {
            foreach ($data13 as $data) {
                $data->delete();
            }
            return back()->with('success', 'Deleted successfully!');
        } else {
            return back()->with('success', 'Something went wrong');
        }

    }

    /**
     * Download Qrcode.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */

    // this function creates new property save data in property table
    // also in related tables which are linked with a property like qrcdoe against property
    function createProperty(request $request)
    {

        $nameofdirectory = "Qrcode" . rand(2, 50);

        File::deleteDirectory(public_path() . '/' . $nameofdirectory);
        if (file_exists(public_path('/' . $nameofdirectory . '.zip'))) {
            unlink(public_path('/' . $nameofdirectory . '.zip'));
        }
        File::makeDirectory(public_path() . '/' . $nameofdirectory, $mode = 0777, true, true);

        $data = array('property_id' => $request->property);

        $url = 'http://mngrshq.managershq.com.au/qrform/' . $request->property;

        $file_name = 'qrcode' . '.pdf';
        $path = public_path('/' . $nameofdirectory . '/' . $file_name);

        $qrcode = $this->generateQrcode(session()->get('qrCode'), $url, $path);

        $path = public_path() . '/' . $nameofdirectory;
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
        //session()->put('downloadFile', 'public/' . $fileName);

        $input = session()->get('qrCode');

        if ($input['form6'][1]['value'] !== null) {

            CustomQrCode::create(['title' => $nameofdirectory, 'web_id' => $input['form6'][1]['value'], 'qrCodelink' => '/public/' . $fileName]);
        } else {

            CustomQrCode::create(['title' => $nameofdirectory, 'web_link' => $input['form6'][0]['value'], 'qrCodelink' => '/public/' . $fileName]);
        }

        return response()->download(public_path('/' . $fileName));
    }

    // this function creates new custom directory with randomly generated unique name
    // and alos make that folders as zip for every apartment etc in a property
    // file and save logos there for differernt pero
    function createProperty2(request $request)
    {

        $request->validate([
            'company_name_or_title' => 'required|unique:custom_qrcode,company_name_or_title',
        ]);

        $nameofdirectory = "Qrcode" . rand(2, 50);

        File::deleteDirectory(public_path() . '/' . $nameofdirectory);
        if (file_exists(public_path('/' . $nameofdirectory . '.zip'))) {
            unlink(public_path('/' . $nameofdirectory . '.zip'));
        }
        File::makeDirectory(public_path() . '/' . $nameofdirectory, $mode = 0777, true, true);

        $data = array('property_id' => $request->property);

        //                $url = 'http://mngrshq.managershq.com.au/qrform/'.$request->property;
        $url = session()->get('new_web_url');

        $file_name = 'qrcode' . '.pdf';
        $path = public_path('/' . $nameofdirectory . '/' . $file_name);

        $qrcode = $this->generateQrcode(session()->get('qrCode'), $url, $path);

        $path = public_path() . '/' . $nameofdirectory;
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
        //session()->put('downloadFile', 'public/' . $fileName);

        $input = session()->get('qrCode');

        if ($input['form6'][1]['value'] !== null) {

            $NewQrData1 = CustomQrCode::create(['title' => $nameofdirectory, 'web_id' => $input['form6'][1]['value'], 'company_name_or_title' => $request->company_name_or_title, 'user_id' => Auth::user()->id, 'qrCodelink' => '/public/' . $fileName]);

            $form_data22 = array(
                'property_id' => session()->get('property'),
                'is_web' => true
            );
            CustomQrCode::whereId($NewQrData1->id)->update($form_data22);

        } else if ($input['form6'][0]['value'] !== null) {

            $NewQrData2 = CustomQrCode::create(['title' => $nameofdirectory, 'web_link' => $input['form6'][0]['value'], 'company_name_or_title' => $request->company_name_or_title, 'user_id' => Auth::user()->id, 'qrCodelink' => '/public/' . $fileName]);

            $form_data23 = array(
                'property_id' => session()->get('property'),
                'is_web' => true
            );
            CustomQrCode::whereId($NewQrData2->id)->update($form_data23);
        }
        //        else if($input['form7'][0]['value'] !== null){
//
//            $dataId34= session()->get('surveyId');
//
//            $form_data2883 = array(
//                'title'                       =>   $nameofdirectory,
//                'company_name_or_title'       =>   $request->company_name_or_title,
//                'web_link'                    =>   'http://managersqr.managershq.com.au/survey/feedback/'.$dataId34,
//                'property_id'                 =>   session()->get('property'),
//                'survey_data'                 =>   $input['form7'][0]['value'],
//                'is_web'                      =>   true,
//                'qrCodelink'                  =>   '/public/'.$fileName
//            );
//            CustomQrCode::whereId($dataId34)->update($form_data2883);
//
//        }
        else if ($input['form7'] !== null) {

            $dataId34 = session()->get('surveyId');

            $form_data2883 = array(
                'title' => $nameofdirectory,
                'company_name_or_title' => $request->company_name_or_title,
                'web_link' => 'http://managersqr.managershq.com.au/survey/feedback/' . $dataId34,
                'property_id' => session()->get('property'),
                'survey_data' => $input['form7'],
                'is_web' => true,
                'qrCodelink' => '/public/' . $fileName
            );
            CustomQrCode::whereId($dataId34)->update($form_data2883);

        } else if ($input['form8'][0]['value'] !== null) {

            $questionFormId = session()->get('questionFormUid');

            $QRforForm = array(
                'title' => $nameofdirectory,
                'user_id' => Auth::user()->id,
                'company_name_or_title' => $request->company_name_or_title,
                'web_link' => 'http://managersqr.managershq.com.au/survey/question/form/' . $questionFormId,
                'property_id' => session()->get('property'),
                'is_web' => true,
                'qrCodelink' => '/public/' . $fileName
            );

            CustomQrCode::create($QRforForm);

        } else if ($input['form4'][0]['value'] !== null) {
            $NewQrData2 = CustomQrCode::create([
                'title' => $nameofdirectory,
                'web_link' => $input['form4'][0]['value'],
                'company_name_or_title' => $request->company_name_or_title,
                'user_id' => Auth::user()->id,
                'qrCodelink' => '/public/' . $fileName
            ]);

            $form_data23 = array(
                'property_id' => session()->get('property'),
                'is_plain_text' => true
            );
            CustomQrCode::whereId($NewQrData2->id)->update($form_data23);
        } else if ($input['form5'][0]['value'] !== null) {

            $NewQrData2 = CustomQrCode::create(['title' => $nameofdirectory, 'web_link' => $input['form5'][0]['value'], 'company_name_or_title' => $request->company_name_or_title, 'user_id' => Auth::user()->id, 'qrCodelink' => '/public/' . $fileName]);

            $form_data23 = array(
                'property_id' => session()->get('property'),
                'is_address' => true
            );
            CustomQrCode::whereId($NewQrData2->id)->update($form_data23);
        } else {

            // in this else web_link will get default value which is null.

            $NewQrData233 = CustomQrCode::create(['title' => $nameofdirectory, 'user_id' => Auth::user()->id, 'company_name_or_title' => $request->company_name_or_title, 'qrCodelink' => '/public/' . $fileName]);

            $form_data222 = array(
                'property_id' => session()->get('property')
            );
            CustomQrCode::whereId($NewQrData233->id)->update($form_data222);
        }
        //                }

        //        $data = CustomQrCode::where('user_id', Auth::user()->id)->groupby('web_link')->distinct()->get();
//        return view('properties.loadview',compact('data'));

        return redirect('/load/view');

        //        return redirect()->back()->with('success', 'QR code created successfully');

        //        return response()->download(public_path('/'.$fileName));
    }

    /**
     * Generate qrcodes.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */


    function unique_code($limit)
    {
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
    }


    function generateQrcode($qrcode, $url, $path)
    {

        $mpdf = new \Mpdf\Mpdf();

        if (file_exists(public_path('/qrcode123.png'))) {

            unlink(public_path('/qrcode123.png'));
        }

        $input = $qrcode;

        if ($input['form4'][0]['value'] !== null) {

            $qrCode = new QrCode($input['form4'][0]['value']);

        } elseif ($input['form5'][0]['value'] !== null) {

            $qrCode = new QrCode('https://maps.google.com/local?q=' . $input['form5'][1]['value'] . "," . $input['form5'][2]['value']);

        } elseif ($input['form6'][0]['value'] !== null) {

            $qrCode = new QrCode($input['form6'][0]['value']);

        } elseif ($input['form7'] !== null) {

            $NewQrData2 = CustomQrCode::create(['user_id' => Auth::user()->id, 'company_name_or_title' => 'test']);
            session()->put('surveyId', $NewQrData2->id);
            $qrCode = new QrCode('http://managersqr.managershq.com.au/survey/feedback/' . $NewQrData2->id);

        } elseif ($input['form8'][0]['value'] !== null) {


            Session::forget('questionFormUid');
            session()->forget('questionFormUid');

            for ($i = 0; $i < count($input['form8']); $i++) {

                if (session()->get('questionFormUid')) {
                    $u_id = session()->get('questionFormUid');
                } else {
                    $u_id = $this->unique_code(9);
                }

                $NewQuestionData = SurveyQuestion::create(['u_id' => $u_id, 'question' => $input['form8'][$i]['value']]);
                session()->put('questionFormUid', $NewQuestionData->u_id);

            }

            $qrCode = new QrCode('http://managersqr.managershq.com.au/survey/question/form/' . $u_id);
        } else {

            $qrCode = new QrCode($url);

        }

        //$qrCode = new QrCode($url);
        if (isset($input['form'][0]['value']) && !empty($input['form'][0]['value']) && $input['form'][0]['name'] == 'foregroundOne') {
            $foregroundcolor = explode(")", $input['form'][0]['value']);
            $forgroundcode = explode("(", $foregroundcolor[0]);
            $forgroundcodes = explode(",", $forgroundcode[1]);
            $qrcode = $qrCode->setForegroundColor(array('r' => $forgroundcodes[0], 'g' => $forgroundcodes[1], 'b' => $forgroundcodes[2], 'a' => 0));
        }

        if (isset($input['form'][1]['value']) && !empty($input['form'][1]['value']) && $input['form'][1]['name'] == 'background') {
            $backgroundcolor = explode(")", $input['form'][1]['value']);
            $backgroundcode = explode("(", $backgroundcolor[0]);
            $backgroundcodes = explode(",", $backgroundcode[1]);
            $qrCode->setBackgroundColor(array('r' => $backgroundcodes[0], 'g' => $backgroundcodes[1], 'b' => $backgroundcodes[2], 'a' => 0.7));
        }

        $qrCode->setSize(250);
        $qrCode->setMargin(0);
        $qrCode->setEncoding('UTF-8');
        $qrCode->setWriterByName('png');
        $qrCode->setLabelFontSize(10);
        $qrCode->setRoundBlockSize(true, QrCode::ROUND_BLOCK_SIZE_MODE_MARGIN); // The size of the qr code is shrinked, if necessary, but the size of the final image remains unchanged due to additional margin being added (default)
        $qrCode->setRoundBlockSize(true, QrCode::ROUND_BLOCK_SIZE_MODE_ENLARGE); // The size of the qr code and the final image is enlarged, if necessary
        $qrCode->setRoundBlockSize(true, QrCode::ROUND_BLOCK_SIZE_MODE_SHRINK); // The size of the qr code and the final image is shrinked, if necessary

        //$qrCode->setLogoPath('https://qrcodegenerator.ioptime.com/public/img/1603091070.png');
        $qrCode->setLogoSize(70, 70);
        $qrCode->setValidateResult(false);

        if (session()->has('logo')) {

            //dd($request->session()->get('logo'));

            $img = imagecreatefrompng(session()->get('logo'));

            $width = imagesx($img);
            $height = imagesy($img);

            // make a plain background with the dimensions
            $background = imagecreatetruecolor($width, $height);
            $color = imagecolorallocate($background, $backgroundcodes[0], $backgroundcodes[1], $backgroundcodes[2]); // grey background
            imagefill($background, 0, 0, $color);

            // place image on top of background
            imagecopy($background, $img, 0, 0, 0, 0, $width, $height);

            //save as png
            imagepng($background, public_path('/img/new.png'), 0);

            if ($input['eye'] == 1) {
                $image = public_path('/img/new.png');
                session()->put('logoNew', $image);
            } else {
                $image = session()->get('logo');
            }
            $qrCode->setLogoPath($image);
        }
        $qrCode->setErrorCorrectionLevel(ErrorCorrectionLevel::HIGH());
        $qrCode->setWriterOptions(['exclude_xml_declaration' => true]);
        header('Content-Type: ' . $qrCode->getContentType());
        $qrCode = $qrCode->writeDataUri();

        $data = array(
            'background' => $input['form3'][3]['value'],
            'textLine1' => $input['form2'][0]['value'],
            'textLine2' => $input['form2'][1]['value'],
            'textColor' => $input['form2'][2]['value'],
            'title' => $input['form3'][0]['value'],
            'link' => $input['form3'][1]['value'],
            'linkColor' => $input['form3'][2]['value'],
            'Adbackground' => $input['form3'][3]['value'],
            'showlink' => $input['link']
        );

        //return view('properties.qrCodeTemplate',compact('qrCode','data'));

        if (session()->has('companylogo')) {
            $logo = '<img src="' . session()->get('companylogo') . '" style="margin-left: auto!important;display: block!important;width: 10rem;
        position: relative !important;
        top:60px !important;margin-top:40px"  alt="" >';
        } else {
            $logo = '<div style="margin-left: auto!important;display: block!important;width: 7px;
                    position: relative !important;
                    top:10px !important;margin-top:2px;color:' . $data['background'] . '">dfgdfgd</div>';
        }

        if (!empty($data['link'])) {
            $link = '  <h5 style="font-weight: bold;color:' . $data['linkColor'] . '">   ' . $data['title'] . '</h5>
            <small style=" font-weight: 800;color:' . $data['linkColor'] . ';">' . $data['link'] . '</small>';
        } else {
            $link = '';
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
        <div class="col-md-12" style=" position: absolute;z-index: 99999;width: 80%;text-align: center;font-size: 1.5em;color: #fff;line-height: 1.5;background: ' . $data['background'] . ';flex: 0 0 100%;max-width: 100%;">
        <div class="row" style="display:flex;flex-wrap: wrap;margin-right: 10px;margin-left: 10px;">
        <div class="box text col-md-6" style="flex: 0 0 50%;max-width: 50%;">' . $logo . '</div>
        </div>

        <div class="row"  style="display: flex;flex-wrap: wrap;margin-right: 60px;margin-left: 60px;">
        <div class="text col-md-12" style="flex: 0 0 100%;max-width: 40%;margin: 0 auto">

        <h3 style="text-align:center;font-weight:bold;font-size:42px;color:' . $data['textColor'] . ' ">' . $data['textLine1'] . '</h3>
        <h3 style="text-align:center;font-weight: bold;font-size:42px;position: relative;color:' . $data['textColor'] . '}}; ">' . $data['textLine2'] . '</h3>
        </div>
        </div>

        <div class="row" style="margin-bottom: 5rem;margin-bottom: 3rem;display: flex;flex-wrap: wrap;margin-right: 10px;margin-left: 10px;">
        <div class=" text col-md-8 " style="margin:0 auto;flex: 0 0 66.666667%;max-width: 30%;}">
        <img class="d-block mx-auto" style="margin-left: auto!important;display: block!important;" height="200" src="' . $qrCode . '"  alt="" >
        </div>
        </div>

        <div class="row" style="padding-bottom:20px;margin-bottom:10rem;display: flex;flex-wrap: wrap;margin-right: 30px;margin-left: 30px;max-width: 10%">
        <div class=" text col-md-6 " style="margin-bottom:10rem;display: flex;flex-wrap: wrap;margin-right: 50px;margin-left: 50px; max-width: 10% ">
          ' . $link . '
        </div>
        </div>
        </div>
        </body>');

        $mpdf->Output($path, 'F');
    }

    /**
     * Upload File.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */

    // this funciton saves logos on to the server and then
    // use their ids etc or path in sessions for futher use
    function fileuploader(request $request)
    {

        if ($request->session()->has('logo')) {
            $image = explode("/", $request->session()->get('logo'));
            if (file_exists(public_path('/img/' . $image[4]))) {
                unlink(public_path('/img/' . $image[4]));
            }
        }

        $request->session()->forget('logo');
        $file = $request->file('files');
        $extension = $file->getClientOriginalExtension();
        $imageName = time() . '.' . $extension;
        $file->move(public_path('/img'), $imageName);
        $logo = url('/public/img/' . $imageName);
        $request->session()->put('logo', $logo);

        return json_encode(['success' => true]);
    }

    /**
     * Upload Logo.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */

    // this funciton saves logos on to the server and then
    // use their ids etc or path in sessions for futher use
    function fileuploaderlogo(request $request)
    {

        if ($request->session()->has('companylogo')) {
            $image = explode("/", $request->session()->get('companylogo'));
            if (file_exists(public_path('/img/' . $image[4]))) {
                unlink(public_path('/img/' . $image[4]));
            }
        }

        $request->session()->forget('companylogo');
        $file = $request->file('files');
        $extension = $file->getClientOriginalExtension();
        $imageName = time() . '.' . $extension;
        $file->move(public_path('/img'), $imageName);
        $logo = url('/public/img/' . $imageName);
        $request->session()->put('companylogo', $logo);

        return json_encode(['success' => true]);
    }

    /**
     * Update Qrcode
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */

    public function updateQr(Request $request, $id)
    {

        if (Session::has('logo')) {
            $image = explode("/", Session::get('logo'));
            if (file_exists(public_path('/img/' . $image[4]))) {
                unlink(public_path('/img/' . $image[4]));
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
        header('Content-Type: ' . $qrCode->getContentType());
        $qrCode->writeFile(public_path('/qrcodeimage6.png'));

        $data = CustomQrCode::find($id);

        return view('properties.updateqr', compact('data'));


    }


    function createQrcode()
    {

        if (Session::has('logo')) {
            $image = explode("/", Session::get('logo'));
            if (file_exists(public_path('/img/' . $image[4]))) {
                unlink(public_path('/img/' . $image[4]));
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
        header('Content-Type: ' . $qrCode->getContentType());
        $qrCode->writeFile(public_path('/qrcodeimage6.png'));

        return view('properties.qrCode2');
    }

    function createQrcode2()
    {

        if (Session::has('logo')) {
            $image = explode("/", Session::get('logo'));
            if (file_exists(public_path('/img/' . $image[4]))) {
                unlink(public_path('/img/' . $image[4]));
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
        header('Content-Type: ' . $qrCode->getContentType());
        $qrCode->writeFile(public_path('/qrcodeimage6.png'));

        return view('properties.qrCode3');
    }

    /**
     * Download UpdatedQrcode.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */

    public function downloadupdatedqr(request $request, $id)
    {

        //dd(session()->get('qrCode'));

        $CustomQr = CustomQrCode::findorfail($id);

        $nameofdirectory = $CustomQr->title;

        File::deleteDirectory(public_path() . '/' . $nameofdirectory);
        if (file_exists(public_path('/' . $nameofdirectory . '.zip'))) {
            unlink(public_path('/' . $nameofdirectory . '.zip'));
        }
        File::makeDirectory(public_path() . '/' . $nameofdirectory, $mode = 0777, true, true);

        $data = array('property_id' => $request->property);

        $url = 'http://mngrshq.managershq.com.au/qrform/' . $request->property;

        $file_name = 'qrcode' . '.pdf';
        $path = public_path('/' . $nameofdirectory . '/' . $file_name);

        $qrcode = $this->generateQrcode(session()->get('qrCode'), $url, $path);

        $path = public_path() . '/' . $nameofdirectory;
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
        //session()->put('downloadFile', 'public/' . $fileName);

        $input = session()->get('qrCode');

        if ($input['form6'][1]['value'] !== null) {

            CustomQrCode::where('id', $id)->update(['title' => $nameofdirectory, 'web_id' => $input['form6'][1]['value'], 'qrCodelink' => '/public/' . $fileName]);
        }

        //                else{
//
//                CustomQrCode::where('id',$id)->update(['title'=> $nameofdirectory,'web_link'=>$input['form6'][0]['value'],'qrCodelink'=>'/public/'.$fileName]);
//                }

        if ($input['form6'][0]['value'] !== null) {

            CustomQrCode::where('id', $id)->update([
                'title' => $nameofdirectory,
                'is_web' => true,
                'web_link' => $input['form6'][0]['value'],
                'qrCodelink' => '/public/' . $fileName
            ]);
        }

        if ($input['form4'][0]['value'] !== null) {

            CustomQrCode::where('id', $id)->update([
                'title' => $nameofdirectory,
                'is_plain_text' => true,
                'web_link' => $input['form4'][0]['value'],
                'qrCodelink' => '/public/' . $fileName
            ]);
        }

        if ($input['form5'][0]['value'] !== null) {

            CustomQrCode::where('id', $id)->update([
                'title' => $nameofdirectory,
                'is_address' => true,
                'web_link' => $input['form5'][0]['value'],
                'qrCodelink' => '/public/' . $fileName
            ]);
        }

        //        return redirect()->back()->with('success', 'QR code updated successfully');

        return redirect('/load/view');

        //            return response()->download(public_path('/'.$fileName));
    }


    /**
     * Download SimpleQr from list.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */

    public function downloadsimpleqr(request $request, $id)
    {

        $CustomQr = CustomQrCode::findorfail($id);

        $nameofdirectory = $CustomQr->title;

        $path = public_path() . '/' . $nameofdirectory;

        $fileName = $nameofdirectory . '.zip';

        return response()->download(public_path('/' . $fileName));
    }

    public function downloadsimpleqr2(request $request, $id)
    {

        try {

            $checkCount = CustomQrCode::where('web_link', 'http://managersqr.managershq.com.au/website/' . $id)->first();


            if ($checkCount) {
                $CustomQr = CustomQrCode::findorfail($checkCount->id);

                $nameofdirectory = $CustomQr->title;

                $path = public_path() . '/' . $nameofdirectory;

                $fileName = $nameofdirectory . '.zip';

                return response()->download(public_path('/' . $fileName));
            } else {
                return redirect()->back()->with('message', 'You have not created any QR for this website');
            }

        } catch (\Exception $e) {

            return $e->getMessage();
        }


    }


    public function FetchQuestionForm($id)
    {

        $data = SurveyQuestion::where('u_id', $id)->get();
        return view('question_form', compact('data'));
    }

    public function SubmitAnswers(Request $request)
    {

        Session::forget('answerUid');
        session()->forget('answerUid');

        for ($i = 0; $i < count($request->fname); $i++) {

            if (session()->get('answerUid')) {
                $Answer_u_id = session()->get('answerUid');
            } else {
                $Answer_u_id = $this->unique_code(9);
            }

            $questionData = SurveyQuestion::where('u_id', $request->formId)->get();

            $NewAnswerData = SurveyAnswer::create([
                'u_id' => $Answer_u_id,
                'question_form_iu_d' => $request->formId,
                'question_id' => $questionData[$i]->id,
                'answer' => $request->fname[$i]
            ]);

            session()->put('answerUid', $NewAnswerData->u_id);

        }
        return response()->json(['success' => 'Feedback submitted successfully.']);
    }
}
