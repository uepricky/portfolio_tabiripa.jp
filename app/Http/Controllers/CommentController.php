<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $data = $request;

        $comment= new Comment;
        $comment->post_main_id = $data['postMainId'];
        $comment->user_id = $data['userId'];
        $comment->content = $data['comment'];
        $comment->save();

        $post_user_id = Post::where('post_main_id', $data['postMainId'])->value('user_id');
        $post_name = User::where('id', $post_user_id)->value('name');
        $data['postUser'] = $post_name;
        return $data;
    }

    public function destroy(Request $request)
    {
        $data = $request;

        $comment = Comment::where('post_main_id', $data['postMainId'])
                    ->where('user_id', $data['userId'])
                    ->where('content', $data['content'])
                    ->first();
        $comment->delete();
        return '削除成功';
    }
}
