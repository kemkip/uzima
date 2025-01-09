<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['user']=new UsersController;  
        $data['facility']=new FacilityController;
        $data['inreferral']=new InreferralController;
        $data['outreferral']=new OutreferralController;
        $data['practitioner']=new PractitionerController;

        return view('home',$data);
    }
}
