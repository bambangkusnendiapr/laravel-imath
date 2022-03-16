<?php

namespace App\Http\Controllers\Admin\Latihan;

use App\Http\Controllers\Controller;
use App\Models\Latihan;
use App\Models\Materi;
use App\Models\SoalLatihan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
class LatihanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.latihan.latihan',[
            'latihans' => Latihan::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $u = Latihan::pluck('materi_id');
        return view('admin.latihan.create',[
            'materis' => Materi::whereNotIn('id',$u)->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

       $request->validate([
           'materi_id'=>'required',
           'tgl_aktif'=>'required',
           'status'=>'required',
       ],[
            'materi_id.*'=>'Materi Harus di Isi',
            'tgl_aktif.*'=>'Tanggal Aktif Harus di Isi',
            'status.*'=>'Status Harus di Isi',  
       ]);

       DB::beginTransaction();
       try{

            $latihan_id = Latihan::create([
                'materi_id'=>$request->materi_id,
                'tgl_aktif'=>$request->tgl_aktif,
                'status'=>$request->status,
            ]);
        
        $uye = $request->soal;
        foreach ($uye as $key => $value){

                $soal[] = [
                    "latihan_id"=> $latihan_id->id,
                    "soal" => $request->soal[$key],
                    "bobot" => $request->bobot[$key],
                    "created_at" =>Carbon::now(),
                ];
        }
        SoalLatihan::insert($soal);

        DB::commit();
        return Redirect::route('latihan.index')->with('success','Latihan Baru Berhasil di Tambahkan');
       }catch(Exception $e){
        DB::rollBack();
        return Redirect::back()->with('error' , $e->getMessage());
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Latihan  $latihan
     * @return \Illuminate\Http\Response
     */
    public function show(Latihan $latihan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Latihan  $latihan
     * @return \Illuminate\Http\Response
     */
    public function edit(Latihan $latihan)
    {
        //
        return view('admin.latihan.edit',[
            'materis' => Materi::all(),
            'latihan'=> $latihan,
            'soals'=> SoalLatihan::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Latihan  $latihan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Latihan $latihan)
    {
        //

       DB::beginTransaction();
       try{
        
        $uye = $request->id;
        foreach ($uye as $key => $value){

            SoalLatihan::where('id', $request->id[$key])
            ->update([
                "soal" => $request->soal[$key],
                "bobot" => $request->bobot[$key],
                "created_at" =>Carbon::now(),
            ]);
        }

        


        DB::commit();
        return Redirect::route('latihan.index')->with('success','Latihan Berhasil di Update');
       }catch(Exception $e){
        DB::rollBack();
        return Redirect::back()->with('error' , $e->getMessage());
       }
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Latihan  $latihan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Latihan $latihan)
    {
        //
        DB::beginTransaction();
        try{
            Latihan::where('id', $latihan->id)->delete();
            DB::commit();
            return Redirect::route('latihan.index')->with('success','Latihan Berhasil di Hapus');
        }catch(Exception $e){
            DB::rollBack();
            return Redirect::back()->with('error' , $e->getMessage());
        }
    }
}
