<?php

    use App\Post;

    // This class wraps up the posts table by providing different methods of accessing the table.
    class PostWrapper
    {
        //This function is used to create a post in a discussion
        static public function createPost($title, $content, $has_link, $link, $society_id, $discussion_id, $poster_id, $poster_name)
        {
            $post = new Post();
            $post->title = $title;
            $post->content = $content;
            $post->has_link = $has_link;
            $post->link = $link;
            $post->discussion_id = $discussion_id;
            $post->user_id = $poster_id;
            $post->user_name = $poster_name;
            $post->save();

            return $post;
        }

        //This function returns a post from its id
        static public function getPostFromId($post_id)
        {
            $post = App\Post::where('post_id', $post_id)->first();
            return $post;
        }

        //This function returns all posts belonging to a society
        static private function getPostFromSociety($society_id) {
            $posts = App\Post::where('society_id', $society_id)->get();
            return $posts;
        }

        //This function returns all posts belonging to a discussion
        static private function getPostFromDiscussion($discussion_id) {
            $posts = App\Post::where('discussion_id', $discussion_id)->get();
            return $posts;
        }

        //This function returns all posts with inserted title
        static private function getPostFromTitle($title) {
            $posts = App\Post::where('title', $title)->get();
            return $posts;
        }

        //This function return all posts in the database
        static public function getAllPost()
        {
            $posts = App\Post::all();
            return $posts;
        }

        //This will return all posts sorted by title
        static public function sortPostByTitle()
        {
            $posts = App\Post::orderBy('title')->get();
            return $posts;
        }

        //These will return all posts belonging to a society, sorted by title
        static public function sortSocPostByTitleAsc($society_id, $ascdesc)
        {
            $posts = App\Post::where('society_id', $society_id)->orderBy('title', $ascdesc)->get();
            return $posts;
        }

        //These will return all posts belonging to a disc, sorted by title
        static public function sortDiscPostByTitleAsc($discussion_id, $ascdesc)
        {
            $posts = App\Post::where('discussion_id', $discussion_id)->orderBy('title', $ascdesc)->get();
            return $posts;
        }

        //These will return all posts belonging to a disc, sorted by update time
        static public function sortDiscPostByUpdateTime($discussion_id, $ascdesc)
        {
            $posts = App\Post::where('discussion_id', $discussion_id)->orderBy('updated_at', $ascdesc)->get();
            return $posts;
        }

        //These will return all posts belonging to a disc, sorted by creation time
        static public function sortSocPostByCreateTime($discussion_id, $ascdesc)
        {
            $posts = App\Post::where('discussion_id', $discussion_id)->orderBy('created_at', $ascdesc)->get();
            return $posts;
        }

        static public function updateUpdatedAt($post_id, $updated_at)
        {
            App\Post::where('post_id', $post_id)
                ->update(['updated_at'=>$updated_at]);
        }
    }