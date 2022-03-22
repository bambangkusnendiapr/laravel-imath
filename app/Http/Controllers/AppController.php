<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Jawaban;
use App\Models\Latihan;
use App\Models\JawabanLatihan;
use App\Models\SoalLatihan;
use App\Models\JawabanPengetahuan;
use Illuminate\Support\Facades\DB;
use Exception;
use Carbon\Carbon;

class AppController extends Controller
{
    public function index()
    {
        return view('front.index',[
            'materis'=> Materi::orderBy('created_at','DESC')->where('status', 'publikasi')->get(),
            'user'=> User::where('id', Auth::user()->id)->first()
        ]);
    }

    public function lembarKerja($id)
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
            $rata2 = $jawabanPengetahuan * 0.3;
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
            $rata2 = $jawabanLatihan * 0.7;
        } else {
            $jawabanLatihan = '-';
        }

        if($jawabanPengetahuan != '-' && $jawabanLatihan != '-') {
            $rata2 = round(($jawabanPengetahuan * 0.3) + ($jawabanLatihan * 0.7) , 2);
        }


        $jawaban = Jawaban::where('materi_id', $id)->where('user_id', Auth::user()->id)->where('tgl_jawab_latihan', '!=', null)->first();
        if($jawaban) {
            $jawaban = 'disabled';
        } else {
            $jawaban = 'enabled';
        }

        return view('front.lembar_kerja',[
            'materi'=> $materi,
            'user'=> User::where('id', Auth::user()->id)->first(),
            'jawaban' => $jawaban,
            'jawabanPengetahuan' => $jawabanPengetahuan,
            'jawabanLatihan' => $jawabanLatihan,
            'rata2' => $rata2
        ]);
    }

    public function lembarKerjaPengetahuan($id)
    {
        $jawaban = Jawaban::where('materi_id', $id)->where('user_id', Auth::user()->id)->where('tgl_jawab_pengetahuan', '!=', null)->first();

        if($jawaban) {
            $jawaban = 'disabled';
        } else {
            $jawaban = 'enabled';
        }

        return view('front.lembar_kerja_pengetahuan',[
            'materi'=> Materi::where('id',$id)->first(),
            'jawaban' => $jawaban
        ]);
    }

    public function lembarKerjaLatihan($id)
    {
        $latihan = Latihan::find($id);

        return view('front.lembar_kerja_latihan',[
            'latihan_id'=>$id,
            'soals'=> SoalLatihan::where('latihan_id', $id)->get(),
            'user'=> User::where('id', Auth::user()->id)->first(),
            'materi_id' => $latihan->materi_id
        ]);
    }
}
