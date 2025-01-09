@extends('layouts.inspinia')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
<div class="col-lg-10">
    <h2 style="color:#1AB394;"><strong>Patient Management</strong></h2>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('/home')}}">Home</a>
        </li>
        <li>
            <a>Patient</a>
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
            <h5>Edit Patient</h5>
            <div class="ibox-tools">
                <a href="{{Route('home')}}" class="btn btn-danger btn-xs active">Home <i class="fa fa-level-up"></i></a> 
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-wrench"></i>
                </a>
                <ul class="dropdown-menu dropdown-patient">
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
          
      
            
            {!! Form::model($patient, ['method' => 'PATCH', 'enctype'=>'multipart/form-data','route' => ['patients.update', $patient->id]]) !!}

         
                <div class="form-body row">  
                <div class="form-group form-md-line-input col-md-12">
                    <div class="form-group form-md-line-input col-md-3">
                    
                    <label class="control-label" >First Name</label>
                    <input type="text" name="first_name" class="form-control" value="{{$patient->first_name}}" required="">
                    <div class="form-control-focus"> </div>
                      
                </div>
                <div class="form-group form-md-line-input col-md-3">
                    
                    <label class="control-label" >Middle Name</label>
                    <input type="text" name="middle_name" class="form-control" value="{{$patient->middle_name}}">
                    <div class="form-control-focus"> </div>
                      
                </div>
                <div class="form-group form-md-line-input col-md-3">
                    
                    <label class="control-label" >Last Name</label>
                    <input type="text" name="last_name" class="form-control" value="{{$patient->last_name}}" required="">
                    <div class="form-control-focus"> </div>
                      
                </div>
                 <div class="form-group form-md-line-input col-md-3">
                    
                    <label class="control-label" >Patient Number</label>
                    <input type="text" name="patient_number" class="form-control" value="{{$patient->patient_number}}" readonly>
                    <div class="form-control-focus"> </div>
                      
                </div>
                </div>               
             

                <div class="form-group form-md-line-input col-md-12">
                    <div class="form-group form-md-line-input col-md-3"> 
                    <label class="control-label" >Select Diagnosis</label>
                    <select name="diagnosis_id"  class="form-control fstdropdown-select" >

                        @foreach($diagnoses as $diagnosis)                            
                        <option value="{{$diagnosis->id}}" {{$diagnosis->id == $patient->diagnosis_id ? 'selected' : ''}}> {{$diagnosis->name}} 
                        </option>
                            @endforeach
                    </select>
                         
                    </div>

                    <div class="form-group form-md-line-input col-md-3">                                
                           
                    <label class="control-label" >Select Patient Category</label>
                    <select name="patientcategory_id"  class="form-control fstdropdown-select" >

                        @foreach($patientcategories as $patientcategory)                            
                        <option value="{{$patientcategory->id}}" {{$patientcategory->id == $patient->patientcategory_id ? 'selected' : ''}}> {{$patientcategory->name}} </option>
                            @endforeach
                    </select>
                         
                    </div>
                    <div class="form-group form-md-line-input col-md-3">
                                    
                               
                        <label class="control-label" >Select Country</label>
                        <select name="country_id"  class="form-control fstdropdown-select" >

                            @foreach($countries as $country)                            
                            <option value="{{$country->id}}" {{$country->id == $patient->country_id ? 'selected' : ''}}> {{$country->name}} </option>
                                @endforeach
                        </select>
                             
                    </div>
                 </div>

                 <div class="form-group form-md-line-input col-md-12">               

                 <div class="form-group form-md-line-input col-md-3">
                    
                        <label class="control-label" >Gender</label>
                       
                        <select name="sex" class="form-control fstdropdown-select form-md-line-input"  value="{{$patient->sex}}">
                           
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                            <div class="form-control-focus"> </div>
                      
                    </div> 

                <div class="form-group form-md-line-input col-md-3">
                    
                        <label class="control-label" >Birth Date</label>
                        <input type="date" name="birth_date" class="form-control daily" placeholder="DD/MM/YYYY e.g 01/01/2020" value="{{$patient->birth_date}}">
                            <div class="form-control-focus"> </div>
                      
                    </div> 


                <div class="form-group form-md-line-input col-md-3">
                    
                        <label class="control-label" >Email Address</label>
                        <input type="text" name="email" class="form-control" value="{{$patient->email}}" >
                            <div class="form-control-focus"> </div>
                      
                </div>
                
                <div class="form-group form-md-line-input col-md-3">
                    
                        <label class="control-label" >Phone Number</label>
                        <input type="text" name="phone_number" class="form-control" value="{{$patient->phone_number}}" >
                            <div class="form-control-focus"> </div>
                      
                </div>
            </div>
             <div class="form-group form-md-line-input col-md-12">

                 <div class="form-group form-md-line-input col-md-3">
                    
                        <label class="control-label" >Age</label>
                        <input type="text" name="age" class="form-control" value="{{$patient->age}}" >
                            <div class="form-control-focus"> </div>
                      
                </div>
                 <div class="form-group form-md-line-input col-md-3">
                    
                        <label class="control-label" >Entry Date</label>
                        <input type="date" name="entry_date" class="form-control daily" placeholder="DD/MM/YYYY e.g 01/01/2020" value="{{$patient->entry_date}}">
                            <div class="form-control-focus"> </div>
                      
                    </div> 
                 <div class="form-group form-md-line-input col-md-3">
                    
                        <label class="control-label" >Description</label>
                        <input type="text" name="description" class="form-control" value="{{$patient->description}}" >
                            <div class="form-control-focus"> </div>
                      
                </div>

                </div>
            


                
                 
                </div>

                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-2">
                        <button class="btn btn-white" type="reset">Cancel</button>
                        <button class="btn btn-primary" type="submit">Save changes</button>
                        <a href="{{Route('patients.index')}}"><button class="btn btn-danger" type="button">Back</button></a>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

</div>


                              
@endsection