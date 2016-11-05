<?php
    // This class wraps up the society table by providing different methods of accessing the table.
class SocietyWrapper
    {

static public function joinSociety($user_id, $society_id) {
            $query = DB::table('user_society')
                ->where('user_id', $user_id)
                ->where('society_id', $society_id)
                ->get();
            
            if(!$query)
            {
                DB::table('user_society')->insert(
                    ['user_id' => $user_id, 'society_id' => $society_id]
                );  
            }
        }

static public function quitSociety($user_id, $society_id) {
            $query = DB::table('user_society')
                ->where('user_id', $user_id)
                ->where('society_id', $society_id)
                ->get();
            
            if($query)
            {
                DB::table('user_society')
                    ->where('user_id', $user_id)
                    ->where('society_id', $society_id)
                    ->delete();
            }
        }

        /**
        * This function returns a table with all the societies a user is in.
        * @param int $user_id
        * @return table a database table containing the societies the user is in
        */

static public function getSocietiesForUser($user_id) {
            $query = DB::table('user_society')
                        ->join('societies', 'user_society.society_id', '=', 'societies.id')
                        ->where('user_society.user_id', $user_id)
                        ->select('user_society.name')
                        ->get();

            return $query;
        }

static public function getAllSocieties() {
        $query = DB::table('societies')
                        ->select('name')
                        ->get();

        return $query;
        }
    }