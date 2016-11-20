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
        //return response()->json(['name'=>'Hi']);
        return redirect()->action(
            'DiscussionController@show', ['society_id' => $society_id]
        );
    }

    // Quit a society
    public function quit(Request $request)
    {
        $user_id = Auth::id();
        $society_id = $request->input('society_id');
        \SocietyWrapper::quitSociety($user_id, $society_id);
        return redirect()->action(
            'SocietyController@listUserSocieties'
        );
    }

    public function createSociety(Request $request) {
        $name = $request->input('name');
        $catagory = $request->input('catagory');
        $society = \SocietyWrapper::createSociety($name, $catagory);
        $user_id = Auth::id();
        \SocietyWrapper::joinSociety($user_id, $society->id);
        //return response()->json($society);
        // redirecting to the listSociety page
        return redirect()->action(
            'DiscussionController@show', ['society_id'=>$society->id]
        );
    }

    public function deleteSociety(Request $request) {
        $id = $request->input('id');
        \SocietyWrapper::deleteSociety($id);
        return response()->json('deleted!');
    }

    // PHP is so shitty!!!
    public function listAllSocieties() {
        $user_id = Auth::id();

        $society_ids_in = \SocietyWrapper::getSocietiesForUser($user_id);
        $societies_user_is_in = \SocietyWrapper::getSocietiesFromIds($society_ids_in);

        //$society_ids_not_in = \SocietyWrapper::getSocietyIdsUserNotIn($user_id);
        $societies_user_not_in = \SocietyWrapper::getSocietiesUserNotIn($user_id);
        //return view('listAllSocieties',['societies_in'=>$societies_user_is_in,
        //    'societies_not_in'=>$societies_user_not_in]);
        //return response()->json($societies_user_not_in);
        //return view('listAllSocieties',['societies'=>$societies_user_not_in]);
        //return view('listAllSocieties',['societies'=>\SocietyWrapper::getAllSocieties()]);
        return view('listAllSocieties', ['societies_in'=>$societies_user_is_in, 'societies_not_in'=>$societies_user_not_in]);
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