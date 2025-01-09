<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Inreferral;
use App\Models\Facility;
use App\Models\Practitioner;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Session;
use Bouncer;
use Datatables;
use Auth;
use PDF;
class InreferralController extends Controller
{
   
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        Controller::has_ability('View_Inreferral');
        $data['inreferrals']=Inreferral::select('inreferrals.*','p.first_name as firstname','p.last_name as lastname','p.middle_name as pmiddlename','pt.first_name as pfirstname','pt.last_name as plastname','pt.middle_name as middlename','f.name as facility_name')                    
                                ->Join('practitioners as p','p.id','=','inreferrals.practitioner_id')
                                ->Join('patients as pt','pt.id','=','inreferrals.patient_id')
                                ->Join('facilities as f','f.id','=','inreferrals.facility_id')
                                ->orderBy('inreferrals.entry_date', 'desc')
                                ->get();
                               
        return view('inreferrals.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        Controller::has_ability('Create_Inreferral');
            $data['patients']=Patient::all();
            $data['facilities']=Facility::all();
            $data['practitioners']=Practitioner::all();

        return view('inreferrals.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        Controller::has_ability('Create_Inreferral');
   
        $this->validate($request,[
           // 'patient_id' => 'required',
            //'facility_id' => 'required',
         //   'practitioner_id' => 'required',
          //  'entry_date' => 'entry_date'
        ]);

        $inreferral= Inreferral::create([ 
                'patient_id' => $request->patient_id,
                'facility_id' => $request->facility_id,
                'practitioner_id' => $request->practitioner_id,
                'entry_date' => $request->entry_date, 
                'reason' => $request->reason,           
        ]);

        //return $path;
        return redirect('inreferrals'); 
       
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
        $data['inreferrals']=Inreferral::select('inreferrals.*','p.first_name as firstname','p.last_name as lastname','p.middle_name as pmiddlename','pt.first_name as pfirstname','pt.last_name as plastname','pt.middle_name as middlename','f.name as facility_name')                    
                                ->Join('practitioners as p','p.id','=','inreferrals.practitioner_id')
                                ->Join('patients as pt','pt.id','=','inreferrals.patient_id')
                                ->Join('facilities as f','f.id','=','inreferrals.facility_id')
                                ->where('inreferral.id','=',$id)
                                ->first();
        return view('inreferrals.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        Controller::has_ability('Edit_Inreferral');
        $inreferral=Inreferral::find($id);

        $data['practitioners']=Practitioner::all();
        $data['patients']=Patient::all();
        $data['facilities']=Facility::all();

        $data['inreferral']=$inreferral;

        return view('inreferrals.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
         Controller::has_ability('Edit_Inreferral');
        $inreferral=Inreferral::find($id); 

        $this->validate($request,[           
              //  'patient_id' => 'required',
               // 'facility_id' => 'required',
             //   'practitioner_id' => 'required',
              //  'entry_date' => 'entry_date'      
          
        ]);


        $inreferral->update([
                'patient_id' => $request->patient_id,
                'facility_id' => $request->facility_id,
                'practitioner_id' => $request->practitioner_id,
                'entry_date' => $request->entry_date,
                'reason' => $request->reason ]
         
     );
         return redirect('inreferrals'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Controller::has_ability('Delete_Inreferral');
         $inreferral=Inreferral::find($id);
         $inreferral->delete();

         return redirect('inreferrals'); 
    }

    public function inreferrals_filter(Request $request)
    {
      
      $data['inreferrals']=Inreferral::select('inreferrals.*','p.first_name as firstname','p.last_name as lastname','p.middle_name as pmiddlename','pt.first_name as pfirstname','pt.last_name as plastname','pt.middle_name as middlename','f.name as facility_name')                    
                                ->Join('practitioners as p','p.id','=','inreferrals.practitioner_id')
                                ->Join('patients as pt','pt.id','=','inreferrals.patient_id')
                                ->Join('facilities as f','f.id','=','inreferrals.facility_id')
                                ->where('inreferrals.'.$request->creteria,'LIKE','%'.$request->str.'%')
                                ->get();
           
      return view('inreferrals.search',$data);

    }

         /*TOTAL Inreferral*/
        public function inreferrals_count()
            {

                return Inreferral::count();

            }
        /*END*/

}
