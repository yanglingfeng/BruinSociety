<<<<<<< HEAD
<?php

    use App\Post;

    // This class wraps up the posts table by providing different methods of accessing the table.
    class PostWrapper
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

        //These will return all posts belonging to a society, sorted by title
        //These might also not be used depending on our implementation decision
        static public function sortSocPostByTitleAsc($society_id)
        {
            $posts = App\Post::where('society_id', $society_id)->orderBy('title', 'asc')->get();
            return $posts;
        }

        static public function sortSocPostByTitleDesc($society_id)
        {
            $posts = App\Post::where('society_id', $society_id)->orderBy('title', 'desc')->get();
            return $posts;
        }

        //These will return all posts belonging to a disc, sorted by title
        static public function sortDiscPostByTitleAsc($discussion_id)
        {
            $posts = App\Post::where('discussion_id', $discussion_id)->orderBy('title', 'asc')->get();
            return $posts;
        }

        static public function sortDiscPostByTitleDesc($discussion_id)
        {
            $posts = App\Post::where('discussion_id', $discussion_id)->orderBy('title', 'desc')->get();
            return $posts;
        }

        //These will return all posts belonging to a disc, sorted by creation date
        static public function sortSocPostByNewest($discussion_id)
        {
            $posts = App\Post::where('discussion_id', $discussion_id)->orderBy('created_at', 'desc')->get();
            return $posts;
        }

        static public function sortSocPostByOldest($discussion_id)
        {
            $posts = App\Post::where('discussion_id', $discussion_id)->orderBy('created_at', 'asc')->get();
            return $posts;
        }

=======
<?php

    use App\Post;

    // This class wraps up the posts table by providing different methods of accessing the table.
    class PostWrapper
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

        //These will return all posts belonging to a society, sorted by title
        //These might also not be used depending on our implementation decision
        static public function sortSocPostByTitleAsc($society_id)
        {
            $posts = App\Post::where('society_id', $society_id)->orderBy('title', 'asc')->get();
            return $posts;
        }

        static public function sortSocPostByTitleDesc($society_id)
        {
            $posts = App\Post::where('society_id', $society_id)->orderBy('title', 'desc')->get();
            return $posts;
        }

        //These will return all posts belonging to a disc, sorted by title
        static public function sortDiscPostByTitleAsc($discussion_id)
        {
            $posts = App\Post::where('discussion_id', $discussion_id)->orderBy('title', 'asc')->get();
            return $posts;
        }

        static public function sortDiscPostByTitleDesc($discussion_id)
        {
            $posts = App\Post::where('discussion_id', $discussion_id)->orderBy('title', 'desc')->get();
            return $posts;
        }

        //These will return all posts belonging to a disc, sorted by creation date
        static public function sortSocPostByNewest($discussion_id)
        {
            $posts = App\Post::where('discussion_id', $discussion_id)->orderBy('created_at', 'desc')->get();
            return $posts;
        }

        static public function sortSocPostByOldest($discussion_id)
        {
            $posts = App\Post::where('discussion_id', $discussion_id)->orderBy('created_at', 'asc')->get();
            return $posts;
        }

>>>>>>> 3a24549653c0266377ea193f3c388d887614b737
    }