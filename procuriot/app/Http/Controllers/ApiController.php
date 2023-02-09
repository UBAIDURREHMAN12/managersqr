<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\AccountVerification;
use Mail;
use Validator;
use App\User;
use App\Gateway;
use App\Beacon;
use App\Venue;
use Session;

class ApiController extends Controller
{

    public function getVenues(Request $request){

        $data = Venue::all();

        $response = array(
                'success' => true,
                'message' => 'Venues list!',
            'data' => $data
        );

        return response()->json($response, 200);

    }

    public function getbeacon($id){

        $data = Beacon::where('id',$id)->get();

        $response = array(
            'success' => true,
            'message' => 'Venues list!',
            'data' => $data
        );

        return response()->json($response, 200);
    }
    public function getVenues2(Request $request){

        $data = Venue::where('vendor_id', 25)->first();

        $getData['id'] = $data->id;
        $getData['vendor_id'] = $data[0]->vendor_id;
        $getData['name'] = $data->name;
        $getData['description'] = $data->description;


        $response = array(
            'success' => true,
            'message' => 'Venues list!',
            'data' => $getData
        );

        return response()->json($response, 200);

    }

    public function getGateways($venue_id){

            $data = Gateway::where('venue_id', $venue_id)->get();

            $response = array(
                    'success' => true,
                    'message' => 'Gateways list!',
                'data' => $data
            );

            return response()->json($response, 200);

    }

    public function getbeacons($gateway_id){

        $data = Beacon::where('gateway_id', $gateway_id)->get();

        $response = array(
                'success' => true,
                'message' => 'Beacons list!',
            'data' => $data
        );

        return response()->json($response, 200);

    }

}
