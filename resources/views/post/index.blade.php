@extends('post.layout')

@section('content')

<div class="container-fluid px-0">
    <div class="row">
        <div  id="left_side" class="col-md-2" style="">

        </div>
        <div id="center_col" class="col-md-8">
            <h1 class="latest-post">新着の投稿</h1>
            @php
                $count = count($posts);
            @endphp
            <ul class="list px-0">
                @for($i = 0; $i < $count; $i++)
                    <li class="card mb-3 showPost">
                        <a href="{{ route('postShow', ['post_id' => $posts[$i]->post_main_id]) }}"  style="text-decoration: none;">
                            <div>
                                <img class="bd-placeholder-img card-img-top" style="width: 100%;" src="{{asset('storage/postedImages/'.$posts[$i]->photo)}}" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Image cap">
                                <span class="main-post-title">{{$posts[$i]->title}}</span>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">{{ Str::limit($posts[$i]->impression, 198) }}</h5>
                                <div class="main-post-flex">
                                    <div>
                                        <p class="card-text">{{ $posts[$i]->area }}</p>
                                        <p class="card-text">{{ $terms[$i] }}</p>
                                    </div>

                                    <div>
                                        <span class="mt-2" x-show="! photoPreview">
                                            <img src="{{ $posts[$i]->user->profile_photo_url }}" alt="{{ $posts[$i]->user->name }}" class="rounded-full h-8 w-8 object-cover main-user-img">
                                        </span>
                                        <span>{{$posts[$i]->user->name}}</span>
                                    </div>
                                </div>
                                <div>
                                    @php
                                        $postDate = $posts[$i]->created_at;
                                        $showPostDate = substr($postDate, 0, strlen($postDate)-9);
                                    @endphp
                                    <small class="text-muted">{{$showPostDate}}</small>
                                </div>
                            </div>
                        </a>
                    </li>
                @endfor
            </ul>

            <div class="more-btn" id="more">
                <button>もっとみる</button>
            </div>
            @if (!empty($postsOrderByPopularity))
                <div class="row" style="width: 100%;">
                    <div class="col-md-12">
                        <h4>人気の投稿</h4>
                    </div>
                </div>

                <div class="row">
                    <section class="wrapper">
                        <div class="container-fostrap">
                            <div class="content">
                                <div class="container">
                                    <div class="row" style="display: flex;">
                                        @for ($i = 0; $i < count($postsOrderByPopularity) ; $i++)
                                            <div class="col-xs-12 col-sm-4 popularityPost">
                                                <div class="card">
                                                    <a class="img-card" href="{{ route('postShow', ['post_id' => $postsOrderByPopularity[$i][0]->post_main_id]) }}">
                                                        <div class="subImg">
                                                            <img src="{{asset('storage/postedImages/'.$postsOrderByPopularity[$i][0]->photo)}}" />
                                                        </div>
                                                    </a>
                                                    <p></p>
                                                    <div class="card-content">
                                                        <h5 class="card-title">
                                                            <a href="{{ route('postShow', ['post_id' => $postsOrderByPopularity[$i][0]->post_main_id]) }}">
                                                                {{ Str::limit($postsOrderByPopularity[$i][0]->title, 58) }}
                                                            </a>
                                                        </h5>
                                                        @if (mb_strlen($postsOrderByPopularity[$i][0]->title) < 15)
                                                            <br>
                                                        @endif
                                                        <div style="padding-bottom: 0rem">
                                                            <span style="float: left;">
                                                                <img src="{{$postsOrderByPopularity[$i][0]->user->profile_photo_url}}" alt="{{$postsOrderByPopularity[$i][0]->user->name}}" class="popularity-user-img">
                                                                <p>
                                                                    {{ $postsOrderByPopularity[$i][0]->user->name }}
                                                                </p>
                                                            </span>
                                                        </div>
                                                        <div>
                                                            <small class="text-muted">{{$postsOrderByPopularity[$i][0]->area}}</small>
                                                        </div>
                                                        <div>
                                                            @php
                                                                $postDate = $postsOrderByPopularity[$i][0]->created_at;
                                                                $showPostDate = substr($postDate, 0, strlen($postDate)-9);
                                                            @endphp
                                                            <small class="text-muted">{{$showPostDate}}</small>
                                                        </div>
                                                    </div>
                                                    <div class="card-read-more">
                                                        <a href="{{ route('postShow', ['post_id' => $postsOrderByPopularity[$i][0]->post_main_id]) }}" class="btn btn-link btn-block">
                                                            もっと見る
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            @endif
        </div>

        <div id="right_side" class="col-md-2 px-0" style="">
           <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        @include('post.search')
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

    <style type="text/css">
    #center_col {
        background-color: white;
    }
    .showPost {
        width: 18rem;
        margin: 1rem;
        width: 60%;
        margin: 0 auto;
    }
    .showPost:hover {
        opacity: 0.8;
    }
    .latest-post {
        text-align: center;
    }
    .card {
        display: block;
        margin-bottom: 20px;
        line-height: 1.42857143;
        background-color: #fff;
        border-radius: 2px;
        box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12);
        transition: box-shadow .25s;
    }
    .card:hover {
        box-shadow: 0 8px 17px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    }
    .main-post-title {
        font-size: 1.3rem;
        width: 50%;
        padding: 5% 1%;
    }
    .subImg {
        display: inline-block;
        width: 100%;
        height: 200px;
    }
    .subImg img{
        width: 100%;
        height: 100%;
    }
    .card-title {
        line-height: 1.2;
        font-size: 1em;
    }
    .main-post-flex {
        display: flex;
        justify-content: space-between;
    }
    .main-user-img {
        width: 2.5rem;
        height: 2.5rem;
        margin: 10px;
        object-fit: cover;
        border-radius: 50%;
    }
    .popularity-user-img {
        width: 2.5rem;
        height: 2.5rem;
        border-radius: 50%;
    }
    .text-muted {
        display: block;
        text-align: right;
    }
    .card-read-more {
        border-top: 1px solid #D4D4D4;
    }
    .card-read-more a {
        text-decoration: none !important;
        padding:10px;
        font-weight:600;
        text-transform: uppercase
    }
    .more-btn {
        text-align: center;
    }
    #more button{
        background-color: #C691A5;
        padding: 1%;
        border-radius: 30px;
        color: #4C4C4C;
    }
    @media screen and (max-width:1100px){
        .showPost {
            width: 90%;
        }
        .popularityPost {
            width: 90%;
            margin: 0 auto;
        }
    }
</style>

<script>
var listContents = $(".list li").length;
  $(".list").each(function(){
    // Num は、デフォルトで表示しておくcardの枚数
    var Num = 5,
        gtNum = Num-1;
    $(this).find('#more').show();
    $(this).find('#closeBtn').hide();
    $(this).find("li:not(:lt("+Num+"))").hide();

    $('#more').click(function(){
        // Num += で、もっと見るボタンが押されたときに追加で表示する枚数
        Num += 5;
        $(this).parent().find("li:lt("+Num+")").slideDown();
        console.log(Num);
        if(listContents <= Num){
            $('#more').hide();

            $('#closeBtn').show();
            
            $('#closeBtn').click(function(){
                console.log(Num);
                $(this).parent().find("li:gt("+gtNum+")").slideUp();
                $(this).hide();
                $('#more').show();
                console.log(gtNum);
            });
        }
    });
  });
</script>
@endsection
