<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function store(Request $request)
    {
        $data = $request;

        $favorite = new Favorite;
        $favorite->post_main_id = $data['postMainId'];
        $favorite->user_id = $data['userId'];
        $favorite->save();
        
        return "保存成功";
    }

    public function destroy(Request $request)
    {
        $data = $request;

        $favorite = Favorite::where('post_main_id', $data['postMainId'])
                    ->where('user_id', $data['userId'])
                    ->first();
        $favorite->delete();
        return '削除成功';
    }
}
