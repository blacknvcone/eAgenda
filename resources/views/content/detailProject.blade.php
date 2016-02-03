@extends('master.app')

@section('content')
        <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Project Description
            <small>Detail ringkasan project</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li><a href="#">Project</a></li>
            <li class="active">Project Detail</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        @if(Session::has('flash_message'))
            <div class="alert alert-success">
                {{ Session::get('flash_message') }}
            </div>
        @endif

        <div class="row">
            <div class="col-md-4">
             <!-- Default Detail Box -->
             <div class="box box-primary">
                 <div class="box-header with-border">
                <h3 class="box-title">{{$project->name}}</h3>
                </div>
                <!-- /.box-header -->

                 <div class="box-body">
                <strong><i class="fa fa-book margin-r-5"></i>Description</strong>

                <p class="text-muted">
                   {{$project->desc}}
                </p>

                <hr>

                <strong><i class="fa fa-map-marker margin-r-5"></i> Klien</strong>

                <p class="text-muted">{{$project->klien}}</p>

                <hr>

                     <div class="row">
                         <div class="col-lg-6">
                        <strong><i class="fa fa-calendar-plus-o margin-r-5"></i> Target Selesai</strong>
                        <p>
                         <span class="label label-danger">{{date("d-m-Y",strtotime($project->tgl_target))}}</span>
                        </p>
                        </div>

                         <div class="col-lg-6">
                             <strong><i class="fa fa-pencil margin-r-5"></i> Status Project</strong>
                             <p>
                                 @if($project->status == "On Going")
                                     <span class="label label-success">{{$project->status}}</span>
                                 @endif

                                 @if($project->status == "Pending")
                                     <span class="label label-warning">{{$project->status}}</span>
                                 @endif

                                 @if( $project->status == "Finished")
                                     <span class="label label-info">{{$project->status}}</span>
                                 @endif
                             </p>
                         </div>

                     </div>

                <hr>

                <strong><i class="fa fa-file-text-o margin-r-5"></i> Executor</strong>

                <p>{{$fillname->implode(', ')}}</p>
            </div>
             </div>
            </div>


            <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>{{count($log)}}</h3>

                        <p>Total Task</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->

            <!-- ./col -->
            <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{$res = (count($log)!= 0)?round((count($log->where('status','Done'))/count($log))*100,0):0}}<sup style="font-size: 20px">%</sup></h3>

                        <p>Overall Progress</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->

            <div class="col-md-8">
                <div class="box box-info">
                    <form role="form" method="post" action="{{URL::to('project/detail/task/update')}}">
                        {!! csrf_field() !!}
                        <input name="project_id" value="{{$project->id}}" type="hidden" class="form-control">
                    <div class="box-header with-border">
                        <h3 class="box-title">Project Task List</h3>

                        <div class="box-tools">
                            <div class="input-group-sm" style="width: 180px;">
                                <div class="input-group-btn input-group-sm">
                                    <button name="btn_sta" type="submit" class="btn btn-danger" value="1"><i class="fa fa-trash"></i></button>
                                </div>

                                <div class="input-group-btn input-group-sm">
                                    <button name="btn_sta" type="submit" class="btn btn-success" value="2"><i class="fa fa-check-square-o"></i> Done</button>
                                </div>

                                <div class="input-group-btn input-group-sm">
                                    <button name="btn_sta" type="submit" class="btn btn-warning" value="3"><i class="fa fa-close"></i> Undone</button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="box-body">

                        <!-- Table Data-->
                        <!-- /.box-header -->
                        <div class="box-body no-padding">
                            <table class="table table-striped">

                                <tr>
                                    <th style="width: 10px">Pilih</th>
                                    <th >Task</th>
                                    <th style="width: 30px">Status</th>
                                </tr>

                               <div class="hidden"> {{$no = 1}}</div>
                                @foreach($log as $key=>$lg)
                                <tr>
                                    <td>
                                        <div align="center">
                                            <input type="checkbox" name="check[{{$key}}]" class="flat-red" value="{{$lg->id}}">
                                        </div>
                                    </td>
                                    <td>{{$lg->desc_task}}</td>

                                    @if($lg->status == 'Undone')
                                        <td><span class="badge bg-red">{{$lg->status}}</span></td>
                                    @else
                                        <td><span class="badge bg-green">{{$lg->status}}</span></td>
                                    @endif

                                </tr>
                                @endforeach

                            </table>
                        </div>
                    </div>
                    </form>
                    <div class="box-header with-border">
                        <h3 class="box-title"> <i class="fa fa-plus"></i> Add Task</h3>
                    </div>

                        <!-- box tools-->
                    <div class="box-body">
                        <form action="{{URL::to('project/detail/task/addtask')}}" method="post" role="form">
                           <div class="input-group input-group-sm">
                            {!! csrf_field() !!}
                            <input name="status" value="Undone" type="hidden" class="form-control">
                            <input name="project_id" value="{{$project->id}}" type="hidden" class="form-control">
                                 <input name="desc_task" type="text" class="form-control" placeholder="Input Task">
                                 <span class="input-group-btn">
                                    <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-plus"></i> </button>
                                </span>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection