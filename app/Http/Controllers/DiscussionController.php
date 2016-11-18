<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

require_once ('SocietyWrapper.php');
require_once ('DiscussionWrapper.php');
require_once ('PostWrapper.php');

// TODO: add sorting and filtering for newest discussion

class DiscussionController extends Controller
{
    public function show(Request $request) {
        $user_id = Auth::id();
        $society_id = $request->input('society_id');
        $discussion_id = $request->input('discussion_id');

        $society = \SocietyWrapper::getSocietyFromId($society_id);
        $all_discussions = \DiscussionWrapper::sortSocDiscussion($society_id, 'desc');

        if(is_null($discussion_id)) {
            $discussion = \DiscussionWrapper::getNewestSocDiscussion($society_id);
        } else {
            $discussion = \DiscussionWrapper::getDiscussionFromId($discussion_id);
        }

        $isInSociety = \SocietyWrapper::isInSociety($user_id, $society_id);

        // TODO: Default sorting, change later!
        $posts = \PostWrapper::sortDiscPostByUpdateTime($discussion_id, 'desc');
        // TODO: add logic to filter and sort for the newsest discussion
        return view('listDiscussions', ['inSociety'=>$isInSociety, 'all_dis' => $all_discussions, 'discussion' => $discussion,
            'society' => $society, 'posts' => $posts]);
        //return response()->json($posts);
    }
}