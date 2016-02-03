@extends('master.app')

@section('content')
        <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            User Management
            <small>Panel manajemen user</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li><a href="#">Users</a></li>
            <li class="active">Users Management</li>
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
            <div class="row">
              <div class="col-md-4">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Form Input User</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                </div>

                    <form action="{{URL::to('users/create')}}" method="post">
                    {!! csrf_field() !!}
                    <div class="box-body">

                                <p><b>Username :</b></p>
                                <input name="email" type="text" class="form-control" placeholder="Username" >

                                <p><b>Password :</b></p>
                                <input name="password" type="password" class="form-control" placeholder="Password" >

                                <p><b>Nama Pegawai :</b></p>
                                <input name="name" type="text" class="form-control" placeholder="Nama Pegawai" >


                                <p><b>Jabatan :</b></p>
                                <input name="jabatan" type="text" class="form-control" placeholder="Jabatan">



                                <p><b>Set Hak Akses:</b></p>
                                <select class="form-control" name="hak_akses">
                                    <option value="1">CEO</option>
                                    <option value="2">Team Leader</option>
                                    <option value="3">Developer</option>
                                </select>


                        <div class="box-footer">
                            <button type="submit" class="btn btn-success pull-right">Submit</button>
                        </div>

                    </div>
                    <!-- /.box-body -->
                </form>
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->
        </div>

              <div class="col-md-8">
                  <form role="form" method="POST" action="{{URL::to('users/update')}}">
                      {!! csrf_field() !!}
                  <div class="box box-info">
                  <div class="box-header with-border">
                      <h3 class="box-title">Data Users</h3>

                      <div class="box-tools pull-left">
                          <div class="input-group-sm" style="width: 220px;">
                              <div class="input-group-btn input-group-sm">
                                  <button name="btn_sta" type="submit" class="btn btn-danger" value="1"><i class="fa fa-trash"></i></button>
                              </div>

                              <div class="input-group-btn input-group-sm">
                                  <button name="btn_sta" type="submit" class="btn btn-success" value="2"><i class="fa fa-street-view"></i>Team Leader</button>
                              </div>

                              <div class="input-group-btn input-group-sm">
                                  <button name="btn_sta" type="submit" class="btn btn-warning" value="3"><i class="fa fa-user"></i>Developer</button>
                              </div>
                          </div>
                      </div>
                  </div>



                  <div class="box-body">
                      <!-- /.box-header -->
                      <div class="box-body no-padding">
                          <table class="table">
                              <tr>
                                  <th >Pilihan</th>
                                  <th>Username</th>
                                  <th style="width: 200px">Nama Pegawai</th>
                                  <th style="width: 200px">Jabatan</th>
                                  <th >Hak Akses</th>
                              </tr>

                              @foreach($user as $key=>$usr)
                              <tr>
                                  <td> <div align="center">
                                          <input type="checkbox" name="check[{{$key}}]" class="flat-red" value="{{$usr->id}}">
                                      </div></td>
                                  <td>{{$usr->email}}</td>
                                  <td>{{$usr->name}}</td>
                                  <td>{{$usr->jabatan}}</td>
                                  <td>
                                          @if($usr->hak_akses == '1')
                                          CEO
                                          @endif

                                          @if($usr->hak_akses == '2')
                                          Team Leader
                                          @endif

                                          @if($usr->hak_akses == '3')
                                           Developer
                                          @endif
                                  </td>
                              </tr>
                              @endforeach

                          </table>
                      </div>
                      <!-- /.box-body -->
                  </div>
                  <!-- /.box -->

                </div>
                  </form>
              </div>
            </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection