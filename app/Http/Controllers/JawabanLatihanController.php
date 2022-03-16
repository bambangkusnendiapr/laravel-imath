<?php

namespace App\Http\Controllers;

use App\Models\Jawabanlatihan;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class JawabanLatihanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'user_id'=>'required',
            'latihan_id'=>'required',
            'soal_id'=>'required',
            'jawaban'=>'required',
            
        ],[
             'user_id.*'=>'User ID Harus di Isi',
             'latihan_id.*'=>'Latihan ID Aktif Harus di Isi',
             'soal_id.*'=>'Soal Harus di Isi',
             'jawaban.*'=>'Jawaban Harus di Isi',
        ]);
 
        DB::beginTransaction();
        try{
         
         $jawaban_soal = $request->jawaban;
            foreach ($jawaban_soal as $key => $value){

                 $soal[] = [
                    "latihan_id"=> $request->latihan_id[$key],
                    "user_id" => $request->user_id[$key],
                    "jawaban" => $request->jawaban[$key],
                    "soal_id" => $request->soal_id[$key],
                    // "jawaban_image" => $name_jawabannn,
                    "created_at" =>Carbon::now(),
                ];
        
        }
         

         Jawabanlatihan::insert($soal);
 
         DB::commit();
         return Redirect::route('summary.index')->with('success','Latihan Berhasil di Kerjakan');
        }catch(Exception $e){
         DB::rollBack();
         return Redirect::back()->with('error' , $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jawabanlatihan  $jawabanlatihan
     * @return \Illuminate\Http\Response
     */
    public function show(Jawabanlatihan $jawabanlatihan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jawabanlatihan  $jawabanlatihan
     * @return \Illuminate\Http\Response
     */
    public function edit(Jawabanlatihan $jawabanlatihan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jawabanlatihan  $jawabanlatihan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jawabanlatihan $jawabanlatihan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jawabanlatihan  $jawabanlatihan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jawabanlatihan $jawabanlatihan)
    {
        //
    }
}
