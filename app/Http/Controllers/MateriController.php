<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get all view object
        $allView = Materi::all();

        return view('materi.index', [
            'index' => 'materi',
            'materi' => $allView,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // show add materi form
        return view('materi.add', [
            'index' => 'materi'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate request
        $request->validate([
            'materi' => 'required',
        ]);

        // get request params
        $materiParam = $request->materi;

        // add object to database
        $resp = Materi::create([
            'materi' => $materiParam,
        ]);

        // check for response
        if($resp) {
            //dd('success adding materi');
            return redirect('/all-materi')->with('success', 'Success Adding Materi');
        } else {
            //dd('failed adding materis');
            return redirect('/all-materi')->with('error', 'Failed Adding Materi');
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Materi $materi)
    {
        // show editing form
        return view('materi.update', [
            'materi' => $materi,
            'index' => 'materi'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // validate request
        // validate request
        $request->validate([
            'materi' => 'required',
        ]);

        // get request params
        $materiParam = $request->materi;
        $getId = $request->id;

        // update user
        $resp = Materi::where('id', $getId)
                ->update([
                    'materi' => $materiParam
                ]);

        if($resp) {
            //dd('success updating materi');
            return redirect('/all-materi')->with('success', 'Success Updating Materi');
        } else {
            //dd('failed to update materi');
            return redirect('/all-materi')->with('error', 'Failed Updating Materi');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Materi $materi)
    {
        // function to delete materi
        $getMateri = Materi::findOrFail($materi->id);

        // delete user
        $resp = $getMateri->delete();

        // check for response
        if($resp) {
            //dd('success delete materi');
            return redirect('/all-materi')->with('success', 'Success Deleting Materi');
        } else {
            //dd('failed to delete materi');
            return redirect('/all-materi')->with('error', 'Failed Deleting Materi');
        }
    }
}
