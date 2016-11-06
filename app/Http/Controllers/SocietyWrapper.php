<?php

    use App\Society;

    // This class wraps up the society table by providing different methods of accessing the table.
    class SocietyWrapper
    {

        static public function joinSociety($user_id, $society_id)
        {
            //$query = DB::table('user_society')
            //    ->where('user_id', $user_id)
            //    ->where('society_id', $society_id)
            //    ->get();
            
            //if(!$query)
            //{
                DB::table('user_society')->insert(
                    ['user_id' => $user_id, 'society_id' => $society_id]
                );  
            //}
        }

        static public function quitSociety($user_id, $society_id)
        {
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

        static public function getSocietiesForUser($user_id)
        {
            /**
            $societyids = DB::table('user_society')
                            ->where('user_id', $user_id)
                            ->get();

            if($societyids)
            {
                foreach($societyids as $id)
                {
                    $query2 = DB::table('societies')
                        ->where('id', $id)
                        ->pluck('name');
                }
            }
             */
            $user_society = App\UserSociety::where('user_id', $user_id)->get();
            return $user_society;
        }

        static public function getAllSocieties()
        {
            $societies = App\Society::all();
            return $societies;
        }

        static public function getSocietiesFromIds($society_ids) {
            $societies = array();
            foreach ($society_ids as $society_id) {
                //$id = $society_id->society_id;
                //$name = self::getSocietyName($id);
                //$societies[$id] = $name;
                //throw new ErrorException($name);
                $society = DB::table('societies')->where('id', $society_id->society_id)->first();
                array_push($societies, $society);
            }
            return $societies;
        }

        // Fix this method
        static private function getSocietyName($society_id) {
            $society = DB::table('societies')->where('id', $society_id)->first();
            $name = $society->name;
            //foreach ($societies as $society) {
            //    $name = $society->name;
            //}
            return $name;
        }

    }