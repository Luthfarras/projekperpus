<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pinjam;
use JWTAuth;
use DB;
use Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;

class PinjamController extends Controller
{
  public function index(){
    if(Auth::user()->level=="admin"){
      $dt_pj=Pinjam::get();
      return response()->json($dt_pj);
    } else{
      return response()->json(['status'=>'anda bukan admin']);
    }
  }

    public function store(Request $request){
      $validator=Validator::make($request->all(),
        [
          'tgl_pinjam'=>'required',
          'id_anggota'=>'required',
          'id_petugas'=>'required',
          'deadline'=>'required'
        ]
      );

      if($validator->fails()){
        return Response()->json($validator->errors());
      }

      $simpan=Pinjam::create([
        'tgl_pinjam'=>$request->tgl_pinjam,
        'id_anggota'=>$request->id_anggota,
        'id_petugas'=>$request->id_petugas,
        'deadline'=>$request->deadline
      ]);

      $status=1;
      $message="Peminjaman Berhasil Ditambah";
      if($simpan){
        return Response()->json(compact('status','message'));
      }else {
        return Response()->json(['status'=>0]);
      }
    }

    public function update($id,Request $request){
      $validator=Validator::make($request->all(),
        [
          'tgl_pinjam'=>'required',
          'id_anggota'=>'required',
          'id_petugas'=>'required',
          'deadline'=>'required'
        ]
    );

    if($validator->fails()){
      return Response()->json($validator->errors());
    }

    $ubah=Pinjam::where('id',$id)->update([
      'tgl_pinjam'=>$request->tgl_pinjam,
      'id_anggota'=>$request->id_anggota,
      'id_petugas'=>$request->id_petugas,
      'deadline'=>$request->deadline
    ]);

    $status=1;
    $message="Data Berhasil Diubah";
    if($ubah){
      return Response()->json(compact('status','message'));
    }else {
      return Response()->json(['status'=>0]);
    }
  }

  public function tampil(){
    $data=DB::table('peminjaman')
    ->join('anggota','anggota.id','=','peminjaman.id_anggota')
    ->join('petugas','petugas.id','=','peminjaman.id_petugas')
    ->select('peminjaman.id','anggota.nama_anggota','anggota.alamat','anggota.telp','petugas.nama_petugas','peminjaman.tgl_pinjam','peminjaman.deadline')
    ->get();
    $count=$data->count();
    $status=1;
    $message="Peminjaman Berhasil ditampilkan";
    return response()->json(compact('data','status','message','count'));
  }

  public function destroy($id){
    $hapus=Pinjam::where('id',$id)->delete();
    $status=1;
    $message="Data Berhasil Dihapus";
    if($hapus){
      return Response()->json(compact('status','message'));
    }else {
      return Response()->json(['status'=>0]);
    }
  }
}
