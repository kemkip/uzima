<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diagnosis;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Session;
use Bouncer;
use Datatables;
use Auth;
use PDF;

class DiagnosisController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        Controller::has_ability('View_Diagnosis');
      $data['diagnoses']=Diagnosis::all();
    
      return view('diagnoses.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        Controller::has_ability('Create_Diagnosis');
        return view('diagnoses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
          $this->validate($request,[           
         
         'name' => 'required|string|max:255|unique:diagnoses',
         'dcode' => 'required',
            
        ]);

        Diagnosis::create($request->all());
        Session::flash('alert-success', 'Diagnosis has been Created');
        return redirect('diagnoses');  
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
       /*   Controller::has_ability('View_diagnosis');
  

        $data['diagnosis']=$diagnosis;

        return view('diagnoses.show',$data);*/
    }

    /**
     * Show the form for editing the specified resource.
     */
     public function edit($id)
    {
        
        Controller::has_ability('Edit_Diagnosis');
        $diagnosis=Diagnosis::find($id);

        
        $data['diagnosis']=$diagnosis;

        return view('diagnoses.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       Controller::has_ability('Edit_Diagnosis');
        $diagnosis=Diagnosis::find($id); 

        $this->validate($request,[           
            'name' => 'required|string|max:255',
            'dcode' => 'required',
            
            
            
        ]);

        $diagnosis->update($request->all());
        Session::flash('alert-success', 'Diagnosis has been updated');

        return redirect('diagnoses'); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Controller::has_ability('Delete_Diagnosis');
         $diagnosis=Diagnosis::find($id);
         $diagnosis->delete();

        Session::flash('alert-danger', 'User has been deleted');

         return redirect('diagnoses');
   
    }

     /*TOTAL diagnoses*/
        public function diagnoses_count()
        {

            return Diagnosis::count();

        }
    /*END*/



}
