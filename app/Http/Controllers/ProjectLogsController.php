<?php

namespace App\Http\Controllers;

use App\Project;
//use Illuminate\Http\Request;

use App\projectLogs;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use Request;
use Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class ProjectLogsController extends Controller
{
    public function __construct(){
        $this->middleware('leader',['only' =>['addTask','update']]);
    }

    public function index($id)
    {
        $id = decrypt($id);

        $project = Project::findOrNew($id);
        $logs = $project->log;
        if(is_null($logs)){
            $logs = Project::findOrNew($id);
            return view('content.detailProject',['project'=>$project,'log'=>$logs]);
        }


            $gp_nama = json_decode($project->developer);

            for ($i = 0; $i < count($gp_nama); $i++) {
                $nama[$i]= DB::table('users')->where('id',$gp_nama[$i])->value('name');
            }

            $res_nama = collect($nama);



        return view('content.detailProject',['project'=>$project,'log'=>$logs,'fillname'=>$res_nama]);
    }

    public function addTask(){
        $req = Request::all();
        projectLogs::create($req);
        Session::flash('flash_message', 'Berhasil Menambahkan Task !');
        return redirect(\URL::to('project/detail',encrypt($req['project_id'])));
    }

    public function update(){
        $btn_sta = Input::get('btn_sta');
        $inputs = Input::get('check');
        $idRed = Input::get('project_id');

        switch ($btn_sta[0]){
            case 1:
                foreach($inputs as $key=>$id){
                    DB::table('project_logs')->where('id', $id)->delete();
                }
                Session::flash('flash_message', "Sukses Menghapus Data !!");
                break;
            case 2:
                foreach($inputs as $key=>$id){
                    DB::table('project_logs')->where('id', $id)->update(['status' => "Done"]);
                }
                Session::flash('flash_message', "Sukses Memperbaharui Status !!");
                break;
            case 3:
                foreach($inputs as $key=>$id){
                    DB::table('project_logs')->where('id', $id)->update(['status' => "Undone"]);
                }
                Session::flash('flash_message', "Sukses Memperbaharui Status !!");
                break;
            default:
                break;
        }
        return redirect(\URL::to('project/detail',encrypt($idRed)));
    }

}
