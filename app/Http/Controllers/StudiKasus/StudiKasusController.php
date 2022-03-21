<?php

namespace App\Http\Controllers\StudiKasus;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use App\Models\Jawaban;
use App\Models\JawabanPengetahuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

class StudiKasusController extends Controller
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
        $jawaban = Jawaban::where('materi_id', $id)->where('user_id', Auth::user()->id)->where('tgl_jawab_pengetahuan', '!=', null)->first();

        if($jawaban) {
            $jawaban = 'disabled';
        } else {
            $jawaban = 'enabled';
        }

        return view('user.studikasus.studikasus',[
            'materi'=> Materi::where('id',$id)->first(),
            'jawaban' => $jawaban
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

    public function jawabanPengetahuan(Request $request)
    {
        DB::beginTransaction();

        try {
            for($i = 0; $i < count($request->pengetahuan); $i++) {
                JawabanPengetahuan::create([
                    'user_id' => Auth::user()->id,
                    'pengetahuan_id' => $request->pengetahuan[$i],
                    'jawaban' => $request->jawaban[$i],
                ]);
            }

            $jawaban = Jawaban::where('materi_id', $request->id)->where('user_id', Auth::user()->id)->first();
            
            if($jawaban) {
                $jawaban->tgl_jawab_pengetahuan = Carbon::now()->format('Y-m-d');
                $jawaban->save();
            } else {
                Jawaban::create([
                    'materi_id' => $request->id,
                    'user_id' => Auth::user()->id,
                    'tgl_jawab_pengetahuan' => Carbon::now()->format('Y-m-d'),
                ]);
            }            

            DB::commit();

            return Redirect::route('lembar.kerja', $request->id)->with('success','Jawaban Pengetahuan Telah Disimpan');
            // return Redirect::route('materi-ongoing.show', $request->id)->with('success','Jawaban Pengetahuan Telah Disimpan');
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('error' , $e->getMessage());
        }
    }
}
