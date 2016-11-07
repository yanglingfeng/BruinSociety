<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;


class DiscussionController extends Controller
{
    public function show($request) {
        $society_id = $request->input('society_id');
        // TODO: get the society
        $all_discussions = \DiscussionWrapper::getAllSocietyDicussion($society_id);
        $newest_discussion = \DiscussionWrapper::getNewestDiscussion($society_id);
        return view('listDiscussions', ['all_dis' => $all_discussions, 'newsest_dis' => $newest_discussion]);
    }
}