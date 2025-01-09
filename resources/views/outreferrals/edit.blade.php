@extends('layouts.inspinia')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
<div class="col-lg-10">
    <h2 style="color:#1AB394;"><strong>Outreferral Management</strong></h2>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('/home')}}">Home</a>
        </li>
        <li>
            <a>Outreferral</a>
        </li>
        <li class="active">
            <strong>Edit</strong>
        </li>
    </ol>
</div>

</div>

  <div class="wrapper wrapper-content animated fadeInRight">        

<div class="row">
<div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Edit Outreferral</h5>
            <div class="ibox-tools">
                <a href="{{Route('home')}}" class="btn btn-danger btn-xs active">Home <i class="fa fa-level-up"></i></a> 
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-wrench"></i>
                </a>
                <ul class="dropdown-menu dropdown-outreferral">
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

            @if (count($errors) > 0)

            <div class="alert alert-danger">


            <ul>

            @foreach ($errors->all() as $error)

            <li>{{ $error }}</li>

            @endforeach

            </ul>

            </div>

            @endif 
          
      
            
            {!! Form::model($outreferral, ['method' => 'PATCH', 'enctype'=>'multipart/form-data','route' => ['outreferrals.update', $outreferral->id]]) !!}

         
                <div class="form-body row">  
                <div class="form-group form-md-line-input col-md-12">
                        <div class="form-group form-md-line-input col-md-4"> 
                    <label class="control-label" >Select Patient</label>
                    <select name="patient_id"  class="form-control fstdropdown-select" >

                        @foreach($patients as $patient)                            
                        <option value="{{$patient->id}}" {{$patient->id == $outreferral->patient_id ? 'selected' : ''}}> {{$patient->name}} 
                        </option>
                            @endforeach
                    </select>
                         
                    </div>
                <div class="form-group form-md-line-input col-md-4">
                    
                    <div class="form-group form-md-line-input col-md-4"> 
                    <label class="control-label" >Select Facility</label>
                    <select name="facility_id"  class="form-control fstdropdown-select" >

                        @foreach($facilities as $facility)                            
                        <option value="{{$facility->id}}" {{$facility->id == $outreferral->facility_id ? 'selected' : ''}}> {{$facility->name}} 
                        </option>
                            @endforeach
                    </select>
                         
                    </div>
                      
                </div>
                <div class="form-group form-md-line-input col-md-4">
                    
                    <div class="form-group form-md-line-input col-md-4"> 
                    <label class="control-label" >Select Specialization</label>
                    <select name="practitioner_id"  class="form-control fstdropdown-select" >

                        @foreach($practitioners as $practitioner)                            
                        <option value="{{$practitioner->id}}" {{$practitioner->id == $outreferral->practitionern_id ? 'selected' : ''}}> {{$practitioner->name}} 
                        </option>
                            @endforeach
                    </select>
                         
                    </div>
                      
                </div>
                
                </div>               
             

                <div class="form-group form-md-line-input col-md-12">
                    

                   <div class="form-group form-md-line-input col-md-4">
                    
                        <label class="control-label" >Entry Date</label>
                        <input type="date" name="entry_date" class="form-control daily" placeholder="DD/MM/YYYY e.g 01/01/2020" value="{{$outreferral->entry_date}}">
                            <div class="form-control-focus"> </div>
                      
                    </div> 
                
                <div class="form-group form-md-line-input col-md-4">
                    
                        <label class="control-label" >Reason</label>
                        <input type="text" name="reason" class="form-control" value="{{$outreferral->reason}}" >
                            <div class="form-control-focus"> </div>
                      
                </div>

                    
                 </div>

          
                
                 
                </div>

                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-2">
                        <button class="btn btn-white" type="reset">Cancel</button>
                        <button class="btn btn-primary" type="submit">Save changes</button>
                        <a href="{{Route('outreferrals.index')}}"><button class="btn btn-danger" type="button">Back</button></a>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

</div>


                              
@endsection