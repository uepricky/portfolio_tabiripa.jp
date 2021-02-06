@extends('post.layout')

@section('content')
    <div class='container-fluid no-gutters' style="margin: 0 auto;">
        <div class="row" style="margin: 0 auto;">
            <div  id="left_side" class="col-md-3" style="">
                <section class="wrapper">
                    <div class="container-fostrap">
                        <div class="content">
                            <div class="container">
                                <div class="row">
                                    @foreach ($sameAreaPosts as $sameAreaPost)
                                        <div class="col-xs-12 col-sm-12">
                                            <div class="card">
                                                <a class="img-card" href="{{ route('postShow', ['post_id' => $sameAreaPost->post_main_id]) }}">
                                                    <img src="{{asset('storage/postedImages/'.$sameAreaPost->photo)}}" />
                                                </a>
                                                <div class="card-content">
                                                    <h5 class="card-title">
                                                        <a href="">{{ $sameAreaPost->title }}</a>
                                                    </h5>
                                                </div>
                                                <div class="card-read-more">
                                                    <a href="{{ route('postShow', ['post_id' => $sameAreaPost->post_main_id]) }}" class="btn btn-link btn-block">
                                                        もっと見る
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div id="center_col" class="col-md-6" style="background-color: white;">
                <div class="row no-gutters">
                    <div  id="main-title" class="col-md-12" style="margin: 2rem 0rem 2rem 0rem; border-bottom: solid 1px rgba(0,0,0,0.2);">
                        <span style="float:right;">
                            <img src="{{$post->user->profile_photo_url}}" alt="" style="width: 2.5rem; height: 2.5rem; border-radius: 50%;">
                            {{ $post->user->name }}
                        </span>
                        <div style="padding-left: 1.5rem">
                            <h3>{{ $post->title }}</h3>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin: 0 auto">
                    <div class="col-md-12">
                        <div class="row no-gutters">
                            <div class="col-md-12 no-gutters" style="position: relative">
                                <div class="row" style="">
                                    <div class="col-md-12" style="text-align: center">
                                        <img class="img-fluid mainImg" id="mainImg" src="{{asset('storage/postedImages/'.$post->photo)}}">
                                    </div>
                                </div>
                                <div class="row" style="position: absolute; bottom: 0;">
                                    <div class="col-md-12" style="">
                                        {{-- いいね --}}
                                        <button id="like" value={{$likeFlag}} class="btn btn-light">
                                            @if ($likeFlag == "0")
                                                <i class="far fa-heart" id = "icon-color"></i>
                                            @else
                                                <i class="current-color fas fa-heart" id = "icon-color"></i>
                                            @endif
                                            <span style="display: block;" id ="like-count">
                                                @if ($like_count != "0")
                                                    {{$like_count}}
                                                @endif
                                            </span>
                                        </button>
                                        {{-- コメント --}}
                                        <a href="#commentPlace">
                                            <button type="button" id="commentButton" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter">
                                                <i class="far fa-comment"></i>
                                            </button>
                                        </a>
                                        {{-- お気に入り保存 --}}
                                        <button class="btn btn-info" id="favorite" value={{$favoriteFlag}}>
                                            @if ($favoriteFlag == "0")
                                                <i class="fas fa-bookmark"></i>
                                            @else
                                                <i class="fas fa-check"></i>
                                            @endif
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 align-bottom">
                                <div class="card-body">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <th>旅の感想</th>
                                                <td><p class="card-text">{{ $post->impression }}</p></td>
                                            </tr>
                                            <tr>
                                                <th>都市</th>
                                                <td><p class="card-text">{{ $post->area }}</td>
                                            </tr>
                                            <tr>
                                                <th>年/月</th>
                                                <td><p class="card-text">{{ $post->year }}年/{{ $post->month }}月</p></p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>期間</th>
                                                <td><p class="card-text">{{ $post->term->term_name }}</p></td>
                                            </tr>
                                            <tr>
                                                <th>予算</th>
                                                <td><p class="card-text">{{ $post->budget->budget_name }}</p></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div style="">
                                        <p class="card-text"><small class="text-muted">{{ $post->created_at }}</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div>
                                    @auth
                                        @if($post->user_id === $login_user_id)
                                            <div class="btn btn-secondary" style="float: right">
                                                <a href={{ route('postEdit', ['post_id' => $post->post_main_id]) }}>編集</a>
                                            </div>
                                            <div style="float: right">
                                                {{ Form::open(['method' => 'delete', 'route' => ['postDestroy', $post->post_main_id]]) }}
                                                    {{ Form::submit('削除', ['class' => 'btn btn-outline-danger']) }}
                                                {{ Form::close() }}
                                            </div>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        </div>
                        <br>
                        <div style="float: right">
                            <a href="{{asset('storage/postedImages/'.$post->photo)}}" data-lightbox="group">
                                <button type="button" class="btn btn-dark">写真一覧</button>
                            </a>
                        </div>                        
                    </div>
                </div>
                @if (!empty($sub_posts))
                    <div class="row no-gutters" style="">
                        <div class="col-md-12 px-0">
                            <div style="margin: 2rem 0rem 2rem 0rem; border-bottom: solid 1px rgba(0,0,0,0.2)">
                                {{-- <h4>旅をみる</h4> --}}
                            </div>
                        </div>
                    </div>
                    @foreach ($sub_posts as $sub_post)
                        <div class="row no-gutters" style="padding: 1rem">
                            <div class="col-md-6 no-gutters">
                                @if (!empty($sub_post->photo))
                                    <div style="text-align: center">
                                        <img class="img-fluid subImg" src="{{asset('storage/postedImages/'.$sub_post->photo)}}">
                                    </div>
                                @endif
                                <?php
                                    $photos[] = $sub_post->photo;
                                ?>

                                <?php foreach($photos as $photo): ?>
                                <a href="{{asset('storage/postedImages/'.$photo)}}" data-lightbox="group"></a>
                                <?php endforeach; ?>
                            </div>
                            <div class="col-md-6 no-gutters" style="">
                                <div class="card-body">
                                    <h5 class="card-title"></h5>
                                    @if ($sub_post->tag_name)
                                        <p class="card-text">{{$sub_post->tag_name}}</p>
                                    @endif
                                    @if (!empty($sub_post->comment))
                                        <p class="card-text">{{$sub_post->comment}}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

                {{-- コメント表示箇所 --}}
                <?php $i = 1; ?>
                @foreach($comments as $value)
                    <div class="comment-area" id ="commentArea{{$i}}">
                        <span id={{$i}}>
                            <p style="border-bottom: solid 1px #CED4DA;">

                                <span class="mt-2" x-show="! photoPreview">
                                    <img src="{{$value->user->profile_photo_url}}" alt="{{$value->user->name}}" style="width: 2.5rem; height: 2.5rem; border-radius: 50%;" class="rounded-full h-8 w-8 object-cover icon2">
                                </span>
 
                                <span>{{ $value->user->name."さんから" }}</span>
                            </p>
                            <p style="color: #6C7592;">{{"---".$post->user->name."さんへ---"}}</p>
                            <p>{{ $value->content }}</p>
                            <div class="btn-right" style="text-align: right;">
                                <button class="btn btn-success"　id="" onclick="replyClk(this.value)" value={{$value->user->name}}>
                                    <span><i class="far fa-comments"></i></span>
                                </button>
                                <button class="btn btn-danger" id="{{$i}}" onclick="clk(this.id, this.value)" value={{$value['content']}}>
                                    <span><i class="fas fa-trash-alt" style="color: #000;"></i></span>
                                </button>
                            </div>
                        </span>
                    </div>
                    <?php $i++; ?>
                @endforeach

                <div id ="commentAreaJS"></div>

                <div class="form-group" id="commentPlace">
                    <label for="exampleFormControlTextarea1">感想をシェアしよう！</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="コメントを書く"></textarea>
                </div>

                <button type="button" class="btn btn-primary" style="float: right" id="submitComment">送信</button>
                {{-- コメント表示ここまで --}}

                @if (!empty($postsOrderByPopularity))
                    <div class="row">
                        <div class="col-md-12">
                            <h4>人気な旅先</h4>
                        </div>
                    </div>
                    <div class="row">
                        <section class="wrapper">
                            <div class="container-fostrap">
                                <div class="content">
                                    <div class="container">
                                        <div class="row">
                                            @for ($i = 0; $i < count($postsOrderByPopularity) ; $i++)
                                                <div class="col-xs-12 col-sm-6">
                                                    <div class="card">
                                                        <a class="img-card" href="{{ route('postShow', ['post_id' => $postsOrderByPopularity[$i][0]->post_main_id]) }}">
                                                            <img src="{{asset('storage/postedImages/'.$postsOrderByPopularity[$i][0]->photo)}}" />
                                                        </a>
                                                        <div class="card-content">
                                                            <h5 class="card-title">
                                                                <a href="{{ route('postShow', ['post_id' => $postsOrderByPopularity[$i][0]->post_main_id]) }}">
                                                                    {{ Str::limit($postsOrderByPopularity[$i][0]->title, 58) }}
                                                                </a>
                                                            </h5>
                                                            <div style="padding-bottom: 0rem">
                                                                <span style="float: left;">
                                                                    <img src="{{$postsOrderByPopularity[$i][0]->user->profile_photo_url}}" alt="" style="width: 2.5rem; height: 2.5rem; border-radius: 50%;">
                                                                    {{ $postsOrderByPopularity[$i][0]->user->name }}
                                                                </span>
                                                            </div>
                                                            <div style="text-align: right;">
                                                                <small class="text-muted">{{$postsOrderByPopularity[$i][0]->area}}</small>
                                                            </div>
                                                            <div style="text-align: right;">
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
            <div id="right_side" class="col-md-3" style="">
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


    <style>
        .mainImg{
            width: auto;
            opacity: 1;
            transition: 1s;
        }
        .subImg {
            width: auto;
            max-height: 20rem;
            opacity: 0;
            transition: 1s;
            margin-top: 60px;
        }
        .showUp{
            width: auto;
            opacity: 1;
            margin-top: 0;
        }
        table{
        width: 100%;
        border-collapse: collapse;
        }

        table tr{
        border-bottom: solid 2px white;
        }

        table tr:last-child{
        border-bottom: none;
        }

        table th{
        position: relative;
        text-align: left;
        width: 30%;
        background-color: #c691a5;
        color: white;
        text-align: center;
        padding: 10px 0;
        }

        /* table th:after{
        display: block;
        content: "";
        width: 0px;
        height: 0px;
        position: absolute;
        top:calc(50% - 10px);
        right:-10px;
        border-left: 10px solid rgba(0,0,0,0.3);
        border-top: 10px solid transparent;
        border-bottom: 10px solid transparent;
        } */

        table td{
        text-align: left;
        width: 70%;
        text-align: center;
        background-color: rgba(0,0,0,0.1);
        padding: 10px 4px;

        }
        #like{
            color: #000;
        }
        .current-color {
            color: red;
        }
        .comment-area {
            border: solid 1px #CED4DA;
            border-radius: 5px;
        }

          .icon2 {
        width: 48px;
        height: 48px;
        margin: 10px;
        border-radius: 24px;
        object-fit: cover;
    }
        @media (max-width: 600px) {
            #up-button{
                display: none;
            }
            #left_side{
                display: none;
            }
            #right_side{
                display: none;
            }
        }


        @import url(https://fonts.googleapis.com/css?family=Roboto:400,100,900);

 
.wrapper {
  display: table;
  width: 100%;
}

.container-fostrap {
  display: table-cell;
  padding: 1em;
  text-align: center;
  vertical-align: middle;
}
.fostrap-logo {
  width: 100px;
  margin-bottom:15px
}
h1.heading {
  color: #fff;
  font-size: 1.15em;
  font-weight: 900;
  margin: 0 0 0.5em;
  color: #505050;
}
@media (min-width: 450px) {
  h1.heading {
    font-size: 3.55em;
  }
}
@media (min-width: 760px) {
  h1.heading {
    font-size: 3.05em;
  }
}
@media (min-width: 900px) {
  h1.heading {
    font-size: 3.25em;
    margin: 0 0 0.3em;
  }
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
.img-card {
  width: 100%;
  height:200px;
  border-top-left-radius:2px;
  border-top-right-radius:2px;
  display:block;
    overflow: hidden;
}
.img-card img{
  width: 100%;
  height: 200px;
  object-fit:cover; 
  transition: all .25s ease;
} 
.card-content {
  padding:15px;
  text-align:left;
}
.card-title {
  margin-top:0px;
  font-weight: 500;
  font-size: 1em;
}
.card-title a {
  color: #000;
  text-decoration: none !important;
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

    </style>

    <script>
        $(function() {
            var block = $(".subImg");
            var Window = $(window);

            Window.scroll(function() {
                block.each(function() {
                    if (Window.scrollTop() > $(this).offset().top - Window.height()) {
                        $(this).addClass("showUp");
                    }
                });
            });
        });

       /**
        * 画像に合わせて、背景を自動生成
        */
        var img = document.getElementById('mainImg');
        img.addEventListener('load', function() {
            // divを追加
            for (let index = 0; index < 30; index++) {
                var newElement = document.createElement("div");
                newElement.setAttribute("class","maru");
                var marus = document.getElementById("marus");
                var maru1 = document.getElementById("maru1");
                marus.insertBefore(newElement, maru1.nextSibling);
            }

            //maruにcssを反映
            let marusArr = document.getElementsByClassName("maru");
            //top,left
            let screenWidth = screen.width;
            let screenHeight = screen.height;

            // color
            var vibrant = new Vibrant(img);
            var swatches = vibrant.swatches();

            var colors = [
                `${swatches['Vibrant'].getRgb()}`,
                `${swatches['Muted'].getRgb()}`,
                `${swatches['LightVibrant'].getRgb()}`,
                `${swatches['DarkVibrant'].getRgb()}`,
                `${swatches['DarkMuted'].getRgb()}`,
            ];

            for (let index = 0; index < marusArr.length; index++) {

                let color = colors[getRandomIntInclusive(0, 2)]; //0~4
                color = color.split(',');

                // radius
                let radius = getRandomIntInclusive(50, 400);

                //opacity
                let opacity = getRandomIntInclusive(4.5, 7);

                marusArr[index].style.cssText =
                `
                    top: ${getRandomIntInclusive(0, screenHeight)}px;
                    left: ${getRandomIntInclusive(0, screenWidth)}px;
                    height: ${radius}px;
                    width: ${radius}px;
                    background: rgba(${color[0]},${color[1]},${color[2]}, 0.${opacity});
                `;
            }

            /**
             * スマホの時にcal-md-10をcol-md-12にする
             */
            screenWidth = 300;
            if (screenWidth < 600) {
                $("#center_col").removeClass("col-md-10");
                $("#center_col").addClass("col-md-12");
            }

        });

        //ランダム整数
        function getRandomIntInclusive(min, max) {
            min = Math.ceil(min);
            max = Math.floor(max);
            return Math.floor(Math.random() * (max - min + 1) + min); //The maximum is inclusive and the minimum is inclusive
        };

        // いいね
        $(function(){
            $('#like').on('click', function(){
                @auth
                    var likeFlag = document.getElementById("like").value;

                    var data = {postMainId: `{{$post->post_main_id}}`, userId: `{{ Auth::id() }}`};
                    if (likeFlag === "0") {
                        console.log(likeFlag);
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: '/like',
                            type: 'POST',
                            data: data
                        })

                        .done((data) => {
                            //成功した場合の処理
                            console.log(data);
                            document.getElementById("like").value = "1";

                            var icon = document.getElementById("icon-color");
                            icon.classList.remove('far');
                            icon.classList.add('fas');
                            document.querySelector('#like').style.color = 'red'

                            var likeCount = '<?=$like_count?>';
                            likeCount++;
                            document.getElementById('like-count').textContent = likeCount;
                            location.reload();
                        })
                        .fail((data) => {
                            //失敗した場合の処理
                            console.log('fail');  //レスポンス文字列を表示
                        })

                    } else if (likeFlag === "1") {
                        console.log(likeFlag);
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: '/deletelike',
                            type: 'POST',
                            data: data
                        })
                        .done((data) => {
                            //成功した場合の処理
                            console.log(data);
                            document.getElementById("like").value = "0";

                            var icon = document.getElementById("icon-color");
                            icon.classList.remove('fas');
                            icon.classList.add('far');

                            document.querySelector('#like').style.color = 'black'

                            var likeCount = '<?=$like_count?>';
                            if (likeCount > "0") {
                                likeCount--;
                            }

                            if (likeCount == "0") {
                                likeCount = '';
                            }
                            document.getElementById('like-count').textContent = likeCount;
                            location.reload();
                        })
                        .fail((data) => {
                            //失敗した場合の処理
                            console.log('fail');  //レスポンス文字列を表示
                        })
                    } else {

                    }
                @endauth

                @guest

                @endguest
            });
        });
        // いいねここまで



        // コメント
        $(function(){
            $('#submitComment').on('click', function(){
                @auth
                var inputComment = document.getElementById('exampleFormControlTextarea1').value;
                var replyTo = document.getElementById('exampleFormControlTextarea1').placeholder;
                
                var data = {postMainId: `{{$post->post_main_id}}`, userId: `{{ Auth::id() }}`, comment: inputComment};

                $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: '/comment',
                            type: 'POST',
                            data: data
                        })
                        .done((data) => {
                            //取得したdivタグ(commentArea)にpタグを加える
                            var newElement = document.createElement("p");
                            var commentTo = document.createTextNode(data['postUser']);
                            var newContent = document.createTextNode(data['comment']);
                            newElement.appendChild(commentTo);
                            newElement.appendChild(newContent);
                            var parentDiv = document.getElementById('commentAreaJS');
                            parentDiv.appendChild(newElement);

                            document.getElementById('exampleFormControlTextarea1').value = '';
                            location.reload();
                        })
                        .fail((data) => {
                            //失敗した場合の処理
                            console.log('fail');  //レスポンス文字列を表示
                        })
                @endauth

                @guest

                @endguest
            });
        });
        // コメントここまで

        // コメント削除

        function clk(commentId, commentValue) {
            var inputDestroyComment = 'commentArea' + commentId;
            var destroyComment = document.getElementById(inputDestroyComment);
            // console.log(commentValue);
            destroyComment.remove();

            var data = {postMainId: `{{$post->post_main_id}}`, userId: `{{ Auth::id() }}`, content: commentValue};
            $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: '/deletecomment',
                            type: 'POST',
                            data: data
                        })

            .done((data) => {
                location.reload();
            })

            console.log(destroyComment);
        }
        // コメント削除ここまで

        // リプライ
        function replyClk(replyId) {
            var element = document.getElementById("exampleFormControlTextarea1");
            var newPlh = element.placeholder;
            newPlh = replyId + "さんへ返信";
            element.placeholder = newPlh;
        }
        
        // お気に入り保存
        $(function(){
            $('#favorite').on('click', function(){
                @auth
                    var favoriteFlag = document.getElementById("favorite").value;
                    var data = {postMainId: `{{$post->post_main_id}}`, userId: `{{ Auth::id() }}`};
                    if (favoriteFlag === "0") {
                        console.log("押された");
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: '/favorite',
                            type: 'POST',
                            data: data
                        })

                        .done((data) => {
                            //成功した場合の処理
                            console.log(data);
                            location.reload();
                        })
                        .fail((data) => {
                            //失敗した場合の処理
                            console.log('fail');  //レスポンス文字列を表示
                        })

                        } else if (favoriteFlag === "1") {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: '/deletefavorite',
                            type: 'POST',
                            data: data
                        })
                        .done((data) => {
                            //成功した場合の処理
                            console.log(data);
                            location.reload();
                        })
                        .fail((data) => {
                            //失敗した場合の処理
                            console.log('fail');  //レスポンス文字列を表示
                        })
                    } else {

                    }
                    
                @endauth

                @guest

                @endguest
            });
        });
        // お気に入り保存ここまで
    </script>
    <script src="{{ mix('js/vibrant.js') }}"></script>
@endsection
