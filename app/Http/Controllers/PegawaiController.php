<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use App\Models\PegawaiModel;
use App\Models\StrukturPegawaiModel;

class PegawaiController extends Controller
{	
    
    public function actionGetPegawai()
	{
        $pegawai  = PegawaiModel::select()
                    ->orderBy('nip')
                    ->get();
        
		return view('fe.listing-pegawai',['pegawai'=>$pegawai]);
    }
    
    public function actionGetForm(){

        $nip        = "RJP88".$this->getRunningNumber();
        $leader     = PegawaiModel::select()->whereStatus('Tetap')->orderBy('nama')->get();

        return view('fe.form-pegawai',['nip'=>$nip, 'leader'=>$leader]);
    }
    
    public function actionPostForm(Request $request){
    
        $established_date   = "1980-02-15";

        $validation = \Validator::make(
                    request()->all() , 
                    [	
                        'nama'                  => 'required',
                        'nip'                   => 'required',
                        'tempat'                => 'required',
                        'dob'                   => 'required|date|date_format:Y-m-d',
                        'join_date'             => 'required|date|date_format:Y-m-d|after:'.$established_date,
                        'status'                => 'required',
                        'nama_spv'              => 'required',
                    ]);

        if($validation->fails())
        {
            return redirect()->back()
                    ->withErrors($validation)
                    ->withInput();
        }

        $data   = new PegawaiModel;
        $data->nama             = $request->nama;
        $data->nip              = $request->nip;
        $data->running_number   = $this->getRunningNumber();
        $data->tempat           = $request->tempat;
        $data->dob              = $request->dob;
        $data->join_date        = $request->join_date;
        $data->status           = $request->status;
        $data->spv              = $request->nama_spv;
        $data->save();

        $datas  = new StrukturPegawaiModel;
        $datas->id_pegawai  = $data->id;
        $datas->id_spv      = $request->spv;
        $datas->save();
        
        return redirect()->back()->with('message', 'Data Anda Berhasil Disimpan !!');
    }

    public function actionEditPegawai($id){
        
        $pegawai    = PegawaiModel::find($id);
/* 
        $listIn         = StrukturPegawaiModel::select('id_pegawai')->whereIdSpv($id)->get();
        $encode_list    = json_encode($listIn);
        
        $decode_list    = json_decode($encode_list,true);
        dd($decode_list[]); */

        $leader     = PegawaiModel::select()->whereStatus('Tetap')->where('id','!=',$id)->orderBy('nama')->get();
        
        return view('fe.edit-pegawai',['pegawai'=>$pegawai, 'leader'=>$leader]);
        
    }
    
    public function actionPostEditPegawai(Request $request){
        
        //dd($request->all());

        $established_date   = "1980-02-15";

        $validation = \Validator::make(
            request()->all() , 
            [	
                'nama'                  => 'required',
                'nip'                   => 'required',
                'tempat'                => 'required',
                'dob'                   => 'required|date|date_format:Y-m-d',
                'join_date'             => 'required|date|date_format:Y-m-d|after:'.$established_date,
                'status'                => 'required',
                'nama_spv'              => 'required',
            ]);

        if($validation->fails())
        {
            return redirect()->back()
                    ->withErrors($validation)
                    ->withInput();
        }

        if($request->action == "Update"){
            $data   = PegawaiModel::find($request->id);
            $data->nama             = $request->nama;
            $data->tempat           = $request->tempat;
            $data->dob              = $request->dob;
            $data->join_date        = $request->join_date;
            $data->status           = $request->status;
            $data->spv              = $request->nama_spv;
            $data->save();

            $datas  = StrukturPegawaiModel::whereIdPegawai($request->id)->first();
            $datas->id_pegawai  = $data->id;
            $datas->id_spv      = $request->spv;
            $datas->save();

            return redirect()->back()->with('message', 'Data Anda Berhasil Diedit !!');
        }else{
            $data   = PegawaiModel::find($request->id);
            $data->nama             = $request->nama;
            $data->tempat           = $request->tempat;
            $data->dob              = $request->dob;
            $data->join_date        = $request->join_date;
            $data->status           = "Keluar";
            $data->save();
            
            $data_bawahan   = StrukturPegawaiModel::select('id_pegawai')->whereIdSpv($request->id)->get();
            $data_spv       = StrukturPegawaiModel::select('id_spv')->whereIdPegawai($request->id)->first();

            foreach($data_bawahan as $key => $val){
                $id_bawahan = $val->id_pegawai;

                $datas  = StrukturPegawaiModel::whereIdPegawai($id_bawahan)->first();
                $datas->id_spv      = $data_spv->id_spv;
                $datas->save();

                $dataSpv   = PegawaiModel::whereId($id_bawahan)->first();
                $dataSpv->spv       = $request->nama_spv;
                $dataSpv->save();
                
            }
            
            return redirect()->back()->with('message', 'Terminate Pegawai Berhasil !!');
        }

        
    }

    public function formatRunningNumber($number)
    {
        $lenght = strlen($number);
        
        if($lenght==1){
            $result = "000".$number;

        }elseif($lenght==2){
            $result = "00".$number;

        }elseif($lenght==3){
            $result = "0".$number;

        }else{
            $result = $number;

        }

        return $result;
    }
    
    public function getRunningNumber()
    {
        $getData = PegawaiModel::orderBy('id','desc')->first();
        if($getData){
            $Number = (int)$getData->running_number + 1;
        }else{
            $Number = 1;
        }

        $runningNumber = $this->formatRunningNumber($Number);

        return $runningNumber;
    }
	
}