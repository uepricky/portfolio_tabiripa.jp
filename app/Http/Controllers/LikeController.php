<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;

class LikeController extends Controller
{
    public function store(Request $request)
    {
        $data = $request;

        $like = new Like;
        $like->post_main_id = $data['postMainId'];
        $like->user_id = $data['userId'];
        $like->save();
        return "保存成功";
    }

    public function destroy(Request $request)
    {
        $data = $request;

        $like = Like::where('post_main_id', $data['postMainId'])
                    ->where('user_id', $data['userId'])
                    ->first();
        $like->delete();
        return '削除成功';
    }
}
