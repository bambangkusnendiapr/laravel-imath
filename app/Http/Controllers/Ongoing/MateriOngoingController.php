<?php

namespace App\Http\Controllers\Ongoing;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use App\Models\User;
use App\Models\Jawaban;
use App\Models\Latihan;
use App\Models\JawabanLatihan;
use App\Models\SoalLatihan;
use App\Models\JawabanPengetahuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MateriOngoingController extends Controller
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $materi = Materi::find($id);
        $rata2 = null;

        $idPengetahuan = [];
        foreach($materi->pengetahuans as $data) {
            $idPengetahuan[] = $data->id;
        }

        $jawabanPengetahuan = JawabanPengetahuan::whereIn('pengetahuan_id', $idPengetahuan)->where('user_id', Auth::user()->id)->where('nilai', '!=', null)->get();
        $jawabanPengetahuanCount = null;
        if($jawabanPengetahuan->count() > 0) {
            $jawabanPengetahuanCount = $jawabanPengetahuan->count();
            $jawabanPengetahuan = $jawabanPengetahuan->sum('nilai');
            $rata2 = $jawabanPengetahuan / $jawabanPengetahuanCount;
        } else {
            $jawabanPengetahuan = '-';
        }

        $latihan = Latihan::where('materi_id', $id)->first();
        $idSoalLatihan = [];
        foreach($latihan->soalLatihans as $data) {
            $idSoalLatihan[] = $data->id;
        }

        $jawabanLatihan = JawabanLatihan::whereIn('soal_latihan_id', $idSoalLatihan)->where('user_id', Auth::user()->id)->where('nilai', '!=', null)->get();
        $jawabanLatihanCount = null;
        if($jawabanLatihan->count() > 0) {
            $jawabanLatihanCount = $jawabanLatihan->count();
            $jawabanLatihan = $jawabanLatihan->sum('nilai');
            $rata2 = $jawabanLatihan / $jawabanLatihanCount;
        } else {
            $jawabanLatihan = '-';
        }

        if($jawabanPengetahuan != '-' && $jawabanLatihan != '-') {
            $rata2 = round(($jawabanPengetahuan + $jawabanLatihan) / ($jawabanPengetahuanCount + $jawabanLatihanCount), 2);
        }


        $jawaban = Jawaban::where('materi_id', $id)->where('user_id', Auth::user()->id)->where('tgl_jawab_latihan', '!=', null)->first();
        if($jawaban) {
            $jawaban = 'disabled';
        } else {
            $jawaban = 'enabled';
        }

        return view('user.ongoing.materi-ongoing',[
            'materi'=> $materi,
            'user'=> User::where('id', Auth::user()->id)->first(),
            'jawaban' => $jawaban,
            'jawabanPengetahuan' => $jawabanPengetahuan,
            'jawabanLatihan' => $jawabanLatihan,
            'rata2' => $rata2
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
