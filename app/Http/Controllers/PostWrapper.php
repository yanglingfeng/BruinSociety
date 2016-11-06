<?php

    use App\Post;

    // This class wraps up the posts table by providing different methods of accessing the table.
    class SocietyWrapper
    {

        static public function createPost($title, $content, $has_link, $link, $society_id, $discussion_id)
        {
                DB::table('posts')->insert(
                    ['title' => $title, 'content' => $content, 'has_link' => $has_link,
                    'link' => $link, 'society_id' => $society_id, 'discussion_id' => $discussion_id]
                );  
        }

        static public function getPostFromId($post_id)
        {
            $post = App\Post::where('post_id', $post_id)->first();
            return $post;
        }

        static private function getPostFromSociety($society_id) {
            $posts = App\Post::where('society_id', $society_id)->get();
            return $posts;
        }

        static private function getPostFromDiscussion($discussion_id) {
            $posts = App\Post::where('discussion_id', $discussion_id)->get();
            return $posts;
        }

        static private function getPostFromTitle($title) {
            $posts = App\Post::where('title', $title)->get();
            return $posts;
        }

        static public function getAllPost()
        {
            $posts = App\Post::all();
            return $posts;
        }

        //This will return all posts sorted by title, will probably only be used for testing
        static public function sortPostByTitle()
        {
            $posts = App\Post::orderBy('title')->get();
            return $posts;
        }

        //This will return all posts belonging to a society, sorted by title
        static public function sortPostByTitleAsc($society_id)
        {
            $posts = App\Post::where('society_id', $society_id)->orderBy('title', 'asc')->get();
            return $posts;
        }

        static public function sortPostByTitleDesc($society_id)
        {
            $posts = App\Post::where('society_id', $society_id)->orderBy('title', 'desc')->get();
            return $posts;
        }

        //Need to find out
        static public function sortPostByTimeStap()
        {

        }

    }