<?php

namespace App\Http\Controllers;

use App\Models\JawabanLatihan;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Models\SoalLatihan;
use App\Models\Jawaban;
use Illuminate\Support\Facades\Auth;

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
        DB::beginTransaction();

        try{

            for($i = 0; $i < count($request->soal_id); $i++) {
                JawabanLatihan::create([
                    'user_id' => Auth::user()->id,
                    'soal_latihan_id' => $request->soal_id[$i],
                    'jawaban' => $request->jawaban[$i],
                ]);
            }

            $jawaban = Jawaban::where('materi_id', $request->materi_id)->where('user_id', Auth::user()->id)->first();
            if($jawaban) {
                $jawaban->tgl_jawab_latihan = Carbon::now()->format('Y-m-d');
                $jawaban->save();
            } else {
                Jawaban::create([
                    'materi_id' => $request->materi_id,
                    'user_id' => Auth::user()->id,
                    'tgl_jawab_latihan' => Carbon::now()->format('Y-m-d'),
                ]);
            }
 
         DB::commit();
         return Redirect::route('lembar.kerja', $request->materi_id)->with('success','Jawaban Latihan Telah Disimpan');
        //  return Redirect::route('materi-ongoing.show', $request->materi_id)->with('success','Jawaban Pengetahuan Telah Disimpan');
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
