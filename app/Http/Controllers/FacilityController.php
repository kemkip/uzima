<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facility;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Session;
use Bouncer;
use Datatables;
use Auth;
use PDF;

class FacilityController extends Controller
{
  /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        Controller::has_ability('View_Facility');
      $data['facilities']=Facility::all();
    
      return view('facilities.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        Controller::has_ability('Create_Facility');
        return view('facilities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
          $this->validate($request,[           
         
         'name' => 'required|string|max:255|unique:facilities',
            
        ]);

        Facility::create($request->all());
        Session::flash('alert-success', 'Facility has been Created');
        return redirect('facilities');  
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
       /*   Controller::has_ability('View_facility');
  

        $data['facility']=$facility;

        return view('facilities.show',$data);*/
    }

    /**
     * Show the form for editing the specified resource.
     */
     public function edit($id)
    {
        
        Controller::has_ability('Edit_Facility');
        $facility=Facility::find($id);

        
        $data['facility']=$facility;

        return view('facilities.edit',$data);
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
       Controller::has_ability('Edit_Facility');
        $facility=Facility::find($id); 

        $this->validate($request,[           
            'name' => 'required|string|max:255',
            
            
            
        ]);

        $facility->update($request->all());
        Session::flash('alert-success', 'Facility has been updated');

        return redirect('facilities'); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Controller::has_ability('Delete_Facility');
         $facility=Facility::find($id);
         $facility->delete();

        Session::flash('alert-danger', 'User has been deleted');

         return redirect('facilities');
   
    }

     /*TOTAL FACILITIES*/
        public function facilities_count()
        {

            return Facility::count();

        }
    /*END*/



}
