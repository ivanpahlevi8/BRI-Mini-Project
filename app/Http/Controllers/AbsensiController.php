<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Code;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Materi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class AbsensiController extends Controller
{
    /**
     * $result = Table1::join('table2', 'table1.column', '=', 'table2.column')
     */
    // function to get all absensi
    public function allAbsensi() {
        $allAbsen = Absensi::join('users', 'absensis.id_user', '=', 'users.id')
                    ->join('kelas', 'absensis.id_kelas', '=', 'kelas.id')
                    ->join('materis', 'absensis.id_materi', '=', 'materis.id')
                    ->join('codes', 'absensis.id_code', '=', 'codes.id')
                    ->select('absensis.teaching_role', 'absensis.date', 'absensis.start', 'absensis.end', 'absensis.duration', 'absensis.id_asisten', // Specify table1 columns
                    'users.name', // Specify table2 columns
                    'kelas.nama_kelas', // Specify table3 columns
                    'materis.materi',// Specify table4 columns
                    'codes.code', // specify table 5
                    ) 
                    ->get();

        //dd($allAbsen);

        return view('absensi.index', [
            'index' => 'absen',
            "absensi" => $allAbsen
        ]);
    }

    // current user absence
    public function currentUserAbsensi() {
        // get user
        $userLogin = Auth::user();

        // get all absence related to user
        $allAbsen = Absensi::join('users', 'absensis.id_user', '=', 'users.id')
                    ->join('kelas', 'absensis.id_kelas', '=', 'kelas.id')
                    ->join('materis', 'absensis.id_materi', '=', 'materis.id')
                    ->join('codes', 'absensis.id_code', '=', 'codes.id')
                    ->where('absensis.id_user', $userLogin->id)
                    ->select('absensis.teaching_role', 'absensis.date', 'absensis.start', 'absensis.end', 'absensis.duration', 'absensis.id_asisten', // Specify table1 columns
                    'users.name', // Specify table2 columns
                    'kelas.nama_kelas', // Specify table3 columns
                    'materis.materi',// Specify table4 columns
                    'codes.code', // specify table 5
                    )
                    ->get();

        //dd($allAbsen);

        return view('absensi.index', [
            'index' => 'absen',
            "absensi" => $allAbsen
        ]);
    }

    // crete function to show absence
    public function showAbsensi() {
        // get current user login
        $userLogin = Auth::user();

        // get all class object
        $allClass = Kelas::all();

        // get all materi object
        $allMateri = Materi::all();

        // get current date
        $currentDate = Carbon::now()->format('d-m-Y');

        // check if there is absence with certain user and certain date in database
        $check = Absensi::where('id_user', $userLogin->id)->exists();

        // if there is no absence create absence and return to view
        if(!$check) {
            // there is no absence, create absence
            $newAbsensi = new Absensi();

            // set default data on absensi
            $newAbsensi->id_user = $userLogin->id;
            $newAbsensi->id_asisten = $userLogin->id_assisten;
            $newAbsensi->date = $currentDate;
            
            // save absence
            $resp = $newAbsensi->save();

            // check for response
            if($resp) {
                // if okay
                // send to view reponse
                $getAbsensFromDb = Absensi::where('id_user', $userLogin->id)->OrderBy('id', 'DESC')->get()->first();
                //dd($getAbsensFromDb);
                 // send current absence to view
                return view('dashboard.index', [
                    'absen' => $getAbsensFromDb,
                    'user' => $userLogin,
                    'kelas' => $allClass,
                    'kelas_value' => '',
                    'materi_value' => '',
                    'materi' => $allMateri,
                    'index' => 'home',
                ]);
            } else {
                dd('error when send new absen data to database');
            }
        }

        // if absence already exist, check if user already checkin or not
        $getAbsensi = Absensi::where('id_user', $userLogin->id)->OrderBy('id', 'DESC')->get()->first();

        // get kelas object related to absensi
        $getKelas = Kelas::where('id', $getAbsensi->id_kelas)->get()->first();

        // get materi object related to absensi
        $getMateri = Materi::where('id', $getAbsensi->id_materi)->get()->first();

        if($getAbsensi->start != null && $getAbsensi->end != null) {
            // absence already filled
            // create new absence
            // there is no absence, create absence
            $newAbsensi = new Absensi();

            // set default data on absensi
            $newAbsensi->id_user = $userLogin->id;
            $newAbsensi->id_asisten = $userLogin->id_assisten;
            $newAbsensi->date = $currentDate;
            
            // save absence
            $resp = $newAbsensi->save();

            // check for response
            if($resp) {
                // if okay
                // send to view reponse
                $getAbsensFromDb = Absensi::where('id_user', $userLogin->id)->OrderBy('id', 'DESC')->get()->first();

                // get kelas object related to absensi
                $getKelas = Kelas::where('id', $getAbsensFromDb->id_kelas)->get()->first();

                // get materi object related to absensi
                $getMateri = Materi::where('id', $getAbsensFromDb->id_materi)->get()->first();

                //dd($getAbsensFromDb);
                return view('dashboard.index', [
                    'absen' => $getAbsensFromDb,
                    'user' => $userLogin,
                    'kelas' => $allClass,
                    'kelas_value' => $getKelas != null ? $getKelas->nama_kelas : '',
                    'materi_value' => $getMateri != null ? $getMateri->materi : '',
                    'materi' => $allMateri,
                    'index' => 'home',
                ]);
            } else {
                dd('error when send new absen data to database');
            }
        }

        //dd('show exist absensi');
        // send current absence to view
        return view('dashboard.index', [
            'absen' => $getAbsensi,
            'user' => $userLogin,
            'kelas' => $allClass,
            'kelas_value' => $getKelas != null ? $getKelas->nama_kelas : '',
            'materi_value' => $getMateri != null ? $getMateri->materi : '',
            'materi' => $allMateri,
            'index' => 'home',
        ]);
    }

    // create absen feature for checkin user
    public function doCheckin(Request $request) {
        // get user login
        $userLogin = Auth::user();

        // validate request
        $request->validate([
            'teaching_role' => "required",
            'materi' => 'required',
            'kelas' => 'required',
        ]);

        // check if token valid or not
        $reqToken = $request->token;

        $isExist = Code::where('code', $reqToken)->exists();

        if(!$isExist) {
            // if token is not valid
            dd('token is not valid, token is not exist');
        }

        // check if token already used or not
        $getToken = Code::where('code', $reqToken)->get()->first();

        if($getToken->id_user_get != null) {
            // if other user already use token
            dd('token already be used by other user');
        }

        // check user role
        // if($userLogin->id == $getToken->id_user) {
        //     // not valid user to login
        //     dd('admin are not allowed to do absence');
        // }

        // if already success update token
        $resp = Code::where('code', $reqToken)->update([
            'id_user_get' => $userLogin->id,
        ]);

        // get class object from database
        $classObj = Kelas::where('nama_kelas', $request->kelas)->get()->first();

        // get materi object from database
        $materiObj = Materi::where('materi', $request->materi)->get()->first();

        // update absensi object
        $resp = Absensi::where('id_code', null)->update([
             'start' => Carbon::now()->format('H:i:s'),
             'id_code' => $getToken->id,
             'id_kelas' => $classObj->id,
             'id_materi' => $materiObj->id,
             'teaching_role' =>$request->teaching_role,
        ]);

        // check response
        if($resp) {
            // success do absence
            //dd('success absence');
            return redirect('/dashboard')->with('success', 'Clock In successfull!');
        } else {
            //dd('failed to absence');
            return redirect('/dashboard')->with('error', 'Clock In Error');
        }
    }

    // create absen feature for checkout
    public function doCheckOut(Request $request) {
        // get user login
        $userLogin = Auth::user();

        // check user role
        // if($userLogin->role == 'admin' || $userLogin->role == 'pj') {
        //     // not valid user to login
        //     dd('admin are not allowed to do absence');
        // }

        // get current time
        $endTime = Carbon::now()->format('H:i:s');
        $timeEndObj = Carbon::parse($endTime);

        // get absence based on id
        $getAbsensi = Absensi::where('id_user', $userLogin->id)->OrderBy('id', 'DESC')->get()->first();

        // get start time from absensi
        $startTime = $getAbsensi->start;
        $timeStartObj = Carbon::parse($startTime);

        // calculate duration
        $duration = $timeEndObj->diffInMinutes($timeStartObj);

        // update absence data
        $resp = Absensi::where('id_user', $userLogin->id)->update([
            'end' => $endTime,
            'duration' => $duration,
        ]);

        // check for resp
        if($resp) {
            // success do absence
           // dd('success checkout absensi');
            return redirect('/dashboard')->with('success', 'Clock Out successfull!');
        } else {
            //dd('gagal checkout absensi');
            return redirect('/dashboard')->with('error', 'Clock Out Error');
        }
    }

    // export excel
    public function exportExcel() {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
