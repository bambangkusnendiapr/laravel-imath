<?php

namespace App\Http\Controllers\Admin\Kuis;

use App\Http\Controllers\Controller;
use App\Models\Kuis;
use App\Models\Materi;
use App\Models\SoalKuis;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class KuisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.kuis.kuis',[
            'kuiss' => Kuis::all(),
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
        $u = Kuis::pluck('materi_id');
        return view('admin.kuis.create',[
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
        // dd($request);
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
 
             $kui_id = Kuis::create([
                 'materi_id'=>$request->materi_id,
                 'tgl_aktif'=>$request->tgl_aktif,
                 'status'=>$request->status,
             ]);
         
         $uye = $request->soal;
         foreach ($uye as $key => $value){
 
                 $soal[] = [
                     "kuis_id"=> $kui_id->id,
                     "soal" => $request->soal[$key],
                     "bobot" => $request->bobot[$key],
                     "created_at" =>Carbon::now(),
                 ];
         }
         SoalKuis::insert($soal);
 
         DB::commit();
         return Redirect::route('kuis.index')->with('success','Kuis Baru Berhasil di Tambahkan');
        }catch(Exception $e){
         DB::rollBack();
         return Redirect::back()->with('error' , $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kuis  $kui
     * @return \Illuminate\Http\Response
     */
    public function show(Kuis $kui)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kuis  $kui
     * @return \Illuminate\Http\Response
     */
    public function edit(Kuis $kui)
    {
        //
        return view('admin.kuis.edit',[
            'materis' => Materi::all(),
            'kuis'=> $kui,
            'soals'=> SoalKuis::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kuis  $kui
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kuis $kui)
    {
        //
        DB::beginTransaction();
       try{
        
        $uye = $request->id;
        foreach ($uye as $key => $value){

            SoalKuis::where('id', $request->id[$key])
            ->update([
                "soal" => $request->soal[$key],
                "bobot" => $request->bobot[$key],
                "created_at" =>Carbon::now(),
            ]);
        }

        


        DB::commit();
        return Redirect::route('kuis.index')->with('success','Kuis Berhasil di Update');
       }catch(Exception $e){
        DB::rollBack();
        return Redirect::back()->with('error' , $e->getMessage());
       }
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kuis  $kui
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kuis $kui)
    {
        //
        DB::beginTransaction();
        try{
            Kuis::where('id', $kui->id)->delete();
            DB::commit();
            return Redirect::route('kuis.index')->with('success','Kuis Berhasil di Hapus');
        }catch(Exception $e){
            DB::rollBack();
            return Redirect::back()->with('error' , $e->getMessage());
        }
    }
}
