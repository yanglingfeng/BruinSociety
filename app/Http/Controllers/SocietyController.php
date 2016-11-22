<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

require_once ('SocietyWrapper.php');
require_once ('PostWrapper.php');
require_once ('DiscussionWrapper.php');

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
        $user_posts = \PostWrapper::getPostsForUser($user_id);
        $posts_with_society_info = array();
        foreach ($user_posts as $post) {
            $discussion_id = $post->discussion_id;
            $discussion = \DiscussionWrapper::getDiscussionFromId($discussion_id);
            $society_id = \DiscussionWrapper::getSocietyIdFromDiscussionId($discussion_id);
            $society = \SocietyWrapper::getSocietyFromId($society_id);
            $post_with_info = array('title'=>($post->title), 'id'=>($post->post_id),
                'society_name'=>($society->name), 'created_at'=>($post['created_at']), 'replied_at'=>($post['updated_at'])
                ,'society_id'=>$society_id, 'discussion_id'=>$discussion_id);
            array_push($posts_with_society_info, $post_with_info);
        }
        usort($posts_with_society_info, function ($item1, $item2) {
            if ($item1['replied_at'] == $item2['replied_at']) return 0;
            return $item1['replied_at'] < $item2['replied_at'] ? 1 : -1;
        });
        return view('welcome', ['societies' => $societies, 'posts' => $posts_with_society_info]);
        //return response()->json($societies);
    }

    // List all members of a society
    public function listSocietyMembers(Request $request)
    {
        $society_id = $request->input('society_id');
        $society = \SocietyWrapper::getSocietyFromId($society_id);
        $members = \SocietyWrapper::getAllSocietyMembers($society_id);
        //return response()->json($members);
        return view('viewAllMembers', ['society'=>$society, 'members'=>$members]);
    }

}