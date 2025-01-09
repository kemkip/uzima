<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Patientcategory;
use App\Models\Patient;
use App\Models\Diagnosis;
use App\Models\Country;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Session;
use Bouncer;
use Datatables;
use Auth;
use PDF;
class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        Controller::has_ability('View_Patient');
        $data['patients']=Patient::select('patients.*','c.name as country_name','p.name as patientcategory_name','d.name as diagnosis_name')                                
                                ->Join('diagnoses as d','d.id','=','patients.diagnosis_id')
                                ->Join('patientcategories as p','p.id','=','patients.patientcategory_id')
                                ->Join('countries as c','c.id','=','patients.country_id')
                                ->orderBy('patients.entry_date', 'desc')
                                ->get();
                               
        return view('patients.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        Controller::has_ability('Create_Patient');
        $data['countries']=Country::all();
        $data['diagnoses']=Diagnosis::all();
        $data['patientcategories']=Patientcategory::all();

        return view('patients.create',$data);
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

        Controller::has_ability('Create_Patient');
   
        $this->validate($request,[           
           // 'patient_number' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'age' => 'required|integer',
            'diagnosis_id' => 'required',
            'patientcategory_id' => 'required',

            
            
        ]);

        $patient= Patient::create([            
                'patient_number' => $request->patient_number,
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                'age' => $request->age,
                'birth_date' => $request->birth_date,
                'sex' => $request->sex,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'entry_date' => $request->entry_date,
                'patientcategory_id' => $request->patientcategory_id,
                'country_id' => $request->country_id,
                'diagnosis_id' => $request->diagnosis_id,
                'description' => $request->description
                   
           
            
        ]);

        //return $path;
        return redirect('patients'); 
       
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
        $data['patients']=Patient::select('patients.*','c.name as country_name','p.name as patientcategory_name','d.name as diagnosis_name')                                
                                ->Join('diagnoses as d','d.id','=','patients.diagnosis_id')
                                ->Join('patientcategories as p','p.id','=','patients.patientcategory_id')
                                ->Join('countries as c','c.id','=','patients.country_id')
                                ->where('patients.id','=',$id)
                                ->first();
        return view('patients.show',$data);
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
        Controller::has_ability('Edit_Patient');
        $patient=Patient::find($id);

        $data['countries']=Country::all();
        $data['diagnoses']=Diagnosis::all();
        $data['patientcategories']=Patientcategory::all();

        $data['patient']=$patient;

        return view('patients.edit',$data);
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
         Controller::has_ability('Edit_Patient');
        $patient=Patient::find($id); 

        $this->validate($request,[           
          //  'patient_number' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'age' => 'required|integer',
            'diagnosis_id' => 'required',
            'patientcategory_id' => 'required',       
          
        ]);


        $patient->update([
                'patient_number' => $request->patient_number,
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                'age' => $request->age,
                'birth_date' => $request->birth_date,
                'sex' => $request->sex,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'entry_date' => $request->entry_date,
                'patientcategory_id' => $request->patientcategory_id,
                'country_id' => $request->country_id,
                'diagnosis_id' => $request->diagnosis_id,
                'description' => $request->description]
         
     );
         return redirect('patients'); 
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
        Controller::has_ability('Delete_Patient');
         $patient=Patient::find($id);
         $patient->delete();

         return redirect('patients'); 
    }

    public function patient_filter(Request $request)
    {
      
      $data['patients']=Patient::select('patients.*','c.name as country_name','p.name as patientcategory_name','d.name as diagnosis_name')                                
                                ->Join('diagnoses as d','d.id','=','patients.diagnosis_id')
                                ->Join('patientcategories as p','p.id','=','patients.patientcategory_id')
                                ->Join('countries as c','c.id','=','patients.country_id')
                                ->where('patients.'.$request->creteria,'LIKE','%'.$request->str.'%')
                                ->get();
           
      return view('patients.search',$data);

    }

}
