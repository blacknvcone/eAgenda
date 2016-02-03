@extends('master.app')

@section('content')
        <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            List Project
            <small>Daftar Project Masuk</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Project Management</a></li>
            <li class="active">List Project</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

            @if(Session::has('flash_message'))
            <div class="alert alert-success alert-dismissible">
                <h4><i class="icon fa fa-check"></i> Notifikasi :</h4>
                {{ Session::get('flash_message') }}
            </div>
            @endif


                    <!-- Modal for Edit button -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-    labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Edit Project</h4>
                        </div>

                        <form action="{{URL::to('project/dataupdate')}}" method="post">
                            {!! csrf_field() !!}
                            <input class="form-control project_id" type="hidden" name="id">
                            <div class="modal-body">


                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label>Nama Project :</label>
                                            <input name="name" type="text" class="form-control project_name" placeholder="Nama Project" >
                                        </div>
                                        <div class="col-lg-6">
                                            <label>Klien :</label>
                                            <input name="klien" type="text" class="form-control project_klien" placeholder="Klien">
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label>Tanggal Pesan :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"> <i class="fa fa-calendar"></i></span>
                                                <input name="tgl_pesan" id="datepicker" type="date" class="form-control project_tglpesan" placeholder="Tanggal Pesan">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <label>Target Selesai :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"> <i class="fa fa-calendar"></i></span>
                                                <input name="tgl_target" id="datepicker" type="date" class="form-control project_target" placeholder="Target Selesai">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Set Developer :</label>
                                                <select class="form-control select2" name="developer[]" multiple="multiple" data-placeholder="Pilih Developer" style="width: 100%;">
                                                    @foreach($users as $user)
                                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Deskripsi</label>
                                                <textarea name="desc" class="form-control project_desc" rows="2" placeholder="Input Deskripsi Project"></textarea>
                                            </div>
                                        </div>

                                    </div>



                                    </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
                    <!-- /.row -->
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">

                        <form action="{{URL::to('project/update')}}" method="POST" role="form">
                            {!! csrf_field() !!}
                            <div class="box-header">
                                <div class="col-lg-offset-0" >
                                    <button name="btn_sta" type="submit" class="btn btn-danger" value="1" ><i class="fa fa-trash"></i></button>
                                    <button name="btn_sta" type="submit" class="btn btn-warning" value="2" ><i class="fa fa-ban"></i>Pending</button>
                                    <button name="btn_sta" type="submit" class="btn btn-success" value="3" ><i class="fa fa-ban"></i>On Going</button>
                                    <button name="btn_sta" type="submit" class="btn btn-info" value="4" ><i class="fa fa-success"></i>Finished</button>
                                </div>
                            </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tr>
                                    <th>Pilih</th>
                                    <th width="20px">Edit Data</th>
                                    <th>Tanggal Pesan</th>
                                    <th>Target Selesai</th>
                                    <th>Nama Project</th>
                                    <th>Klien</th>
                                    <th>Status</th>
                                    <th>Executor</th>
                                    <th>Progress</th>

                                </tr>
                                @foreach ($projects as $key=>$project)
                                <tr>
                                    <td>
                                        <div class="form-group" align="center">
                                            <label>
                                                <input type="checkbox" name="check[{{$key}}]" class="flat-red" value="{{$project->id}}">
                                            </label>
                                        </div>
                                    </td>
                                    <td align="center"><button type="button" class="btn btn-primary btn-xs edit_button"
                                                 data-toggle="modal"
                                                 data-target="#myModal"
                                                 data-id="{{encrypt($project->id)}}"
                                                 data-name="{{$project->name}}"
                                                 data-klien="{{$project->klien}}"
                                                 data-tgl_target="{{$project->tgl_target}}"
                                                 data-desc="{{$project->desc}}"><i class="fa fa-pencil" ></i>
                                        </button></td>
                                    <td>{{date("d-m-Y",strtotime($project->tgl_pesan))}}</td>
                                    <td>{{date("d-m-Y",strtotime($project->tgl_target))}}</td>
                                    <td><a href="{{\URL::to('project/detail', encrypt($project->id))}}"> {{$project->name}}</a></td>
                                    <td>{{$project->klien}}</td>

                                    <td>
                                             @if($project->status == "On Going")
                                                 <span class="label label-success">{{$project->status}}</span>
                                             @endif

                                             @if($project->status == "Pending")
                                                 <span class="label label-warning">{{$project->status}}</span>
                                             @endif

                                             @if( $project->status == "Finished")
                                                 <span class="label label-info">{{$project->status}}</span>
                                             @endif
                                    </td>


                                    <td>{{$fillname[$key]->implode(', ')}}</td>

                                    <td align="center"><b>{{round($fillprogress[$key]->implode(''))}}%</b></td>

                                </tr>
                                @endforeach
                            </table>
                        </div>
                        </form>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
