@extends('layouts.inspinia')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
<div class="col-lg-10">
    <h2 style="color:#1AB394;"><strong>Diagnosis</strong></h2>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('/home')}}">Home</a>
            <i class="fa fa-play-circle" style="color:#1AB394;"></i>
        </li>
        <li>
            <a>Settings</a>
        </li>
        <li class="active">
            <strong>Diagnosis</strong>
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
              <a href="{{Route('diagnoses.create')}}" class="btn btn-primary btn-xs active">Add Diagnosis <i class="fa fa-plus"></i></a>
            
             <a href="{{Route('home')}}" class="btn btn-danger btn-xs active">Home <i class="fa fa-level-up"></i></a> 
            
        </div>
    </div>
    <div class="ibox-content">

        <div class="table-responsive">
    <table class="table table-striped table-bordered table-hover diagnoses" >
    <thead>
    <tr class="font-bold text-navy">
        <th>NAME</th>
        <th>DIAGNOSIS CODE</th>
        <th>DESCRIPTION</th>
        <th>LAST UPDATED</th>
        <th width="12%">ACTIONS</th>
    </thead>
    <tbody>

          @foreach($diagnoses as $diagnosis)
                                                    <tr class="gradeX">
                                                    <td>{{$diagnosis->name}}</td>
                                                    <td>{{$diagnosis->dcode}}</td>
                                                    <td>{{$diagnosis->description}}</td>
                                                    <td>{{$diagnosis->updated_at}}</td> 

                                                    <td>
    <a href="{{route('diagnoses.edit',$diagnosis->id)}}"><button class="btn btn-primary  btn-xs active">Edit</button></a>

    

    {!! Form::open(['method' => 'DELETE','route' => ['diagnoses.destroy', $diagnosis->id],'style'=>'display:inline', 'onsubmit' => 'return ConfirmDelete()']) !!}
    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs active']) !!}
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
    $('.diagnoses').DataTable({
        pageLength: 10,
        responsive: true,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
            { extend: 'copy'},
            {extend: 'csv'},
            {extend: 'excel', title: 'ExampleFile'},
            {extend: 'pdf', title: 'ExampleFile'},

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