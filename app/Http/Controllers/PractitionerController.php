<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Specialization;
use App\Models\Practitioner;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Session;
use Bouncer;
use Datatables;
use Auth;
use PDF;
class PractitionerController extends Controller
{
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        Controller::has_ability('View_Practitioner');
        $data['practitioners']=Practitioner::select('practitioners.*','s.name as specialization_name')                                
                                ->Join('specializations as s','s.id','=','practitioners.specialization_id')
                                ->orderBy('practitioners.created_at', 'desc')
                                ->get();
                               
        return view('practitioners.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        Controller::has_ability('Create_Practitioner');
        $data['specializations']=Specialization::all();

        return view('practitioners.create',$data);
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

        Controller::has_ability('Create_Practitioner');
   
        $this->validate($request,[
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'specialization_id' => 'required',
        ]);

        $practitioner= Practitioner::create([ 
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'specialization_id' => $request->specialization_id
            
        ]);

        //return $path;
        return redirect('practitioners'); 
       
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
        $data['practitioners']=Practitioner::select('practitioners.*','s.name as specialization_name')                                
                                ->Join('specializations as s','s.id','=','practitioners.specialization_id')
                                ->where('practitioners.id','=',$id)
                                ->first();
        return view('practitioners.show',$data);
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
        Controller::has_ability('Edit_Practitioner');
        $practitioner=Practitioner::find($id);

        $data['countries']=Specialization::all();

        $data['practitioner']=$practitioner;

        return view('practitioners.edit',$data);
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
         Controller::has_ability('Edit_Practitioner');
        $practitioner=Practitioner::find($id); 

        $this->validate($request,[           
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'specialization_id' => 'required',      
          
        ]);


        $practitioner->update([
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'specialization_id' => $request->specialization_id]
         
     );
         return redirect('practitioners'); 
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
        Controller::has_ability('Delete_Practitioner');
         $practitioner=Practitioner::find($id);
         $practitioner->delete();

         return redirect('practitioners'); 
    }

    public function practitioner_filter(Request $request)
    {
      
      $data['practitioners']=Practitioner::select('practitioners.*','s.name as specialization_name')                                
                                ->Join('specializations as s','s.id','=','practitioners.specialization_id')
                                //->orderBy('practitioners.created_at', 'desc')
                                ->where('practitioners.'.$request->creteria,'LIKE','%'.$request->str.'%')
                                ->get();
           
      return view('practitioners.search',$data);

    }

     /*TOTAL Inreferral*/
        public function practitioners_count()
            {

                return Practitioner::count();

            }
        /*END*/

}
