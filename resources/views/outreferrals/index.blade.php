@extends('layouts.inspinia')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
<div class="col-lg-10">
    <h2 style="color:#1AB394;"><strong>Outreferral Management</strong></h2>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('/home')}}">Home</a>
            <i class="fa fa-play-circle" style="color:#1AB394;"></i>
        </li>
        <li>
            <a>Settings</a>
        </li>
        <li class="active">
            <strong>Outreferral</strong>
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
             <a href="{{Route('outreferrals.create')}}" class="btn btn-primary btn-xs active">Add Outreferral <i class="fa fa-plus"></i></a>
            
             <a href="{{Route('home')}}" class="btn btn-danger btn-xs active">Home <i class="fa fa-level-up"></i></a> 
            
        </div>
    </div>
    <div class="ibox-content">

        <div class="table-responsive">
    <table class="table table-striped table-bordered table-hover outreferrals" >
    <thead>
    <tr class="font-bold text-navy">
        <th>FULL NAME</th>
        <th>FACILITY</th>        
        <th>PRACTITIONER</th>
        <th>ENTRY DATE</th> 
        <th>REASON</th> 
        <th width="12%">ACTIONS</th>
    </thead>
    <tbody>

          @foreach($outreferrals as $outreferral)
                                                    <tr class="gradeX">
                                                    <td>{{$outreferral->firstname}} {{$outreferral->middlename}} {{$outreferral->lastname}}</td>
                                                    
                                                    <td>{{$outreferral->facility_name}}</td> 
                                                    <td>{{$outreferral->pfirstname}} {{$outreferral->pmiddlename}} {{$outreferral->plastname}}</td>
                                                    <td>{{$outreferral->entry_date}}</td>
                                                    <td>{{$outreferral->reason}}</td>

                                                    <td width="8%">
   <a href="#" target="blank"><button class="btn btn-xs btn-success active"><i class="fa fa-eye" aria-hidden="true" title="View Out Referral"></i></button></a>                                                
    <a href="{{route('outreferrals.edit',$outreferral->id)}}"><button class="btn btn-primary  btn-xs active"><i class="fa fa-pencil" aria-hidden="true" title="Edit outreferral"></i></button></a>

    

    {!! Form::open(['method' => 'DELETE','route' => ['outreferrals.destroy', $outreferral->id],'style'=>'display:inline', 'onsubmit' => 'return ConfirmDelete()']) !!}
    <!-- {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs active']) !!} -->
     <button type="submit" class="btn btn-primary  btn-xs btn-danger"><i class="fa fa-trash" aria-hidden="true" title="Delete Out Referral"></i></button> 
    {!! Form::close() !!}


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

                              
@endsection

@section('scripts')

<script src="{{asset('inspinia/js/plugins/dataTables/datatables.min.js')}}"></script>
<script>
$(document).ready(function(){
    $('.outreferrals').DataTable({
        pageLength: 10,
        responsive: true,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
            { extend: 'copy'},
            {extend: 'csv'},
            {extend: 'excel', title: 'Exampleoutreferral'},
            {extend: 'pdf', title: 'Exampleoutreferral'},

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