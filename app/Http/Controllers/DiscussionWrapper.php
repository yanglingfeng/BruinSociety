<?php

    use App\Discussion;

    // This class wraps up the discussions table by providing different methods of accessing the table.
    class SocietyWrapper
    {

        static public function createDiscussion($name, $society_id)
        {
                DB::table('discussions')->insert(
                    ['name' => $name, 'society_id' => $society_id]
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

        

    }