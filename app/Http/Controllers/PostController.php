<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Sub_post;
use App\Models\Tag_map;
use App\Models\ImageFactory;
use Illuminate\Http\Request;
use App\Models\Budget;
use App\Models\Term;
use App\Models\tag;
use App\Models\Area;
use App\Models\Like;
use App\Models\Comment;
use App\Models\Favorite;
use App\Models\User;

class PostController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth')->except(['index','show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Post $post, Term $term, Area $area, Like $like)
    {
        $postsOrderByLatest = Post::latest()->get(); // 新着順

        /**
         * 人気順取得(monthly)
         */
        // １ヶ月以内のLikeを取得
        $monthAge = date("Y-m-d H:i:s",strtotime("-1 month"));
        $likes =  Like::where('created_at', '>', $monthAge)->get();
        $postsOrderByPopularity = [];
        if (!empty($likes[0])) {
            // 配列にpost_main_idを格納
            for ($i=0; $i < count($likes); $i++) {
                $postsIdArr[] = $likes[$i]['post_main_id'];
            }
            // それぞれの個数チェック
            // Keyがid
            $likeNumArrVluIsNum = array_count_values($postsIdArr);
            // keyがnum
            
            // いいねの数が多い順にpostIdを配列に追加
            $postIdsOrderByLikeNum = [];
            $i = 0;
            foreach ($likeNumArrVluIsNum as $id => $num) {
                // １回目だけ普通に追加
                if ($i === 0) {
                    $postIdsOrderByLikeNum[] = $id;
                } else {
                    // ２回目以降は、配列のそれぞれのnumを大きさを比較しながら、idを挿入
                    $k = 0;
                    $insertSuccessFlag = false;
                    foreach ($postIdsOrderByLikeNum as $postIdOrderByLikeNum) {
                        if ($num >= $likeNumArrVluIsNum[$postIdOrderByLikeNum]) {
                            array_splice($postIdsOrderByLikeNum, $k, 0, $id);
                            $insertSuccessFlag = true;
                            continue 2;
                        }
                        $k++;
                    }
                    // $postIdsOrderByLikeNum配列内で、最小の場合は、上の条件に一致しないので、最後に追加する。
                    if ( $insertSuccessFlag === false) {
                        array_push($postIdsOrderByLikeNum, $id);
                    }
                }
                $i++;
                // 何個取得するか
                if ($i > 12) {
                    break;
                }
            }

            $postsOrderByPopularity = [];
            for ($i=0; $i < count($postIdsOrderByLikeNum) ; $i++) { 
                $postsOrderByPopularity[] = Post::where('post_main_id', $postIdsOrderByLikeNum[$i])->get();
                
            }
        }

        $posts = Post::latest()->get(); // 新着順
        
        for ($i = 0; $i < count($posts); $i++) {
            $term_id = $posts[$i]['term_id'];
            $terms[] = Term::where('id', $term_id)->value('term_name');
        }

        $tags = \DB::table('tags')->get();


        return view('post.index', [
                                    'postsOrderByLatest' => $postsOrderByLatest,
                                    'postsOrderByPopularity' => $postsOrderByPopularity,
                                    'posts' => $posts,
                                    'terms' => $terms,
                                    'tags' => $tags
                                    ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Tag $tag, Area $area)
    {
        $areas = \App\Models\Area::get();
        $tags = \App\Models\Tag::get();
        return view('post.create', ['tags' => $tags, 'areas' => $areas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /**
         * post_mainをDBへ保存
         */
        $ImageFactory = new ImageFactory;
        //画像を保存し、ファイル名を返す
        $imageName = $ImageFactory->storeImage($request->file('main_photo'));

        $post_main = new Post;
        $user = \Auth::user();
        //一意のpost_main_idを生成
        $post_main_id = $user->id.time();

        $post_main->post_main_id = $post_main_id;
        $post_main->user_id = $user->id;
        $post_main->title = $request->title;
        $post_main->area = $request->area;
        $post_main->impression = $request->impression;
        $post_main->budget_id = $request->budget;
        $post_main->photo = $imageName;
        $post_main->year = $request->year;
        $post_main->month = $request->month;
        $post_main->term_id = $request->term;
        $post_main->save();

        //tag情報を格納
        if (!empty($request->tag)) {
            $tagMap = new Tag_map;
            $tagMap->post_id = $post_main_id;
            $tagMap->tag_id = $request->tag;
            $tagMap->save();
        }

        /**
         * post_subをDBへ保存
         */

        $count = $request->totalCount + 1;
        for ($i=1; $i < $count ; $i++) {

            $delFlag = 'delFlag_'.$i;
            if ($request->$delFlag === "1") {
                continue;
            }

            if (!empty($request->file('sub_photo_'.$i))) {
                //画像を保存しファイル名を返す
                $imageName = $ImageFactory->storeImage($request->file('sub_photo_'.$i));
            } else {
                $imageName = "";
            }

            $comment = 'comment_'.$i;
            $tag = 'tag_'.$i;

            //一意のpost_sub_idを生成
            $post_sub_id = $user->id.time().$i;

            //DBへ格納
            $sub_post = new Sub_post;

            $sub_post->post_sub_id = $post_sub_id;
            $sub_post->post_main_id = $post_main_id;
            $sub_post->post_order = $i;

            if (!empty($request->$comment)) {
                $sub_post->comment = $request->$comment;
            }
            if (!empty($imageName)) {
                $sub_post->photo = $imageName;
            }

            $sub_post->save();

            //tag情報を格納
            if (!empty($request->$tag)) {
                $tagMap = new Tag_map;
                $tagMap->post_id = $post_sub_id;
                $tagMap->tag_id = $request->$tag;
                $tagMap->save();
            }
        }
        return redirect()->route('postShow', ['post_id' => $post_main_id]);//用調整
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($post_main_id, Budget $budget, Term $term, Sub_post $sub_post)
    {

        $post = Post::find($post_main_id);

        $budget_id = $post->budget_id;
        $budget = Budget::where('id',  $budget_id)->get();

        $term_id = $post->term_id;
        $term = Term::where('id', $term_id)->get();

        // sub_postsテーブル内の$post_main_idにマッチするレコードを全部取得して配列へ格納
        $sub_posts = Sub_post::findMany($post_main_id);

        // $post_main_idとマッチするtag_mapsテーブルのtag_idを取得して配列に格納、値がない場合はNullを
        // 本当は下のpost_sub_idで検索を$post_main_idの検索で一本化したかったけどなぜか検索できなくて現状二つに分けてます。
        $before_tag_maps[] = Tag_map::where('post_id',  $post_main_id)->get();
        if (!empty($before_tag_maps[0][0]['tag_id'])) {
            $koko = $before_tag_maps[0][0]['tag_id'];
            $tag_maps[] = $koko;
        } else {
            $tag_maps[] = "";
        }

        // post_sub_idのみを取得し、それとマッチするtag_mapsテーブルのtag_idを取得して配列へ格納
        foreach ($sub_posts as $sub_post) {
            if (!empty($sub_post['post_sub_id'])) {
            $post_sub_id = $sub_post->post_sub_id;
            $tag_id = Tag_map::where('post_id', $post_sub_id)->value('tag_id');
            $tag_maps[] = $tag_id;
            }
        }
        // tag_mapsテーブルのtag_idとマッチするtagsテーブルのtag_nameを取得し、$sub_posts配列へ格納
        $i = 0;
        foreach ($tag_maps as $tag_map) {
            if (!empty($tag_map)) {
                $tag = Tag::where('tag_id', $tag_map)->value('tag_name');
                if ($i == 0) {
                    $post['tag_name'] = $tag;
                } else {
                    $sub_posts[$i - 1]['tag_name'] = $tag;
                }
            }
            $i++;
        }

        /**
         * 同一エリアのポストを取得（サイドバー表示用）
         */
        $area = $post['area'];
        $postIdArr = [
            $post_main_id
        ];
        $sameAreaPosts = Post::whereNotIn('post_main_id', $postIdArr)
                            ->where('area', 'like', "%$area%")
                            ->get();

        /**
         * 人気順取得(monthly)
         */
        // １ヶ月以内のLikeを取得
        $monthAge = date("Y-m-d H:i:s",strtotime("-1 month"));
        $likes =  Like::where('created_at', '>', $monthAge)->get();
        $postsOrderByPopularity = [];
        if (!empty($likes[0])) {
            // 配列にpost_main_idを格納
            for ($i=0; $i < count($likes); $i++) {
                $postsIdArr[] = $likes[$i]['post_main_id'];
            }
            // それぞれの個数チェック
            // Keyがid
            $likeNumArrVluIsNum = array_count_values($postsIdArr);
            // いいねの数が多い順にpostIdを配列に追加
            $postIdsOrderByLikeNum = [];
            $i = 0;
            foreach ($likeNumArrVluIsNum as $id => $num) {
                // １回目だけ普通に追加
                if ($i === 0) {
                    $postIdsOrderByLikeNum[] = $id;
                } else {
                    // ２回目以降は、配列のそれぞれのnumを大きさを比較しながら、idを挿入
                    $k = 0;
                    $insertSuccessFlag = false;
                    foreach ($postIdsOrderByLikeNum as $postIdOrderByLikeNum) {
                        if ($num >= $likeNumArrVluIsNum[$postIdOrderByLikeNum]) {
                            array_splice($postIdsOrderByLikeNum, $k, 0, $id);
                            $insertSuccessFlag = true;
                            continue 2;
                        }
                        $k++;
                    }
                    // $postIdsOrderByLikeNum配列内で、最小の場合は、上の条件に一致しないので、最後に追加する。
                    if ( $insertSuccessFlag === false) {
                        array_push($postIdsOrderByLikeNum, $id);
                    }
                }
                $i++;
                // 何個取得するか
                if ($i > 12) {
                    break;
                }
            }

            $postsOrderByPopularity = [];
            for ($i=0; $i < count($postIdsOrderByLikeNum) ; $i++) { 
                $postsOrderByPopularity[] = Post::where('post_main_id', $postIdsOrderByLikeNum[$i])->get();
            }
        }
        

        /**
         * 
         */
        
        $user = \Auth::user();
        $likeFlag = "0";
        if ($user) {
            $login_user_id = $user->id;
            $likeExists = Like::where('post_main_id', $post_main_id)
                    ->where('user_id', $login_user_id)
                    ->exists();
            if ($likeExists) {
                $likeFlag = "1";
            }

        } else {
            $login_user_id = "";
        }
        $like_count = Like::where('post_main_id', $post_main_id)->count();
        $comments = Comment::where('post_main_id', $post_main_id)->get();
        $tags = \DB::table('tags')->get();

        $favoriteFlag = "0";
        if ($user) {
            $favoriteExists = Favorite::where('post_main_id', $post_main_id)
                    ->where('user_id', $login_user_id)
                    ->exists();
            if ($favoriteExists) {
                $favoriteFlag = "1";
            }

        } else {
            $login_user_id = "";
        }

        return view('post.show', [
                                    'post' => $post,
                                    'tag_maps' => $tag_maps,
                                    'budget' => $budget, 
                                    'term' => $term, 
                                    'sub_posts' => $sub_posts, 
                                    'login_user_id' => $login_user_id, 
                                    'likeFlag' => $likeFlag, 
                                    'like_count' => $like_count, 
                                    'comments' => $comments,
                                    'tags' => $tags, 
                                    'user' => $user,
                                    'sameAreaPosts' => $sameAreaPosts,
                                    'postsOrderByPopularity' => $postsOrderByPopularity,
                                    'favoriteFlag' => $favoriteFlag
                                ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post, $post_id)
    {
        $areas = \DB::table('areas')->get();
        $tags = \DB::table('tags')->get();
        $post = Post::find($post_id);
        $mainTagMap = Tag_map::where('post_id', $post_id)->first();
        $sub_posts = Sub_post::where('post_main_id', $post->post_main_id)->get();
        // 配列にsubPostの個数を追加
        $subPostCount = count($sub_posts);
        $subTagMaps = [];
        for ($i=0; $i < count($sub_posts); $i++) {
            $subTagMaps[] = Tag_map::where('post_id', $sub_posts[$i]['post_sub_id'])->first();
        }

        return view('post.edit')->with('areas', $areas)
                                ->with('tags', $tags)
                                ->with('post', $post)
                                ->with('mainTagMap', $mainTagMap)
                                ->with('sub_posts', $sub_posts)
                                ->with('subTagMaps', $subTagMaps)
                                ->with('subPostCount', $subPostCount);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //user情報取得
        $user = \Auth::user();
        if ($user) {
            $login_user_id = $user->id;
        } else {
            $login_user_id = "";
        }

        /**
         * post_mainをDBへ保存
         */
        //更新用過去データ準備
        $preMainId = $request->preMainId;
        $postMain = Post::find($preMainId);

        $ImageFactory = new ImageFactory;

        // 画像の投稿がある場合は、保存
        if (!empty($request->file('main_photo'))) {
            //画像を保存し、ファイル名を返す
            $imageName = $ImageFactory->storeImage($request->file('main_photo'));
            $postMain->photo = $imageName;
        }

        $postMain->title = $request->title;
        $postMain->area = $request->area;
        $postMain->impression = $request->impression;
        $postMain->budget_id = $request->budget;
        $postMain->year = $request->year;
        $postMain->month = $request->month;
        $postMain->term_id = $request->term;
        $postMain->save();
        //tag情報を格納 where('post_id', 'like', $post_sub_id)->value('tag_id');
        $tagMap = Tag_map::where('post_id', $preMainId)->first();
        $tagMap->tag_id = $request->tag;
        $tagMap->save();

        /**
         * post_subをDBへ保存
         */

        $count = $request->totalCount + 1;

        for ($i=1; $i < $count ; $i++) {
            //更新用$i番目過去データ準備
            $preSubPost = sub_Post::where('post_main_id', $preMainId)
            ->where('post_order', $i)
            ->first();

            //delFlagが立っていた場合は、削除
            $delFlag = 'delFlag_'.$i;
            if ($request->$delFlag === "1") {
                // 画像を削除
                if ($preSubPost['photo']) {
                    $pathdel = public_path('storage/postedImages/'. $preSubPost['photo']);
                    \File::delete($pathdel);
                }
                // tag_mapを削除
                tag_Map::where('post_id', $preSubPost['post_sub_id'])
                    ->delete();
                // sub_postを削除
                sub_post::where('post_sub_id', $preSubPost['post_sub_id'])
                    ->where('post_order', $i)
                    ->delete();
                continue;
            }

            //新たに登録用のレコード用意
            $subPost = new sub_Post;

            $comment = 'comment_'.$i;
            $tag = 'tag_'.$i;
            //一意のpost_sub_idを生成
            $post_sub_id = $user->id.time().$i;

            $subPost->post_sub_id = $post_sub_id;
            $subPost->post_main_id = $preMainId;
            $subPost->post_order = $i;

            //画像を保存
            if (!empty($request->file('sub_photo_'.$i))) { // 写真が更新された場合
                //画像を保存しファイル名を返す
                $imageName = $ImageFactory->storeImage($request->file('sub_photo_'.$i));
                $subPost->photo = $imageName;
                //旧写真削除
                if (!empty($preSubPost['photo'])) {
                    $pathdel = public_path('storage/postedImages/'. $preSubPost['photo']);
                    \File::delete($pathdel);
                }
            } elseif (!empty($preSubPost['photo'])) { // 写真が更新されない&元々画像があった場合
                $subPost->photo = $preSubPost['photo'];
            } else { // 写真が削除されている場合
                // 未実装
            }

            //コメントを保存
            if (!empty($request->$comment)) {
                $subPost->comment = $request->$comment;
            }
            $subPost->save();

            //tag情報を格納
            if (!empty($request->$tag)) {
                $tagMap = new Tag_map;
                $tagMap->post_id = $post_sub_id;
                $tagMap->tag_id = $request->$tag;
                $tagMap->save();
            }

            // 旧レコードを削除
            if (!empty($preSubPost['post_sub_id'])) {
                Tag_map::where('post_id', $preSubPost['post_sub_id'])
                    ->delete();
                sub_post::where('post_sub_id', $preSubPost['post_sub_id'])
                    ->where('post_order', $i)
                    ->delete();
            }
        }
        return redirect()->route('postShow', ['post_id' => $preMainId]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post, $post_main_id)
    {
        $post = Post::find($post_main_id);
        $sub_posts = Sub_post::findMany($post_main_id);

        $main_photo_name = $post->photo;
        $pathdel = public_path('storage/postedImages/'. $main_photo_name);
        \File::delete($pathdel);

        $main_tag_map = Tag_map::where('post_id', 'like', $post_main_id);
        $main_tag_map->delete();

        foreach ($sub_posts as $sub_post) {
            $post_sub_id = $sub_post->post_sub_id;
            $del_sub_photo = $sub_post->photo;

            $sub_tag_map = Tag_map::where('post_id', 'like', $post_sub_id);
            $sub_tag_map->delete();
        }

        foreach ($sub_posts as $sub_post) {
            $sub_photo_name = $sub_post->photo;
            $pathdel = public_path('storage/postedImages/'. $sub_photo_name);
            \File::delete($pathdel);

            $sub_post->delete();
        }

        $post->delete();
        return redirect('/posts');
    }

    /**
     * 検索機能
     */
    public function search(Request $request)
    {
        //　検索フォームが未入力だった場合
        if (empty($request->keyword)
            && empty($request->budget)
            && empty($request->term)
            && empty($request->month)
            && empty($request->tag)
        ) {
            $tags = \DB::table('tags')->get();

            return  view('post.search-result')->with('tags', $tags);
        }

        // 検索項目リスト
        $serchItemsListForMainPost = [];
        $serchItemsListForSubPost = [];
        $keyword = '';
        $budget = '';
        $term = '';
        $month = '';
        $tag = '';

        if (!empty($request->keyword)) {
            $keyword = '%'. $request->keyword . '%';
            $keyword = \DB::getPdo()->quote($keyword);
            $serchItemsListForMainPost[] = 'keyword';
            $serchItemsListForSubPost[] = 'keyword';
        }
        if (!empty($request->budget)) {
            $budget = \DB::getPdo()->quote($request->budget);
            $serchItemsListForMainPost[] = 'budget';
        }
        if (!empty($request->term)) {
            $term = \DB::getPdo()->quote($request->term);
            $serchItemsListForMainPost[] = 'term';
        }
        if (!empty($request->month)) {
            $month = \DB::getPdo()->quote($request->month);
            $serchItemsListForMainPost[] = 'month';
        }
        if (!empty($request->tag)) {
            $tag = \DB::getPdo()->quote($request->tag);
            $serchItemsListForMainPost[] = 'tag';
            $serchItemsListForSubPost[] = 'tag';
        }

        $serchItemsMapForMainPost = [
            'keyword' => "(title LIKE $keyword OR impression LIKE $keyword)",
            'budget' => "budget_id = $budget",
            'term' => "term_id = $term",
            'month' => "month = $month",
            'tag' => "tag_id = $tag"
        ];

        // メインポスト用検索クエリ作成
        // 初期化
        $queryArr = [];
        for ($i=0; $i < count($serchItemsListForMainPost) ; $i++) {
            $queryArr[] = $serchItemsMapForMainPost[$serchItemsListForMainPost[$i]];
        }
        $query = implode(' AND ', $queryArr);

        if (!empty($query)) {
            $serchedMainPosts = \DB::table('posts')
                            ->leftJoin('tag_maps', 'posts.post_main_id', '=', 'tag_maps.post_id')
                            ->whereRaw("$query")
                            ->get();
        } else {
            $serchedMainPosts = '';
        }

        // サブポスト用のクエリ作成
        $serchItemsMapForSubPost = [
            'keyword' => "comment LIKE $keyword",
            'tag' => "tag_id = $tag"
        ];
        // 初期化
        $queryArr = [];
        for ($i=0; $i < count($serchItemsListForSubPost) ; $i++) {
            $queryArr[] = $serchItemsMapForSubPost[$serchItemsListForSubPost[$i]];
        }
        $query = implode(' AND ', $queryArr);

        if (!empty($query)) {
            $serchedSubPosts = \DB::table('sub_posts')
            ->leftJoin('tag_maps', 'sub_posts.post_sub_id', '=', 'tag_maps.post_id')
            ->whereRaw("$query")
            ->get();
        } else {
            $serchedSubPosts = '';
        }
       

        $tags = \DB::table('tags')->get();

        $i = 0;
        foreach ($serchedMainPosts as $serchedMainPost) {
            $user[$i] = User::where('id', $serchedMainPost->user_id)->first();
            $serchedMainPosts[$i]->user_img_path = $user[$i]->profile_photo_url;
            $serchedMainPosts[$i]->user_name = $user[$i]->name;
            $i++;
        }

        $k = 0;
        foreach ($serchedSubPosts as $serchedSubPost) {
            $beforeSub_user = Post::where('post_main_id', $serchedSubPost->post_main_id)->value('user_id');
            $sub_user[$i] = User::where('id', $beforeSub_user)->first();
            $serchedSubPosts[$i]->user_img_path = $sub_user[$i]->profile_photo_url;
            $serchedSubPosts[$i]->user_name = $sub_user[$i]->name;
            $i++;
        }
        
        return view('post.search-result', [
            'tags' => $tags,
            'serchedMainPosts' => $serchedMainPosts,
            'serchedSubPosts' => $serchedSubPosts,
        ]);
    }
}
