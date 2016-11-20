<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

require_once ('SocietyWrapper.php');
require_once ('DiscussionWrapper.php');
require_once ('PostWrapper.php');
require_once ('CommentWrapper.php');

// TODO: add sorting and filtering for newest discussion

class CommentController extends Controller
{
    public function post(Request $request) {
        // Current user would be the one making comments
        $current_user = Auth::user();
        $commenter_id = Auth::id();
        $commenter_name = $current_user->name;
        $post_id = $request->input('post_id');
        $content = $request->input('content');
        $society_id = $request->input('society_id');
        $discussion_id = $request->input('discussion_id');
        $post = \PostWrapper::getPostFromId($post_id);
        $comment = \CommentWrapper::postComment($post_id, $commenter_id, $commenter_name, $content);
        \PostWrapper::updateUpdatedAt($post_id, $comment->created_at);
        //return response()->json($comment);
        return redirect()->action(
            'PostController@show', ['post_id' => $post_id, 'discussion_id' => $discussion_id, 'society_id' => $society_id]
        );
    }
}