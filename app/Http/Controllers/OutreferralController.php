<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Outreferral;
use App\Models\Facility;
use App\Models\Practitioner;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Session;
use Bouncer;
use Datatables;
use Auth;
use PDF;
class OutreferralController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        Controller::has_ability('View_Outreferral');
        $data['outreferrals']=Outreferral::select('outreferrals.*','p.first_name as firstname','p.last_name as lastname','p.middle_name as pmiddlename','pt.first_name as pfirstname','pt.last_name as plastname','pt.middle_name as middlename','f.name as facility_name')                                
                                ->Join('practitioners as p','p.id','=','outreferrals.practitioner_id')
                                ->Join('patients as pt','pt.id','=','outreferrals.patient_id')
                                ->Join('facilities as f','f.id','=','outreferrals.facility_id')
                                ->orderBy('outreferrals.entry_date', 'desc')
                                ->get();
                               
        return view('outreferrals.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        Controller::has_ability('Create_Outreferral');
            $data['practitioners']=Practitioner::all();
            $data['patients']=Patient::all();
            $data['facilities']=Facility::all();

        return view('outreferrals.create',$data);
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

        Controller::has_ability('Create_Outreferral');
   
        $this->validate($request,[
            //'patient_id' => 'required',
            //'facility_id' => 'required',
           // 'practitioner_id' => 'required',
            //'entry_date' => 'entry_date',
        ]);

        $outreferral= Outreferral::create([ 
                'patient_id' => $request->patient_id,
                'facility_id' => $request->facility_id,
                'practitioner_id' => $request->practitioner_id,
                'entry_date' => $request->entry_date, 
                'reason' => $request->reason,           
        ]);

        //return $path;
        return redirect('outreferrals'); 
       
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
        $data['outreferrals']=Outreferral::select('outreferrals.*','p.first_name as firstname','p.last_name as lastname','p.middle_name as pmiddlename','pt.first_name as pfirstname','pt.last_name as plastname','pt.middle_name as middlename','f.name as facility_name')                                
                                ->Join('practitioners as p','p.id','=','outreferrals.practitioner_id')
                                ->Join('patients as pt','pt.id','=','outreferrals.patient_id')
                                ->Join('facilities as f','f.id','=','outreferrals.facility_id')
                                ->where('outreferrals.id','=',$id)
                                ->first();
        return view('outreferrals.show',$data);
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
        Controller::has_ability('Edit_Outreferral');
        $outreferral=Outreferral::find($id);

        $data['practitioners']=Practitioner::all();
        $data['patients']=Patient::all();
        $data['facilities']=Facility::all();

        $data['outreferral']=$outreferral;

        return view('outreferrals.edit',$data);
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
         Controller::has_ability('Edit_Outreferral');
        $outreferral=Outreferral::find($id); 

        $this->validate($request,[           
                //'patient_id' => 'required',
               // 'facility_id' => 'required',
             //   'practitioner_id' => 'required',
              //  'entry_date' => 'entry_date'      
          
        ]);


        $outreferral->update([
                'patient_id' => $request->patient_id,
                'facility_id' => $request->facility_id,
                'practitioner_id' => $request->practitioner_id,
                'entry_date' => $request->entry_date,
                'reason' => $request->reason ]
         
     );
         return redirect('outreferrals'); 
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
        Controller::has_ability('Delete_Outreferral');
         $outreferral=Outreferral::find($id);
         $outreferral->delete();

         return redirect('outreferrals'); 
    }

    public function outreferral_filter(Request $request)
    {
      
      $data['outreferrals']=Outreferral::select('outreferrals.*','p.first_name as firstname','p.last_name as lastname','p.middle_name as pmiddlename','pt.first_name as pfirstname','pt.last_name as plastname','pt.middle_name as middlename','f.name as facility_name')                                
                                ->Join('practitioners as p','p.id','=','outreferrals.practitioner_id')
                                ->Join('patients as pt','pt.id','=','outreferrals.patient_id')
                                ->Join('facilities as f','f.id','=','outreferrals.facility_id')
                                ->where('outreferrals.'.$request->creteria,'LIKE','%'.$request->str.'%')
                                ->get();
           
      return view('outreferrals.search',$data);

    }


         /*TOTAL Outreferral*/
        public function outreferrals_count()
            {

                return Outreferral::count();

            }
        /*END*/

}
