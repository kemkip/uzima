<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AfricasTalking\SDK\AfricasTalking;

use App\Models\SmsRecord;

class SmsController extends Controller
{

     public function index()
    {
        //
      
      $data['sms_records']=SmsRecord::all();
    
      return view('smses.index',$data);
    }

    public function create()
    {
        //
         
        $data['smses']=SmsRecord::all();
        

        return view('smses.create',$data);
    }

    public function store(Request $request)
    {
        // Initialize Africa's Talking
        $AT = new AfricasTalking(env('AFRICASTALKING_USERNAME'), env('AFRICASTALKING_API_KEY'));

        // Set up the SMS service
        $sms = $AT->sms();

        // Send SMS
        $result = $sms->send([
            'to'      => $request->phone_number,
            'message' => 'Christian Greetings' . " " . $request->first_name . " " . $request->last_name . "," . 'Thank you for your contribution of ' . $request->contribution_amount . ' KSHS.'
        ]);

        $smsrecord= SmsRecord::create([            
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone_number' => $request->phone_number,
                'contribution_amount' => $request->contribution_amount        
           
            
        ]);

        // Save record to the database
       // $smsRecord = new \App\Models\SmsRecord();
        //$smsRecord->first_name = $request->first_name;
        //$smsRecord->last_name = $request->last_name;
        //$smsRecord->phone_number = $request->phone_number;
        //$smsRecord->contribution_amount = $request->contribution_amount;
       // $smsRecord->save();

        return redirect('smses')->with('success', 'SMS sent successfully');
    }
}
