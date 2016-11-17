<?php

    use App\Comment;

    class CommentWrapper {

        // Only one kind of sorting is required for comments (sort by creation time).
        // Thus, we only provide one funtion for getting comments
        static public function getCommentsForPost($post_id)
        {
            $comments = App\Comment::where('post_id', $post_id)->orderBy('created_at', 'desc')->get();
            return $comments;
        }

        static public function postComment($post_id, $commenter_id, $commenter_name, $content)
        {
            $comment = new Comment();
            $comment->post_id = $post_id;
            $comment->commenter_id = $commenter_id;
            $comment->commenter_name = $commenter_name;
            $comment->content = $content;
            $comment->save();
            return $comment;
        }

    }