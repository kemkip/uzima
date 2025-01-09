<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patientcategory;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Session;
use Bouncer;
use Datatables;
use Auth;
use PDF;

class PatientcategoryController extends Controller
{
    //
/**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        Controller::has_ability('View_Patientcategory');
      $data['patientcategories']=Patientcategory::all();
    
      return view('patientcategories.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        Controller::has_ability('Create_Patientcategory');
        return view('patientcategories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
          $this->validate($request,[           
         
         'name' => 'required|string|max:255|unique:patientcategories',
            
        ]);

        Patientcategory::create($request->all());
        Session::flash('alert-success', 'Patientcategory has been Created');
        return redirect('patientcategories');  
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
       /*   Controller::has_ability('View_patientcategory');
  

        $data['patientcategory']=$patientcategory;

        return view('patientcategories.show',$data);*/
    }

    /**
     * Show the form for editing the specified resource.
     */
     public function edit($id)
    {
        
        Controller::has_ability('Edit_Patientcategory');
        $patientcategory=Patientcategory::find($id);

        
        $data['patientcategory']=$patientcategory;

        return view('patientcategories.edit',$data);
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
       Controller::has_ability('Edit_Patientcategory');
        $patientcategory=Patientcategory::find($id); 

        $this->validate($request,[           
            'name' => 'required|string|max:255',
            
            
            
        ]);

        $patientcategory->update($request->all());
        Session::flash('alert-success', 'Patientcategory has been updated');

        return redirect('patientcategories'); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Controller::has_ability('Delete_Patientcategory');
         $patientcategory=Patientcategory::find($id);
         $patientcategory->delete();

        Session::flash('alert-danger', 'User has been deleted');

         return redirect('patientcategories');
   
    }



}
