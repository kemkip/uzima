@extends('layouts.inspinia')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
<div class="col-lg-10">
    <h2 style="color:#1AB394;"><strong>Inreferral Management</strong></h2>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('/home')}}">Home</a>
            <i class="fa fa-play-circle" style="color:#1AB394;"></i>
        </li>
        <li>
            <a>Settings</a>
        </li>
        <li class="active">
            <strong>Inreferral</strong>
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
             <a href="{{Route('inreferrals.create')}}" class="btn btn-primary btn-xs active">Add Inreferral <i class="fa fa-plus"></i></a>
            
             <a href="{{Route('home')}}" class="btn btn-danger btn-xs active">Home <i class="fa fa-level-up"></i></a> 
            
        </div>
    </div>
    <div class="ibox-content">

        <div class="table-responsive">
    <table class="table table-striped table-bordered table-hover inreferrals" >
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

          @foreach($inreferrals as $inreferral)
                                                    <tr class="gradeX">
                                                    <td>{{$inreferral->firstname}} {{$inreferral->middlename}} {{$inreferral->lastname}}</td>
                                                    <td>{{$inreferral->facility_name}}</td> 
                                                    <td>{{$inreferral->pfirstname}} {{$inreferral->pmiddlename}} {{$inreferral->plastname}}</td>
                                                    
                                                    <td>{{$inreferral->entry_date}}</td>
                                                    <td>{{$inreferral->reason}}</td>

                                                    <td width="8%">
   <a href="#" target="blank"><button class="btn btn-xs btn-success active"><i class="fa fa-eye" aria-hidden="true" title="View Out Referral"></i></button></a>                                                
    <a href="{{route('inreferrals.edit',$inreferral->id)}}"><button class="btn btn-primary  btn-xs active"><i class="fa fa-pencil" aria-hidden="true" title="Edit inreferral"></i></button></a>

    

    {!! Form::open(['method' => 'DELETE','route' => ['inreferrals.destroy', $inreferral->id],'style'=>'display:inline', 'onsubmit' => 'return ConfirmDelete()']) !!}
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
    $('.inreferrals').DataTable({
        pageLength: 10,
        responsive: true,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
            { extend: 'copy'},
            {extend: 'csv'},
            {extend: 'excel', title: 'Exampleinreferral'},
            {extend: 'pdf', title: 'Exampleinreferral'},

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