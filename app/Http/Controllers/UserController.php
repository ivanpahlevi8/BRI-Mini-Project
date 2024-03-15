<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // function to show form to add user
    public function index() {
        return view('user.index', [
            'index' => 'user',
        ]);
    }

    //function to get all asisten
    public function getAsisten() {
        $allAsisten = User::all()->where('role', 'assisten');

        return view('', [
            'asisten'=> $allAsisten
        ]);
    }

    // function to get all user
    public function getAllUser(){
        // get current user
        $currUser = Auth::user();
        $allUser = User::orderBy('id', 'DESC')->get();

        return view('user.all', [
            'index' => 'user',
            'allUser' => $allUser,
            'role' => $currUser,
        ]);
    }

    // fucntion to add asisten
    public function addAsisten(Request $request) {
        // dd($request->all());
        //validate input first
        $request->validate([
            'name' => 'required | max:255',
            'email' => 'required | email:dns',
            'role' => 'required | in:admin,pj,assisten',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'id_assisten' => 'required',
            'password' => 'required',
        ]);

        //dd($request->all());

        // create user object
        $userObj = new User();

        // processing image
        $imageName = time().'.'.$request->image->extension();  
        
        // move image to public folder
        $request->image->move(public_path('images'), $imageName);

        // assign user object with column value
        $userObj->name = $request->name;
        $userObj->email = $request->email;
        $userObj->role = $request->role;
        $userObj->photo = $imageName;
        $userObj->id_assisten = $request->id_assisten;
        $userObj->password = bcrypt($request->password);

        // save data to database
        $resp = $userObj->save();

        if($resp) {
            return redirect('/all-user')->with('success', 'Success Adding User');
        } else {
            return redirect('/all-user')->with('error', 'Failed Adding user');
        }
    }

    // function to delete assisten
    public function removeAssisten(User $user) {
        $getUser = User::findOrFail($user->id);

        // delete user
        $resp = $getUser->delete();

        // check for response
        if($resp) {
            return redirect('/all-user')->with('success', 'Success Deleting User');
        } else {
            return redirect('/all-user')->with('error', 'Failed Deleting user');
        }
    }

    // function to show assisten data for update purposes
    public function showUpdateAssisten(User $user) {
        // get user by params
        $getParam = User::find($user)->first();

        // send data to view
        return view('user.update', [
            'userData' => $getParam,
            'index' => 'user',
        ]);
    }

    // function to update assisten
    public function updateAssisten(Request $request) {
        // validate input first
        $request->validate([
            'name' => 'required | max:255',
            'email' => 'required | email:dns',
            'role' => 'required | in:admin, pj, assisten',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'id_assisten' => 'required',
        ]);

        // processing image
        $imageName = time().'.'.$request->image->extension();  
        
        // move image to public folder
        $request->image->move(public_path('images'), $imageName);

        // get request id
        $getUserId = $request->id;

        // update user
        $resp = User::where('id', $getUserId)
                ->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'role' => $request->role,
                    'photo' => $imageName,
                    'id_assisten' => $request->id_assisten,
                ]);
        
        // check for resp
        if($resp) {
            //dd('success updating user data');
            return redirect('/all-user')->with('success', 'Success Updating User');
        } else {
            //dd('failed to updating user data');
            return redirect('/all-user')->with('error', 'error updating user');
        }
    }
}
