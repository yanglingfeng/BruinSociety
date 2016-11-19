<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

require_once ('SocietyWrapper.php');
require_once ('DiscussionWrapper.php');
require_once ('PostWrapper.php');
require_once ('CommentWrapper.php');

// TODO: add sorting and filtering for newest discussion

class PostController extends Controller
{
    public function show(Request $request) {

        $post_id = $request->input('post_id');

        $post = \PostWrapper::getPostFromId($post_id);

        $comments = \CommentWrapper::getCommentsForPost($post_id);

        //return response()->json($post);
        return view('showPost', ['post' => $post, 'comments' => $comments]);
    }

    public function postCreation(Request $request)
    {
        $discussion_id = $request->input('discussion_id');
        $society_id = $request->input('society_id');
        $society = \SocietyWrapper::getSocietyFromId($society_id);
        $discussion = \DiscussionWrapper::getDiscussionFromId($discussion_id);
        return view('postCreation', ['discussion_id'=>$discussion_id]);
    }
}