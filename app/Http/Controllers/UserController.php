<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

use App\User;
use App\Http\Requests;
use Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class UserController extends Controller{

    public function index(){
        $data = User::all();
        return view('content.user',['user'=>$data]);
    }

    public function addUser(){
        $input = Request::all();
        $input['password'] = bcrypt($input['password']);
        User::create($input);
        Session::flash('flash_message', 'Berhasil Menambahkan User !');
        return redirect('users');
    }

    public function update()
    {
        $btnStatus = Input::get('btn_sta');
        $inputs = Input::get('check');

        switch ($btnStatus[0]) {
            case 1:
                foreach($inputs as $key=>$id){
                    DB::table('users')->where('id', $id)->delete();
                }
                Session::flash('flash_message', "Sukses Menghapus Data !!");
                break;
            case 2:
                foreach($inputs as $key=>$id){
                    DB::table('users')->where('id', $id)->update(['hak_akses' => "2"]);
                }
                Session::flash('flash_message', "Sukses Memperbaharui Status !!");
                break;
            case 3:
                foreach($inputs as $key=>$id){
                    DB::table('users')->where('id', $id)->update(['hak_akses' => "3"]);
                }
                Session::flash('flash_message', "Sukses Memperbaharui Status !!");
                break;
            default:
                break;
        }
        return redirect('users');
    }
}
