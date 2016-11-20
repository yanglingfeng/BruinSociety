<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;


require_once ('SocietyWrapper.php');
require_once ('DiscussionWrapper.php');
require_once ('PostWrapper.php');
require_once ('CommentWrapper.php');

// TODO: add sorting and filtering for newest discussion

class PostController extends Controller
{
    public function show(Request $request) {

        $post_id = $request->input('post_id');
        $society_id = $request->input('society_id');
        $discussion_id = $request->input('discussion_id');

        $society = \SocietyWrapper::getSocietyFromId($society_id);
        $discussion = \DiscussionWrapper::getDiscussionFromId($discussion_id);
        $post = \PostWrapper::getPostFromId($post_id);

        $comments = \CommentWrapper::getCommentsForPost($post_id);

        $file_url = '';

        if($post->has_link == 1) {
            $file_url = Storage::url($post->link);
            //$prefix = "/storage/";
            //$link = $prefix.$file_url;
            //$file_url = $link;
        }

        //return response()->json($file_url);
        return view('showPost', ['post' => $post, 'comments' => $comments,
                   'society'=>$society, 'discussion'=>$discussion, 'file_url'=>$file_url]);
    }

    public function postCreation(Request $request)
    {
        $discussion_id = $request->input('discussion_id');
        $society_id = $request->input('society_id');
        $society = \SocietyWrapper::getSocietyFromId($society_id);
        $discussion = \DiscussionWrapper::getDiscussionFromId($discussion_id);
        return view('postCreation', ['society'=>$society, 'discussion'=>$discussion]);
        //return response()->json($discussion);
    }

    public function create(Request $request)
    {
        //$file = $request->file('myFile');
        //return response()->json($request->hasFile('myFile'));
        $current_user = Auth::user();
        $poster_id = Auth::id();
        $poster_name = $current_user->name;

        $title = $request->input('title');
        $content = $request->input('content');
        // TODO: currently hardcoded to be 0, change when we support file upload
        $has_link = 0;
        $link = '';

        // handle file uploads
        if($request->hasFile('myFile')) {
            $has_link = 1;
            $path = $request->file('myFile')->store('public');
            $link = $path;
        }
        $society_id = $request->input('society_id');
        $discussion_id = $request->input('discussion_id');
        $post = \PostWrapper::createPost($title, $content, $has_link, $link, $society_id, $discussion_id, $poster_id, $poster_name);
        $post_id = $post->id;
        return redirect()->action(
            'PostController@show', ['post_id'=>$post_id, 'society_id'=>$society_id, 'discussion_id'=>$discussion_id]
        );
        //return response()->json($post);
    }


}