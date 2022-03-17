<?php

namespace App\Http\Controllers\StudiKasus;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use App\Models\JawabanPengetahuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Redirect;

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
        //
        return view('user.studikasus.studikasus',[
            'materi'=> Materi::where('id',$id)->first(),
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

            DB::commit();

            return Redirect::route('materi-ongoing.show', $request->id)->with('success','Jawaban Pengetahuan Telah Disimpan');
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('error' , $e->getMessage());
        }
    }
}
