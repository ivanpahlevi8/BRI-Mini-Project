<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // function to get all class
        $allClass = Kelas::all();

        return view('kelas.index', [
            'kelas' => $allClass,
            'index' => 'kelas'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kelas.form', [
            'index' => 'kelas',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate input first
        $request->validate([
            'nama_kelas' => 'required | max:255',
            'tingkat' => 'required',
            'fakultas' => 'required',
            'jurusan' => 'required',
        ]);

        // if validate okay, creat object
        $response = Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'tingkat' => $request->tingkat,
            'fakultas' => $request->fakultas,
            'jurusan' => $request->jurusan,
        ]);

        // check for response
        if($response) {
            dd('success adding data');
        } else {
            dd("failed to add data");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Kelas $kelas)
    {
        //get class
        $getClass = Kelas::find($kelas)->first();

        dd($getClass);

        return view('', [
            "kelas" => $getClass,
        ]);
    }

    // show update form
    public function showUpdate(Kelas $kelas) {
        return view('kelas.update', [
            'index' => 'kelas',
            'kelas' => $kelas,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // validate request
        $request->validate([
            'nama_kelas' => 'required',
            'tingkat' => 'required',
            'fakultas' => 'required',
            'jurusan' => 'required',
        ]);

        // update kelas
        $resp = Kelas::where('id', $request->id)->update([
            'nama_kelas' => $request['nama_kelas'],
            'tingkat' => $request['tingkat'],
            'fakultas' => $request['fakultas'],
            'jurusan' => $request['jurusan'],
        ]);

        // check for resp
        if($resp) {
            dd('success updating kelas');
        } else {
            dd('failed to updating kelas');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelas $kelas)
    {
        // function to delete kelas
        $getKelas = Kelas::findOrFail($kelas->id);

        // delete user
        $resp = $getKelas->delete();

        // check for response
        if($resp) {
            //dd('success delete materi');
            return redirect('/all-kelas')->with('success', 'Success Deleting Materi');
        } else {
            //dd('failed to delete materi');
            return redirect('/all-kelas')->with('error', 'Failed Deleting Materi');
        }
    }
}
