@extends('master.app')

@section('content')
        <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add Project
            <small>Tambahkan Project Baru</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Project Management</a></li>
            <li class="active">Add Project</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

            @if(Session::has('flash_message'))
            <div class="alert alert-success">
                {{ Session::get('flash_message') }}
            </div>
            @endif

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Form Input Data</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>

            <form action="{{URL::to('project/create')}}" method="post">
                {!! csrf_field() !!}
            <div class="box-body">
                <div class="row">
                <div class="col-lg-4">
                    <label>Nama Project :</label>
                   <input name="name" type="text" class="form-control" placeholder="Nama Project" >
                </div>
                <div class="col-lg-4">
                    <label>Klien :</label>
                    <input name="klien" type="text" class="form-control" placeholder="Klien">
                </div>
                </div>


                <div class="row">
                    <div class="col-lg-4">
                        <label>Tanggal Pesan :</label>
                        <div class="input-group">
                            <span class="input-group-addon"> <i class="fa fa-calendar"></i></span>
                            <input name="tgl_pesan" id="datepicker" type="date" class="form-control" placeholder="Tanggal Pesan">
                        </div>
                    </div>


                    <div class="col-lg-4">
                        <label>Target Selesai :</label>
                        <div class="input-group">
                            <span class="input-group-addon"> <i class="fa fa-calendar"></i></span>
                        <input name="tgl_target" id="datepicker" type="date" class="form-control" placeholder="Target Selesai">
                        </div>
                    </div>


                </div>


                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Set Status</label>
                            <select class="form-control" name="status">
                                <option value="Pending">Pending</option>
                                <option value="On Going">On Going</option>
                            </select>
                        </div>
                    </div>
                        <div class="col-lg-4">
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
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="desc" class="form-control" rows="3" placeholder="Input Deskripsi Project"></textarea>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-success">Submit</button>

            </div>
            <!-- /.box-body -->
            </form>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection