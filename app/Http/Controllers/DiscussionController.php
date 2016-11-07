<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

// TODO: add sorting and filtering for newest discussion

class DiscussionController extends Controller
{
    public function show($request) {
        $society_id = $request->input('society_id');
        $society = \SocietyWrapper::getSocietyFromId($society_id);
        $all_discussions = \DiscussionWrapper::getAllSocietyDicussion($society_id);
        $newest_discussion = \DiscussionWrapper::getNewestDiscussion($society_id);
        // TODO: add logic to filter and sort for the newsest discussion
        return view('listDiscussions', ['all_dis' => $all_discussions, 'newsest_dis' => $newest_discussion,
            'society' => $society]);
    }
}