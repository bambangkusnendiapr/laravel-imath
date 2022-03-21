<?php

namespace App\Http\Controllers\Admin\Materi;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use App\Models\Pengetahuan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class MateriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.materi.materi',[
            'materis' => Materi::all(),
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
        return view('admin.materi.create');
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
            'judul' => 'required',
            'tgl_aktif' => 'required',
            'isi_materi' => 'required',
            'status' => 'required',
            'isi' => 'required',
            'bobot' => 'required',
        ],[
            'judul.*' => 'Judul Materi harus di Isi',
            'tgl_aktif.*' => 'Tanggal Aktif Harus di Isi',
            'isi_materi.*' => 'Isi Materi Harus di Isi',
            'status.*' => 'Status Harus di Isi',
        ]);

        DB::beginTransaction();
        try{

            $materi = Materi::create([
                'judul' => $request->judul,
                'tgl_aktif' => $request->tgl_aktif,
                'isi_materi' => $request->isi_materi,
                'status' => $request->status,
            ]);

            for($i = 0; $i<count($request->isi); $i++) {
                Pengetahuan::create([
                    'materi_id' => $materi->id,
                    'isi' => $request->isi[$i],
                    'bobot' => $request->bobot[$i],
                ]);
            }

            DB::commit();
            return Redirect::route('materi.index')->with('success','Materi Baru Berhasil di Tambahkan');
        }catch(Exception $e){
            DB::rollBack();
            return Redirect::back()->with('error' , $e->getMessage());
        }
        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Materi  $materi
     * @return \Illuminate\Http\Response
     */
    public function show(Materi $materi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Materi  $materi
     * @return \Illuminate\Http\Response
     */
    public function edit(Materi $materi)
    {
        $pengetahuan = DB::table('pengetahuans')->where('materi_id', $materi->id)->first();
        return view('admin.materi.edit',[
            'materi'=> $materi,
            'tgl_aktif_pengetahuan' => $pengetahuan->tgl_aktif,
            'status_pengetahuan' => $pengetahuan->status
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Materi  $materi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Materi $materi)
    {
        // if(array_sum($request->bobot) > 100) {
        //     return Redirect::back()->with('error' , 'Bobot lebih dari 100');
        // }
        $request->validate([
            'judul' => 'required',
            'tgl_aktif' => 'required',
            'isi_materi' => 'required',
            'status' => 'required',
        ],[
            'judul.*' => 'Judul Materi harus di Isi',
            'tgl_aktif.*' => 'Tanggal Aktif Harus di Isi',
            'isi_materi.*' => 'Isi Materi Harus di Isi',
            'status.*' => 'Status Harus di Isi',
        ]);

        //hapus pengetahuan berdasarkan id

        //tambahkan pengetahuan
        //masukkan id pengetahuan ke variabel

        DB::beginTransaction();
        try{


            
            $update_materi = [
                'judul' => $request->judul,
                'tgl_aktif' => $request->tgl_aktif,
                'isi_materi' => $request->isi_materi,
                'status' => $request->status,
            ];

            Materi::where('id',$materi->id)->update($update_materi);

            DB::commit();
            return Redirect::route('materi.index')->with('success','Materi Berhasil di Update');
        }catch(Exception $e){
            DB::rollBack();
            return Redirect::back()->with('error' , $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Materi  $materi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Materi $materi)
    {
        //
        DB::beginTransaction();
        try{
            Materi::where('id', $materi->id)->delete();

            Pengetahuan::where('materi_id', $materi->id)->delete();

            DB::commit();
            return Redirect::route('materi.index')->with('success','Lembar Kerja Berhasil di Hapus');
        }catch(Exception $e){
            DB::rollBack();
            return Redirect::back()->with('error' , $e->getMessage());
        }
    }

    public function pengetahuanTambah(Request $request)
    {
        if(empty($request->isi)) {
            return Redirect::back()->with('error' , 'Tidak ada data');
        }

        $materi = Materi::find($request->materi_id);
        if(($materi->pengetahuans->sum('bobot') + array_sum($request->bobot)) > 100) {
            return Redirect::back()->with('error' , 'Bobot lebih dari 100');
        }

        DB::beginTransaction();

        try {
            for($i = 0; $i<count($request->isi); $i++) {
                Pengetahuan::create([
                    'materi_id' => $request->materi_id,
                    'isi' => $request->isi[$i],
                    'bobot' => $request->bobot[$i],
                ]);
            }

            DB::commit();
            return Redirect::back()->with('success','Lembar Pengetahuan Berhasil di Tambah');
        } catch (Exception $e) {
            B::rollBack();
            return Redirect::back()->with('error' , $e->getMessage());
        }
    }

    public function pengetahuanUpdate(Request $request, $id)
    {
        $materi = Materi::find($request->materi_id);
        $pengetahuan = Pengetahuan::find($id);
        if(($materi->pengetahuans->sum('bobot') - $pengetahuan->bobot + $request->bobot) > 100) {
            return Redirect::back()->with('error' , 'Bobot lebih dari 100');
        }

        DB::beginTransaction();

        try {
            $pengetahuan->isi = $request->isi;
            $pengetahuan->bobot = $request->bobot;
            $pengetahuan->save();

            DB::commit();
            return Redirect::back()->with('success','Lembar Pengetahuan Berhasil di Update');
        } catch (Exception $e) {
            B::rollBack();
            return Redirect::back()->with('error' , $e->getMessage());
        }
    }

    public function pengetahuanHapus($id)
    {        
        DB::beginTransaction();
        
        try {
            $pengetahuan = Pengetahuan::find($id);
            $pengetahuan->delete();

            DB::commit();
            return Redirect::back()->with('success','Lembar Pengetahuan Berhasil di Hapus');
        } catch (Exception $e) {
            B::rollBack();
            return Redirect::back()->with('error' , $e->getMessage());
        }
    }
}
