<?php

namespace App\Http\Controllers\Admin\Nilai;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use App\Models\User;
use App\Models\Materi;
use App\Models\Mahasiswa;
use App\Models\Latihan;
use App\Models\Pengetahuan;
use App\Models\JawabanPengetahuan;
use App\Models\JawabanLatihan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Models\SoalLatihan;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.nilai.nilai', [
            'mahasiswa' => Mahasiswa::all()
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

        try {
            for($i = 0; $i < count($request->nilai); $i++) {
                JawabanPengetahuan::where('id', $request->id[$i])
                        ->update(['nilai' => $request->nilai[$i]]);
            }

            DB::commit();
            return Redirect::back()->with('success','Nilai Berhasil Disimpan');
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('error' , $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function show($idMahasiswa)
    {
        $mahasiswa = Mahasiswa::find($idMahasiswa);
        $jawabanPengetahuan = null;
        $jawabanLatihan = null;
        if(request('pengetahuan')) {
            $pengetahuan = Pengetahuan::where('materi_id', request('pengetahuan'))->get('id');
            $jawabanPengetahuan = JawabanPengetahuan::where('user_id', $mahasiswa->user_id)->whereIn('pengetahuan_id', $pengetahuan)->get();
        }

        if(request('latihan')) {
            $latihan = Latihan::where('materi_id', request('latihan'))->first();
            $soalLatihan = SoalLatihan::where('latihan_id', $latihan->id)->get('id');
            $jawabanLatihan = JawabanLatihan::where('user_id', $mahasiswa->user_id)->whereIn('soal_latihan_id', $soalLatihan)->get();
        }

        return view('admin.nilai.show', [
            'mahasiswa' => $mahasiswa,
            'idMahasiswa' => $idMahasiswa,
            'materi' => Materi::all(),
            'jawabanPengetahuan' => $jawabanPengetahuan,
            'jawabanLatihan' => $jawabanLatihan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function edit(Nilai $nilai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nilai $nilai)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nilai $nilai)
    {
        //
    }

    public function nilaiLatihan(Request $request)
    {
        DB::beginTransaction();

        try {
            for($i = 0; $i < count($request->nilai); $i++) {
                JawabanLatihan::where('id', $request->id[$i])
                        ->update(['nilai' => $request->nilai[$i]]);
            }

            DB::commit();
            return Redirect::back()->with('success','Nilai Berhasil Disimpan');
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('error' , $e->getMessage());
        }
    }
}
