@extends('layouts.inspinia')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
<div class="col-lg-10">
    <h2 style="color:#1AB394;"><strong>Inreferral Management</strong></h2>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('/home')}}">Home</a>
        </li>
        <li>
            <a>Inreferral</a>
        </li>
        <li class="active">
            <strong>Create</strong>
        </li>
    </ol>
</div>

</div>

  <div class="wrapper wrapper-content animated fadeInRight">        

<div class="row">
<div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Create Inreferral</h5>
            <div class="ibox-tools">
                <a href="{{Route('home')}}" class="btn btn-danger btn-xs active">Home <i class="fa fa-level-up"></i></a> 
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-wrench"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="#">Config option 1</a>
                    </li>
                    <li><a href="#">Config option 2</a>
                    </li>
                </ul>
                <a class="close-link">
                    <i class="fa fa-times"></i>
                </a>
            </div>
        </div>
        <div class="ibox-content">
          
            {!! Form::open(array('route' => 'inreferrals.store','method'=>'POST','class'=>'form-horizontal','enctype'=>'multipart/form-data')) !!}


                <div class="form-body row"> 
                    <div class="form-group col-md-12">   
                        <div class="form-md-line-input col-md-4"> 
                               <label class="control-label" >Patient</label>
                            <select name="patient_id"  class="form-control form-md-line-input fstdropdown-select">
                                <option value="">Select Patient..</option>
                                <option value=""></option>
                                    @foreach($patients as $patient)                            
                                <option value="{{$patient->id}}">{{$patient->first_name}} {{$patient->middle_name}} {{$patient->last_name}} </option>
                                @endforeach
                             </select>
                        </div>
                        <div class="form-md-line-input col-md-4"> 
                               <label class="control-label" >Facility</label>
                            <select name="facility_id"  class="form-control form-md-line-input fstdropdown-select">
                                <option value="">Select Facility..</option>
                                <option value=""></option>
                                    @foreach($facilities as $facility)                            
                                <option value="{{$facility->id}}">{{$facility->name}} </option>
                                @endforeach
                             </select>
                        </div>
                        <div class="form-md-line-input col-md-4"> 
                              <label class="control-label" >Practitioner</label>
                            <select name="practitioner_id"  class="form-control form-md-line-input fstdropdown-select">
                                <option value="">Select Practitioner..</option>
                                <option value=""></option>
                                    @foreach($practitioners as $practitioner)                            
                                <option value="{{$practitioner->id}}">{{$practitioner->first_name}} {{$practitioner->middle_name}}  {{$practitioner->last_name}}  </option>
                                @endforeach
                             </select>
                        </div>
                        
                    </div>
                    <div class="form-group col-md-12">   
                   
                     <div class="form-md-line-input col-md-4">
                    
                        <label class="control-label" >Reason</label>
                        <div class="input-group date">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                        <input type="text" name="reason" class="form-control" placeholder="Reason">
                    </div>
                            <div class="form-control-focus"> </div>
                      
                    </div> 

                     <div class=" form-md-line-input col-md-4">
                    
                        <label class="control-label" >Entry Date</label>
                        <div class="input-group date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="date" name="entry_date" class="form-control daily" placeholder="DD/MM/YYYY e.g 01/01/2020">
                    </div>
                            <div class="form-control-focus"> </div>
                      
                    </div> 

                    
                    
                </div>
            
            
                 
                         
            </div>

                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-2">
                        <button class="btn btn-white" type="reset">Cancel</button>
                        <button class="btn btn-primary" type="submit">Save changes</button>
                        <a href="{{Route('inreferrals.index')}}"><button class="btn btn-danger" type="button">Back</button></a>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

</div>


                              
@endsection