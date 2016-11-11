<?php

    use App\Comments;

    class CommentWrapper {

        // Only one kind of sorting is required for comments (sort by creation time).
        // Thus, we only provide one funtion for getting comments
        static public function getCommentsForPost($post_id)
        {
            $comments = App\Comment::where('post_id', $post_id)->orderBy('created_at', 'asc')->get();
            return $comments;
        }

    }