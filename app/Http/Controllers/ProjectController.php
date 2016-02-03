<?php

namespace App\Http\Controllers;

use App\Project;
//use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Request;
use Session;
use Illuminate\Support\Facades\Input;
use DB;

class ProjectController extends Controller
{

    public function __construct()
    {
        $this->middleware('leader', ['except' => ['showall', 'detail']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('content.addProject', ['users' => $users]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $input = Request::all();
        $input['tgl_pesan'] = date('Y-m-d', strtotime(str_replace('-', '/', $input['tgl_pesan'])));
        $input['tgl_target'] = date('Y-m-d', strtotime(str_replace('-', '/', $input['tgl_target'])));
        $input['developer'] = json_encode($input['developer']);
        Project::create($input);
        Session::flash('flash_message', 'Berhasil Menambahkan Project !');
        return redirect('project/addproject');
    }

    /**
     * Display all resource based on active project.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function showall()
    {

        $alluser = User::all();
        $logdata = Auth::user();

        if($logdata->hak_akses == 1){
           //full access ke data
            $projects = Project::all();

            //add nama dari tabel user
            foreach($projects as $key=>$pro) {
                $gp_nama = json_decode($pro->developer);

                for ($i = 0; $i < count($gp_nama); $i++) {
                    $nama[$i]= DB::table('users')->where('id',$gp_nama[$i])->value('name');
                }
                $res_nama[$key] = collect($nama);

                //////////////////////////////////////////////////////////////////////////////////////////
                //get progress
                $log_all  = DB::table('project_logs')->where('project_id',$pro->id)->get();
                $log_done = DB::table('project_logs')->where('project_id',$pro->id)->Where('status','Done')->get();

                //$res = (count($log)!= 0)?round((count($log->where('status','Done'))/count($log))*100,0):0
                $prog =(count($log_all)!=0)?count($log_done)/count($log_all)*100:0;

                ///////////////////////////////////////////////////////////////////////////////////////////
                $res_prog[$key] = collect($prog);

            }
            $fin_nama = collect($res_nama);
            $fin_progress = collect($res_prog);
        }else {
           //filter access ke data
            $containId = '%'.$logdata->id.'%';
            $projects = DB::table('projects')->where('developer','like',$containId)->get();

            //add nama dari tabel user
            foreach($projects as $key=>$pro) {
                $gp_nama = json_decode($pro->developer);

                for ($i = 0; $i < count($gp_nama); $i++) {
                    $nama[$i]= DB::table('users')->where('id',$gp_nama[$i])->value('name');
                }
                $res_nama[$key] = collect($nama);

                //////////////////////////////////////////////////////////////////////////////////////////
                //get progress
                $log_all  = DB::table('project_logs')->where('project_id',$pro->id)->get();
                $log_done = DB::table('project_logs')->where('project_id',$pro->id)->Where('status','Done')->get();

                //$res = (count($log)!= 0)?round((count($log->where('status','Done'))/count($log))*100,0):0
                $prog =(count($log_all)!=0)?count($log_done)/count($log_all)*100:0;

                ///////////////////////////////////////////////////////////////////////////////////////////
                $res_prog[$key] = collect($prog);
            }

            $fin_nama = collect($res_nama);
            $fin_progress = collect($res_prog);
        }

        return view('content.Project',['projects'=>$projects,'fillname'=>$fin_nama,'fillprogress'=>$fin_progress,'users'=>$alluser]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        $btnStatus = Input::get('btn_sta');
        $inputs = Input::get('check');

        switch ($btnStatus[0]) {
            case 1:
                foreach($inputs as $key=>$id){
                    DB::table('projects')->where('id', $id)->delete();
                }
                Session::flash('flash_message', "Sukses Menghapus Data !!");
                break;
            case 2:
                foreach($inputs as $key=>$id){
                    DB::table('projects')->where('id', $id)->update(['status' => "Pending"]);
                }
                Session::flash('flash_message', "Sukses Memperbaharui Status !!");
                break;
            case 3:
                foreach($inputs as $key=>$id){
                    DB::table('projects')->where('id', $id)->update(['status' => "On Going"]);
                }
                Session::flash('flash_message', "Sukses Memperbaharui Status !!");
                break;
            case 4:
                foreach($inputs as $key=>$id){
                    DB::table('projects')->where('id', $id)->update(['status' => "Finished"]);
                }
                Session::flash('flash_message', "Sukses Memperbaharui Status !!");
                break;
            default:
                break;
        }
        return redirect('project');
    }

    public function dataUpdate(){
        $input = Request::all();
        $input['tgl_target'] = date('Y-m-d', strtotime(str_replace('-', '/', $input['tgl_target'])));
        $input['tgl_pesan'] = date('Y-m-d', strtotime(str_replace('-', '/', $input['tgl_target'])));
        $input['developer'] = json_encode($input['developer']);

        $pro = Project::findOrNew(decrypt($input['id']));
        $pro->name = $input['name'];
        $pro->klien = $input['klien'];
        $pro->tgl_pesan = $input['tgl_pesan'];
        $pro->tgl_target = $input['tgl_target'];
        $pro->developer = $input['developer'];
        $pro->desc = $input['desc'];
        $pro -> save();

        Session::flash('flash_message', 'Berhasil Mengedit Data Project '.$pro->name);

        return redirect('project');
    }


    public function detail($id){
        return view('content.detailProject');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
