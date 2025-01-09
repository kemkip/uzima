@extends('layouts.inspinia')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
<div class="col-lg-10">
    <h2 style="color:#1AB394;"><strong>Member Report Management</strong></h2>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('/home')}}">Home</a>
            <i class="fa fa-play-circle" style="color:#1AB394;"></i>
        </li>
        <li>
            <a>Settings</a>
        </li>
        <li class="active">
            <strong>Members</strong>
        </li>
    </ol>
</div>

</div>
<div class="wrapper wrapper-content animated fadeInRight">
<div class="row">
<div class="col-lg-12">
<div class="ibox float-e-margins">
   <div class="ibox-title">
        <h5></h5>
        <div class="ibox-tools">
              <a href="{{Route('home')}}" class="btn btn-danger btn-xs active">Home <i class="fa fa-level-up"></i></a>             
        </div>
    </div>
<div class="portlet box green">
<div class="portlet-title">
    <div class="caption">
        <h3 style="color:#1AB394;"><strong>Apply Search Filters</strong></h3>
</div>
<div class="portlet-body">

   {!! Form::open(array('url' => 'member-report','method'=>'POST')) !!} 

     <div class="row form-body">


       <div class="row">
        <div class="col-md-12">
            <div class="form-group form-md-line-input col-md-3">
                   <select  name="prayercell" class="form-control fstdropdown-select" id="form_control_1">
                        <option value="">Select Prayercell ..</option>

                        @foreach($prayercells as $prayercell)
                        <option value="{{$prayercell->id}}">{{$prayercell->prayercell_name}}</option>
                        @endforeach
                    </select>
                <div class="form-control-focus"> </div>
            </div>
           
            <div class="form-group form-md-line-input col-md-3">
                   <select  name="maritalstatus" class="form-control fstdropdown-select" id="form_control_1">
                        <option value="">Select Member Status..</option>

                        @foreach($maritalstatuses as $maritalstatus)
                        <option value="{{$maritalstatus->id}}">{{$maritalstatus->name}}</option>
                        @endforeach
                    </select>
                <div class="form-control-focus"> </div>
            </div>

            <div class="form-group form-md-line-input col-md-3">
                   <select  name="department" class="form-control fstdropdown-select" id="form_control_1">
                        <option value="">Select Department..</option>

                        @foreach($departments as $department)
                        <option value="{{$department->id}}">{{$department->name}}</option>
                        @endforeach
                    </select>
                <div class="form-control-focus"> </div>
            </div>

           

            <div class="form-group form-md-line-input col-md-3">

            
                <input type="text" name="membernumber" id="membernumber" class="form-control" placeholder="Enter Membership Number" autocomplete="off" />
            
          </div> 

            <div class="col-md-6">
                <div class="form-group form-md-line-input">
                    <div class="input-group date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="date" name="date_from" id="date_from" class="form-control daily" placeholder="Enter Start Date" autocomplete="off" />
                </div>
                </div>
            </div>

          <div class="col-md-6">
            <div class="form-group form-md-line-input">
                <div class="input-group date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="date" name="date_to" id="date_to" class="form-control daily" placeholder="Enter End Date" autocomplete="off" />
            </div>
            </div>
          </div>
        
            </div>
            
        </div>
   
  
    </div>

     <div class="form-actions">
            <button type="submit" class="btn btn-primary btn-xm active">Filter</button>
            <button type="reset" class="btn btn-danger btn-xm active">Cancel</button>
        </div>


        
</div>

        {!! Form::close() !!}  

    </div> 
    <div class="ibox-content">

        <div class="table-responsive">
    <table class="table table-striped table-bordered table-hover members" >
    <thead>
    <tr class="font-bold text-navy">
        <th>IMAGE</th>  
        <th>FULL NAME</th>
        <th>NUMBER</th> 
        <th>DEPARTMENT</th> 
        <th>PRAYERCELL</th>       
        <th>GENDER</th>
        <th>PHONE</th> 
        <th>COUNTRY</th> 
        <th width="6%">ACTIONS</th>
    </thead>
</tr>
    <tbody>

          @foreach($members as $member)
                                                    <tr class="gradeX">
                                                    <td><img src="../{{$member->photo }}" width="40px" height="25px"/></td>
                                                    <td>{{$member->firstname}} {{$member->middlename}} {{$member->lastname}}</td>
                                                    <td>{{$member->membership_number}}</td>
                                                    <td>{{$member->department_name}}</td>
                                                    <td>{{$member->prayercell_name}}</td>
                                                    <td>{{$member->sex}}</td> 
                                                    <td>{{$member->phone_number}}</td>
                                                    <td>{{$member->country_name}}</td>    

                                                    <td width="6%">
   <a href="#" target="blank"><button class="btn btn-xs btn-success active"><i class="fa fa-eye" aria-hidden="true" title="View Member"></i></button></a>                                                
    <a href="{{route('members.edit',$member->id)}}"><button class="btn btn-primary  btn-xs active"><i class="fa fa-pencil" aria-hidden="true" title="Edit Member"></i></button></a>

    
<!-- 
    {!! Form::open(['method' => 'DELETE','route' => ['members.destroy', $member->id],'style'=>'display:inline', 'onsubmit' => 'return ConfirmDelete()']) !!}
   
     <button type="submit" class="btn btn-primary  btn-xs btn-danger"><i class="fa fa-trash" aria-hidden="true" title="Delete Member"></i></button> 
    {!! Form::close() !!} -->


                                                    </td>                                                 
                                                    </tr>
                                                @endforeach


   
      
 
    </tbody>
  
    </table>
        </div>

    </div>
</div>
</div>
</div>
</div>
</div>

                              
@endsection

@section('scripts')

<script src="{{asset('inspinia/js/plugins/dataTables/datatables.min.js')}}"></script>
<script>
$(document).ready(function(){
    $('.members').DataTable({
        pageLength: 10,
        responsive: true,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
            { extend: 'copy'},
            {extend: 'csv'},
            {extend: 'excel', title: 'Examplemember'},
            {extend: 'pdf', title: 'Examplemember'},

            {extend: 'print',
             customize: function (win){
                    $(win.document.body).addClass('white-bg');
                    $(win.document.body).css('font-size', '10px');

                    $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
            }
            }
        ]

    });

});

</script>

@endsection