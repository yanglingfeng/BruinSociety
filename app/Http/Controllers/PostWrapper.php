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

        static public function getAllPosts()
        {
            $discussions = App\Post::all();
            return $discussions;
        }  

    }