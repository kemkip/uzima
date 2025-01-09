<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Specialization;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Session;
use Bouncer;
use Datatables;
use Auth;
use PDF;

class SpecializationController extends Controller
{
  /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        Controller::has_ability('View_Specialization');
      $data['specializations']=Specialization::all();
    
      return view('specializations.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        Controller::has_ability('Create_Specialization');
        return view('specializations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
          $this->validate($request,[           
         
         'name' => 'required|string|max:255|unique:specializations',
            
        ]);

        Specialization::create($request->all());
        Session::flash('alert-success', 'Specialization has been Created');
        return redirect('specializations');  
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
       /*   Controller::has_ability('View_specialization');
  

        $data['specialization']=$specialization;

        return view('specializations.show',$data);*/
    }

    /**
     * Show the form for editing the specified resource.
     */
     public function edit($id)
    {
        
        Controller::has_ability('Edit_Specialization');
        $specialization=Specialization::find($id);

        
        $data['specialization']=$specialization;

        return view('specializations.edit',$data);
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
       Controller::has_ability('Edit_Specialization');
        $specialization=Specialization::find($id); 

        $this->validate($request,[           
            'name' => 'required|string|max:255',
            
            
            
        ]);

        $specialization->update($request->all());
        Session::flash('alert-success', 'Specialization has been updated');

        return redirect('specializations'); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Controller::has_ability('Delete_Specialization');
         $specialization=Specialization::find($id);
         $specialization->delete();

        Session::flash('alert-danger', 'User has been deleted');

         return redirect('specializations');
   
    }

     /*TOTAL specializations*/
        public function specializations_count()
        {

            return Specialization::count();

        }
    /*END*/



}
