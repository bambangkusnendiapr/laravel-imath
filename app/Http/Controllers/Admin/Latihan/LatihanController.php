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
        $latihan = Latihan::all();
        $materiId = [];
        foreach($latihan as $data) {
            $materiId[] = $data->materi_id;
        }

        return view('admin.latihan.create',[
            'materis' => Materi::whereNotIn('id', $materiId)->get()
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
        if(array_sum($request->bobot) > 100) {
            return Redirect::back()->with('error' , 'Bobot lebih dari 100');
        }
       $request->validate([
           'materi_id'=>'required',
           'status'=>'required',
       ],[
            'materi_id.*'=>'Materi Harus di Isi',
            'status.*'=>'Status Harus di Isi',  
       ]);

       DB::beginTransaction();
       try{

        $latihan_id = Latihan::create([
            'materi_id'=>$request->materi_id,
            'tgl_aktif'=>$request->tgl_aktif,
            'status'=>$request->status,
        ]);

        for($i = 0; $i < count($request->soal); $i++) {
            SoalLatihan::create([
                'latihan_id'=>$latihan_id->id,
                'soal'=>$request->soal[$i],
                'bobot'=>$request->bobot[$i],
            ]); 
        }

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
        if(array_sum($request->bobot) > 100) {
            return Redirect::back()->with('error' , 'Bobot lebih dari 100');
        }
        
       DB::beginTransaction();
       try{
        $latihan->status = $request->status;
        $latihan->save();

        SoalLatihan::where('latihan_id', $request->latihan_id)->delete();

        for($i = 0; $i<count($request->bobot); $i++) {
            SoalLatihan::create([
                'latihan_id' => $request->latihan_id,
                'soal' => $request->soal[$i],
                'bobot' => $request->bobot[$i],
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
            SoalLatihan::where('latihan_id', $latihan->id)->delete();
            DB::commit();
            return Redirect::route('latihan.index')->with('success','Latihan Berhasil di Hapus');
        }catch(Exception $e){
            DB::rollBack();
            return Redirect::back()->with('error' , $e->getMessage());
        }
    }

    public function soalTambah(Request $request)
    {
        if(empty($request->bobot)) {
            return Redirect::back()->with('error' , 'Tidak ada data');
        }

        $latihan = Latihan::find($request->latihan_id);
        if(($latihan->soalLatihans->sum('bobot') + array_sum($request->bobot)) > 100) {
            return Redirect::back()->with('error' , 'Bobot lebih dari 100');
        }

        DB::beginTransaction();

        try {
            for($i = 0; $i<count($request->bobot); $i++) {
                SoalLatihan::create([
                    'latihan_id' => $request->latihan_id,
                    'soal' => $request->soal[$i],
                    'bobot' => $request->bobot[$i],
                ]);
            }

            DB::commit();
            return Redirect::back()->with('success','Latihan Berhasil di Tambah');
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('error' , $e->getMessage());
        }
    }

    public function soalUpdate(Request $request, $id)
    {
        $latihan = Latihan::find($request->latihan_id);
        $soalLatihan = SoalLatihan::find($id);

        if(($latihan->soalLatihans->sum('bobot') - $soalLatihan->bobot + $request->bobot) > 100) {
            return Redirect::back()->with('error' , 'Bobot lebih dari 100');
        }

        DB::beginTransaction();

        try {
            $soalLatihan->soal = $request->soal;
            $soalLatihan->bobot = $request->bobot;
            $soalLatihan->save();

            DB::commit();
            return Redirect::back()->with('success','Latihan Berhasil di Update');
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('error' , $e->getMessage());
        }

        dd($request->all());
    }

    public function soalHapus($id)
    {
        DB::beginTransaction();
        
        try {
            $soalLatihan = SoalLatihan::find($id);
            $soalLatihan->delete();

            DB::commit();
            return Redirect::back()->with('success','Latihan Berhasil di Hapus');
        } catch (Exception $e) {
            B::rollBack();
            return Redirect::back()->with('error' , $e->getMessage());
        }
    }
}
