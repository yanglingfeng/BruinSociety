<?php

    use App\Discussion;

    // TODO: add a getNewestDiscussion function

    // This class wraps up the discussions table by providing different methods of accessing the table.
    class DiscussionWrapper
    {
        //Quarter: 1 = Winter, 2 = Spring, 3 = Summer, 4 = Fall
        static public function createDiscussion($quarter, $society_id, $year)
        {
                DB::table('discussions')->insert(
                    ['quarter' => $quarter, 'society_id' => $society_id, 'year' => $year]
                );  
        }

        //What is name for??? I am assuming each society only has one discussion
        static public function getSocietiesOfDiscussion($id)
        {
            $societyid = App\Discussion::select('society_id')->where('id', $id)->first();
            return $societyid;
        }

        static private function getDiscussionName($id) {
            $discussionname = App\Discussion::select('name')->where('id', $id)->first();
            return $discussionname;
        }

        static public function getAllDiscussion()
        {
            $discussions = App\Discussion::all();
            return $discussions;
        }

        static public function getAllSocietyDicussion($society_id)
        {
            $discussions = App\Discussion::where('society_id', $society_id)->get();
            return $discussions;
        }

        static public function getNewestSocDiscussion($society_id) {
            $discussion = App\Discussion::where('society_id', $societyid)->orderBy('year', 'desc')
                            ->orderBy('quarter','desc')->first();
            return $discussion;
        }

        static public function sortSocDiscussion($society_id, $ascdesc)
        {
            $discussions = App\Discussion::where('society_id', $societyid)->orderBy('year', $ascdesc)
                            ->orderBy('quarter', $ascdesc)->get();
            return $discussions;
        }
    }