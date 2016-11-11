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



        //return view('listDiscussions', ['all_dis' => $all_discussions, 'discussion' => $discussion,
        //    'society' => $society, 'posts' => $posts]);
        return response()->json($comments);
    }
}