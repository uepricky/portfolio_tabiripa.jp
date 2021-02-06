@extends('post.layout')

@section('content')
    <div class="row">
        <div class="col-md-3">
        @php
            $totalCount = count($serchedMainPosts) + count($serchedSubPosts);
        @endphp
        <h1>検索結果：{{$totalCount}}件</h1>
        </div>
        <div class="col-md-6">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="" style="display: flex; flex-wrap: wrap;">
                    @if (!empty($serchedMainPosts[0]))
                        @foreach ($serchedMainPosts as $serchedMainPost)
                            <div class="col-xs-12 popularityPost" style="width: 60%;">
                                <div class="card">
                                    <a class="img-card" href="{{ route('postShow', ['post_id' => $serchedMainPost->post_main_id]) }}">
                                        <div class="subImg">
                                            <img src="{{asset('storage/postedImages/'.$serchedMainPost->photo)}}" style="width: 100%;"/>
                                        </div>
                                    </a>
                                    <p></p>
                                    <div class="card-content">
                                        <h5 class="card-title">
                                            <a href="{{ route('postShow', ['post_id' => $serchedMainPost->post_main_id]) }}">
                                                {{ Str::limit($serchedMainPost->title, 58) }}
                                            </a>
                                        </h5>
                                        @if (mb_strlen($serchedMainPost->title) < 15)
                                            <br>
                                        @endif
                                        <div style="display:flex; justify-content: space-between;">
                                            <div style="padding-bottom: 0rem">
                                                    <span style="float: left;">
                                                        @if (!empty($serchedMainPost->user_img_path))
                                                        <img src="{{$serchedMainPost->user_img_path}}" alt="{{$serchedMainPost->user_name}}" class="serch-user-img">
                                                        @endif
                                                        <div>
                                                            {{ $serchedMainPost->user_name }}
                                                        </div>
                                                    </span>
                                                </div>
                                            <div>
                                                <small class="text-muted">{{$serchedMainPost->area}}</small>
                                            
                                                <div>
                                                    @php
                                                        $postDate = $serchedMainPost->created_at;
                                                        $showPostDate = substr($postDate, 0, strlen($postDate)-9);
                                                    @endphp
                                                    <small class="text-muted">{{$showPostDate}}</small>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="card-read-more">
                                        <a href="{{ route('postShow', ['post_id' => $serchedMainPost->post_main_id]) }}" class="btn btn-link btn-block">
                                            もっと見る
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="" style="display: flex; flex-wrap: wrap;">
                    @if (!empty($serchedSubPosts[0]))
                        @foreach ($serchedSubPosts as $serchedSubPost)
                            <div class="col-xs-12 popularityPost" style="width: 60%;">
                                <div class="card">
                                    <a class="img-card" href="{{ route('postShow', ['post_id' => $serchedSubPost->post_main_id]) }}">
                                        <div class="subImg">
                                            <img src="{{asset('storage/postedImages/'.$serchedSubPost->photo)}}" style="width: 100%;"/>
                                        </div>
                                    </a>
                                    <p></p>
                                    <div class="card-content">
                                        <h5 class="card-title">
                                            <a href="{{ route('postShow', ['post_id' => $serchedSubPost->post_main_id]) }}">
                                                {{ Str::limit($serchedSubPost->comment, 58) }}
                                            </a>
                                        </h5>
                                        @if (mb_strlen($serchedSubPost->comment) < 15)
                                            <br>
                                        @endif
                                        <div style="display:flex; justify-content: space-between;">
                                            <div style="padding-bottom: 0rem">
                                                <span style="float: left;">
                                                    @if (!empty($serchedSubPost->user_img_path))
                                                    <img src="{{$serchedSubPost->user_img_path}}" alt="{{$serchedSubPost->user_name}}" class="serch-user-img">
                                                    @endif
                                                    <div>
                                                        {{ $serchedSubPost->user_name }}
                                                    </div>
                                                </span>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="card-read-more">
                                        <a href="{{ route('postShow', ['post_id' => $serchedSubPost->post_main_id]) }}" class="btn btn-link btn-block">
                                            もっと見る
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

        </div>
        <div class="col-md-3">
            @include('post.search')
        </div>
    </div>
</div>

<style>
    .serch-user-img {
        width: 2.5rem;
        height: 2.5rem;
        border-radius: 50%;
    }
</style>

@endsection
 