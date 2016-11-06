<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

require_once ('SocietyWrapper.php');
class SocietyController extends Controller
{
    // Join a society
    public function join(Request $request)
    {
        $user_id = Auth::id();
        $society_id = $request->input('society_id');
        \SocietyWrapper::joinSociety($user_id, $society_id);
        return response()->json(['name'=>'Hi']);

    }

    // Quit a society
    public function quit(Request $request)
    {
        $user_id = Auth::id();
        $society_id = $request->input('society_id');
        \SocietyWrapper::quitSociety($user_id, $society_id);
    }

    public function listAllSocieties() {
        $societies = \SocietyWrapper::getAllSocieties();
        return view('listAllSocieties',['societies'=>$societies]);
    }

    // List all societies a user is in
    public function listUserSocieties()
    {
        $user_id = Auth::id();
        $society_ids = \SocietyWrapper::getSocietiesForUser($user_id);
        $societies = \SocietyWrapper::getSocietiesFromIds($society_ids);
        return view('welcome', ['societies' => $societies]);
        //return response()->json($societies);
    }
}