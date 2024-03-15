<?php

namespace App\Http\Controllers;

use App\Models\Code;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get all token
        $allToken = Code::all();

        return view('', [
            'all_token' => $allToken
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // function to generate code
        // create object
        $codeObj = new Code();

        // get current user id
        $currUserId = Auth::id();

        // set curr user id
        $codeObj->id_user = $currUserId;

        $codeObj->code = Str::random(5);

        // save data
        $resp = $codeObj->save();

        // check for response
        if($resp) {
            //dd('success adding data');
            // get code with id user
            $getCode = Code::where('id_user', $currUserId)->orderBy('id', 'DESC')->get()->first();
            return back()->with('success', $getCode->code);
        } else {
            dd('failed to create token');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Code $code)
    {
        // create function to update token when user do absence
        // validate a

        // get request 
        $absence = $request->absensi;
        // $userAbsence = 

        // update code 
    }

}
